<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<?= js_notify() ?>
<?= js_axios() ?>
<?= js_sweetalert2() ?>
<?= js_chosen() ?>
<?= js_moment() ?>
<?= js_switch() ?>

<script type="text/template" id='tmp_detalle_perfil'>
    <?= $this->include('perfil_manager/tmp_detalle_perfil') ?>
</script>

<script type="text/template" id='tmp_edita_perfil'>
    <?= $this->include('perfil_manager/tmp_edita_perfil') ?>
</script>

<div class="container" id='container'></div>

<?= script_tag('resource/perfil/build.perfil.js') ?>
<?= $this->endSection() ?>