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
          <!--  <li data-tmpl="about" ><a href="#create_wallet">Create Wallet</a></li>
            <li data-tmpl="contact"><a href="#recharge_wallet">Recharge Wallet</a></li>-->
          </ul> 
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div id="content" class="container">
	<h1>Core API list</h1>
<div   class="api-doc-section">
	<h3>get_token</h3>	<p> Create token and set permission for this token. Return token that will used in all methods </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) get_token</li>
	</ul>
</div>

<div   class="api-doc-section">
	<h3>new_cart</h3>	<p> Create new shopping cart object and return his internal_id </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method*</b> = (string) new_cart</li>
		<li><b>$token*</b>- token your got from get_token method</li>
		<li><b>user_id*</b>- user id</li>
		<li><font color="grey"><b>cart_name (optional)</b>- the name of this shopping cart (Attention! the name is not unique in the system)</font></li>
		<li><strong>You can add any additional parameters connected to cart object. </strong> </li>
	</ul>
</div>

<div   class="api-doc-section">
	<h3>get_all_carts</h3>	<p> Return all shopping carts connected with the specified user</p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) get_all_carts</li>
		<li><b>$token</b>- token your got from get_token method</li>
		<li><b>user_id</b>- user_id</li>
		<li><strong>You can add any additional parameters connected to cart object. For example cart_name and/or internal_id</strong> </li>
	</ul>
</div>

<div   class="api-doc-section">
	<h3>get_carts</h3>	<p> get_all_carts alias </p>
</div>

<div   class="api-doc-section">
	<h3>get_items</h3>	<p> Return all items from the specified cart </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) get_items</li>
		<li><b>$token</b>- token your got from one of login api</li>
		<li><b>user_id</b>- user id</li>
		<li><b>cart_id</b>- cart id</li>
		<li><strong>You can add any additional parameters connected to the cart object.</strong> </li>
	</ul>
</div>

<div   class="api-doc-section">
	<h3>get_status</h3>	<p> Return the specified cart status </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) get_status</li>
		<li><b>$token</b>- token your got from one of login api</li>
		<li><b>user_id</b>- user id</li>
		<li><b>cart_id</b>- cart id</li>
		<li><strong>You can add any additional parameters connected to the cart object.</strong> </li>
	</ul>
</div>

<div   class="api-doc-section">
	<h3>add_item</h3>	<p> Add item to the the specified cart. Return item identifier - item_incart_internal_id </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) add_item</li>
		<li><b>$token</b>- token your got from get_token</li>
		<li><b>user_id</b>- user id</li>
		<li><b>cart_id</b>- cart id</li>
		<li><strong>You can add any additional parameters connected to the cart object.</strong> </li>
	</ul>
</div>

<div   class="api-doc-section">
	<h3>remove_item</h3>	<p> Remove item from the cart</p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) remove_item</li>
		<li><b>$token</b>- token your got from one of login api</li>
		<li><b>user_id</b>- user id</li>
		<li><b>cart_id</b>- cart id</li>
		<li><b>item_incart_internal_id</b>- item in cart identifier</li>
	</ul>
</div>

<div   class="api-doc-section">
	<h3>update_status</h3>	<p> Update cart status </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) update_status</li>
		<li><b>$token</b>- token your got from one of login api</li>
		<li><b>staus</b>- (string) new cart status</li>
		<li><b>user_id</b>- user id</li>
		<li><b>cart_id</b>- cart id</li>
		<li><strong>You can add any additional parameters connected to the cart object.</strong> </li>
	</ul>
</div>
<!---------------------------------------------------------------->
<div   class="api-doc-section"><h3>not documented CORE methods (5)</h3></DIV>
<div style="display:none">
<div   class="api-doc-section"><h3>get_categories_tree</h3>	<p> METHOD_NAME </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) get_categories_tree</li>
		<li><b>$token</b>- token your got from one of login api</li>
		<li><strong>You can add any additional parameters connected to this merchant account.</strong> </li>
	</ul></div><div   class="api-doc-section"><h3>add_category</h3>	<p> METHOD_NAME </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) add_category</li>
		<li><b>$token</b>- token your got from one of login api</li>
		<li><strong>You can add any additional parameters connected to this merchant account.</strong> </li>
	</ul></div><div   class="api-doc-section"><h3>update_category</h3>	<p> METHOD_NAME </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) update_category</li>
		<li><b>$token</b>- token your got from one of login api</li>
		<li><strong>You can add any additional parameters connected to this merchant account.</strong> </li>
	</ul></div><div   class="api-doc-section"><h3>get_products</h3>	<p> METHOD_NAME </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) get_products</li>
		<li><b>$token</b>- token your got from one of login api</li>
		<li><strong>You can add any additional parameters connected to this merchant account.</strong> </li>
	</ul></div><div   class="api-doc-section"><h3>add_product</h3>	<p> METHOD_NAME </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) add_product</li>
		<li><b>$token</b>- token your got from one of login api</li>
		<li><strong>You can add any additional parameters connected to this merchant account.</strong> </li>
	</ul></div><div   class="api-doc-section"><h3>update_product</h3>	<p> METHOD_NAME </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) update_product</li>
		<li><b>$token</b>- token your got from one of login api</li>
		<li><strong>You can add any additional parameters connected to this merchant account.</strong> </li>
	</ul></div><div   class="api-doc-section"><h3>get_admin_templates</h3>	<p> METHOD_NAME </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) get_admin_templates</li>
		<li><b>$token</b>- token your got from one of login api</li>
		<li><strong>You can add any additional parameters connected to this merchant account.</strong> </li>
	</ul></div><div   class="api-doc-section"><h3>add_admin_template</h3>	<p> METHOD_NAME </p>
	<p>
		<b>URL:</b>
			http//api.mosh9api.com/api.php  <br>
			https//api.mosh9api.com/api.php
		<br>
		<b>Method:</b>
		POST or GET
	</p>
	<ul>
		<li><b>method</b> = (string) add_admin_template</li>
		<li><b>$token</b>- token your got from one of login api</li>
		<li><strong>You can add any additional parameters connected to this merchant account.</strong> </li>
	</ul></div>    
</div>	
	
</div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
