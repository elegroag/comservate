<div class='row'>
    <div class='col-md-3'>
        <div class="card card-pricing ">
            <div class="card-header">
                <h4 class="card-title"> Usuario</h4>
            </div>
            <div class="card-body">
                <div class="card-icon icon-primary ">
                    <i class="fa fa-user"></i>
                </div>
                <h3 class="card-title"><%=nombres%></h3>
                <ul>
                    <li>ESTADO <%=estado_detalle%></li>
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
                <h5 class="text-primary">Datos Del Usuario</h5>
            </div>
            <div class="card-body">
                <form method="get" action="/" class="form-horizontal">
                    <div class='row'>
                        <div class="col-md-6">
                            <?= showBoostrap('label: Usuario', 'value: <%=usuario%>') ?>
                        </div>
                        <div class="col-md-6">
                            <?= showBoostrap('label: Nombres', 'value: <%=nombres%>') ?>
                        </div>
                        <div class="col-md-6">
                            <?= showBoostrap('label: Correo', 'value: <%=correo%>') ?>
                        </div>
                        <div class="col-md-6">
                            <?= showBoostrap('label: Estado', 'value: <%=estado_detalle%>') ?>
                        </div>
                        <div class="col-md-6">
                            <?= showBoostrap('label: Fecha Creación', 'value: <%=fecha_creacion%>') ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>