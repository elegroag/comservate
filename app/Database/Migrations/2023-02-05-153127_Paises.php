<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paises extends Migration
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
            'pais' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'null' => false
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('paises');
    }

    public function down()
    {
        $this->forge->dropTable('paises');
    }
}
