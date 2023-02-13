<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Socio extends Migration {

    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
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