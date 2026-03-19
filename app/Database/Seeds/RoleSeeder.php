<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $roles = [
            [
                'name' => 'admin',
                'label' => 'Administrator',
                'description' => 'Full system access',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'teacher',
                'label' => 'Teacher',
                'description' => 'Manages student academic data',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'student',
                'label' => 'Student',
                'description' => 'Regular student user',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'coordinator',
                'label' => 'Coordinator',
                'description' => 'Program coordinator access',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        $this->db->table('roles')->insertBatch($roles);
    }
}
