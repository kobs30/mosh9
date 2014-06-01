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
    <link href="../css/bootstrap.css" rel="stylesheet">

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
    <script src="google-code-prettify/run_prettify.js?lang=html&skin=pretty2"></script>



	
  </head>

  <body>
<script>
  !function ($) {
    $(function(){
      window.prettyPrint && prettyPrint()
    })
  }(window.jQuery)
</script>
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
1.  Create html page with a form describing your product. You can use any field in this form like  product_id, product_specification, price etc. and include mosh.lib.js, jquery.js, jstorage.js and create initial function and form submit function. Place these functions into the jquery $(document).ready
<p>
File product_form.php

<pre class="prettyprint  linenums">
<?
$str = file_get_contents('http://dvorale.com/MOSH9/docs/tutorial_files/tutorial.html');
echo htmlspecialchars($str)
?>
</pre>

</p>
</li>

<li>
2. Now we need to create a shopping cart page where we display user's cart with all selected items. To do it we have to call _mosh_get_carts js function and create diplayCart callback function. Place these functions into the _mosh_init. 
<p>
File “shopping_cart.php”
<pre class="prettyprint  linenums">
<?
$str = file_get_contents('http://dvorale.com/MOSH9/docs/tutorial_files/tutorial_shopping_cart.html');
echo htmlspecialchars($str)
?>
</pre>
</p>
</li>
</ul>
<div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
