<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth extends Model
{
    public function ambil_post($alamat, $data, $token = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $alamat);
        if ($token != false) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer " . $token));
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return json_decode(curl_exec($ch));
        curl_close($ch);
    }
    public function ambil_get($alamat, $token = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $alamat);
        if ($token != false) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer " . $token));
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return json_decode(curl_exec($ch));
        curl_close($ch);
    }
    protected $table = "auth";
    public function getUserPriv($token)
    {
        // $query = $this->db->table($this->table)->getWhere(["token" => $token])->getRow();
        // $level = $this->db->table("level")->getWhere(["id" => $query->level])->getRow();
        $level = $this->ambil_post(getenv("laravel.address") . "/auth/level", ["token" => $token]);
        // dd($level);
        return $level;
    }
    public function getAllUser($token)
    {
        $query = $this->ambil_get(getenv("laravel.address") . "/auth/userall", $token);
        // $query = $this->findAll();
        return $query;
    }
    public function getUserFromToken($token)
    {
        // $query = $this->ambil_post(getenv("laravel.address") . "/auth/user", ["token" => $token], $token);
        $query = $this->ambil_post(getenv("laravel.address") . "/auth/user", ["token" => $token]);
        // $query = $this->db->table($this->table)->getWhere(["token" => $token])->getRow();
        // dd($query);
        return $query;
    }
    public function getAllLevel()
    {
        $level = $this->ambil_get(getenv("laravel.address") . "/auth/levelall/");
        // $level = $this->db->table("level")->get()->getResultArray();
        return $level;
    }
    public function getUserFromID($id)
    {
        $query = $this->ambil_get(getenv("laravel.address") . "/auth/userid/" . $id);
        // $query = $this->ambil_get("http://localhost:8000/api/auth/userid/2");
        // $query = $this->db->table($this->table)->getWhere(["id" => $id])->getRow();
        return $query;
    }
    public function getUser($email, $password)
    {
        $datalogin = [
            "email" => $email,
            "password" => $password
        ];
        $query = $this->ambil_post(getenv("laravel.address") . "/auth/login", $datalogin);
        // $query = $this->db->table($this->table)->getWhere(["email" => $email])->getRow();
        return $query->data;
    }
    public function authProcess($email, $password)
    {
        // $query = $this->db->table($this->table)->getWhere(["email" => $email])->getRow();
        $datalogin = [
            "email" => $email,
            "password" => $password
        ];
        $query = $this->ambil_post(getenv("laravel.address") . "/auth/login", $datalogin);
        if ($query->status != 404) {
            return true;
        } else {
            return false;
        }
    }
    // public function getUserToken($email)
    // {
    //     $query = $this->db->table($this->table)->getWhere(["email" => $email])->getRow();
    //     return $query->token;
    // }
    public function updateUser($data, $id, $token)
    {
        // if ($this->getUserPriv($token)->can_edit_user) {
        // dd($data);
        $query = $this->ambil_post(getenv("laravel.address") . "/admin/edit/" . $id, $data);
        // $query = $this->ambil_post("http://localhost:8000/api/admin/edit/3", $data);
        // $query = $this->db->table($this->table)->update($data, ["id" => $id]);
        return $query;
        // } else {
        // return false;
        // }
    }
    public function addUser($data, $token)
    {
        // if ($this->getUserPriv($token)->can_add_user) {
        // dd($data);
        $query = $this->ambil_post(getenv("laravel.address") . "/user/add/", $data);
        // $query = $this->db->table($this->table)->insert($data);
        return $query;
        // } else {
        // return false;
        // }
    }
    public function delUser($id, $token)
    {
        // if ($this->getUserPriv($token)->can_delete_user) {
        $query = $this->ambil_get(getenv("laravel.address") . "/user/delete/" . $id);
        // $query = $this->db->table($this->table)->delete(["id" => $id]);
        if ($query->status == 200) {
            return $query;
        } else {
            return false;
        }
        // } else {
        // return false;
        // }
    }
}
