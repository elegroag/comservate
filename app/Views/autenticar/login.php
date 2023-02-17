<?= $this->extend('layouts/login') ?>
<?= $this->section('content') ?>
<?=js_notify()?>
<?=js_axios()?>
<?=js_sweetalert2()?>

<script type='text/template' id='tmp_login_render'>
    <?= $this->include('autenticar/tmp_login') ?>
</script>

<script type='text/template' id='tmp_login_recovery'>
    <?= $this->include('autenticar/tmp_recovery') ?>
</script>

<div class="container" >
    <div class="row justify-content-md-center">
        <div class="col-lg-4 col-md-6" id='container'></div>
    </div>
</div>
<?= $this->endSection() ?>
