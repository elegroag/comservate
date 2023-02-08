
<?php $sysSidebarService = new App\Services\SysSidebarService();?>
<?= $this->include('template/header_main') ?>
<?= $this->include('template/loading') ?>
<div id='render_mymodal'></div>
<div class="wrapper">
    <div class="sidebar">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">
                <div class="logo-image-small"></div>
            </a>
            <a href="" class="simple-text logo-normal" style='color:#FFF;'> COMSERVA</a>
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

<style>

.sidebar-wrapper {
  background-color: #000;
  opacity: 0.77;
  background-image: url("<?=base_url()?>/assets/img/sidebar1.jpg") !important;
  background-size: cover;
  background-position: top;
}

.sidebar .logo {
  background-color: #000;
  opacity: 0.80;
  background-image: url("<?=base_url()?>/assets/img/sidebar2.jpg") !important;
  background-size: cover;
  background-position: bottom;
}
.sidebar .nav li>a{
    opacity: 1;
}
.sidebar .nav li>a .nc-icon {
    color: #fff;
}

</style>
</body>
</html>