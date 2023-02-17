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
                'label' => 'Datos De Usuario',
                'estado' => 'A', #Oculto activo
                'resource_router' => '',
                'orden' => 1,
                'sys_sidebar_id' => null,
                'ambiente' => 'T',
                'icon' => 'fa fa-user'
            ],
            [
                'id'=> 2,
                'label'=> 'Gestión Clientes',
                'estado'=> 'A',
                'resource_router'=> null,
                'orden'=> 1,
                'sys_sidebar_id'=> null,
                'ambiente' => 'T', #todos los ambientes
                'icon' => 'nc-icon nc-book-bookmark'
            ],
            [
                'id'=> 3,
                'label' => 'Tabla Clientes',
                'estado'=> 'A',
                'resource_router' => 'web/clientes#all',
                'orden'=> 1,
                'sys_sidebar_id' => 2,
                'ambiente' => 'T',
                'icon' => 'L'
            ],
            [
                'id'=> 4,
                'label'=> 'Crear Cliente',
                'estado'=> 'A',
                'resource_router'=> 'web/clientes#crear',
                'orden'=> 2,
                'sys_sidebar_id'=> 2,
                'ambiente' => 'E',
                'icon' => 'C'
            ],
            [
                'id'=> 5,
                'label' => 'Editar cliente',
                'estado' => 'O', #Oculto activo
                'resource_router' => 'web/clientes#editar',
                'orden' => 3,
                'sys_sidebar_id' => 2,
                'ambiente' => 'E',
                'icon' => 'E'
            ],
            [
                'id'=> 6,
                'label' => 'Detalle cliente',
                'estado' => 'O', #Oculto activo
                'resource_router' => 'web/clientes#detalle',
                'orden' => 4,
                'sys_sidebar_id' => 2,
                'ambiente' => 'E',
                'icon' => 'D'
            ],
            [
                'id'=> 7,
                'label' => 'Perfil',
                'estado' => 'A', #Oculto activo
                'resource_router' => 'web/perfil#show',
                'orden' => 1,
                'sys_sidebar_id' => 1,
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
                'resource_router' => 'conf/municipios',
                'orden' => 1,
                'sys_sidebar_id' => 8,
                'ambiente' => 'E',
                'icon' => 'MU'   
            ],
            [
                'id'=> 10,
                'label' => 'Tipos Residuos',
                'estado' => 'A',
                'resource_router' => 'conf/residuos',
                'orden' => 2,
                'sys_sidebar_id' => 8,
                'ambiente' => 'E',
                'icon' => 'TR'   
            ],
            [
                'id'=> 11,
                'label' => 'Empleados',
                'estado' => 'A',
                'resource_router' => 'conf/empleados',
                'orden' => 2,
                'sys_sidebar_id' => 8,
                'ambiente' => 'E',
                'icon' => 'EM'   
            ],
            [
                'id'=> 12,
                'label' => 'Gestión Usuarios',
                'estado' => 'A',
                'resource_router' => null,
                'orden' => 4,
                'sys_sidebar_id' => null,
                'ambiente' => 'E',
                'icon' => 'fa fa-users'   
            ],
            [
                'id'=> 13,
                'label' => 'Tabla Usuarios',
                'estado' => 'A',
                'resource_router' => 'conf/usuarios#all',
                'orden' => 4,
                'sys_sidebar_id' => 12,
                'ambiente' => 'E',
                'icon' => 'TU'   
            ],
            [
                'id'=> 14,
                'label' => 'Crear Usuario',
                'estado' => 'A',
                'resource_router' => 'conf/usuarios#crear',
                'orden' => 4,
                'sys_sidebar_id' => 12,
                'ambiente' => 'E',
                'icon' => 'CU'   
            ]
        ];

        foreach($data as $row){
            $this->db->table('sys_sidebar')->insert($row);
        }
    }
}
