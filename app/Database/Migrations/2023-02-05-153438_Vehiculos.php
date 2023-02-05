<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Vehiculos extends Migration
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
            'placa' => [
                'type' => 'CHAR',
                'constraint'  => 10,
                'null' => true,
                'unique' => true
            ],
            'marca' => [
                'type' => 'VARCHAR',
                'constraint'  => 60,
                'null' => true
            ],
            'estado' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'null' => false
            ],
            'modelo' => [
                'type' => 'CHAR',
                'constraint' => 10,
                'null' => false
            ],
            'id_usuario' => [
                'type' => 'INT',
                'constraint' => 8,
                'null' => false
            ],
            'fecha_creacion' => [
                'type' => 'timestamp',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'fecha_modificacion' => [
                'type' => 'timestamp',
                'null' => true
            ],
            'syncros' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('vehiculos'); 
    }

    public function down()
    {
        $this->forge->dropTable('vehiculos');
    }
}
