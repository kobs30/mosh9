/*
* This file is part of the MOSH9 package.
*
* (c) Sergei Kovalov
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
function _mosh_init(api_url,user_id,f){
			$_MOSH_API_URL = api_url;
			$_MOSH_TOKEN = '';
			$_MOSH_user_id = '';
			$_MOSH_cart_id = '';
			if (typeof f == 'function') $_INIT_ON = f;
			if (user_id) _mosh_new_token_and_cart(user_id);
			else _mosh_new_token_and_cart();
};

function _mosh_loadTemplate(_tmplt,Container,context,callBkF) {
	$_MOSH_CURRENT_TEMPLATE = _tmplt;
	var source   = $("#"+_tmplt+"-template").html();
	var html = Mustache.to_html(source,context);
	Container.html(html);
	if (typeof callBkF == 'function') callBkF();
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

function _mosh_w(thedata,callBack) {
	var data = $.parseJSON( thedata );
	if (data.error) _mosh_errorHandler(data);
	else window[callBack](data);
}

//==================================================================

function _mosh_get_products(callBack,param) {
	if (!param) param = {}; 
	_mosh_call_api('get_products',param,'_mosh_w',callBack);
}

function _mosh_get_carts(callBack,param) {
	if (!param) param = {'user_id':$_MOSH_user_id};
	else param.user_id = $_MOSH_user_id;
	_mosh_call_api('get_carts',param,'_mosh_w',callBack);	
}

function _mosh_setTokenAndUser(data,callBack) {
	$_MOSH_TOKEN = data.token;
	$_MOSH_user_id = data.user_id;
	if (callBack) window[callBack]();
	if (typeof $_INIT_ON == 'function') {
		$_INIT_ON();
		$_INIT_ON = 'DONE';
	}
}

function _mosh_new_token_and_cart(user_id) {
	var param = {};
	if (user_id) param.user_id = user_id;
	_mosh_call_api('get_token',param,'_mosh_w','_mosh_setTokenUserAddCart');
}

function _mosh_setTokenUserAddCart(data,callBack) {
	$_MOSH_TOKEN = data.token;
	$_MOSH_user_id = data.user_id;
	_mosh_new_cart(false,$_INIT_ON);
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
	if (typeof $_INIT_ON == 'function') {
		$_INIT_ON();
		$_INIT_ON = 'DONE';
	}
}

function _mosh_set_token(data) {
	$_MOSH_cart_id = data.cart_id;
	return data;
}

function _mosh_set_cart(data) {
	$_MOSH_cart_id = data.cart_id;
	return data;
}






