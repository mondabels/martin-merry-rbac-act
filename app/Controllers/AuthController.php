<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    public function register()
    {
        helper(['form']);

        if (strtolower($this->request->getMethod()) === 'post') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[50]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'pass_confirm' => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $db = \Config\Database::connect();
            $role = $db->table('roles')->where('name', 'student')->get()->getRow();
            $roleId = $role ? $role->id : 3;

            $userModel = new UserModel();
            $userModel->save([
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'role_id' => $roleId,
            ]);

            session()->setFlashdata('success', 'Registration successful! Please login.');
            return redirect()->to('/login');
        }

        return view('auth/register');
    }

    public function login()
    {
        if (session()->has('user')) {
            $role = session('user')['role'] ?? 'student';
            return match ($role) {
                'admin', 'teacher' => redirect()->to('/dashboard'),
                'student' => redirect()->to('/student/dashboard'),
                default => redirect()->to('/login'),
            };
        }

        helper(['form']);

        if (strtolower($this->request->getMethod()) === 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $userModel = new UserModel();
            $user = $userModel->where('email', $this->request->getPost('email'))->first();

            if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
                session()->setFlashdata('error', 'Invalid login credentials.');
                return redirect()->back()->withInput();
            }

            $db = \Config\Database::connect();
            $role = $db->table('roles')->where('id', $user['role_id'])->get()->getRow();

            $roleName = $role ? $role->name : 'student';

            session()->set([
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $roleName,
                    'profile_image' => $user['profile_image'] ?? null,
                ],
                'isLoggedIn' => true,
            ]);

            return match ($roleName) {
                'admin' => redirect()->to('/dashboard'),
                'teacher' => redirect()->to('/dashboard'),
                'student' => redirect()->to('/student/dashboard'),
                default => redirect()->to('/login'),
            };
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function unauthorized()
    {
        return view('errors/unauthorized');
    }
}