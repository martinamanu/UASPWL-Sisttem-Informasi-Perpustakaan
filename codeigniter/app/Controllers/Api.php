<?php

namespace App\Controllers;

use App\Models\Api as ModelsApi;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Controller;

class Api extends ResourceController
{
    // protected $format = "json";
    // protected $model = "App\Models\Buku";
    public function index($id = false)
    {
        $model = new ModelsApi();
        if ($id === false) {
            return $this->respond($model->getBook(), 200);
        } else {
            return $this->respond($model->getBook($id), 200);
        }
    }
    public function bukuId($id)
    {
        //  = $this->request->getVar("id");
        $model = new ModelsApi();
        return $this->respond($model->getBook($id), 200);
    }
    public function deleteBuku($id)
    {
        $auth = new ModelsApi();
        // $array = [];
        $alluser = $auth->deleteBuku($id);
        $data = [
            "status" => 200,
            "data" => [
                "messages" => "success"
            ]
        ];
        return $this->respond($data, 200);
    }
    public function editBuku($id)
    {
        // $email = $this->request->getVar("email");
        $data = [
            "nama_buku" => $this->request->getVar("nama_buku"),
            "penerbit" => $this->request->getVar("penerbit"),
            "penulis" => $this->request->getVar("penulis"),
            "jumlah" => $this->request->getVar("jumlah"),
        ];
        //  = $this->request->getVar("id");
        $auth = new ModelsApi();
        // $array = [];
        $alluser = $auth->updateBuku($data, $id);
        $data = [
            "status" => 200,
            "data" => [
                $alluser
            ]
        ];
        return $this->respond($data, 200);
    }
    public function addBuku()
    {
        // $email = $this->request->getVar("email");
        $data = [
            "nama_buku" => $this->request->getVar("nama_buku"),
            "penerbit" => $this->request->getVar("penerbit"),
            "penulis" => $this->request->getVar("penulis"),
            "jumlah" => $this->request->getVar("jumlah"),
        ];
        // return dd($data);
        //  = $this->request->getVar("id");
        $auth = new ModelsApi();
        // $array = [];
        $alluser = $auth->saveBuku($data);
        $data = [
            "status" => 200,
            "data" => [
                $alluser
            ]
        ];
        return $this->respond($data, 200);
    }
    // public function delete($id)
    // {
    //     $model = new ModelsApi();
    //     $model->deleteBuku($id);
    //     return $this->respond($model->getBook(), 200);
    // }
    public function loginAttempt()
    {
        helper(["form"]);
        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password_form");
        // dd($email);
        // $email = $_POST["email"];
        // $password = $_POST["password_form"];
        // dd($_POST[0]["password_form"]);
        $auth = new ModelsApi();
        $authh = $auth->loginAttempt($email, $password);
        // dd($authh);
        if ($authh) {
            return $this->respond(["status" => 200, "data" => ["api_token" => $authh]], 200);
        } else {
            return ["status" => 404, "errors" => "Authorization failed"];
        }
    }
    public function listLevel()
    {
        $auth = new ModelsApi();
        $array = [];
        $alluser = $auth->listLevel();
        foreach ($alluser as $item) {
            $arraydump = [
                "id" => $item["id"],
                "nama" => $item["nama"],

            ];
            array_push($array, $arraydump);
        }
        $data = [
            "status" => 200,
            "data" => [
                $array
            ]
        ];
        return $this->respond($data, 200);
    }
    public function userAll()
    {
        $auth = new ModelsApi();
        $array = [];
        $alluser = $auth->userAll();
        foreach ($alluser as $item) {
            $arraydump = [
                "id" => $item["id"],
                "nama" => $item["nama"],
                "email" => $item["email"],
                "token" => $item["token"],
                "level" => $auth->getPrivfromId($item["id"])->nama,
                "level_id" => $item["level"]
            ];
            array_push($array, $arraydump);
        }
        $data = [
            "status" => 200,
            "data" => [
                $array
            ]
        ];
        return $this->respond($data, 200);
    }
    public function userId($id)
    {
        //   = $this->request->getVar("id");
        $auth = new ModelsApi();
        // $array = [];
        $alluser = $auth->userId($id);
        $array = [
            "id" => $alluser->id,
            "nama" => $alluser->nama,
            "email" => $alluser->email,
            "token" => $alluser->token,
            "level" => $auth->getPrivfromId($alluser->id)->nama,
            "level_id" => $alluser->level
        ];
        $data = [
            "status" => 200,
            "data" => [
                $array
            ]
        ];
        return $this->respond($data, 200);
    }
    public function userToken()
    {
        $token  = $_POST["token"];
        // $token  =  $this->request->getPost("token");
        $auth = new ModelsApi();
        // $array = [];
        $alluser = $auth->getUserInfoFromToken($token);
        $array = [
            "id" => $alluser->id,
            "nama" => $alluser->nama,
            "email" => $alluser->email,
            "token" => $alluser->token,
            "level" => $auth->getPrivfromId($alluser->id),
            "level_id" => $alluser->level
        ];
        $data = [
            "status" => 200,
            "data" => [
                $array
            ]
        ];
        return $this->respond($data, 200);
    }
    public function deleteUser($id)
    {
        //  = $this->request->getVar("id");
        $auth = new ModelsApi();
        // $array = [];
        $alluser = $auth->deleteUser($id);
        $data = [
            "status" => 200,
            "data" => [
                "messages" => "success"
            ]
        ];
        return $this->respond($data, 200);
    }
    public function addUser()
    {
        $data = [
            "email" => $this->request->getVar("email"),
            "password" => password_hash($this->request->getVar("password"), PASSWORD_BCRYPT),
            "nama" => $this->request->getVar("nama"),
            "level" => $this->request->getVar("level"),
            "token" => bin2hex(openssl_random_pseudo_bytes(32))
        ];

        //  = $this->request->getVar("id");
        $auth = new ModelsApi();
        // $array = [];
        $alluser = $auth->saveUser($data);
        $data = [
            "status" => 200,
            "data" => [
                $alluser
            ]
        ];
        return $this->respond($data, 200);
    }
    public function editUser($id)
    {
        // $email = $this->request->getVar("email");
        if (!empty($this->request->getVar("password")) && $this->request->getVar("password") != null) {
            $data = [
                "email" => $this->request->getVar("email"),
                "password" => password_hash($this->request->getVar("password"), PASSWORD_BCRYPT),
                "nama" => $this->request->getVar("nama"),
                "level" => $this->request->getVar("level"),
            ];
        } else {
            $data = [
                "email" => $this->request->getVar("email"),
                // "password" => $this->request->getVar("password"),
                "nama" => $this->request->getVar("nama"),
                "level" => $this->request->getVar("level"),
            ];
        }
        //  = $this->request->getVar("id");
        $auth = new ModelsApi();
        // $array = [];
        $alluser = $auth->editUser($data, $id);
        $data = [
            "status" => 200,
            "data" => [
                $alluser
            ]
        ];
        return $this->respond($data, 200);
    }
}
