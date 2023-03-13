<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<?= js_notify() ?>
<?= js_axios() ?>
<?= js_sweetalert2() ?>
<?= js_datatable() ?>

<script type="text/template" id='tmp_all_empleados'>
    <?= $this->include('empleados_manager/tmp_all_empleados') ?>
</script>

<script type="text/template" id='tmp_masivo_empleados'>
    <?= $this->include('empleados_manager/tmp_masivo_empleados') ?>
</script>

<div class="container" id='container'></div>

<?= script_tag('resource/municipio/build.empleados.js?time='.strtotime('now')) ?>
<?= $this->endSection() ?>