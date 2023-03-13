<div class='row'>
    <div class="col-md-6">
        <div class="row justify-content-first">
            <h4 class="card-title"> Crear Registro</h4>
            <p class="card-category"> Modulo de municipios para la administración y control de los mismos.</p>
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
                                'nombres',
                                "autocomplete: off"
                            ),
                            'label: Nombres',
                            'class: has-valid col-md-6 mb-2',
                            'id: nombres',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            text_field(
                                'usuario',
                                "autocomplete: off"
                            ),
                            'label: Usuario',
                            'class: has-valid col-md-6 mb-2',
                            'id: usuario',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            text_upper_field(
                                'correo',
                                "autocomplete: off"
                            ),
                            'label: Correo',
                            'class: has-valid col-md-6 mb-2',
                            'id: correo',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            select_statico(
                                'estado',
                                ['A' => 'ACTIVO', 'I' => 'INACTIVO', 'S' => 'SUSPENDIDO', 'X' => 'BORRADO'],
                                "autocomplete: off"
                            ),
                            'label: Estado',
                            'class: has-valid col-md-6 mb-2',
                            'id: estado',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            '<div class="input-group">
                                <input type="password" autocomplete="off" id="password" name="password" class="form-control" placeholder="***" aria-label="password" aria-describedby="button-addon2">
                                <button id="btnShowPassword" class="btn btn-outline-primary border-0 mt-0 mb-0" style="padding:8px" type="button" id="button-addon2"><i class="fa fa-eye"></i></button>
                            </div>',
                            'label: Clave',
                            'class: has-valid col-md-6 mb-2',
                            'id: password',
                            'required: 1'
                        ) ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>