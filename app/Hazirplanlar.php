<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hazirplanlar extends Model
{
    protected $table="hazirplanlar";
    protected $fillable=['ekleyen_id','plan_ismi','egzersiz_isim','set','tekrar','dinlenme','kurum_id','haftalik_tekrar','gunluk_tekrar','aktif','silinme_tarihi'];


}
