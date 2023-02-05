<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Clientes extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 14,
                'unsigned'       => false,
                'auto_increment' => false
            ],
            'cedula' => [
                'type' => 'BIGINT',
                'constraint' => 16,
                'null' => false
            ],
            'nit' => [
                'type' => 'BIGINT',
                'constraint' => 16,
                'null' => false
            ],
            'afiliado' => [
                'type' => 'VARCHAR',
                'constraint'  => 180,
                'null' => false
            ],
            'representante' => [
                'type' => 'VARCHAR',
                'constraint'  => 180,
                'null' => false
            ],
            'ruta' => [
                'type' => 'CHAR',
                'constraint' => 3,
                'null' => false
            ],
            'id_municipio' => [
                'type' => 'INT',
                'constraint' => 8,
                'null' => false
            ],
            'frecuencia' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => false
            ],
            'contrato' => [
                'type' => 'INT',
                'constraint' => 8,
                'null' => false
            ],
            'fecha_finalizacion' => [
                'type' => 'datetime',
                'null' => true
            ],
            'valor_kilo' => [
                'type' => 'DOUBLE',
                'constraint' => '12,2',
                'null' => true
            ],
            'kilos' => [
                'type' => 'DOUBLE',
                'constraint' => '8,2',
                'null' => true
            ],
            'valor_kilo_adicional' => [
                'type' => 'DOUBLE',
                'constraint' => '12,2',
                'null' => true
            ],
            'direccion' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true
            ],
            'telefono' => [
                'type' => 'CHAR',
                'constraint' => 10,
                'null' => false
            ],
            'barrio' => [
                'type' => 'VARCHAR',
                'constraint' => 180,
                'null' => false
            ],
            'correo' => [
                'type' => 'VARCHAR',
                'constraint' => 180,
                'null' => false
            ],
            'especiales' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'default' => '0'
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
            'usuario_creador' => [
                'type' => 'INT',
                'constraint' => 8,
                'null' => false
            ],
            'estado' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'null' => false,
                'default' => 'A'
            ],
            'mapa' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'syncros' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('clientes');
    }

    public function down()
    {
        $this->forge->dropTable('clientes');
    }
}
