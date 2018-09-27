<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hareketler extends Model
{
    protected $table="hareketler";
    protected $fillable=['ekleyen_id','hareket_isim','silme_tarihi','aktif'];
}
