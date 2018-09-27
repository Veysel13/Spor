<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planlama extends Model
{
    protected $table="plantablosu";
    protected $fillable=['ekleyen_id','hasta_id','baslangic_tarihi','bitis_tarihi','program_adi','plan_numarasi','egzersiz_isim','haftalik_tekrar','pazartesi','sali','carsamba','persembe','cuma','cumartesi','pazar','plan_durum','aktif','silinme_tarihi'];

    public  function scopeActive($query){
        return $query->where('aktif',1);
    }
}
