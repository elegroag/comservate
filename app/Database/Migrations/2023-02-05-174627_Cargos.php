<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Cargos extends Migration
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
            'cargo' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
                'null' => false
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => 220,
                'null' => false
            ],
            'usuario_registra' => [
                'type' => 'INT',
                'constraint' => 8,
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
            'syncros' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cargos');
    }

    public function down()
    {
        $this->forge->dropTable('cargos');
    }
}
