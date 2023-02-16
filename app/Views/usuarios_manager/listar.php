<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<?= js_notify() ?>
<?= js_axios() ?>
<?= js_sweetalert2() ?>
<?= js_datatable() ?>
<?= js_chosen() ?>
<?= js_moment() ?>
<?= js_datetimepicker() ?>

<script type="text/template" id='tmp_all_usuarios'>
    <?= $this->include('usuarios_manager/tmp_all_usuarios') ?>
</script>

<script type="text/template" id='tmp_usuario_detalle'>
    <?= $this->include('usuarios_manager/tmp_usuario_detalle') ?>
</script>

<script type="text/template" id='tmp_usuario_editar'>
    <?= $this->include('usuarios_manager/tmp_usuario_editar') ?>
</script>

<script type="text/template" id='tmp_usuario_crear'>
    <?= $this->include('usuarios_manager/tmp_usuario_crear') ?>
</script>

<div class="container" id='container'></div>

<?= script_tag('resource/usuario/build.usuarios.js') ?>
<?= $this->endSection() ?>