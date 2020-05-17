<?php

namespace App\Models;

use CodeIgniter\Model;

class Api extends Model
{
    protected $table = "buku";
    public function getBook($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(["id" => $id])->getRowArray();
        }
    }
    public function deleteBuku($id)
    {
        $query = $this->db->table($this->table)->delete(["id" => $id]);
        return $query;
    }
    public function updateBuku($data, $id)
    {
        // $auth = new Auth();
        $query = $this->db->table($this->table)->update($data, ["id" => $id]);
        return $query;
        // if ($auth->getUserPriv($token)->can_edit_book) {
        //     return $query;
        // } else {
        //     return false;
        // }
    }
    public function saveBuku($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function loginAttempt($email, $password)
    {
        $query = $this->db->table("auth")->getWhere(["email" => $email])->getRow();
        if (password_verify($password, $query->password)) {
            return $query->token;
        } else {
            return false;
        }
    }
    public function listLevel()
    {
        return $this->db->table("level")->get()->getResultArray();
    }
    public function userAll()
    {
        return $this->db->table("auth")->get()->getResultArray();
    }
    public function userId($id)
    {
        return $this->db->table("auth")->getWhere(["id" => $id])->getRow();
    }
    public function deleteUser($id)
    {
        return $this->db->table("auth")->delete(["id" => $id]);
    }
    public function editUser($data, $id)
    {
        return $this->db->table("auth")->update($data, ["id" => $id]);
    }
    public function getPrivfromToken($token)
    {
        $query = $this->db->table("auth")->getWhere(["token" => $token])->getRow();
        $level = $this->db->table("level")->getWhere(["id" => $query->level])->getRow();

        return $level;
    }
    public function getPrivfromId($id)
    {
        $query = $this->db->table("auth")->getWhere(["id" => $id])->getRow();
        $level = $this->db->table("level")->getWhere(["id" => $query->level])->getRow();

        return $level;
    }
    public function saveUser($data)
    {
        $query = $this->db->table("auth")->insert($data);
        return $query;
    }
    public function getUserInfoFromToken($token)
    {
        $query = $this->db->table("auth")->getWhere(["token" => $token])->getRow();
        return $query;
    }
}
