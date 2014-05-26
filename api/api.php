<?
/*
* This file is part of the MOSH9 package.
*
* (c) Sergei Kovalov
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

if (__DEBUG_MODE__ === true) {
 error_reporting(E_ALL);
 ini_set("display_errors", 1); 
}
include 'settings.php';
include 'functions.php';

if (__ACTIVE__ === false) die('system off');
if (__DEBUG_MODE__ === true) add_obj('log_requests',$_REQUEST);
unset($_REQUEST['_rnd']);

$token_permitions = check_permissions($_REQUEST);
if ( $token_permitions === false  ) die('permissions error');
if (is_array($token_permitions)) { 
	$callback_param = isset($_GET ['callback_param']) ? $_GET ['callback_param'] : false ;
	$callback = isset($_GET ['callback_function']) ? $_GET ['callback_function'] : false ;
	echo sendResult($token_permitions,$callback);  die(); 
} 


switch ($_REQUEST['method']) {
	case 'get_token' : {
		$user_id = (isset($_REQUEST['user_id'])) ? $_REQUEST['user_id'] : new_token();
		$permissions = array(
			'new_cart'=> array('required_param'=>array('user_id'=>$user_id)),
			'get_carts'=> array('required_param'=>array('user_id'=>$user_id)),
			'get_all_carts'=> array('required_param'=>array('user_id'=>$user_id)), // get_carts alias
			'get_items' => array('required_param'=>array('user_id'=>$user_id,'cart_id'=>'ALL')),
			'get_status' => array('required_param'=>array('user_id'=>$user_id,'cart_id'=>'ALL')),
			'add_item'=> array('required_param'=>array('user_id'=>$user_id,'cart_id'=>'ALL')),
			'remove_item'=> array('required_param'=>array('user_id'=>$user_id,'cart_id'=>'ALL','item_incart_internal_id'=>'ALL')),
			'get_products'=> array(),
		);
		$cursor = array();
		$cursor['token'] = setToken($permissions,$user_id);
		$cursor['user_id'] = $user_id;
	break;
	}

	case 'new_cart' : {
		$param = $_REQUEST;
		$param['cart_id'] = new_token();
		$param['items'] = array();
		$param['status'] = 'new';
		$cursor = array();
		$cursor['cart_id'] = $param['cart_id'];
		add_obj('carts',$param);
		if (isset($param['cart_name'])) $cursor['cart_name'] = $param['cart_name'];
		$cursor['callBack'] = $_REQUEST;
	break;
	}
	
	case 'get_all_carts' : {}  // get_carts alias
	case 'get_carts' : {
		$param = $_REQUEST;
		$cursor = get_obj('carts',$param);
	break;
	}	
	
	case 'get_items' : {
		$param = $_REQUEST;
		$view_fields_permitions = array('items');
		$cursor = get_obj('carts',$param);
	break;
	}	
	
	case 'get_status' : {
		$param = $_REQUEST;
		$view_fields_permitions = array('status');
		$cursor = get_obj('carts',$param);
	break;
	}
	
	case 'add_item' : {
		$param = $_REQUEST;
		$criteria = array();
		$criteria['cart_id'] = $param['cart_id'];
		$criteria['user_id'] = $param['user_id'];
		
		$items = $param;
		$internal_id = new_token();
		$items['item_incart_internal_id'] = new_token();
		update_obj('carts',array('criteria'=>$criteria,'push'=>array('items'  => $items)));
		$cursor = array(); 
		$cursor['item_incart_internal_id'] = $items['item_incart_internal_id'];
	break;
	}	

	case 'remove_item' : {
		$param = $_REQUEST;
		$criteria = array();
		$criteria['cart_id'] = $param['cart_id'];
		$criteria['user_id'] = $param['user_id'];
		$items = array();
		$items = $param['item_incart_internal_id'];
				
		$cursor = update_obj('carts',array('criteria'=>$criteria,'pull'=>array('items'=>array('item_incart_internal_id'=>$param['item_incart_internal_id']))));
	break;
	}	


	case 'update_status' : {
		$param = $_REQUEST;
		$criteria = array();
		$criteria['cart_id'] = $param['cart_id'];
		$criteria['user_id'] = $param['user_id'];
				
		$cursor = update_obj('carts',array('criteria'=>$criteria,'set'=>array('status'=>$param['status'])));
	break;
	}
	
// ================================================================================================================

	case 'get_categories_tree' : {
		$param = $_REQUEST;
		$cursor = get_obj('categories',$param);
	break;
	}
	
	case 'add_category' : {
		$param = $_REQUEST;
		$cursor = add_obj('categories',$param);	
	break;
	}
	
	case 'update_category' : {
	break;
	}
	
// ================================================================================================================

	case 'get_products' : {
		$param = $_REQUEST;
		$cursor = get_obj('products',$param);
		$view_fields_permitions = array('_id','token','method','callback_function','callback_param','cr_time');
		$fields_permitions_mode = 0;
	break;
	}
	
	case 'add_product' : {
		$param = $_REQUEST;
		if (isset($_FILES)) {
			$param['files'] = array();
			foreach($_FILES as $file) {
				if($file['error']==0) {
					$product_file_name = new_token().'_'.$file['name'];
					$param['files'][] = $product_file_name;
					move_uploaded_file($file['tmp_name'], __UPLOAD_FILE_DIR__.$product_file_name);
				}
			}
		}
		$cursor = add_obj('products',$param);
	break;
	}
	
	case 'update_product' : {
	break;
	}
	
// ================================================================================================================

	case 'get_admin_templates' : {
		$param = $_REQUEST;
		$cursor = get_obj('admin_templates',$param);
	break;
	}
	
	case 'add_admin_template' : {
		$param = $_REQUEST;
		$cursor = add_obj('admin_templates',$param);
	break;
	}
	
	default : {
		try {
		if (! @include ('methods/'.str_replace(array('.','..'),'',$_REQUEST['method']).'.php')) throw new Exception ('method not exist');
		} catch(Exception  $err) {
			$cursor = array();
			$cursor['error'] = $err->getMessage();
			$cursor['error_message'] = $_REQUEST['method'];
		}
	}

}

$view_fields_permitions = isset($view_fields_permitions) ? $view_fields_permitions : 'ALL';
$callback_param = isset($_REQUEST ['callback_param']) ? $_REQUEST ['callback_param'] : false ;
$callback = isset($_REQUEST ['callback_function']) ? $_REQUEST ['callback_function'] : false ;
if (!isset($fields_permitions_mode)) $fields_permitions_mode = 1;
// echo htmlspecialchars(sendResult($cursor,$callback,$view_fields_permitions,$callback_param,$fields_permitions_mode));
if (stristr($callback, '_iframe_')) echo "<script>parent.".sendResult($cursor,$callback,$view_fields_permitions,$callback_param,$fields_permitions_mode)."</script>";
else echo sendResult($cursor,$callback,$view_fields_permitions,$callback_param,$fields_permitions_mode);

?>