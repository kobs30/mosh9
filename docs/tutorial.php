<?
ini_set('error_reporting', E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="ico/favicon.png">	
	<script src="js/handlebars.js"></script>
    <title>MOSH9 dev. documentation</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
	body {
	  padding-top: 50px;
	}
	.starter-template {
	  padding: 40px 15px;
	  text-align: center;
	}
	.api-doc-section {
		border-bottom: 1px solid #EEEEEE;
		padding-bottom: 25px;	
	}
    </style>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery.min.js"></script>
    
	
<link href="http://alexgorbatchev.com/pub/sh/current/styles/shThemeDefault.css" rel="stylesheet" type="text/css" />
<script src="http://alexgorbatchev.com/pub/sh/current/scripts/shCore.js" type="text/javascript"></script>
<script src="http://alexgorbatchev.com/pub/sh/current/scripts/shAutoloader.js" type="text/javascript"></script>
		

	
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">MOSH9</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li data-tmpl="home" class="active"><a href="incl.php">Tutorial</a></li>
			<li data-tmpl="about" ><a href="index.php">API list</a></li>
          <!--  <li data-tmpl="about" ><a href="#create_wallet">Create Wallet</a></li>
            <li data-tmpl="contact"><a href="#recharge_wallet">Recharge Wallet</a></li>-->
          </ul> 
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div id="content" class="container">
	How to use MOSH9
<ul>
<li>
1.  Create html page with a form describing your product. You can add any field in this form like  product_id, product_specification, price etc. Include mosh.lib.js, jquery.js, jstorage.js and create initial function and form submit function. Place these functions into the jquery $(document).ready
<p>
File product_form.php

<pre><code class="jush-htm"><span class="jush"><span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/struct/global.html#edef-HTML">html</a><span class="jush-op">&gt;</span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/struct/global.html#edef-HEAD">head</a><span class="jush-op">&gt;</span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span>/head<span class="jush-op">&gt;</span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/struct/global.html#edef-BODY">body</a><span class="jush-op">&gt;</span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/forms.html#edef-FORM">form</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/struct/global.html#adef-class">class</a><span class="jush-att_quo"><span class="jush-op">="</span>addItemToCart<span class="jush-op">"</span></span></span><span class="jush-op">&gt;</span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/forms.html#edef-INPUT">input</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/forms.html#adef-type-INPUT">type</a><span class="jush-att_quo"><span class="jush-op">="</span>hidden<span class="jush-op">"</span></span></span><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/forms.html#adef-name-INPUT">name</a><span class="jush-att_quo"><span class="jush-op">="</span>product_id<span class="jush-op">"</span></span></span><span class="jush-op">&gt;</span></span>
Name <span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/forms.html#edef-INPUT">input</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/forms.html#adef-type-INPUT">type</a><span class="jush-att_quo"><span class="jush-op">="</span>text<span class="jush-op">"</span></span></span><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/forms.html#adef-name-INPUT">name</a><span class="jush-att_quo"><span class="jush-op">="</span>product_name<span class="jush-op">"</span></span></span><span class="jush-op">&gt;</span></span><span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/struct/text.html#edef-BR">br</a><span class="jush-op">&gt;</span></span>
Color <span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/forms.html#edef-INPUT">input</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/forms.html#adef-type-INPUT">type</a><span class="jush-att_quo"><span class="jush-op">="</span>text<span class="jush-op">"</span></span></span><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/forms.html#adef-name-INPUT">name</a><span class="jush-att_quo"><span class="jush-op">="</span>product_color<span class="jush-op">"</span></span></span><span class="jush-op">&gt;</span></span><span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/struct/text.html#edef-BR">br</a><span class="jush-op">&gt;</span></span>
Description <span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/forms.html#edef-INPUT">input</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/forms.html#adef-type-INPUT">type</a><span class="jush-att_quo"><span class="jush-op">="</span>text<span class="jush-op">"</span></span></span><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/forms.html#adef-name-INPUT">name</a><span class="jush-att_quo"><span class="jush-op">="</span>product_description<span class="jush-op">"</span></span></span><span class="jush-op">&gt;</span></span><span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/struct/text.html#edef-BR">br</a><span class="jush-op">&gt;</span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/forms.html#edef-INPUT">input</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/forms.html#adef-type-INPUT">type</a><span class="jush-att_quo"><span class="jush-op">="</span>submit<span class="jush-op">"</span></span></span><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/forms.html#adef-value-INPUT">value</a><span class="jush-att_quo"><span class="jush-op">="</span>ADD TO CART<span class="jush-op">"</span></span></span><span class="jush-op">&gt;</span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span>/form<span class="jush-op">&gt;</span></span>

<span class="jush"><span class="jush-htm_com"><span class="jush-op">&lt;!--</span> link to the shopping cart <span class="jush-op">--&gt;</span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/struct/links.html#edef-A">a</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/struct/links.html#adef-href">href</a><span class="jush-att_val"><span class="jush-op">=</span>”shopping_cart.php”</span></span><span class="jush-op">&gt;</span></span>My shopping cart<span class="jush-tag"><span class="jush-op">&lt;</span>/a<span class="jush-op">&gt;</span></span></span>

<span class="jush-tag_js"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/scripts.html#edef-SCRIPT">script</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/scripts.html#adef-src-SCRIPT">src</a><span class="jush-att_quo"><span class="jush-op">="</span>js/jquery.min.js<span class="jush-op">"</span></span></span><span class="jush-js"><span class="jush-op">&gt;</span><span class="jush-js_code"><span class="jush-op">&lt;</span>/script<span class="jush-op">&gt;</span></span></span></span>
<span class="jush-tag_js"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/scripts.html#edef-SCRIPT">script</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/scripts.html#adef-src-SCRIPT">src</a><span class="jush-att_quo"><span class="jush-op">="</span>js/jstorage.js<span class="jush-op">"</span></span></span><span class="jush-js"><span class="jush-op">&gt;</span><span class="jush-js_code"><span class="jush-op">&lt;</span>/script<span class="jush-op">&gt;</span></span></span></span>
<span class="jush-tag_js"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/scripts.html#edef-SCRIPT">script</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/scripts.html#adef-src-SCRIPT">src</a><span class="jush-att_apo"><span class="jush-op">='</span>http://vmishchenko.com/mosh/cdn/mosh.lib.js<span class="jush-op">'</span></span></span><span class="jush-js"><span class="jush-op">&gt;</span><span class="jush-js_code"><span class="jush-op">&lt;</span>/script<span class="jush-op">&gt;</span></span></span></span>
<span class="jush-tag_js"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/scripts.html#edef-SCRIPT">script</a><span class="jush-js"><span class="jush-op">&gt;</span><span class="jush-js_code">
$<span class="jush-op">(</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/DOM/window.document">document</a>)<span class="jush-op">.</span></span><span class="jush-js_code">ready<span class="jush-op">(</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/function">function</a><span class="jush-op">(</span></span><span class="jush-js_code">)<span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $_MOSH_user_id <span class="jush-op">=</span></span><span class="jush-js_code"> $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">get<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>$_MOSH_user_id<span class="jush-op">'</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/if...else">if</a> <span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-op">!</span></span><span class="jush-js_code">$_MOSH_user_id) <span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; _mosh_init<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>http://vmishchenko.com/mosh/api/api.php<span class="jush-op">'</span></span><span class="jush-op">,</span></span><span class="jush-js_code">false<span class="jush-op">,</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/function">function</a><span class="jush-op">(</span></span><span class="jush-js_code">)<span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">set<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_API_URL<span class="jush-op">"</span></span><span class="jush-op">,</span></span><span class="jush-js_code">$_MOSH_API_URL)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">set<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_TOKEN<span class="jush-op">"</span></span><span class="jush-op">,</span></span><span class="jush-js_code">$_MOSH_TOKEN)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">set<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_user_id<span class="jush-op">"</span></span><span class="jush-op">,</span></span><span class="jush-js_code">$_MOSH_user_id)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">set<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_cart_id<span class="jush-op">"</span></span><span class="jush-op">,</span></span><span class="jush-js_code">$_MOSH_cart_id)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; })<span class="jush-op">;</span></span><span class="jush-js_code"> 
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; } <a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/if...else">else</a> <span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $_MOSH_API_URL <span class="jush-op">=</span></span><span class="jush-js_code"> $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">get<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_API_URL<span class="jush-op">"</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $_MOSH_TOKEN <span class="jush-op">=</span></span><span class="jush-js_code"> $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">get<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_TOKEN<span class="jush-op">"</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $_MOSH_user_id <span class="jush-op">=</span></span><span class="jush-js_code"> $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">get<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_user_id<span class="jush-op">"</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $_MOSH_cart_id <span class="jush-op">=</span></span><span class="jush-js_code"> $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">get<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_cart_id<span class="jush-op">"</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; }
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $<span class="jush-op">(</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/DOM/window.document">document</a>)<span class="jush-op">.</span></span><span class="jush-js_code">on<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>submit<span class="jush-op">'</span></span><span class="jush-op">,</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>.addItemToCart<span class="jush-op">'</span></span><span class="jush-op">,</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/function">function</a><span class="jush-op">(</span></span><span class="jush-js_code">)<span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; _mosh_add_item<span class="jush-op">(</span></span><span class="jush-js_code">$<span class="jush-op">(</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/JavaScript/Reference/Operators/Special/this">this</a>)<span class="jush-op">,</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>updateCart<span class="jush-op">'</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/return">return</a> false<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; })<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
&nbsp; &nbsp; &nbsp; &nbsp; })<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; 
&nbsp; &nbsp; &nbsp; &nbsp; <a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/function">function</a> updateCart<span class="jush-op">(</span></span><span class="jush-js_code">data) <span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; console<span class="jush-op">.</span></span><span class="jush-js_code">log<span class="jush-op">(</span></span><span class="jush-js_code">data)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; }
<span class="jush-op">&lt;</span>/script<span class="jush-op">&gt;</span></span></span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span>/body<span class="jush-op">&gt;</span></span>


