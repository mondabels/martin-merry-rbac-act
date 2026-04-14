<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class AuthController extends ResourceController
{
    public function createToken()
    {

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        if (!$email || !$password) {
            return $this->failValidationError('Email and password are required');
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->failUnauthorized('Invalid email or password');
        }

        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 day'));

        $db = \Config\Database::connect();
        $db->table('api_tokens')->insert([
            'user_id' => $user['id'],
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
            'expires_at' => $expiresAt
        ]);

        return $this->respond([
            'status' => 'success',
            'message' => 'Token issued successfully.',
            'data' => [
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $expiresAt,
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ]
            ]
        ]);
    }
}
