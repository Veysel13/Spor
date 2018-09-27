<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bildirimler extends Model
{
    protected $table="bildirimler";
    protected $fillable=['ekleyen_id','gonderilen_id','mesaj_detay','mesaj_durum','plan_sayisi','aktif','silinme_tarihi'];

    public  function scopeActive($query){
        return $query->where('aktif',1);
    }

}