<span class="jush-tag"><span class="jush-op">&lt;</span>/html<span class="jush-op">&gt;</span></span>
</span></code></pre>

</p>
</li>

<li>
2. Now we need to create a shopping cart page where we display user's cart with all selected items. To do it we have to call _mosh_get_carts js function and create diplayCart callback function. Place these functions into the _mosh_init. 
<p>
File “shopping_cart.php”
<pre><code class="jush-htm"><span class="jush"><span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/struct/global.html#edef-HEAD">head</a><span class="jush-op">&gt;</span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span>/head<span class="jush-op">&gt;</span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/struct/global.html#edef-BODY">body</a><span class="jush-op">&gt;</span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/struct/global.html#edef-DIV">div</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/struct/global.html#adef-class">class</a><span class="jush-att_quo"><span class="jush-op">="</span>shoppingCart<span class="jush-op">"</span></span></span><span class="jush-op">&gt;</span></span>

<span class="jush-tag"><span class="jush-op">&lt;</span>/div<span class="jush-op">&gt;</span></span>

<span class="jush-tag_js"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/scripts.html#edef-SCRIPT">script</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/scripts.html#adef-src-SCRIPT">src</a><span class="jush-att_quo"><span class="jush-op">="</span>js/jquery.min.js<span class="jush-op">"</span></span></span><span class="jush-js"><span class="jush-op">&gt;</span><span class="jush-js_code"><span class="jush-op">&lt;</span>/script<span class="jush-op">&gt;</span></span></span></span>
<span class="jush-tag_js"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/scripts.html#edef-SCRIPT">script</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/scripts.html#adef-src-SCRIPT">src</a><span class="jush-att_quo"><span class="jush-op">="</span>js/jstorage.js<span class="jush-op">"</span></span></span><span class="jush-js"><span class="jush-op">&gt;</span><span class="jush-js_code"><span class="jush-op">&lt;</span>/script<span class="jush-op">&gt;</span></span></span></span>
<span class="jush-tag_js"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/scripts.html#edef-SCRIPT">script</a><span class="jush-att"><span class="jush-op"> </span><a href="http://www.w3.org/TR/html4/interact/scripts.html#adef-src-SCRIPT">src</a><span class="jush-att_apo"><span class="jush-op">='</span>http://vmishchenko.com/mosh/cdn/mosh.lib.js<span class="jush-op">'</span></span></span><span class="jush-js"><span class="jush-op">&gt;</span><span class="jush-js_code"><span class="jush-op">&lt;</span>/script<span class="jush-op">&gt;</span></span></span></span>
<span class="jush-tag_js"><span class="jush-op">&lt;</span><a href="http://www.w3.org/TR/html4/interact/scripts.html#edef-SCRIPT">script</a><span class="jush-js"><span class="jush-op">&gt;</span><span class="jush-js_code">
$<span class="jush-op">(</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/DOM/window.document">document</a>)<span class="jush-op">.</span></span><span class="jush-js_code">ready<span class="jush-op">(</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/function">function</a><span class="jush-op">(</span></span><span class="jush-js_code">)<span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $_MOSH_user_id <span class="jush-op">=</span></span><span class="jush-js_code"> $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">get<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>$_MOSH_user_id<span class="jush-op">'</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/if...else">if</a> <span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-op">!</span></span><span class="jush-js_code">$_MOSH_user_id) <span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; _mosh_init<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>http://vmishchenko.com/mosh/api/api.php<span class="jush-op">'</span></span><span class="jush-op">,</span></span><span class="jush-js_code">false<span class="jush-op">,</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/function">function</a><span class="jush-op">(</span></span><span class="jush-js_code">)<span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">set<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_API_URL<span class="jush-op">"</span></span><span class="jush-op">,</span></span><span class="jush-js_code">$_MOSH_API_URL)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">set<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_TOKEN<span class="jush-op">"</span></span><span class="jush-op">,</span></span><span class="jush-js_code">$_MOSH_TOKEN)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">set<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_user_id<span class="jush-op">"</span></span><span class="jush-op">,</span></span><span class="jush-js_code">$_MOSH_user_id)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">set<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_cart_id<span class="jush-op">"</span></span><span class="jush-op">,</span></span><span class="jush-js_code">$_MOSH_cart_id)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; })<span class="jush-op">;</span></span><span class="jush-js_code"> 
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; } <a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/if...else">else</a> <span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $_MOSH_API_URL <span class="jush-op">=</span></span><span class="jush-js_code"> $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">get<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_API_URL<span class="jush-op">"</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $_MOSH_TOKEN <span class="jush-op">=</span></span><span class="jush-js_code"> $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">get<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_TOKEN<span class="jush-op">"</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $_MOSH_user_id <span class="jush-op">=</span></span><span class="jush-js_code"> $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">get<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_user_id<span class="jush-op">"</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $_MOSH_cart_id <span class="jush-op">=</span></span><span class="jush-js_code"> $<span class="jush-op">.</span></span><span class="jush-js_code">jStorage<span class="jush-op">.</span></span><span class="jush-js_code">get<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-quo"><span class="jush-op">"</span>$_MOSH_cart_id<span class="jush-op">"</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; _mosh_get_carts<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>displayCart<span class="jush-op">'</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; }
&nbsp; &nbsp; 
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $<span class="jush-op">(</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/DOM/window.document">document</a>)<span class="jush-op">.</span></span><span class="jush-js_code">on<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>submit<span class="jush-op">'</span></span><span class="jush-op">,</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>.addItemToCart<span class="jush-op">'</span></span><span class="jush-op">,</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/function">function</a><span class="jush-op">(</span></span><span class="jush-js_code">)<span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; _mosh_add_item<span class="jush-op">(</span></span><span class="jush-js_code">$<span class="jush-op">(</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/JavaScript/Reference/Operators/Special/this">this</a>)<span class="jush-op">,</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>updateCart<span class="jush-op">'</span></span>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/return">return</a> false<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; })<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
&nbsp; &nbsp; &nbsp; &nbsp; })<span class="jush-op">;</span></span><span class="jush-js_code">

