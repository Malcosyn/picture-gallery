<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            $role = $user['role'] ?? 'user';

            session()->set([
                'user_id'   => $user['id'],
                'user_role' => $role,
            ]);

            if ($role === 'admin') {
                return redirect()->to('/admin')->with('success', 'Login successful!');
            }

            return redirect()->to('/photos')->with('success', 'Login successful!');
        } else {
            return redirect()->to('/login')->with('error', 'Invalid email or password.');
        }
    }
}
