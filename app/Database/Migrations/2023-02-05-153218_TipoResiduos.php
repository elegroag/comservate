<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipoResiduos extends Migration
{
    
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'  => 'INT',
                'constraint'  => 8,
                'unsigned' => false,
                'auto_increment' => true
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => 224,
                'null' => false
            ],
            'tipo' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
                'null' => false
            ],
            'syncros' => [
                'type' => 'VARCHAR',
                'constraint' => 225,
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tipo_residuos');
    }

    public function down()
    {
        $this->forge->dropTable('tipo_residuos');
    }
}
