<?=link_tag('fonts/monserrat.woff2')?>
<?=link_tag('assets/font-awesome/css/font-awesome.min.css')?>
<?=link_tag('assets/bootstrap/bootstrap.css')?>
<?=link_tag('assets/paper/paper-dashboard.css')?>
<?=link_tag('img/favicon.ico','shortcut icon', 'image/ico')?>
<?=link_tag('css/paper.css')?>

<?=script_tag('assets/jquery/jquery.min.js');?>
<?=script_tag('assets/framework/underscore-min.js');?>
<?=script_tag('assets/framework/backbone-min.js');?>
<?=script_tag('assets/bootstrap/bootstrap.bundle.js')?>
<?=script_tag('assets/perfect-scrollbar/perfect-scrollbar.jquery.min.js')?>

<?= script_tag('js/bootstrap-menu.js')?>
<?= script_tag('assets/bootstrap/bootstrap-notify.min.js') ?>
<?= script_tag('assets/bootstrap/bootstrap-datetimepicker.js') ?>
<?= script_tag('assets/bootstrap/bootstrap-select.min.js') ?>
<?= script_tag('assets/moment/moment.js'); ?>
<?= script_tag('assets/sweetalert2/sweetalert2.min.js'); ?>

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