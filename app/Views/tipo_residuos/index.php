<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<?= js_notify() ?>
<?= js_axios() ?>
<?= js_sweetalert2() ?>
<?= js_datatable() ?>

<script type="text/template" id='tmp_all_tipos'>
    <?= $this->include('tipo_residuos/tmp_all_tipos') ?>
</script>

<script type="text/template" id='tmp_masivo_tipos'>
    <?= $this->include('tipo_residuos/tmp_masivo_tipos') ?>
</script>

<div class="container" id='container'></div>

<?= script_tag('resource/municipio/build.tipo_residuos.js?time='.strtotime('now')) ?>
<?= $this->endSection() ?>