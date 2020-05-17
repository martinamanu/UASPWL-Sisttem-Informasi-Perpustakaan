<?php

namespace App\Controllers;

use App\Models\Auth;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class User extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $data["title"] = "Daftar User";
        $data["user_active"] = true;
        $session = \Config\Services::session();
        $model = new Auth();
        if ($session->has("token")) {
            $user = new Auth();
            $token = $session->get("token");
            // if (!$model->getUserPriv($token)->can_see_user) {
            //     // $this->output->set_status_header('404');
            //     return $this->response->setStatusCode(404);
            //     // return $this->respond(404);
            // }
            $data["user"] = array(
                "email" => $user->getUserFromToken($token)->email,
                "nama" => $user->getUserFromToken($token)->name,
                "token" => $user->getUserFromToken($token)->api_token
            );
        } else {
            // $this->output->set_status_header('404');
            // $this->response->setStatusCode(404);
            return redirect()->to("/auth/login");
            // $data["token"] = "";
        };
        $model = new Auth();
        $data["auth"] = new Auth();
        $data["title"] = "Lihat User";
        $data["datauser"] = $model->getAllUser($token);
        echo view("layout/head", $data);
        echo view('user-man/user', $data);
        echo view("layout/footer");
    }

    public function edit($id)
    {
        $data["title"] = "Edit User";
        $model = new Auth();

        $data["user_active"] = true;

        $session = \Config\Services::session();
        if ($session->has("token")) {
            $user = new Auth();
            $token = $session->get("token");
            // dd($model->getUserPriv($token)->can_edit_user);
            // if (!$model->getUserPriv($token)->can_edit_user) {
            //     return $this->response->setStatusCode(404);
            //     // $this->output->set_status_header('404');
            // }
            $data["user"] = array(
                "email" => $user->getUserFromToken($token)->email,
                "id" => $user->getUserFromToken($token)->id,
                "nama" => $user->getUserFromToken($token)->name,
                "token" => $user->getUserFromToken($token)->api_token
            );
        } else {
            // $data["token"] = "";
            return redirect()->to("/auth/login");
        };
        $model = new Auth();
        $db      = \Config\Database::connect();
        $data["title"] = "Edit User";
        $data["jabatan"] = $model->getAllLevel();
        // dd($data["jabatan"]);
        $data["userinfo"] = $model->getUserFromID($id);
        // dd($data["userinfo"]);
        echo view("layout/head", $data);
        echo view('user-man/edit', $data);
        echo view("layout/footer");
    }
    public function update($id)
    {
        $data["title"] = "Edit User";
        // dd($this->request);
        helper(['form', 'url', 'session']);
        $model = new Auth();
        $data["jabatan"] = $model->getAllLevel();
        $data["userinfo"] = $model->getUserFromID($id);
        // $validation =  \Config\Services::validation();
        $session = \Config\Services::session();
        if ($session->has("token")) {
            $token = $session->get("token");
            if (!$model->getUserPriv($token)->can_edit_user) {
                return $this->response->setStatusCode(404);
            }
            $user = new Auth();
            $data["user"] = array(
                "email" => $user->getUserFromToken($token)->email,
                "id" => $user->getUserFromToken($token)->id,
                "nama" => $user->getUserFromToken($token)->name,
                "token" => $user->getUserFromToken($token)->api_token
            );
            $validate = $this->validate([
                "nama" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Nama tidak boleh kosong"
                    ]
                ],
                "email" => [
                    "rules" => "required|valid_email",
                    "errors" => [
                        "required" => "Email tidak boleh kosong",
                        "valid_email" => "Harus berformat email",
                    ]
                ],
                "jabatan" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Jabatan tidak boleh kosong"
                    ]
                ],
            ]);
            if ($validate) {
                if (isset($this->request->password) && !empty($this->request->password)) {
                    $datajson = array(
                        "name" => $this->request->getVar("nama"),
                        "email" => $this->request->getVar("email"),
                        "level" => $this->request->getVar("jabatan"),
                        "password" => password_hash($this->request->getVar("password"), PASSWORD_BCRYPT),
                    );
                } else {
                    $datajson = array(
                        "name" => $this->request->getVar("nama"),
                        "email" => $this->request->getVar("email"),
                        "level" => $this->request->getVar("jabatan"),
                    );
                }
                // dd($datajson);
                // dd($model->updateUser($datajson, $id, $token));
                if ($model->updateUser($datajson, $id, $token)) {
                    return redirect()->to("/user");
                } else {
                    // $this->session->set_flashdata('warning', 'Pengupdate an user gagal!');
                    return redirect()->to("/buku");
                }
            } else {
                $data["userinfo"] = $model->getUserFromID($id);
                $data["validate"] = $validate;
                echo view("layout/head", $data);
                echo view('user-man/edit', $data);
                echo view("layout/footer");
            }
        } else {
            // $data["token"] = "";
            return redirect()->to("/auth/login");
        };
    }
    public function tambah()
    {
        $data["title"] = "Tambah User";
        $data["user_active"] = true;
        $model = new Auth();
        $session = \Config\Services::session();
        if ($session->has("token")) {
            $user = new Auth();
            $token = $session->get("token");
            $data["user"] = array(
                "email" => $user->getUserFromToken($token)->email,
                "id" => $user->getUserFromToken($token)->id,
                "nama" => $user->getUserFromToken($token)->name,
                "token" => $user->getUserFromToken($token)->api_token
            );
            if (!$model->getUserPriv($token)->can_edit_user) {
                return $this->response->setStatusCode(404);
                // $this->output->set_status_header('404');
            }
            // $data["user"] = array(
            //     "email" => $user->getUserFromToken($token)->email,
            //     "id" => $user->getUserFromToken($token)->id,
            //     "nama" => $user->getUserFromToken($token)->nama,
            //     "token" => $user->getUserFromToken($token)->token
            // );
        } else {
            // $data["token"] = "";
            return redirect()->to("/auth/login");
        };
        // $model = new Auth();
        $db      = \Config\Database::connect();
        $data["title"] = "Tambah User";
        $data["jabatan"] = $model->getAllLevel();
        // $data["userinfo"] = $model->getUserFromID($id);
        echo view("layout/head", $data);
        echo view('user-man/tambah', $data);
        echo view("layout/footer");
    }
    public function add()
    {
        $data["title"] = "Tambah User";
        // dd($this->request->getVar("nama"));
        helper(['form', 'url', 'session']);
        $model = new Auth();
        $data["jabatan"] = $model->getAllLevel();
        $session = \Config\Services::session();
        if ($session->has("token")) {
            $user = new Auth();
            $token = $session->get("token");
            $data["user"] = array(
                "email" => $user->getUserFromToken($token)->email,
                "id" => $user->getUserFromToken($token)->id,
                "nama" => $user->getUserFromToken($token)->name,
                "token" => $user->getUserFromToken($token)->api_token
            );
            if (!$model->getUserPriv($token)->can_edit_user) {
                return $this->response->setStatusCode(404);
                // $this->output->set_status_header('404');
            }
            $validate = $this->validate([
                "nama" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Nama harus Diisi!"
                    ]
                ],
                "email" => [
                    "rules" => "required|valid_email",
                    "errors" => [
                        "required" => "Email harus diisi!",
                        "valid_email" => "Harus berformat email!",
                    ]
                ],
                "password" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Harus mencantumkan password!"
                    ]
                ],
                "jabatan" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Harus memilih jabatan!"
                    ]
                ],
            ]);
            if ($validate) {
                $datajson = array(
                    "name" => $this->request->getVar("nama"),
                    "email" => $this->request->getVar("email"),
                    "level" => $this->request->getVar("jabatan"),
                    "password" => $this->request->getVar("password"),
                    // "token" => bin2hex(openssl_random_pseudo_bytes(32)),
                );

                // dd($model->updateUser($data, $id, $token));
                if ($model->addUser($datajson, $token)) {
                    return redirect()->to("/user");
                } else {
                    // $this->session->set_flashdata('warning', 'Pengupdate an user gagal!');
                    return redirect("/user");
                    // echo "adasdasd";
                }
            } else {
                // $session->setFlashdata('error_list', $validation->listErrors());
                // return redirect()->to("/user/edit/" . $id);
                // $this->session->set_flashdata('validate', $validate);
                $data["validate"] = $validate;
                echo view("layout/head", $data);
                echo view('user-man/tambah', $data);
                echo view("layout/footer");
            }
        } else {
            // $data["token"] = "";
            return redirect()->to("/auth/login");
        };
    }
    public function hapus($id)
    {
        $data["title"] = "Hapus User";
        $data["user_active"] = true;
        $model = new Auth();

        $session = \Config\Services::session();
        if ($session->has("token")) {
            $user = new Auth();
            $token = $session->get("token");
            if (!$model->getUserPriv($token)->can_delete_user) {
                return $this->response->setStatusCode(404);
                // $this->output->set_status_header('404');
            }
            $data["user"] = array(
                "email" => $user->getUserFromToken($token)->email,
                "id" => $user->getUserFromToken($token)->id,
                "nama" => $user->getUserFromToken($token)->name,
                "token" => $user->getUserFromToken($token)->api_token
            );
            $data["userinfo"] = $model->getUserFromID($id);
            // dd($data["userinfo"]);
            echo view("layout/head", $data);
            echo view('user-man/hapus', $data);
            echo view("layout/footer");
        } else {
            // $data["token"] = "";
            return redirect()->to("/auth/login");
        };
    }
    public function delete($id)
    {
        $data["title"] = "Hapus User";
        $data["user_active"] = true;
        $model = new Auth();

        $session = \Config\Services::session();
        if ($session->has("token")) {
            $user = new Auth();
            $token = $session->get("token");
            if (!$model->getUserPriv($token)->can_delete_user) {
                return $this->response->setStatusCode(404);
                // $this->output->set_status_header('404');
            }
            $data["user"] = array(
                "email" => $user->getUserFromToken($token)->email,
                "id" => $user->getUserFromToken($token)->id,
                "nama" => $user->getUserFromToken($token)->name,
                "token" => $user->getUserFromToken($token)->api_token
            );
            if ($model->delUser($id, $token)) {
                return redirect()->to("/user");
            } else {
                return redirect()->to("/user");
            }
        } else {
            // $data["token"] = "";
            return redirect()->to("/auth/login");
        };
    }
}
