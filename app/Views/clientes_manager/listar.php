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

<script type="text/template" id="tmp_reload_datatable">
    <table class="table table-striped table-bordered dataTable dtr-inline" id='datatable' aria-describedby="datatable_info" style="width: 100%;">
        <thead class="text-primary">
            <tr>
                <th>Afiliado</th>
                <th>Representante</th>
                <th class="text-right">Municipio</th>
                <th>Estado</th>
                <th>Teléfono</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id='filas'></tbody>
    </table>
</script>

<div class="container" id='container'></div>

<?= script_tag('resource/cliente/build.clientes.js?time='.strtotime('now')) ?>
<?= $this->endSection() ?>