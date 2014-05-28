<html>
<head>
</head>
<body>
<div class="shoppingCart">

</div>

<script src="js/jquery.min.js"></script>
<script src="js/jstorage.js"></script>
<script src='http://vmishchenko.com/mosh/cdn/mosh.lib.js'></script>
<script>
$(document).ready(function(){
			$_MOSH_user_id = $.jStorage.get('$_MOSH_user_id');
			if (!$_MOSH_user_id) {
				_mosh_init('http://vmishchenko.com/mosh/api/api.php',false,function(){
				$.jStorage.set("$_MOSH_API_URL",$_MOSH_API_URL);
				$.jStorage.set("$_MOSH_TOKEN",$_MOSH_TOKEN);
				$.jStorage.set("$_MOSH_user_id",$_MOSH_user_id);
				$.jStorage.set("$_MOSH_cart_id",$_MOSH_cart_id);
				}); 
			} else {
					$_MOSH_API_URL = $.jStorage.get("$_MOSH_API_URL");
					$_MOSH_TOKEN = $.jStorage.get("$_MOSH_TOKEN");
					$_MOSH_user_id = $.jStorage.get("$_MOSH_user_id");
					$_MOSH_cart_id = $.jStorage.get("$_MOSH_cart_id");
					_mosh_get_carts('displayCart');
			}
			
			$(document).on('submit','.addItemToCart',function(){
				_mosh_add_item($(this),'updateCart');
				return false;
			});
			
		});
		
		function displayCart(data) {
			var html = '';
			var items = data[0].items;
			console.log(items);
			console.log(items.length);
			for (var i=items.length-1; i>=0; i--) {
				html += items[i].product_name+'<br>';
			}
			$('.shoppingCart').html(html);
		}
</script>
</body>


</html>