<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApiTokensTable extends Migration
{
    public function up()
    {
        // 1. Define the columns for our new table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true, // Must match the user table's ID
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => '64', // Our random string token length 
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // 2. Set 'id' as the Primary Key
        $this->forge->addKey('id', true);

        // 3. Link user_id to the 'users' table so we know who owns the token
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        // 4. Create the actual table
        $this->forge->createTable('api_tokens');
    }

    public function down()
    {
        // If we ever want to rollback, this drops the table
        $this->forge->dropTable('api_tokens');
    }
}
