<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        return view('profile/detail_profile');
    }

    public function getById()
    {
        $model = new UserModel();
        $user['user'] = $model->find(1); 

        return view('profile/detail_profile', $user);
    }

    public function edit()
    {
        $model = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $model->update(1, $data);

        return redirect()->to('/profile')->with('success', 'Profile updated successfully');
    }
}
