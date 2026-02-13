<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $user['user'] = $model->find(4);

        return view('profile/detail_profile', $user);
    }


    public function edit()
    {
        $model = new UserModel();
        $userId = 4;

        $currentUser = $model->find($userId);

        $currentPasswordInput = $this->request->getPost('current_password');

        if (!password_verify($currentPasswordInput, $currentUser['password'])) {
            return redirect()->to('/profile')->with('error', 'Password lama salah!');
        }

        $updateData = [
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            $updateData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $model->update($userId, $updateData);
        return redirect()->to('/profile')->with('success', 'Profile updated!');
    }

    public function delete() {
        $model = new UserModel();
        $userId = 4;

        $currentUser = $model->find($userId);

        $confirmPassword = $this->request->getPost('confirm_password');

        if (!password_verify($confirmPassword, $currentUser['password'])) {
            return redirect()->to('/profile')->with('error', 'Password salah!');
        }

        $model->delete($userId);
        return redirect()->to('/register')->with('success', 'Account deleted!');
    }

    public function hashPassword($password): String
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