&nbsp; &nbsp; &nbsp; &nbsp; <a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/function">function</a> displayCart<span class="jush-op">(</span></span><span class="jush-js_code">data) <span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/var">var</a> html <span class="jush-op">=</span></span><span class="jush-js_code"> <span class="jush-apo"><span class="jush-op">'</span><span class="jush-op">'</span></span><span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/var">var</a> items <span class="jush-op">=</span></span><span class="jush-js_code"> data<span class="jush-op">[</span></span><span class="jush-js_code"><span class="jush-num"><span class="jush-op">0</span></span>]<span class="jush-op">.</span></span><span class="jush-js_code">items<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; console<span class="jush-op">.</span></span><span class="jush-js_code">log<span class="jush-op">(</span></span><span class="jush-js_code">items)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; console<span class="jush-op">.</span></span><span class="jush-js_code">log<span class="jush-op">(</span></span><span class="jush-js_code">items<span class="jush-op">.</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/DOM/element.length">length</a>)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/for">for</a> <span class="jush-op">(</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/JavaScript/Reference/Statements/var">var</a> i<span class="jush-op">=</span></span><span class="jush-js_code">items<span class="jush-op">.</span></span><span class="jush-js_code"><a href="https://developer.mozilla.org/en/DOM/element.length">length</a><span class="jush-op">-</span></span><span class="jush-js_code"><span class="jush-num"><span class="jush-op">1</span></span><span class="jush-op">;</span></span><span class="jush-js_code"> i<span class="jush-op">&gt;</span></span><span class="jush-js_code"><span class="jush-op">=</span></span><span class="jush-js_code"><span class="jush-num"><span class="jush-op">0</span></span><span class="jush-op">;</span></span><span class="jush-js_code"> i<span class="jush-op">-</span></span><span class="jush-js_code"><span class="jush-op">-</span></span><span class="jush-js_code">) <span class="jush-op">{</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; html <span class="jush-op">+</span></span><span class="jush-js_code"><span class="jush-op">=</span></span><span class="jush-js_code"> items<span class="jush-op">[</span></span><span class="jush-js_code">i]<span class="jush-op">.</span></span><span class="jush-js_code">product_name<span class="jush-op">+</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>&lt;br&gt;<span class="jush-op">'</span></span><span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; }
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $<span class="jush-op">(</span></span><span class="jush-js_code"><span class="jush-apo"><span class="jush-op">'</span>.shoppingCart<span class="jush-op">'</span></span>)<span class="jush-op">.</span></span><span class="jush-js_code">html<span class="jush-op">(</span></span><span class="jush-js_code">html)<span class="jush-op">;</span></span><span class="jush-js_code">
&nbsp; &nbsp; &nbsp; &nbsp; }
<span class="jush-op">&lt;</span>/script<span class="jush-op">&gt;</span></span></span></span>
<span class="jush-tag"><span class="jush-op">&lt;</span>/body<span class="jush-op">&gt;</span></span>


<span class="jush-tag"><span class="jush-op">&lt;</span>/html<span class="jush-op">&gt;</span></span></span></code></pre>
</p>
</li>
</ul>
<div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
