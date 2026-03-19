<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        // Look up role IDs dynamically — avoids hard-coded IDs that
        // may differ if the seeder is run on a fresh vs. existing DB
        $getRoleId = function (string $slug): ?int {
            $row = $this->db->table('roles')->where('name', $slug)->get()->getRowArray();
            return $row ? (int) $row['id'] : null;
        };

        // Hash the shared demo password using CI4's recommended approach:
        // password_hash() with PASSWORD_BCRYPT (cost factor defaults to 10)
        // password_verify() should be used to check this hash on login
        $hash = password_hash('Password1', PASSWORD_BCRYPT);

        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@school.edu',
                'password' => $hash,
                'role_id' => $getRoleId('admin'),
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,       // NULL = active (not soft-deleted)
            ],
            [
                'name' => 'Teacher Cruz',
                'email' => 'teacher@school.edu',
                'password' => $hash,
                'role_id' => $getRoleId('teacher'),
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ],
            [
                'name' => 'Student Reyes',
                'email' => 'student@school.edu',
                'password' => $hash,
                'role_id' => $getRoleId('student'),
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ],
            [
                'name' => 'Coordinator Bautista',
                'email' => 'coordinator@school.edu',
                'password' => $hash,
                'role_id' => $getRoleId('coordinator'),
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ],
        ];

        $this->db->table('users')->insertBatch($users);
    }
}
