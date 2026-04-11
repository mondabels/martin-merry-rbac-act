<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class StudentController extends ResourceController
{
    // Helping function to figure out what ID the "student" role uses in the database
    private function getStudentRoleId()
    {
        $db = \Config\Database::connect();
        $role = $db->table('roles')->where('name', 'student')->get()->getRow();
        return $role ? $role->id : 3;
    }

    /**
     * GET /api/v1/students
     * Fetch all students (returns JSON list)
     */
    public function index()
    {
        $userModel = new UserModel();
        $roleId = $this->getStudentRoleId();

        // 1. Ask database for all users who have the role of "student"
        $students = $userModel->where('role_id', $roleId)->findAll();

        // 2. We use ->respond() instead of return view(). This sends back raw JSON data!
        return $this->respond([
            'message' => 'Students retrieved successfully',
            'data' => $students
        ]);
    }

    /**
     * GET /api/v1/students/{id}
     * Fetch ONE specific student by their ID
     */
    public function show($id = null)
    {
        $userModel = new UserModel();
        $roleId = $this->getStudentRoleId();

        // 1. Try to find one specific student using the $id passed from the URL route
        $student = $userModel->where('role_id', $roleId)->find($id);

        // 2. If no student exists with this ID, return a 404 Not Found error
        if (!$student) {
            return $this->failNotFound('Student not found matching this ID');
        }

        // 3. Return the single student object as JSON
        return $this->respond([
            'message' => 'Student retrieved successfully',
            'data' => $student
        ]);
    }
}
