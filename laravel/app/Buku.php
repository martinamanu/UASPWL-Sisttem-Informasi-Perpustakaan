<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = "bukus";
    protected $fillable = array("nama_buku", "penerbit", "jumlah");
}
