<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Empleados extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => false,
                'auto_increment' => true
            ],
            'nombres' => [
                'type' => 'VARCHAR',
                'constraint'  => 100,
                'null' => false
            ],
            'apellidos' => [
                'type' => 'VARCHAR',
                'constraint'  => 100,
                'null' => false
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 180,
                'null' => false
            ],
            'usuario_empleado' => [
                'type' => 'INT',
                'constraint' => 8,
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
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'fecha_modificacion' => [
                'type' => 'timestamp',
                'null' => true
            ],
            'identificacion' => [
                'type' => 'BIGINT',
                'constraint' => 17,
                'null' => false
            ],
            'usuario_creador' => [
                'type' => 'INT',
                'constraint' => 8,
                'null' => false
            ],
            'tipo_identificacion' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => false
            ],
            'celular' => [
                'type' => 'CHAR',
                'constraint' => 10,
                'null' => true
            ],
            'direccion' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true
            ],
            'syncros' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('empleados');
    }

    public function down()
    {
        $this->forge->dropTable('empleados');
    }
}
