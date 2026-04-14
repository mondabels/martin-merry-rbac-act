<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddExpiresAtToApiTokens extends Migration
{
    public function up()
    {
        $this->forge->addColumn('api_tokens', [
            'expires_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'created_at'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('api_tokens', 'expires_at');
    }
}
