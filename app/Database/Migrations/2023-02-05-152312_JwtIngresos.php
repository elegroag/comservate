<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JwtIngresos extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'token' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'unique'       => true,
                'auto_increment' => false
            ],
            'dia' => [
                'type' => 'date',
                'null' => false,
            ],
            'hora' => [
                'type' => 'time',
                'null' => false
            ],
            'http_cliente' => [
                'type' => 'VARCHAR',
                'constraint'  => 180,
                'null' => true
            ],
            'http_cliente_origen' => [
                'type' => 'VARCHAR',
                'constraint'  => 180,
                'null' => true
            ],
            'estado' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'null' => false
            ],
            'consumo' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => false
            ]
        ]);
        $this->forge->addKey('token', true);
        $this->forge->createTable('jwt_ingresos'); 
    }

    public function down()
    {
        $this->forge->dropTable('jwt_ingresos');
    }
}
