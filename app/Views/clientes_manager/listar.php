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
                    <h3 class="card-title">Afiliado</h3>
                    <ul>
                        <li>Estado <%=estado%></li>
                        <li>Ruta <%=ruta%></li>
                        <li>Municipio <%=id_municipio%></li>
                    </ul>
                </div>
                <div class="card-footer">
                    <button type='button' class="btn btn-round btn-default" id='btnVolver'>Volver</button>
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
                            <div class="col-md-6">
                                <?= showBoostrap('label: Cedula', 'value: <%=cedula%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Nit', 'value: <%=nit%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Afiliado', 'value: <%=afiliado%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Representante', 'value: <%=representante%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Contrato', 'value: <%=contrato%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Fecha Finalizacion', 'value: <%=fecha_finalizacion%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Valor kilo', 'value: <%=valor_kilo%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Kilos', 'value: <%=kilos%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Dirección', 'value: <%=direccion%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Teléfono', 'value: <%=telefono%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Barrio', 'value: <%=barrio%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Correo', 'value: <%=correo%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Especiales', 'value: <%=especiales%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Fecha creacion', 'value: <%=fecha_creacion%>') ?>
                            </div>
                            <div class="col-md-6">
                                <?= showBoostrap('label: Usuario creador', 'value: <%=usuario_creador%>') ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/template" id='tmp_cliente_editar'>
    <div class='row'>
        <div class='col-md-12'>
            <div class="nav justify-content-end">
                <div class="nav-item">
                    <button class="nav-link btn btn-success" id='btnSendData'>
                        <span class="btn-label"><i class="nc-icon nc-check-2"></i></span> Guardar
                    </button>
                </div>
                <div class="nav-item">
                    <button class="nav-link btn btn-default" id='btnVolver'>
                        <span class="btn-label"><i class="nc-icon nc-zoom-split"></i></span> Volver
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="#" id='formEditData'>
                        <div class='row form-horizontal'>
                            <?= formBoostrap(
                                numeric_field(
                                    'cedula', 'value: <%=cedula%>'), 'label: Cedula', 'class: has-valid col-md-6 mb-2', 'id: cedula','required: 1') ?>
                            <?= formBoostrap(
                                numeric_field(
                                    'nit', 'value: <%=nit%>'), 'label: Nit', 'class: has-valid col-md-6 mb-2', 'id: nit','required: 1') ?>
                            <?= formBoostrap(
                                text_upper_field(
                                    'afiliado', 'value: <%=afiliado%>'), 'label: Afiliado', 'class: has-valid col-md-6 mb-2', 'id: afiliado', 'required: 1') ?>
                            <?= formBoostrap(
                                text_upper_field(
                                    'representante', 'value: <%=representante%>'), 'label: Representante', 'class: has-valid col-md-6 mb-2', 'id: representante','required: 1') ?>
                            <?= formBoostrap(
                                numeric_field(
                                    'contrato', 'value: <%=contrato%>'), 'label: Contrato', 'class: has-valid col-md-6 mb-2', 'id: contrato', 'required: 1') ?>
                            <?= formBoostrap(
                                text_upper_field(
                                    'fecha_finalizacion', 'value: <%=fecha_finalizacion%>'), 'label: Fecha finalización', 'class: has-valid col-md-6 mb-2', 'id: fecha_finalizacion') ?>
                            <?= formBoostrap(
                                money_field(
                                    'valor_kilo', 'value: <%=valor_kilo%>'), 'label: Valor kilo', 'class: has-valid col-md-6 mb-2', 'id: valor_kilo') ?>
                            <?= formBoostrap(
                                money_field(
                                    'valor_kilo_adicional', 'value: <%=valor_kilo_adicional%>'), 'label: Valor kilo adicional', 'class: has-valid col-md-6 mb-2', 'id: valor_kilo_adicional') ?>
                            <?= formBoostrap(
                                text_field(
                                    'kilos', 'value: <%=kilos%>'), 'label: Kilos', 'class: has-valid col-md-6 mb-2', 'id: kilos', 'required: -1') ?>
                            <?= formBoostrap(
                                text_upper_field(
                                    'direccion', 'value: <%=direccion%>'), 'label: Dirección', 'class: has-valid col-md-6 mb-2', 'id: direccion', 'required: 1') ?>
                            <?= formBoostrap(
                                numeric_field(
                                    'telefono', 'value: <%=telefono%>'), 'label: Teléfono', 'class: has-valid col-md-6 mb-2', 'id: telefono', 'required: 1') ?>
                            <?= formBoostrap(
                                text_upper_field(
                                    'barrio', 'value: <%=barrio%>'), 'label: Barrio', 'class: has-valid col-md-6 mb-2', 'id: barrio', 'required: 1') ?>
                            <?= formBoostrap(
                                text_upper_field(
                                    'correo', 'value: <%=correo%>'), 'label: Correo', 'class: has-valid col-md-6 mb-2', 'id: correo', 'required: 1') ?>
                            <?= formBoostrap(
                                text_field(
                                    'especiales', 'value: <%=especiales%>'), 'label: Especiales', 'class: has-valid col-md-6 mb-2', 'id: especiales') ?>
                            <?= formBoostrap(
                                select_statico(
                                    'estado', ['A'=>'ACTIVO', 'I'=> 'INACTIVO', 'S'=> 'SUSPENDIDO'], 'value: <%=estado%>'), 'label: Estado', 'class: has-valid col-md-6 mb-2', 'id: estado', 'required: 1') ?>
                            <?= formBoostrap(
                                numeric_field(
                                    'ruta', 'value: <%=ruta%>'), 'label: Ruta', 'class: has-valid col-md-6 mb-2', 'id: ruta', 'required: 1') ?>
                            <?= formBoostrap(
                                numeric_field(
                                    'id_municipio', 'value: <%=id_municipio%>'), 'label: id_municipio', 'class: has-valid col-md-6 mb-2', 'id: id_municipio', 'required: 1') ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/template" id='tmp_cliente_crear'>
    <div class='row'>
        <div class='col-md-12'>
            <div class="nav justify-content-end">
                <div class="nav-item">
                    <button class="nav-link btn btn-success" id='btnSendData'>
                        <span class="btn-label"><i class="nc-icon nc-check-2"></i></span> Guardar
                    </button>
                </div>
                <div class="nav-item">
                    <button class="nav-link btn btn-default" id='btnVolver'>
                        <span class="btn-label"><i class="nc-icon nc-zoom-split"></i></span> Volver
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="#" id='formCreateData'>
                        <div class='row form-horizontal'>
                            <?= formBoostrap(
                                numeric_field(
                                    'cedula'), 'label: Cedula', 'class: has-valid col-md-6 mb-2', 'id: cedula','required: 1') ?>
                            <?= formBoostrap(
                                numeric_field(
                                    'nit'), 'label: Nit', 'class: has-valid col-md-6 mb-2', 'id: nit','required: 1') ?>
                            <?= formBoostrap(
                                text_upper_field(
                                    'afiliado'), 'label: Afiliado', 'class: has-valid col-md-6 mb-2', 'id: afiliado', 'required: 1') ?>
                            <?= formBoostrap(
                                text_upper_field(
                                    'representante'), 'label: Representante', 'class: has-valid col-md-6 mb-2', 'id: representante','required: 1') ?>
                            <?= formBoostrap(
                                numeric_field(
                                    'contrato'), 'label: Contrato', 'class: has-valid col-md-6 mb-2', 'id: contrato', 'required: 1') ?>
                            <?= formBoostrap(
                                text_upper_field(
                                    'fecha_finalizacion'), 'label: Fecha finalización', 'class: has-valid col-md-6 mb-2', 'id: fecha_finalizacion') ?>
                            <?= formBoostrap(
                                money_field(
                                    'valor_kilo'), 'label: Valor kilo', 'class: has-valid col-md-6 mb-2', 'id: valor_kilo') ?>
                            <?= formBoostrap(
                                money_field(
                                    'valor_kilo_adicional'), 'label: Valor kilo adicional', 'class: has-valid col-md-6 mb-2', 'id: valor_kilo_adicional') ?>
                            <?= formBoostrap(
                                text_field(
                                    'kilos'), 'label: Kilos', 'class: has-valid col-md-6 mb-2', 'id: kilos', 'required: -1') ?>
                            <?= formBoostrap(
                                text_upper_field(
                                    'direccion'), 'label: Dirección', 'class: has-valid col-md-6 mb-2', 'id: direccion', 'required: 1') ?>
                            <?= formBoostrap(
                                numeric_field(
                                    'telefono'), 'label: Teléfono', 'class: has-valid col-md-6 mb-2', 'id: telefono', 'required: 1') ?>
                            <?= formBoostrap(
                                text_upper_field(
                                    'barrio'), 'label: Barrio', 'class: has-valid col-md-6 mb-2', 'id: barrio', 'required: 1') ?>
                            <?= formBoostrap(
                                text_upper_field(
                                    'correo'), 'label: Correo', 'class: has-valid col-md-6 mb-2', 'id: correo', 'required: 1') ?>
                            <?= formBoostrap(
                                text_field(
                                    'especiales'), 'label: Especiales', 'class: has-valid col-md-6 mb-2', 'id: especiales') ?>
                            <?= formBoostrap(
                                select_statico(
                                    'estado', ['A'=>'ACTIVO', 'I'=> 'INACTIVO', 'S'=> 'SUSPENDIDO'], 'value: estado'), 'label: Estado', 'class: has-valid col-md-6 mb-2', 'id: estado', 'required: 1') ?>
                            <?= formBoostrap(
                                numeric_field(
                                    'ruta'), 'label: Ruta', 'class: has-valid col-md-6 mb-2', 'id: ruta', 'required: 1') ?>
                            <?= formBoostrap(
                                numeric_field(
                                    'id_municipio'), 'label: id_municipio', 'class: has-valid col-md-6 mb-2', 'id: id_municipio', 'required: 1') ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</script>

<div class="container" id='container'></div>

<?= script_tag('resource/cliente/build.clientes-min.js') ?>
<?= $this->endSection() ?>