<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TiposIdentificacion extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 3,
                'unsigned'       => false,
                'auto_increment' => true
            ],
            'sigla'=> [
                'type'       => 'CHAR',
                'constraint' => 3,
                'unique'     => true
            ],
            'descripcion' => [
                'type'       => 'VARCHAR',
                'constraint' => 140
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tipos_identificacion');
    }

    public function down()
    {
        $this->forge->dropTable('tipos_identificacion');
    }
}
