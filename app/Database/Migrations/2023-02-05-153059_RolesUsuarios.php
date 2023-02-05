<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RolesUsuarios extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => false,
                'auto_increment' => true
            ],
            'id_rol' => [
                'type' => 'int',
                'constraint' => 5,
                'null' => false
            ],
            'id_usuario' => [
                'type' => 'int',
                'constraint' => 8,
                'null' => false
            ],
            'syncros' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('roles_usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('roles_usuarios');
    }
}
