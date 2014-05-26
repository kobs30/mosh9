<?
/*
* This file is part of the MOSH9 package.
*
* (c) Sergei Kovalov
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

function new_token() {
	return md5 ( uniqid ( microtime () ) . time () );
}


function setToken($permissions,$user=false) {
	$token = new_token();
	$user_id = ($user) ? $user : new_token();
	if ( _DEFAULT_EXP_TIME != 'endless' ) add_obj('tokens',array('token'=>$token,'exp_time'=>time()+_DEFAULT_EXP_TIME,'permissions'=>$permissions));
	else add_obj('tokens',array('token'=>$token,'exp_time'=>_DEFAULT_EXP_TIME,'permissions'=>$permissions,'user_id'=>$user_id));
	return $token;
}
/**
PERMISSIONS structure
array("method_name"=>'all',
	"method_name"=>array("required_parameters"=>'all',"allow_parameters"=>array("param_name"=>array("param_value",..),"param_name"=>'all',..),
	...
	);
**/

function check_permissions($param) {
	if (!isset($param['method'])) return array('error'=>'method missing');
	if (@$param['method'] == 'get_token' ) return true; 
	
	if (@$param['method'] == 'remove_item' ) return true; 

	if (@$param['token'] == __BACKDOOR__ ) return true;
	if (@$param['token'] == __ADMIN_TOKEN__ ) return true;
	
	if (isset($param['token']) ) $token_obj = getResult(get_obj('tokens',array('token'=>$param['token'])));
	else return array('error'=>'empty token');
	if (empty($token_obj)) return array('error'=>'token invalid');
	if ($token_obj[0]['exp_time']!='endless' && $token_obj[0]['exp_time']<time() ) {
		return array('error'=>'token expired');
	}
	
	if (!isset($token_obj[0]['permissions'][$param['method']])) {
		return array('error'=>'permissions error');
	} else {
		if (isset($token_obj[0]['permissions'][$param['method']]['required_param'])) {
			foreach($token_obj[0]['permissions'][$param['method']]['required_param'] as $param_name => $param_value) {
				if ( !isset($param[$param_name]) || ( $param[$param_name] != $param_value && $param_value != 'ALL' ) ) {
					return array('error'=>'permissions error');
				}
			}
		}
	}
	
	return true;
}

function ip_protection_set($method) {
	$param = array();
	$param['method'] = $method;
	$param['ip'] = $_SERVER['REMOTE_ADDR'];
	$param['request'] = $_REQUEST;
	add_obj('ip_protection_log',$param);
}

//=================== ip protection ==============
function ip_protection_get($method,$interval=3600) {
	$param = array();
	$param['method'] = $method;
	$param['ip'] = $_SERVER['REMOTE_ADDR'];
	$param['cr_time'] = array('$gte'=>(time() - $interval));
	return getResult(get_obj('ip_protection_log',$param));
}

function ip_protection_check($method,$interval=3600,$call_limit=3) {
	$res = ip_protection_get($method);
	$count = count($res);
	if ( $count <= ($call_limit+1) ) { ;
		return true;
	}
	else {
		return false;
	}
}

function ip_protection($method,$interval=3600,$call_limit=3) {
	$res = ip_protection_get($method);
	$count = count($res)+1;
	if ( $count <= ($call_limit+1) ) { ;
		ip_protection_set($method);
		return $count;
	}
	else {
		return false;
	}
}
//=================== / ip protection ==============

function SMTPmail($to,$subject,$message) {
	ini_set("SMTP","172.31.34.90");
	// ini_set("SMTP","ssl://smtp.gmail.com");
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = "172.31.34.90";
	// $mail->Host = "ssl://smtp.gmail.com";
	$mail->Port = 25;
	// $mail->Port = 465;
	$mail->setFrom('info@lazycoins.com', 'Lazycoins');
	$mail->Subject = $subject;
	$mail->msgHTML($message);
	$mail->AltBody = $message;
	$mail->addAddress($to);
	if (!$mail->send()) {
		return $mail->ErrorInfo;
	} else {
		return true;
	}
 }

