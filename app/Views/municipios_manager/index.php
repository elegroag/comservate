<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<?= js_notify() ?>
<?= js_axios() ?>
<?= js_sweetalert2() ?>
<?= js_datatable() ?>

<script type="text/template" id='tmp_all_municipios'>
    <?= $this->include('municipios_manager/tmp_all_municipios') ?>
</script>

<script type="text/template" id='tmp_masivo_municipios'>
    <?= $this->include('municipios_manager/tmp_masivo_municipios') ?>
</script>

<div class="container" id='container'></div>

<?= script_tag('resource/municipio/build.municipio.js?time='.strtotime('now')) ?>
<?= $this->endSection() ?>