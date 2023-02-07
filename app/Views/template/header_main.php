<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<title>COMSERVA</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<?//link_tag('font-awesome/css/font-awesome')?>
	<?//link_tag('assets/datatables/css/dataTables.bootstrap4')?>
	<?=link_tag('assets/bootstrap/bootstrap.min.css')?>
	<?=link_tag('assets/paper/paper-dashboard.min.css')?>
	<?=link_tag('img/favicon.ico','shortcut icon', 'image/ico')?>
	<?=link_tag('css/paper.css')?>

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
<div id='circle-logo'></div>
<?=view('template/loading')?>
<div id='render_mymodal'></div>
<div class="wrapper">
	<?=view('template/sidebar_main')?>

<script type='text/template' id='tmp_modal'>
	<div class="modal-dialog <%=size%>">
		<div class="modal-content">
			<div class="modal-header" style='padding: 5px 8px;'>
				<div class="row">
					<div class="col-11"><h6 class="modal-title"><%=title%></h6></div>
					<div class="col-1">
						<a type='button' class="btn-close" data-bs-dismiss="modal"><i class='fa fa-times'></i></a>
					</div>
				</div>
			</div>
			<div class="modal-body"><%=content%></div>
			<% if(footer !== -1){ %>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary">Continuar</button>
				</div>
			<% } %>
		</div>
	</div>
</script>

<script type='text/template' id='tmp_busqueda_invalid'>
	<div class='row'>
		<div class="pull-right" style='z-index:3000; position:absolute; right:10px;'>
			<a href='#' class="btn btn-sm btn-outline-primary btn-round" id='bt_back'><i class="fa fa-heart"></i> Salir</a>
		</div>
		<div class="col-md-6 ml-auto mr-auto">
			<div class="card-testimonial">
				<div class="card-body">
					<h4 class="card-title">Notificación Asamblea</h4>
					<p><%=msj%></p><br/>
					<div class="card-avatar">
						<a href="javascript:;"></a>
					</div>
				</div>
				<div class="card-footer ">
					<h6 class="card-category">@Comfaca</h6>
				</div>
			</div>
		</div>
	</div>
</script>

<div class="modal fade" id="notice_modal" tabindex="-1" role="dialog" aria-labelledby="notice" aria-hidden="true">
	<div class="modal-dialog modal-notice">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="nc-icon nc-simple-remove"></i>
				</button>
				<h5 class="modal-title" id='mdl_set_title'></h5>
			</div>
			<div class="modal-body" id='mdl_set_body'></div>
			<div class="modal-footer justify-content-center" id='mdl_set_footer'>
				<button type="button" class="btn btn-info btn-round" data-dismiss="modal" id='mdl_set_button'>Continuar!</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="dialog_modal" tabindex="-1" role="dialog" aria-labelledby="notice" aria-hidden="true">
	<div class="modal-dialog modal-dialog">
		<div class="modal-content" id='mdl_set_body'>
		</div>
	</div>
</div>