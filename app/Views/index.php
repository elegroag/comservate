<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<title>COMSERVA</title>
    <?=view('template/header_main')?>
</head>
<body>
    <?=view('template/loading')?>
    <div id='render_mymodal'></div>
    <div class="wrapper">
        <?=view('template/sidebar_main')?>    
        <div class="main-panel">
            <?=view('template/navbar_main',['title' => esc($title)])?>
            <div class="content">
                <div class="row">
                    <?= $content ?>
                </div>
            </div>
        </div>
        <?=view('template/footer_main'); ?>
    </div>
		<?= script_tag('assets/paper/paper-dashboard.min.js') ?>
		<?= script_tag('js/paper.js') ?>
	</body>
</html>