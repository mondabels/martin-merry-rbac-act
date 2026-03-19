<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UserAdminController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $users = $this->db->table('users')
            ->select('users.*, roles.name as role_name, roles.label as role_label')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->get()->getResult();
            
        $roles = $this->db->table('roles')->get()->getResult();

        return view('admin/users/index', ['users' => $users, 'roles' => $roles]);
    }

    public function assignRole($id)
    {
        $user = $this->db->table('users')->where('id', $id)->get()->getRow();
        if (!$user) return redirect()->to('/admin/users')->with('error', 'User not found.');

        // Block admin from changing own role
        if (session('user')['id'] == $id) {
            return redirect()->to('/admin/users')->with('error', 'Cannot change your own role.');
        }

        $newRoleId = $this->request->getPost('role_id');
        $this->db->table('users')->where('id', $id)->update(['role_id' => $newRoleId]);

        return redirect()->to('/admin/users')->with('success', 'User role updated successfully.');
    }
}
