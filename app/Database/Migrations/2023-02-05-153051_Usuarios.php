<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Usuarios extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 8,
                'unsigned'       => false,
                'auto_increment' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 224,
                'null' => false
            ],
            'nombres' => [
                'type' => 'VARCHAR',
                'constraint'  => 200,
                'null' => false
            ],
            'correo' => [
                'type' => 'VARCHAR',
                'constraint' => 180,
                'null' => false
            ],
            'usuario' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],
            'estado' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'null' => false
            ],
            'fecha_creacion' => [
                'type' => 'timestamp',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'fecha_modificacion' => [
                'type' => 'timestamp',
                'null' => true
            ],
            'syncros' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
