<?= $this->include('template/header_login') ?>
<div id='render_mymodal'></div>
<?= $this->include('template/loading') ?>
<?= $this->include('template/navbar_login') ?>

<div class="wrapper wrapper-full-page">
    <div class="full-page section-image" filter-color="black">
        <div class="content">

            <?= $this->renderSection('content') ?>

        </div>
        <?=script_tag('resource/login/build.login-min.js')?>
        <?= $this->include('template/footer_login') ?>
    </div>
</div>
</body>
</html>