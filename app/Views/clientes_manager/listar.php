<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-plain">
        <div class="card-header">
            <h4 class="card-title"> Tabla De Clientes</h4>
            <p class="card-category"> Modulo de clientes para la administración y control de los mismos.</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="">
                        <tr>
                            <th>..</th>
                            <th>identificación</th>
                            <th>Afiliado</th>
                            <th>Representante</th>
                            <th class="text-right">Municipio</th>
                            <th>Estado</th>
                            <th>Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Dakota
                            </td>
                            <td>
                                Niger
                            </td>
                            <td>
                                Oud
                            </td>
                            <td>
                                Oud
                            </td>
                            <td class="text-right">
                                $36,738
                            </td>
                            <td>
                                Oud
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>