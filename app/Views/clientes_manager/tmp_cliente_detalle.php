<div class='row'>
    <div class='col-md-3'>
        <div class="card card-pricing ">
            <div class="card-header">
                <h4 class="card-title"> Cliente</h4>
            </div>
            <div class="card-body">
                <div class="card-icon icon-primary ">
                    <i class="fa fa-user"></i>
                </div>
                <h3 class="card-title"><%=afiliado%></h3>
                <ul>
                    <li>ESTADO <%=estado_detalle%></li>
                    <li>RUTA <%=ruta%></li>
                    <li>MUNICIPIO <span class='text-uppercase'><%=municipio%></span></li>
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
                <h5 class="text-primary">Datos Del Cliente</h5>
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
                            <?= showBoostrap('label: Fecha Finalización', 'value: <%=fecha_finalizacion%>') ?>
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
                            <?= showBoostrap('label: Fecha creación', 'value: <%=fecha_creacion%>') ?>
                        </div>
                        <div class="col-md-6">
                            <?= showBoostrap('label: Usuario creador', 'value: <%=usuario%>') ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>