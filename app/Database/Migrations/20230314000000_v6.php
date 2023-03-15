<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class dbv6 extends Migration {

    public function up() {
        $this->forge->addField([
            '_created' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            '_updated' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            '_deleted' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],                        
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'data' => [
                'type' => 'DATE',
            ],
            'ativo' => [
                'type' => 'ENUM("Y","N")',
                'default' => 'Y',
                'null' => false,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('eventos');
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'idEvento' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'indicativo' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('eventos-participantes');        
    }

    public function down() {
        $this->forge->dropTable('eventos');
        $this->forge->dropTable('eventos-participantes');

    }


}