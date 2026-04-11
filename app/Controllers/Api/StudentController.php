<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class StudentController extends ResourceController
{

    private function getStudentRoleId()
    {
        $db = \Config\Database::connect();
        $role = $db->table('roles')->where('name', 'student')->get()->getRow();
        return $role ? $role->id : 3;
    }

    public function index()
    {
        $userModel = new UserModel();
        $roleId = $this->getStudentRoleId();

        $students = $userModel->where('role_id', $roleId)->findAll();

        return $this->respond([
            'message' => 'Students retrieved successfully',
            'data' => $students
        ]);
    }

    public function show($id = null)
    {
        $userModel = new UserModel();
        $roleId = $this->getStudentRoleId();

        $student = $userModel->where('role_id', $roleId)->find($id);

        if (!$student) {
            return $this->failNotFound('Student not found matching this ID');
        }

        return $this->respond([
            'message' => 'Student retrieved successfully',
            'data' => $student
        ]);
    }
}
