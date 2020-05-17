<?php

namespace App\Controllers;

use App\Models\Auth;
use CodeIgniter\Controller;

class Buku extends Controller
{
    protected function ambil_post($alamat, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $alamat);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return curl_exec($ch);
        curl_close($ch);
    }
    protected function ambil_get($alamat)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $alamat);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return curl_exec($ch);
        curl_close($ch);
    }
    public function index()
    {
        $data["title"] = "Daftar Buku Dari Laravel";
        $data["laravel_active"] = true;
        $session = \Config\Services::session();
        if ($session->has("token")) {
            $user = new Auth();
            $token = $session->get("token");
            $model = new Auth();
            // if (!$model->getUserPriv($token)->can_see_book) {
            //     // $this->output->set_status_header('404');
            //     return $this->response->setStatusCode(404);
            // }
            // dd($user->getUserFromToken($token));
            $data["user"] = array(
                "email" => $user->getUserFromToken($token)->email,
                "nama" => $user->getUserFromToken($token)->name,
                "token" => $user->getUserFromToken($token)->api_token,
            );
        } else {
            // $data["token"] = "";
            return redirect()->to("/auth/login");
        };
        $data["auth"] = new Auth();
        // $model = new ModelsBuku();
        $client = \Config\Services::curlrequest();
        $res = $this->ambil_get(getenv("laravel.address"));
        // $res = $client->request("GET", getenv("laravel.address"))->getBody();
        $data['buku'] = json_decode($res);
        // dd(json_decode(json_encode($data['buku'])));
        echo view("layout/head", $data);
        echo view("buku/home_dari_laravel", $data);
        echo view("layout/footer");
    }
    public function hapus($id)
    {
        // dd($id);
        $data["title"] = "Hapus Buku Dari Laravel";
        $data["laravel_active"] = true;

        $res = $this->ambil_post(getenv("laravel.address") . "/delete/" . $id, []);
        // dd($res);
        $data['buku'] = json_decode($res);
        return redirect()->to("/buku");
        // dd(json_decode(json_encode($data['buku'])));
        // echo view("layout/head", $data);
        // echo view("buku/home_dari_laravel", $data);
        // echo view("layout/footer");
    }
    public function tambah()
    {
        $data["title"] = "Tambah Buku Dari Laravel";
        $data["laravel_active"] = true;
        $session = \Config\Services::session();
        if ($session->has("token")) {
            $user = new Auth();
            $token = $session->get("token");
            $model = new Auth();
            if (!$model->getUserPriv($token)->can_add_book) {
                // $this->output->set_status_header('404');
                return $this->response->setStatusCode(404);
            }
            $data["user"] = array(
                "email" => $user->getUserFromToken($token)->email,
                "nama" => $user->getUserFromToken($token)->name,
                "token" => $user->getUserFromToken($token)->api_token,
            );
        } else {
            // $data["token"] = "";
            return redirect()->to("/auth/login");
        };

        // return view("buku/tambah.php");
        echo view("layout/head", $data);
        echo view("buku/tambah_dari_laravel", $data);
        echo view("layout/footer");
    }
    public function add()
    {
        helper(['form', 'url', 'session']);
        $data["laravel_active"] = true;
        $data["title"] = "Tambah Buku";
        $session = \Config\Services::session();
        if ($session->has("token")) {
            $user = new Auth();
            $token = $session->get("token");
            $model = new Auth();
            if (!$model->getUserPriv($token)->can_add_book) {
                // $this->output->set_status_header('404');
                return $this->response->setStatusCode(404);
            }
            $data["user"] = array(
                "email" => $user->getUserFromToken($token)->email,
                "nama" => $user->getUserFromToken($token)->name,
                "token" => $user->getUserFromToken($token)->api_token,
            );
        } else {
            // $data["token"] = "";
            return redirect()->to("/auth/login");
        };
        $model = new Buku();
        $session = \Config\Services::session();
        $token = $session->get("token");
        $auth = new Auth();
        if (!$auth->getUserPriv($token)->can_add_book) {
            // $this->output->set_status_header('404');
            return $this->response->setStatusCode(404);
        }
        $validate = $this->validate([
            "nama_buku" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama Buku harus diisi!",
                ]
            ],
            "penulis" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama Penulis harus diisi!"
                ]
            ],
            "penerbit" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama Penerbit harus diisi!"
                ]
            ],
            "jumlah" => [
                "rules" => "required|integer",
                "errors" => [
                    "required" => "Jumlah Buku harus diisi!",
                    "integer" => "Jumlah Buku harus berupa angka!"
                ]
            ],
        ]);
        if ($validate) {
            // dd($this->request);
            $datajson = array(
                "nama_buku" => $this->request->getPost("nama_buku"),
                "penulis" => $this->request->getPost("penulis"),
                "penerbit" => $this->request->getPost("penerbit"),
                "jumlah" => $this->request->getPost("jumlah")
            );
            // $model->saveBuku($data);
            $client = \Config\Services::curlrequest();
            // $datapost = [
            //     "id" => $id
            // ];
            // $ch = curl_init();
            $output = $this->ambil_post("http://localhost:8000/api/tambah", $datajson);
            // $res = $client->setBody($datajson)->request("POST", "http://localhost:8000/api/tambah");
            // dd($output);
            return redirect()->to("/buku");
        } else {
            $data['validate'] = $validate;
            echo view("layout/head", $data);
            echo view("buku/tambah_dari_laravel", $data);
            echo view("layout/footer");
        }
    }
    public function edit($id)
    {
        // dd($this->request);

        helper(['form', 'url', 'session']);

        $data["title"] = "Edit Buku Dari Laravel";
        $data["laravel_active"] = true;
        $session = \Config\Services::session();
        if ($session->has("token")) {
            $user = new Auth();
            $token = $session->get("token");
            $auth = new Auth();
            // if (!$auth->getUserPriv($token)->can_edit_book) {
            //     return $this->response->setStatusCode(404);
            // }
            $data["user"] = array(
                "email" => $user->getUserFromToken($token)->email,
                "nama" => $user->getUserFromToken($token)->name,
                "token" => $user->getUserFromToken($token)->api_token,
            );
        } else {
            return redirect()->to("/auth/login");
        };

        // $model = new ModelsBuku();
        $data["buku"] = json_decode($this->ambil_get("http://localhost:8000/api/" . $id));
        // dd($data["buku"]);
        echo view("layout/head", $data);
        echo view("buku/edit_dari_laravel", $data);
        echo view("layout/footer");
    }
    public function update($id)
    {
        // dd($this->request);
        $data["title"] = "Edit Buku Dari Laravel";

        helper(['form', 'url', 'session']);
        $session = \Config\Services::session();
        $data["laravel_active"] = true;
        $token = $session->get("token");
        $auth = new Auth();
        if ($session->has("token")) {
            $user = new Auth();
            $token = $session->get("token");
            $auth = new Auth();
            if (!$auth->getUserPriv($token)->can_edit_book) {
                return $this->response->setStatusCode(404);
            }
            $data["user"] = array(
                "email" => $user->getUserFromToken($token)->email,
                "nama" => $user->getUserFromToken($token)->name,
                "token" => $user->getUserFromToken($token)->api_token,
            );
        } else {
            return redirect()->to("/auth/login");
        };
        // $model = new ModelsBuku();
        $validate = $this->validate([
            "nama_buku" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama Buku harus diisi!",
                ]
            ],
            "penulis" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama Penulis harus diisi!"
                ]
            ],
            "penerbit" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama Penerbit harus diisi!"
                ]
            ],
            "jumlah" => [
                "rules" => "required|integer",
                "errors" => [
                    "required" => "Jumlah Buku harus diisi!",
                    "integer" => "Jumlah Buku harus berupa angka!"
                ]
            ],
        ]);
        if ($validate) {
            $dataedit = array(
                "nama_buku" => $this->request->getVar("nama_buku"),
                "penulis" => $this->request->getVar("penulis"),
                "penerbit" => $this->request->getVar("penerbit"),
                "jumlah" => $this->request->getVar("jumlah")
            );
            $output = $this->ambil_post("http://localhost:8000/api/edit/" . $id, $dataedit);
            // $model->updateBuku($dataedit, $id, $token);
            return redirect()->to("/buku");
        } else {
            // $model = new ModelsBuku();
            $data["buku"] = $this->ambil_get("http://localhost:8000/api/" . $id);
            $data['validate'] = $validate;
            echo view("layout/head", $data);
            echo view("buku/edit_dari_laravel", $data);
            echo view("layout/footer");
        }
        // return redirect()->to("/buku");
    }
}
