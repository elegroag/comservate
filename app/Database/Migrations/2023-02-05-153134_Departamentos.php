<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Departamentos extends Migration
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
            'pais' => [
                'type'       => 'INT',
                'constraint' => 8,
            ],
            'departamento' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
                'null' => false
            ]
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('departamentos');
    }

    public function down()
    {
        $this->forge->dropTable('departamentos');
    }
}
