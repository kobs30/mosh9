<?
/*
* This file is part of the MOSH9 package.
*
* (c) Sergei Kovalov
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MOSH tool front example</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="navigation_container">

    </nav>

    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Shop Name</p>
                <div class="list-group">
                    <a href="#" class="list-group-item">Printable</a>
                    <a href="#" class="list-group-item">Cupcake Wrappers</a>
                    <a href="#" class="list-group-item">Authentic Dragon Bones</a>
                </div>
            </div>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="row" id="products_list">

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Company 2013 - Template by <a href="http://maxoffsky.com/">Maks</a>
                    </p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
	<script src='js/mustache.js'></script>
	<script src="js/jstorage.js"></script>
	<script src='js/mosh.lib.js'></script>
	
	<script>
		$(document).ready(function(){
			$__SAVE_TO_LOCAL_DB = true;
			$_MOSH_user_id = $.jStorage.get('$_MOSH_user_id');
			if (!$_MOSH_user_id) {
				_mosh_init('http://vmishchenko.com/mosh/api/api.php',false,function(){
					_mosh_loadTemplate('menu',$('#navigation_container'));
					_mosh_get_products('displayProducts');//_mosh_call_api('get_products',{},'_mosh_w','displayProducts');	
					if ($__SAVE_TO_LOCAL_DB) {
						$.jStorage.set("$_MOSH_API_URL",$_MOSH_API_URL);
						$.jStorage.set("$_MOSH_TOKEN",$_MOSH_TOKEN);
						$.jStorage.set("$_MOSH_user_id",$_MOSH_user_id);
						$.jStorage.set("$_MOSH_cart_id",$_MOSH_cart_id);
					}
				}); 
			} else {
					$_MOSH_API_URL = $.jStorage.get("$_MOSH_API_URL");
					$_MOSH_TOKEN = $.jStorage.get("$_MOSH_TOKEN");
					$_MOSH_user_id = $.jStorage.get("$_MOSH_user_id");
					$_MOSH_cart_id = $.jStorage.get("$_MOSH_cart_id");
					_mosh_loadTemplate('menu',$('#navigation_container'));
					_mosh_get_products('displayProducts'); //_mosh_call_api('get_products',{},'_mosh_w','displayProducts');			
			}
			
			$(document).on('submit','.product_form',function(){
				addToCart($(this));
				return false;
			})
			
			$(document).on('click','.save_to_local_db',function(){
				if ($__SAVE_TO_LOCAL_DB) {
					$__SAVE_TO_LOCAL_DB = false;
					$.jStorage.flush();
					$('.save_to_local_db').html('OFF');
				}
				else {
					$__SAVE_TO_LOCAL_DB = true;
					$.jStorage.set("$_MOSH_API_URL",$_MOSH_API_URL);
					$.jStorage.set("$_MOSH_TOKEN",$_MOSH_TOKEN);
					$.jStorage.set("$_MOSH_user_id",$_MOSH_user_id);
					$.jStorage.set("$_MOSH_cart_id",$_MOSH_cart_id);
					$('.save_to_local_db').html('ON');
				}
				return false;
			});
			
			$(document).on('click','.navbar-nav a',function(){
				var template = $(this).attr('data-tmpl');
				var f = false;
				if (template == 'shopping_cart') {
					_mosh_get_carts('displayCart');// _mosh_call_api('get_carts',{'user_id':$_MOSH_user_id},'_mosh_w','displayCart');	
				}
				else {
					if (template == 'catalog') _mosh_get_products('displayProducts'); //_mosh_call_api('get_products',{},'_mosh_w','displayProducts');	
					else _mosh_loadTemplate(template,$('#products_list'),f);
				}
			});
		});
		
		function displayCart(data) {
		console.log(data[0].items);
			_mosh_loadTemplate('shopping_cart',$('#products_list'),{'data':data[0].items});
		}
		
		function addToCart(product) {
			_mosh_call_api('add_item',product.serialize()+'&user_id='+$_MOSH_user_id+'&cart_id='+$_MOSH_cart_id,'_mosh_w','updateCart');
		}
		
		function displayProducts(data) {
			_mosh_loadTemplate('product_cart',$('#products_list'),{'data':data});
		}
		
		function updateCart() {
			console.log('updateCart');
		}
		
		function _mosh_errorHandler(data) {
			console.log('ERROR:: '+data.error);
			// _mosh_call_api('get_products',{},'_mosh_w','displayProducts');		
		}
	</script>
<?
	$templates = scandir('templates');
	$templates =  array_diff($templates, array('.', '..'));
	foreach ($templates as $template) {
		echo '<script id="'.$template.'-template" type="text/template" >';
		echo file_get_contents('templates/'.$template);
		echo '</script>';
	}
?>	
</body>

</html>
