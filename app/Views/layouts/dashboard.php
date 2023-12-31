<?= $this->include('template/header_main') ?>
<?= $this->include('template/loading') ?>
<div id='render_mymodal'></div>
<div class="wrapper">
    <?= $this->include('template/sidebar_main') ?>
    <div class="main-panel">
        <?= $this->include('template/navbar_main') ?>
        <div class="content">
            <div class="row">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    <?= $this->include('template/footer_main') ?>
</div>
<?= script_tag('assets/paper/paper-dashboard.min.js', 'preload') ?>
</body>
</html>