<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class AuthController extends ResourceController
{
    /**
     * POST /api/v1/auth/token
     * Authenticates a user and generates an API token
     */
    public function createToken()
    {
        // 1. Get the email and password sent by the user
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // 2. Make sure they actually typed something in
        if (!$email || !$password) {
            return $this->failValidationError('Email and password are required');
        }

        // 3. Ask the database to find a user with this email
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        // 4. Check if user exists AND if the password matches the hashed one in the DB
        if (!$user || !password_verify($password, $user['password'])) {
            return $this->failUnauthorized('Invalid email or password');
        }

        // 5. Success! Generate a random secure token
        $token = bin2hex(random_bytes(32));

        // 6. Save the token in our database so we remember who it belongs to
        $db = \Config\Database::connect();
        $db->table('api_tokens')->insert([
            'user_id' => $user['id'],
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // 7. Give the token string back to the user as a JSON response
        return $this->respond([
            'message' => 'Token generated successfully. KEEP THIS SECURE!',
            'token' => $token,
        ]);
    }
}
