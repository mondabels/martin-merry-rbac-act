<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function show()
    {
        $userModel = new UserModel();
        $user = $userModel->find(session('user')['id']);
        return view('profile/show', ['user' => $user]);
    }

    public function edit()
    {
        $userModel = new UserModel();
        $user = $userModel->find(session('user')['id']);
        return view('profile/edit', ['user' => $user]);
    }

    public function update()
    {
        helper(['form']);
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
        ];

        $userId = session('user')['id'];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone') ?? '',
            'address' => $this->request->getPost('address') ?? '',
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!is_dir(FCPATH . 'uploads/profiles/')) {
                mkdir(FCPATH . 'uploads/profiles/', 0777, true);
            }
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/profiles/', $newName);
            $data['profile_image'] = $newName;

            $userArr = session('user');
            $userArr['profile_image'] = $newName;
            session()->set('user', $userArr);
        }

        $userModel->update($userId, $data);

        $userArr = session('user');
        $userArr['name'] = $data['name'];
        session()->set('user', $userArr);

        session()->setFlashdata('success', 'Profile updated successfully.');

        return redirect()->to('/profile');
    }
}
