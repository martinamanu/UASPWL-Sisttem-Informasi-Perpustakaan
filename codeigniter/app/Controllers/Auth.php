<?php

namespace App\Controllers;

use App\Models\Auth as ModelsAuth;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to("/");
    }
    public function login()
    {
        $data["title"] = "Login";
        $data["home_active"] = true;
        echo view("layout/head", $data);
        echo view('auth/login');
        echo view("layout/footer");
    }
    public function index()
    {
        return redirect()->to("/auth/login");
    }
    public function process()
    {
        helper(['form', 'url', 'session']);
        $validate = $this->validate([
            "email" => [
                "rules" => "required|valid_email",
                "errors" => [
                    "required" => "Email harus diisi",
                    "email" => "Harus berformat email"
                ]
            ],
            "password" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Password harus diiisi"
                ]
            ]

        ]);
        if ($validate) {
            $email = $this->request->getPost("email");
            $password = $this->request->getPost("password");
            $model = new ModelsAuth();
            if ($model->authProcess($email, $password)) {
                $user = $model->getUser($email, $password);
                // dd($user->api_token);
                $session = \Config\Services::session();
                $session->set("token", $user->api_token);
                return redirect()->to("/buku");
            } else {
                return redirect()->to("/auth/login");
            }
        } else {
            $data["title"] = "Login";
            $data["home_active"] = true;
            echo view("layout/head", $data);
            echo view('auth/login', ["validate" => $validate]);
            echo view("layout/footer");
        }
    }
}
