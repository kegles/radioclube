<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Socio extends Migration {

    public function up() {
        $this->forge->addColumn('socios',[
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,

            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => 15
            ],
            'cpf' => [
                'type' => 'VARCHAR',
                'constraint' => 14,
                'null' => false,
                'unique' => true,
            ]
        ]);
    }

    public function down() {
        $this->forge->dropColumn('socios', 'nome');
        $this->forge->dropColumn('socios', 'telefone');
        $this->forge->dropColumn('socios', 'cpf');
    }


}