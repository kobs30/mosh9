/*
* This file is part of the MOSH9 package.
*
* (c) Sergei Kovalov
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

function _mosh_init(api_url,user_id){
			$_MOSH_API_URL = api_url;
			$_MOSH_TOKEN = '';
			$_MOSH_user_id = '';
			$_MOSH_cart_id = '';
			if (user_id) _mosh_new_token(user_id);
			else _mosh_new_token();
};

function _mosh_init_admin(api_url,admin_token){
			$_MOSH_API_URL = api_url;
			$_MOSH_TOKEN = admin_token;
};

function _mosh_loadTemplate(_tmplt,Container,context,callBkF) {
 try {
	$_MOSH_CURRENT_TEMPLATE = _tmplt;
	var source   = $("#"+_tmplt+"-template").html();
	var html = Mustache.to_html(source,context);
	Container.html(html);
	if (typeof callBkF == 'function') callBkF();
 } catch(e) { console.log('error '+e);  _mosh_loadTemplate('error',Container); }
}

function _mosh_call_api(method,param,callback,callbackparam) {
	console.log('in'+callbackparam);
	var parameters = '';
	if (typeof(param) === 'object') parameters = '&'+$.param(param);
	if (typeof(param) === 'string') parameters = '&'+param;			
	var callbackparameters = '';
	if (callbackparam) callbackparameters = '&callback_param='+String(callbackparam);
	var url = $_MOSH_API_URL+'?token='+$_MOSH_TOKEN+'&method='+method+'&callback_function=' + callback + parameters + callbackparameters;
	script = document.createElement("script");
	script.type = "text/javascript";
	script.src = url;
	document.body.appendChild(script);
}
function _mosh_call_post_api(method,form,callback,callbackparam) {
	if (!$('#_mosh_tmp_f_method').length) $(form).append('<input style="display:none;" id="_mosh_tmp_f_method" trype="text" name="method" value="'+method+'">');
	if (!$('#_mosh_tmp_f_callback').length) $(form).append('<input style="display:none;" trype="text" id="_mosh_tmp_f_callback"  name="callback_function" value="'+callback+'">');
	if (!$('#_mosh_tmp_f_callbackparam').length) $(form).append('<input style="display:none;" trype="text" id="_mosh_tmp_f_callbackparam"  name="callback_param" value="'+callbackparam+'">');
	if (!$('#_mosh_tmp_f_token').length) $(form).append('<input trype="text" style="display:none;" id="_mosh_tmp_f_token"  name="token" value="'+$_MOSH_TOKEN+'">');
	$(form).attr('action',$_MOSH_API_URL);
	$(form).attr('method','post');
	if (!$('#mosh_api_ifr').length) {
		var ifr = document.createElement("iframe");
		ifr.name = 'mosh_api_ifr';
		ifr.id = 'mosh_api_ifr';
		ifr.style.display = 'none';
		document.body.appendChild(ifr);
	}
	$(form).attr('target','mosh_api_ifr');
	console.log($(form));
	$(form).submit();
	return false;
}

function _mosh_w(thedata,callBack) {
	var data = $.parseJSON( thedata );
	if (data.error) _mosh_errorHandler(data);
	else window[callBack](data);
}

//==================================================================

function _mosh_get_products(category,callBack,user_id) {
	if (!user_id) user_id = $_MOSH_user_id; 
	_mosh_call_api('get_products',{'':category,'user_id' : user_id},'_mosh_w',callBack);
}

function _mosh_setTokenAndUser(data,callBack) {
	$_MOSH_TOKEN = data.token;
	$_MOSH_user_id = data.user_id;
	if (callBack) window[callBack]();
}


function _mosh_new_token(user_id) {
	var param = {};
	if (user_id) param.user_id = user_id;
	_mosh_call_api('get_token',param,'_mosh_w','_mosh_setTokenAndUser');
}

function _mosh_new_cart(user_id) {
	var param = {};
	if (user_id) param.user_id = user_id;
	else param.user_id = $_MOSH_user_id;
	_mosh_call_api('new_cart',param,'_mosh_w','_mosh_set_cart');
}

function _mosh_set_token(data) {
	$_MOSH_cart_id = data.cart_id;
	return data;
}

function _mosh_set_cart(data) {
	$_MOSH_cart_id = data.cart_id;
	return data;
}






