<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ForeingKeys extends Seeder
{
    public function run()
    {
        $this->cargosEmpleados();
        $this->clientes();
        $this->departamentos();
        $this->empleados();
        $this->municipios();
        $this->rhps();
        $this->rolesUsuarios();
        $this->vehiculos();
        $this->zonas();
        $this->zonasMunicipios();
        $this->recoleccion();
    }

    private function cargosEmpleados() {
        $this->forge->addForeignKey('id_empleado','empleados', 'id', 'NO ACTION','NO ACTION', 'cargos_empleados_id_empleado_FK');
        $this->forge->addForeignKey('id_cargo', 'cargos', 'id','NO ACTION','NO ACTION','cargos_empleados_id_cargo_FK');
        $this->forge->processIndexes('cargos_empleados');
    }


    public function clientes()
    {
        $this->forge->addForeignKey('id_municipio','municipios', 'id', 'NO ACTION', 'NO ACTION', 'clientes_id_municipio_FK');
        $this->forge->addForeignKey('usuario_creador','usuarios', 'id','NO ACTION', 'NO ACTION', 'clientes_usuario_creador_FK');
        $this->forge->processIndexes('clientes');
    }


    public function departamentos()
    {
        $this->forge->addForeignKey('pais','paises', 'id', 'NO ACTION', 'NO ACTION', 'departamentos_id_pais_FK');
        $this->forge->processIndexes('departamentos');
    }

    public function empleados()
    {
        $this->forge->addForeignKey('usuario_empleado','usuarios', 'id', 'NO ACTION', 'NO ACTION', 'empleados_usuario_empleado_FK');
        $this->forge->addForeignKey('tipo_identificacion','tipos_identificacion', 'id', 'NO ACTION', 'NO ACTION', 'empleados_tipo_identificacion_FK');
        $this->forge->processIndexes('empleados');
    }

    public function municipios()
    {
        $this->forge->addForeignKey('departamento_id','departamentos', 'id', 'NO ACTION', 'NO ACTION', 'municipios_departamento_id_FK');
        $this->forge->processIndexes('municipios');
    }

    public function recoleccion()
    {
        $this->forge->addForeignKey('tipo_residuo','tipo_residuos', 'id', 'NO ACTION', 'NO ACTION','recoleccion_tipo_residuo_FK');
        $this->forge->addForeignKey('id_rhps','rhps', 'id', 'CASCADE', 'CASCADE', 'recoleccion_id_rhps_FK');
        $this->forge->processIndexes('recoleccion');
    }

    public function rhps()
    {
        $this->forge->addForeignKey('id_cliente','clientes', 'id', 'NO ACTION', 'NO ACTION','rhps_id_cliente_FK');
        $this->forge->addForeignKey('usuario_creador','usuarios', 'id', 'NO ACTION', 'NO ACTION','rhps_usuario_creador_FK');
        $this->forge->addForeignKey('id_empleado','empleados', 'id', 'NO ACTION', 'NO ACTION','rhps_id_empleado_FK');
        $this->forge->addForeignKey('vehiculo','vehiculos', 'id', 'NO ACTION', 'NO ACTION','rhps_vehiculo_FK');
        $this->forge->processIndexes('rhps');
    }

    public function rolesUsuarios()
    {
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id','NO ACTION','NO ACTION','roles_usuarios_id_usuario_FK');
        $this->forge->addForeignKey('id_rol', 'roles', 'id', 'NO ACTION','NO ACTION','roles_usuarios_id_rol_FK');
        $this->forge->processIndexes('roles_usuarios');
    }

    public function vehiculos()
    {
        $this->forge->addForeignKey('id_usuario','usuarios', 'id', 'NO ACTION', 'NO ACTION', 'vehiculos_id_usuario_FK');        
        $this->forge->processIndexes('vehiculos');
    }

    public function zonas()
    {
        $this->forge->addForeignKey('id_usuario','usuarios', 'id', 'NO ACTION', 'NO ACTION','zonas_id_usuario_FK');
        $this->forge->processIndexes('zonas');
    }

    public function zonasMunicipios()
    {
        $this->forge->addForeignKey('id_municipio','municipios', 'id','NO ACTION', 'NO ACTION','zonas_municipios_id_municipio_FK');        
        $this->forge->processIndexes('zonas_municipios');
    }

}
