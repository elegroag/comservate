<div class='row'>
    <div class="col-md-6">
        <div class="row justify-content-first">
            <h4 class="card-title"> Crear Registro</h4>
            <p class="card-category"> Modulo de clientes para la administración y control de los mismos.</p>
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
                            numeric_field(
                                'cedula'
                            ),
                            'label: Cedula',
                            'class: has-valid col-md-6 mb-2',
                            'id: cedula',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            numeric_field(
                                'nit'
                            ),
                            'label: Nit',
                            'class: has-valid col-md-6 mb-2',
                            'id: nit',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            text_upper_field(
                                'afiliado'
                            ),
                            'label: Afiliado',
                            'class: has-valid col-md-6 mb-2',
                            'id: afiliado',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            text_upper_field(
                                'representante'
                            ),
                            'label: Representante',
                            'class: has-valid col-md-6 mb-2',
                            'id: representante',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            numeric_field(
                                'contrato'
                            ),
                            'label: Contrato',
                            'class: has-valid col-md-6 mb-2',
                            'id: contrato',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            text_upper_field(
                                'fecha_finalizacion'
                            ),
                            'label: Fecha finalización',
                            'class: has-valid col-md-6 mb-2',
                            'id: fecha_finalizacion'
                        ) ?>
                        <?= formBoostrap(
                            money_field(
                                'valor_kilo'
                            ),
                            'label: Valor kilo',
                            'class: has-valid col-md-6 mb-2',
                            'id: valor_kilo'
                        ) ?>
                        <?= formBoostrap(
                            money_field(
                                'valor_kilo_adicional'
                            ),
                            'label: Valor kilo adicional',
                            'class: has-valid col-md-6 mb-2',
                            'id: valor_kilo_adicional'
                        ) ?>
                        <?= formBoostrap(
                            text_field(
                                'kilos'
                            ),
                            'label: Kilos',
                            'class: has-valid col-md-6 mb-2',
                            'id: kilos',
                            'required: -1'
                        ) ?>
                        <?= formBoostrap(
                            select_statico('id_municipio', []),
                            'label: Municipio',
                            'class: has-valid col-md-6 mb-2',
                            'id: id_municipio',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            text_upper_field(
                                'direccion'
                            ),
                            'label: Dirección',
                            'class: has-valid col-md-6 mb-2',
                            'id: direccion',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            numeric_field(
                                'telefono'
                            ),
                            'label: Teléfono',
                            'class: has-valid col-md-6 mb-2',
                            'id: telefono',
                            'required: 1'
                        ) ?>
                        <?= formBoostrap(
                            text_upper_field(
                                'barrio'
                            ),
                            'label: Barrio',
                            'class: has-valid col-md-6 mb-2',
                            'id: barrio',
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
                            text_field(
                                'especiales'
                            ),
                            'label: Especiales',
                            'class: has-valid col-md-6 mb-2',
                            'id: especiales'
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
                        <?= formBoostrap(
                            numeric_field(
                                'ruta'
                            ),
                            'label: Ruta',
                            'class: has-valid col-md-6 mb-2',
                            'id: ruta',
                            'required: 1'
                        ) ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>