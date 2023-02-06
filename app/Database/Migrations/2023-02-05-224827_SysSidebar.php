<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SysSidebar extends Migration
{
    public function up()
    {
        $this->forge->addField(
        [
            'id' => [
                'type' => 'INT',
                'constraint' => 4,
                'auto_increment' => true
            ],
            'label' => [
                'type' => 'varchar',
                'constraint' => 180,
                'null' => false
            ],
            'estado' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'null' => false
            ],
            'resource_router' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'orden' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => false
            ],
            'sys_sidebar_id' => [
                'type' => 'INT',
                'constraint' => 4,
                'null' => true
            ],
            'ambiente' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'default' => 'E',
                'comment' => 'E:Escritorio, T:Todos, M:Mobile'
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sys_sidebar'); 
    }

    public function down()
    {
        $this->forge->dropTable('sys_sidebar');
    }
}
