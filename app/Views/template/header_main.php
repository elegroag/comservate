<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="Comserva Api Rest Dedicada" />
	<meta name="android-mobile-web-app-title" content="Comserva" />
	<meta name="apple-touch-icon", src='img/favicon.ico' />
	<meta name="theme-color" content="#f44336" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<meta http-equiv="Cache-control" content="no-store, no-cache, max-age=0, must-revalidate, proxy-revalidate">
	<title>COMSERVA</title>
	
	<?=link_tag('assets/img/mini-logo.png','apple-touch-icon', 'image/ico')?>
	<?=link_tag('img/favicon.ico','shortcut icon', 'image/ico')?>
	<?=link_tag('js/manifest.json','manifest')?>
	<?=link_tag('assets/font-awesome/css/font-awesome.min.css', 'stylesheet')?>
	<?=link_tag('assets/bootstrap/bootstrap.css', 'stylesheet')?>
	<?=link_tag('css/paper-dashboard.css', 'stylesheet')?>
	<?=link_tag('css/paper.css', 'stylesheet')?>

	<?=script_tag('assets/jquery/jquery.min.js');?>
	<?=script_tag('assets/framework/underscore-min.js');?>
	<?=script_tag('assets/framework/backbone-min.js');?>
	<?=script_tag('assets/bootstrap/bootstrap.bundle.js')?>
	<?=script_tag('assets/perfect-scrollbar/perfect-scrollbar.jquery.min.js')?>

	<script type='text/javascript'>
		const public_url = function(){
			return "<?=site_url()?>"; 
		};
		const create_url = function(url=""){
			return "<?=base_url().'/'?>" + url;
		};
		var _router = {};
		var _model = {};
		var _view = {};
		var _collections = {};

		function scroltop(){
			$(".main-panel").scrollTop(0);
		}
	</script>
</head>
<body>