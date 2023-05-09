<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePlans extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'plan_id' => [ //Será populado quando tivermos retorno da gerencianet
                'type'           => 'INT',
                'constraint'     => 11,                
                'null'           => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'recorrence' => [
                'type'       => 'ENUM',
                'constraint' => ['monthly', 'quarterly', 'semester', 'yearly'],
            ],
            'adverts' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'description' => [
                'type'       => 'TEXT',
                
            ],
            'value' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',                
            ],
            'is_highlighted' => [ //Indica quando o plano deve ser destacado na área de vendas
                'type'       => 'BOOLEAN',
                'default' => false,                
                'null' => false,                
            ],            
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('name');

        $this->forge->createTable('plans');
    }

    public function down()
    {
        $this->forge->dropTable('plans');
    }
}
