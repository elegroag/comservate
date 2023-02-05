<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Zonas extends Migration
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
            'nombre_zona' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
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
            'id_usuario' => [
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
        $this->forge->createTable('zonas');
    }

    public function down()
    {
        $this->forge->dropTable('zonas');
    }
}
