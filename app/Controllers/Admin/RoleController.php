<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class RoleController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Get roles with user count
        $roles = $this->db->table('roles')
            ->select('roles.*, COUNT(users.id) as user_count')
            ->join('users', 'users.role_id = roles.id', 'left')
            ->groupBy('roles.id')
            ->get()->getResult();

        return view('admin/roles/index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('admin/roles/create');
    }

    public function store()
    {
        $rules = [
            'name' => 'required|alpha_dash|is_unique[roles.name]',
            'label' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->db->table('roles')->insert([
            'name' => $this->request->getPost('name'),
            'label' => $this->request->getPost('label'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/admin/roles')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = $this->db->table('roles')->where('id', $id)->get()->getRow();
        if (!$role) return redirect()->to('/admin/roles')->with('error', 'Role not found.');

        return view('admin/roles/edit', ['role' => $role]);
    }

    public function update($id)
    {
        $role = $this->db->table('roles')->where('id', $id)->get()->getRow();
        if (!$role) return redirect()->to('/admin/roles')->with('error', 'Role not found.');

        $rules = [
            'label' => 'required',
        ];

        // Core roles lock slug 'name'
        $coreRoles = ['admin', 'teacher', 'student'];
        $data = [
            'label' => $this->request->getPost('label'),
            'description' => $this->request->getPost('description'),
        ];

        if (!in_array($role->name, $coreRoles)) {
            $rules['name'] = "required|alpha_dash|is_unique[roles.name,id,{$id}]";
            $data['name'] = $this->request->getPost('name');
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->db->table('roles')->where('id', $id)->update($data);

        return redirect()->to('/admin/roles')->with('success', 'Role updated successfully.');
    }

    public function delete($id)
    {
        $role = $this->db->table('roles')->where('id', $id)->get()->getRow();
        if (!$role) return redirect()->to('/admin/roles')->with('error', 'Role not found.');

        if ($role->name === 'admin') {
            return redirect()->to('/admin/roles')->with('error', 'Cannot delete the admin role.');
        }

        // Unassign affected users (set to student role or null, assuming student is default)
        $studentRole = $this->db->table('roles')->where('name', 'student')->get()->getRow();
        if ($studentRole) {
            $this->db->table('users')->where('role_id', $id)->update(['role_id' => $studentRole->id]);
        }

        $this->db->table('roles')->where('id', $id)->delete();

        return redirect()->to('/admin/roles')->with('success', 'Role deleted successfully.');
    }
}
