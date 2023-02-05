<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Recoleccion extends Migration
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
            'id_rhps' => [
                'type'       => 'INT',
                'constraint' => 14,
                'null' => false
            ],
            'tipo_residuo' => [
                'type' => 'INT',
                'constraint' => 8,
                'null' => false
            ],
            'cantidad_residuo' => [
                'type' => 'DOUBLE',
                'constraint' => '8,2',
                'null' => false,
                'default' => 0.00
            ],
            'syncros' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('recoleccion');
    }

    public function down()
    {
        $this->forge->dropTable('recoleccion');
    }
}
