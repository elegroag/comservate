<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CargosEmpleados extends Migration
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
            'id_cargo' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => false
            ],
            'id_empleado' => [
                'type' => 'INT',
                'constraint' => 14,
                'null' => false
            ],
            'fecha_creacion' => [
                'type' => 'timestamp',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'fecha_modificacion' => [
                'type' => 'timestamp',
                'null' => false
            ],
            'syncros' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('cargos_empleados');
    }

    public function down()
    {
        $this->forge->dropTable('cargos_empleados');
    }
}
