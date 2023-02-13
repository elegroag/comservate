<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<?= js_notify() ?>
<?= js_axios() ?>
<?= js_sweetalert2() ?>
<?= js_datatable() ?>
<script type="text/template" id='tmp_all_clientes'>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Tabla De Clientes</h4>
            <p class="card-category"> Modulo de clientes para la administración y control de los mismos.</p>
        </div>
        <div class="card-body">
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
        </div>
    </div>
</script>

<script type="text/template" id='tmp_cliente_detalle'>
    <div class='row'>
        <div class='col-md-3'>
            <div class="card card-pricing ">
                <div class="card-header">
                    <h6 class="card-category"> Datos Del Cliente</h6>
                </div>
                <div class="card-body">
                    <div class="card-icon icon-primary ">
                        <i class="fa fa-user"></i>
                    </div>
                    <h3 class="card-title">69$</h3>
                    <ul>
                        <li>Working materials in EPS</li>
                        <li>6 months access to the library</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="javascript:;" class="btn btn-round btn-default">Volver</a>
                </div>
            </div>
        </div>
        <div class='col-md-9'>
            <div class="card card-pricing ">
                <div class="card-header">
                    <h6 class="card-category"> Datos Del Cliente</h6>
                </div>
                <div class="card-body">
                    <form method="get" action="/" class="form-horizontal">
                        <div class='row'>
                            <div class="col-md-4">
                                <?=showBoostrap('cedula', 'label: cedula', 'value: 11126616')?>
                            </div>
                            <div class="col-md-4">
                                <?=showBoostrap('cedula', 'label: cedula', 'value: 11126616')?>
                            </div>
                            <div class="col-md-4">
                                <?=showBoostrap('cedula', 'label: cedula', 'value: 11126616')?>
                            </div>
                            <div class="col-md-4">
                                <?=showBoostrap('cedula', 'label: cedula', 'value: 11126616')?>
                            </div>
                            <div class="col-md-4">
                                <?=showBoostrap('cedula', 'label: cedula', 'value: 11126616')?>
                            </div>
                            <div class="col-md-4">
                                <?=showBoostrap('cedula', 'label: cedula', 'value: 11126616')?>
                            </div>
                            <div class="col-md-4">
                                <?=showBoostrap('cedula', 'label: cedula', 'value: 11126616')?>
                            </div>
                            <div class="col-md-4">
                                <?=showBoostrap('cedula', 'label: cedula', 'value: 11126616')?>
                            </div>
                            <div class="col-md-4">
                                <?=showBoostrap('cedula', 'label: cedula', 'value: 11126616')?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</script>




<script type="text/template" id='tmp_cliente_editar'>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Editar Datos Cliente</h4>
            <p class="card-category"> Cliente</p>
        </div>
        <div class="card-body">
            
        </div>
    </div>
</script>

<div class="container" id='container'></div>

<?= script_tag('resource/cliente/build.clientes-min.js') ?>
<?= $this->endSection() ?>