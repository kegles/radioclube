<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class dbv1 extends Migration {

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
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true
            ],
            'senha' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('socios');
    }

    public function down() {
        $this->forge->dropTable('socios');
    }


}