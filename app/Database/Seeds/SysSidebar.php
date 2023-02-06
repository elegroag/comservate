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
                'icon' => ''
            ],
            [
                'id'=> 2,
                'label' => 'Listado clientes',
                'estado'=> 'A',
                'resource_router' => 'clientes/index',
                'orden'=> 1,
                'sys_sidebar_id' => 1,
                'ambiente' => 'T',
                'icon' => ''
            ],
            [
                'id'=> 3,
                'label'=> 'Crear cliente',
                'estado'=> 'A',
                'resource_router'=> 'clientes/create',
                'orden'=> 2,
                'sys_sidebar_id'=> 1,
                'ambiente' => 'E',
                'icon' => ''
            ],
            [
                'id'=> 4,
                'label' => 'Editar cliente',
                'estado' => 'O', #Oculto activo
                'resource_router' => 'clientes/editar',
                'orden' => 3,
                'sys_sidebar_id' => 1,
                'ambiente' => 'E',
                'icon' => ''
            ],
            [
                'id'=> 5,
                'label' => 'Borrar cliente',
                'estado' => 'O', #Oculto activo
                'resource_router' => 'clientes/delete',
                'orden' => 4,
                'sys_sidebar_id' => 1,
                'ambiente' => 'E',
                'icon' => ''
            ]  
        ];

        foreach($data as $row){
            $this->db->table('sys_sidebar')->insert($row);
        }
    }
}
