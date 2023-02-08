<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SysSidebar extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'=> 1,
                'label'=> 'Gestión Clientes',
                'estado'=> 'A',
                'resource_router'=> null,
                'orden'=> 1,
                'sys_sidebar_id'=> null,
                'ambiente' => 'T', #todos los ambientes
                'icon' => 'nc-icon nc-book-bookmark'
            ],
            [
                'id'=> 2,
                'label' => 'Listado clientes',
                'estado'=> 'A',
                'resource_router' => 'clientes/index',
                'orden'=> 1,
                'sys_sidebar_id' => 1,
                'ambiente' => 'T',
                'icon' => 'L'
            ],
            [
                'id'=> 3,
                'label'=> 'Crear cliente',
                'estado'=> 'A',
                'resource_router'=> 'clientes/create',
                'orden'=> 2,
                'sys_sidebar_id'=> 1,
                'ambiente' => 'E',
                'icon' => 'C'
            ],
            [
                'id'=> 4,
                'label' => 'Editar cliente',
                'estado' => 'O', #Oculto activo
                'resource_router' => 'clientes/editar',
                'orden' => 3,
                'sys_sidebar_id' => 1,
                'ambiente' => 'E',
                'icon' => 'E'
            ],
            [
                'id'=> 5,
                'label' => 'Borrar cliente',
                'estado' => 'O', #Oculto activo
                'resource_router' => 'clientes/delete',
                'orden' => 4,
                'sys_sidebar_id' => 1,
                'ambiente' => 'E',
                'icon' => 'D'
            ],
            [
                'id'=> 6,
                'label' => 'Datos De Usuario',
                'estado' => 'A', #Oculto activo
                'resource_router' => '',
                'orden' => 1,
                'sys_sidebar_id' => null,
                'ambiente' => 'T',
                'icon' => 'fa fa-user'
            ],
            [
                'id'=> 7,
                'label' => 'Perfil',
                'estado' => 'A', #Oculto activo
                'resource_router' => 'perfil/index',
                'orden' => 1,
                'sys_sidebar_id' => 6,
                'ambiente' => 'T',
                'icon' => 'P'   
            ],
            [
                'id'=> 8,
                'label' => 'Configuración',
                'estado' => 'A',
                'resource_router' => '',
                'orden' => 3,
                'sys_sidebar_id' => null,
                'ambiente' => 'E',
                'icon' => 'fa fa-cogs'   
            ],
            [
                'id'=> 9,
                'label' => 'Municipios',
                'estado' => 'A',
                'resource_router' => 'config/municipios',
                'orden' => 1,
                'sys_sidebar_id' => 8,
                'ambiente' => 'E',
                'icon' => 'MU'   
            ],
            [
                'id'=> 10,
                'label' => 'Tipos Residuos',
                'estado' => 'A',
                'resource_router' => 'config/residuos',
                'orden' => 2,
                'sys_sidebar_id' => 8,
                'ambiente' => 'E',
                'icon' => 'TR'   
            ],
            [
                'id'=> 11,
                'label' => 'Listar Usuarios',
                'estado' => 'A',
                'resource_router' => 'config/usuarios',
                'orden' => 2,
                'sys_sidebar_id' => 8,
                'ambiente' => 'E',
                'icon' => 'U'   
            ],
            [
                'id'=> 12,
                'label' => 'Empleados',
                'estado' => 'A',
                'resource_router' => 'empleados/index',
                'orden' => 2,
                'sys_sidebar_id' => 8,
                'ambiente' => 'E',
                'icon' => 'EM'   
            ]
        ];

        foreach($data as $row){
            $this->db->table('sys_sidebar')->insert($row);
        }
    }
}
