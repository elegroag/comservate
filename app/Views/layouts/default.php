
<?php $sysSidebarService = new App\Services\SysSidebarService();?>
<?= $this->include('template/header_main') ?>
<?= $this->include('template/loading') ?>
<div id='render_mymodal'></div>
<div class="wrapper">
    <div class="sidebar">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">
                <div class="logo-image-small"><?=img(['src'=> 'assets/img/mini-logo.png', 'width'=>'60px'])?> </div>
            </a>
            <a href="" class="simple-text logo-normal" style='color:#FFF;'> COMSERVA <?=img(['src'=> 'assets/img/mini-logo.png', 'width'=>'40px'])?></a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav list-unstyled ps-0">
                <?= $sysSidebarService->createMenuEscritorio() ?>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <?= $this->include('template/navbar_main') ?>
        <div class="content">
            <div class="row">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
        <?= $this->include('template/footer_main') ?>
    </div>
</div>
<?= script_tag('assets/paper/paper-dashboard.min.js') ?>
<?= script_tag('js/paper.js') ?>
</body>
</html>