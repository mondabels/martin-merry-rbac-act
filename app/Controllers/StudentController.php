<?php

namespace App\Controllers;

use App\Models\UserModel;

class StudentController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    private function getStudentRoleId()
    {
        $db = \Config\Database::connect();
        $role = $db->table('roles')->where('name', 'student')->get()->getRow();
        return $role ? $role->id : 3;
    }

    public function dashboard()
    {
        return view('dashboard/index');
    }

    public function index()
    {
        $roleId = $this->getStudentRoleId();
        $students = $this->userModel->where('role_id', $roleId)->findAll();

        return view('students/index', ['students' => $students]);
    }

    public function show($id)
    {
        $roleId = $this->getStudentRoleId();
        $student = $this->userModel->where('role_id', $roleId)->find($id);

        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('students/show', ['student' => $student]);
    }

    public function create()
    {
        return view('students/create');
    }

    public function store()
    {
        helper(['form']);

        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'student_id' => 'required|is_unique[users.student_id]',
            'course' => 'required',
            'year_level' => 'required|numeric',
            'section' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $passwordHash = password_hash('Password123', PASSWORD_BCRYPT);

        $this->userModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $passwordHash,
            'role_id' => $this->getStudentRoleId(),
            'student_id' => $this->request->getPost('student_id'),
            'course' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section' => $this->request->getPost('section'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ]);

        session()->setFlashdata('success', 'Student created successfully. Default password is Password123');
        return redirect()->to('/students');
    }

    public function edit($id)
    {
        $roleId = $this->getStudentRoleId();
        $student = $this->userModel->where('role_id', $roleId)->find($id);

        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('students/edit', ['student' => $student]);
    }

    public function update($id)
    {
        helper(['form']);

        $roleId = $this->getStudentRoleId();
        $student = $this->userModel->where('role_id', $roleId)->find($id);

        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'name' => 'required',
            'email' => "required|valid_email|is_unique[users.email,id,{$id}]",
            'student_id' => "required|is_unique[users.student_id,id,{$id}]",
            'course' => 'required',
            'year_level' => 'required|numeric',
            'section' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->update($id, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'student_id' => $this->request->getPost('student_id'),
            'course' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section' => $this->request->getPost('section'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ]);

        session()->setFlashdata('success', 'Student updated successfully.');
        return redirect()->to('/students');
    }

    public function delete($id)
    {
        $roleId = $this->getStudentRoleId();
        $student = $this->userModel->where('role_id', $roleId)->find($id);

        if ($student) {
            $this->userModel->delete($id);
            session()->setFlashdata('success', 'Student deleted successfully.');
        } else {
            session()->setFlashdata('error', 'Student not found.');
        }

        return redirect()->to('/students');
    }
}
