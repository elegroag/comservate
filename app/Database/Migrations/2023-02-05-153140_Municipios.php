<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Municipios extends Migration
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
            'municipio' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'null' => false
            ],
            'estado' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'null' => false
            ],
            'departamento_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => false
            ],
            'syncros' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('municipios');
    }

    public function down()
    {
        $this->forge->dropTable('municipios');
    }
}
