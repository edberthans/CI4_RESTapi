<?php 
namespace App\Database\Migrations;

class Users extends \CodeIgniter\Database\Migration{

    public function up(){
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'username' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' => [
                'type' => 'TEXT',
                'constraint' => 100,
            ],
            'age' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'password' => [
                'type' => 'TEXT',
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
