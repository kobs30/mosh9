<?
/*
* This file is part of the MOSH9  package.
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="ico/favicon.png">	
    <title>Mosh Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/nestable/nestable.css" rel="stylesheet">

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
	#par_list { padding-top:20px; padding-bottom:20px;}
	.del { color:blue; text-decoration:underline;}
	.filter {background-color:#eeeeee; padding:20px 20px 10px 10px;}
    </style>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
        <script src='js/jquery.min.js'></script>
        <script src='js/jquery.nestable.js'></script>
        <script src='js/mustache.js'></script>
        <script src='js/mosh.lib.js'></script>
	<script>
		$(document).ready(function(){
			_mosh_init_admin('http://vmishchenko.com/mosh/api/api.php','ADMIN_TOKEN_535erEWRE58asEDF746tdlgfogk');
			
			_mosh_loadTemplate('navigation',$('#navigation_container'));
			
			$(document).on('click','#newCategoryButton',function(){
				var catId = $('#newCategory').val();
				$('#categoryList').append('<li data-id="'+catId+'" class="dd-item dd3-item"><div class="dd-handle dd3-handle"></div><div class="dd3-content">'+catId+'</div></li>');
			});
			$(document).on('click','.nav a',function(){
				var f = {};
				if ($(this).attr('data-tmpl') == 'admin_templates') {
					f = function(){
						_mosh_call_api('get_admin_templates',{},'_mosh_w','displayAdminTemplatesList');
					}
				}
				if ($(this).attr('data-tmpl') == 'products') {
					f = function(){
						_mosh_call_api('get_admin_templates',{},'_mosh_w','displayAdminTemplatesListInProducts');
						getAndDisplayProducts();
					}
				}				
				if ($(this).attr('data-tmpl') == 'categories') {
					f = function(){
						nestableInit();
					}
				}
				_mosh_loadTemplate($(this).attr('data-tmpl'),$('#content'),{},f);
			});
			
			$(document).on('click','#addField',function(){
				$('#fieldContainer').append('<div class="form-group"><label>Field Name</label><input type="text" name="name[]" class="form-control"></div>');
			});			
			$(document).on('click','#addFile',function(){
				$('#fieldContainer').append('<div class="form-group"><label>Field Name</label><input type="text" name="file[]" class="form-control"></div>');
			});			
			$(document).on('click','#addCategory',function(){
				$('#fieldContainer').append('<div class="form-group"><label>Field Name</label><input type="text" name="category[]" class="form-control"></div>');
			});
			
			$(document).on('submit','#addForm',function(){
				_mosh_call_api('add_admin_template',$(this).serialize(),'_mosh_w','getAndDisplayAdminTemplatesList');
				return false;
			});
			
			$(document).on('click','#addProductFormButton',function(){
				_mosh_call_post_api('add_product','#addProductForm','_iframe_getAndDisplayProducts');
				// _mosh_call_api('add_product',$(this).serialize(),'_mosh_w','getAndDisplayProducts');
				return false;
			});	
			
			$(document).on('click','.dispayTemplate',function(){
			try{
				var templ = $_ADMIN_TEMPLATES[$(this).attr('data-admin_template_key')].name;
				$('#formFields').html('');
				for (var i=0; i<templ.length; i++) {
					$('#formFields').append('<div class="form-group"><label>'+templ[i]+'</label><input type="text" name="'+templ[i].replace(" ", "_")+'" class="form-control"></div>');
				}
				templ = $_ADMIN_TEMPLATES[$(this).attr('data-admin_template_key')].file;
				for (var i=0; i<templ.length; i++) {
					$('#formFields').append('<div class="form-group"><label>'+templ[i]+'</label><input type="file" name="'+templ[i].replace(" ", "_")+'" class="form-control"></div>');
				}
				// templ = $_ADMIN_TEMPLATES[$(this).attr('data-admin_template_key')].category;
				// for (var i=0; i<templ.length; i++) {
					// $('#formFields').append('<div class="form-group"><label>'+templ[i]+'</label><input type="text" name="'+templ[i].replace(" ", "_")+'" class="form-control"></div>');
				// }
			} catch(e) {}
				return false;
			});
			
		});
		
		function getAndDisplayProducts() {
			$('#productList').html('');
			_mosh_call_api('get_products',{},'_mosh_w','displayProducts');
		}	
		
		function _iframe_getAndDisplayProducts(thedata) {
			alert(thedata);
			$('#productList').html('');
			_mosh_call_api('get_products',{},'_mosh_w','displayProducts');
		}
		
		function displayProducts(data) {
			for (var i=data.length-1; i>=0; i--) {
				var html = '<li class="productTemplate" data-product_key="'+i+'"><ul>';
				for (var k in data[i]) {
					html = html + '<li>'+k+' : '+data[i][k]+'</li>';
				}
				html = html + '</li></ul>';
				$('#productList').append(html);
			}			
		}
		
		function getAndDisplayAdminTemplatesList() {
			$('#templates_list').html('');
			_mosh_call_api('get_admin_templates',{},'_mosh_w','displayAdminTemplatesList');
		}		
		
		
		function displayAdminTemplatesList(data) {
			for (var i=data.length-1; i>=0; i--) {
				$('#templates_list').append('<li class="editTemplate" data-admin_template_key="'+i+'" data-template_id="'+data[i].internal_id+'">'+data[i].template+' <a href="" class="deleteTemplate" data-template_id="'+data[i].internal_id+'">X Delete</a></li>');
			}
		}
		
		function displayAdminTemplatesListInProducts(data) {
			$_ADMIN_TEMPLATES = data;
			for (var i=data.length-1; i>=0; i--) {
				$('#templates_list').append('<li class="dispayTemplate" data-admin_template_key="'+i+'" data-template_id="'+data[i].internal_id+'">'+data[i].template+'</li>');
			}
		}
		
		
		function _mosh_errorHandler(d) {
			console.log(d);
		}
		

	</script>
	
	<script id="error-template" type="text/template" >
		ERROR: template not found
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
	
	
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container" id="navigation_container">
	  
      </div>
    </div>

    <div id="content" class="container">
		<div class="api-doc-section" id="create_wallet">
			Welcome message,<br>
			Кто не скачет, тот москаль!
		 </div>	
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
