<div class='row'>
    <div class="col-md-6">
        <div class="row justify-content-first">
            <h4 class="card-title"> Tabla De Municipios</h4>
            <p class="card-category"> Modulo de municipios para la administración y control de los mismos.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="nav justify-content-end">
            <div class="nav-item d-none">
                <button class="nav-link btn btn-success" id='btnSendData'>
                    <span class="btn-label"><i class="nc-icon nc-check-2"></i></span> Exportar
                </button>
            </div>
            <div class="nav-item d-none">
                <button class="nav-link btn btn-success" id='btnSendData'>
                    <span class="btn-label"><i class="nc-icon nc-check-2"></i></span> Crear
                </button>
            </div>
            <div class="nav-item d-none">
                <button class="nav-link btn btn-success" id='btnSendData'>
                    <span class="btn-label"><i class="nc-icon nc-check-2"></i></span> Filtrar
                </button>
            </div>
        </div>
    </div>

    <div class='col'>
        <div class="card">
            <div class="card-body" id='render_data_table'>
                <table class="table table-striped table-bordered dataTable dtr-inline" id='datatable' aria-describedby="datatable_info" style="width: 100%;">
                    <thead class="text-primary">
                        <tr>
                            <th>ID</th>
                            <th>Municipio</th>
                            <th>Estado</th>
                            <th>Departamento</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id='filas'></tbody>
                </table>
            </div>
        </div>
    </div>
</div>