<div class='row'>
    <div class="col-md-6">
        <div class="row justify-content-first">
            <h4 class="card-title"> Crear Registro</h4>
            <p class="card-category"> Modulo de usuarios para la administración y control de los mismos.</p>
        </div>
    </div>
    <div class="col-md-6">
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
    </div>

    <div class='col'>
        <div class="card">
            <div class="card-body">
                <form method="post" action="#" id='formCreateData'>
                    <div class='row form-horizontal'>
                        <?= formBoostrap(
                            text_upper_field(
                                'nombres'
                            ),
                            'label: Nombres',
                            'class: has-valid col-md-6 mb-2',
                            'id: nombres',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            text_field(
                                'usuario'
                            ),
                            'label: Usuario',
                            'class: has-valid col-md-6 mb-2',
                            'id: usuario',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            text_upper_field(
                                'correo'
                            ),
                            'label: Correo',
                            'class: has-valid col-md-6 mb-2',
                            'id: correo',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            select_statico(
                                'estado',
                                ['A' => 'ACTIVO', 'I' => 'INACTIVO', 'S' => 'SUSPENDIDO', 'X' => 'BORRADO']
                            ),
                            'label: Estado',
                            'class: has-valid col-md-6 mb-2',
                            'id: estado',
                            'required: 1'
                        ) ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>