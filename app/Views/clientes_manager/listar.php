<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<?= js_notify() ?>
<?= js_axios() ?>
<?= js_sweetalert2() ?>
<?= js_datatable() ?>
<?= js_chosen() ?>
<?= js_moment() ?>
<?= js_datetimepicker() ?>

<script type="text/template" id='tmp_all_clientes'>
    <?= $this->include('clientes_manager/tmp_all_clientes') ?>
</script>

<script type="text/template" id='tmp_cliente_detalle'>
    <?= $this->include('clientes_manager/tmp_cliente_detalle') ?>
</script>

<script type="text/template" id='tmp_cliente_editar'>
    <?= $this->include('clientes_manager/tmp_cliente_editar') ?>
</script>

<script type="text/template" id='tmp_cliente_crear'>
    <?= $this->include('clientes_manager/tmp_cliente_crear') ?>
</script>

<div class="container" id='container'></div>

<?= script_tag('resource/cliente/build.clientes.js') ?>
<?= $this->endSection() ?>