function validate($param,$filter,$type='required') {
	$valid_param = array();
	$res = true;
	foreach($param as $k=>$p) {
		if (isset($filter[$k])){
			switch ($filter[$k]) {
				case 'int' : {
					$valid_param[$k] = (int)$p;
					break;
				}
			
				case 'float' : {
					$valid_param[$k] = round($p,8);
					break;
				}
			
				case 'string' : {
					$valid_param[$k] = (string)$p;
					break;
				}
				
				case 'float>0' : {
					$p = round($p,8);
					if ($p>0) $valid_param[$k] = $p;
					else $res = false;
					break;
				}				
			}
		}	
	}
	if ($type == 'required' && count($valid_param) != count($filter) ) return false; 
	if ($res) return $valid_param;
	else return $res;
}



function add_obj($collection_name,$_PARMAS=false) {
	global $db;
	if (!$_PARMAS) $_PARMAS = $_REQUEST;
	$collection = $db->$collection_name;
	$obj = Array();
	foreach ($_PARMAS as $k => $val) {
		if ($k == 'pass') $val = md5($val);
		$obj[$k] = $val;
	}
	$obj['cr_time'] = time();
	if (!isset($obj['internal_id'])) $obj['internal_id'] = uniqid();
	$collection->insert($obj);
	return $obj;
}

function get_obj($collection_name,$_PARMAS=false) {
	global $db;
	if ($_PARMAS===false) $_PARMAS = $_REQUEST;
	unset($_PARMAS["method"]);
	if ($collection_name != 'tokens') unset($_PARMAS["token"]);
	unset($_PARMAS["callback_function"]);
	unset($_PARMAS["callback_param"]);
	$collection = $db->$collection_name;
	$param = Array();
	foreach ($_PARMAS as $k => $val) {
		if ($k == 'pass') $val = md5($val);
		if ($k == '_id') $val = new MongoId($val);
		$param[$k] = $val;
	}
	$cursor = $collection->find($param);
	return $cursor;
}

function update_obj($collection_name,$_PARMAS=false) { 
	global $db;
	$cursor = array();
	if ($_PARMAS===false) $_PARMAS = $_REQUEST;
	$collection = $db->$collection_name;
	if (isset($_PARMAS['push'])) {
		$cursor = $collection->update($_PARMAS['criteria'],array('$push'=>$_PARMAS['push']));
	}		
	if (isset($_PARMAS['pull'])) {
		$cursor = $collection->update($_PARMAS['criteria'],array('$pull'=>$_PARMAS['pull']));
	}	
	if (isset($_PARMAS['set'])) {
		$cursor = $collection->update($_PARMAS['criteria'],array('$set'=>$_PARMAS['set']));
	}	
	if (isset($_PARMAS['Wset'])) {
		$cursor = $collection->update($_PARMAS['criteria'],array('$set'=>$_PARMAS['Wset']),array("w" => "AllDCs"));
	}	
	if (isset($_PARMAS['inc'])) {
		$cursor = $collection->update($_PARMAS['criteria'],array('$inc'=>$_PARMAS['inc']));
	}
	return $cursor; 
}

function getResult($cursor,$view_fields_permitions='ALL',$fields_permitions_mode=1) {
	$res = array ();
	$res_obg = new stdClass();
	if($cursor) {
		foreach ( $cursor as $obj ) {
			if ($view_fields_permitions=='ALL') {
				$res_obg = $obj;
			}
			else {
				$res_fields = array();
				foreach ($view_fields_permitions as $field) {
					
					if ($fields_permitions_mode==1) {
						if (isset($obj[$field])) $res_fields[$field] = $obj[$field];
					}
					if ($fields_permitions_mode==0) {
						unset($obj[$field]); 
					}
				}
				if ($fields_permitions_mode==0) $res_fields = $obj;
				$res_obg = $res_fields;
			}
			$res [] = $res_obg;
		} 
	}
	return $res;
}

function sendResult($cursor,$the_callback_function,$view_fields_permitions='ALL',$the_callback_param='',$fields_permitions_mode=1) {
	global $m;
	$res = array ();
	$res_obg = new stdClass();
	$res = (is_array($cursor)) ? $cursor : getResult($cursor,$view_fields_permitions,$fields_permitions_mode);
	$m->close ();
	$json_res = json_encode ( $res );
	$json_res = addslashes ( $json_res );
	
	$callback_param = ($the_callback_param) ? ",'".$the_callback_param."'" : ''; 
	
	if ( $the_callback_function ) {
		return htmlspecialchars ( $the_callback_function ) . "('{$json_res}'".$callback_param.")";
	} else	return json_encode ( $res );
}



