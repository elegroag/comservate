<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ZonasMunicipios extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'  => 'INT',
                'constraint'  => 12,
                'unsigned' => false,
                'auto_increment' => true
            ],
            'id_municipio' => [
                'type' => 'INT',
                'constraint' => 8,
                'null' => false
            ],
            'id_zona' => [
                'type' => 'INT',
                'constraint' => 8,
                'null' => false
            ],
            'syncros' => [
                'type' => 'VARCHAR',
                'constraint' => 225,
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('zonas_municipios');
    }

    public function down()
    {
        $this->forge->dropTable('zonas_municipios');
    }
}
