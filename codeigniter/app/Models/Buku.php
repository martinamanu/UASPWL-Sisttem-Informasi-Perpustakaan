<?php

namespace App\Models;

use CodeIgniter\Model;

class Buku extends Model
{
    protected $table = "buku";

    public function getAllBuku()
    {
        return $this->findAll();
    }
    public function getBuku($id)
    {
        return $this->db->table($this->table)->getWhere(["id" => $id]);
    }
    public function saveBuku($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function updateBuku($data, $id, $token)
    {
        $auth = new Auth();
        $query = $this->db->table($this->table)->update($data, ["id" => $id]);
        return $query;
        // if ($auth->getUserPriv($token)->can_edit_book) {
        //     return $query;
        // } else {
        //     return false;
        // }
    }
    public function deleteBuku($id)
    {
        $query = $this->db->table($this->table)->delete(["id" => $id]);
        return $query;
    }
}
