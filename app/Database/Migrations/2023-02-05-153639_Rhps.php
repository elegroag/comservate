<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Rhps extends Migration
{
    
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 14,
                'unsigned'       => false,
                'auto_increment' => true
            ],
            'id_cliente' => [
                'type'       => 'INT',
                'constraint' => 14,
                'null' => false
            ],
            'fecha_recoleccion' => [
                'type' => 'date',
                'null' => false
            ],
            'hora_recoleccion' => [
                'type' => 'time',
                'null' => false
            ],
            'id_empleado' => [
                'type' => 'INT',
                'constraint' => 12,
                'null' => false
            ],
            'cantidad_bolsas' => [
                'type' => 'INT',
                'constraint' => 4,
                'null' => false,
                'default' => 1
            ],
            'cantidad_guardianes' => [
                'type' => 'INT',
                'constraint' => 4,
                'default' => 0 
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
            'usuario_creador' => [
                'type' => 'INT',
                'constraint' => 8,
                'null' => false
            ],
            'vehiculo' => [
                'type' => 'INT',
                'constraint' => 8,
                'null' => true
            ],
            'syncros' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ]);
       
        $this->forge->addKey('id', true);
        $this->forge->createTable('rhps');
    }

    public function down()
    {
        $this->forge->dropTable('rhps');
    }
}
