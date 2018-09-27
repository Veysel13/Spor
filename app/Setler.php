<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setler extends Model
{
    protected $table="setler";
    protected $fillable=['ekleyen_id','hasta_id','baslangic_tarihi','bitis_tarihi','program_adi','egzersiz_isim','set','tekrar','plan_sayisi','dinlenme','gunluk_tekrar','haftalik_tekrar','aktif','silinme_tarihi'];


    public static function ekleyenisimal($id){

        $user=User::where('id',$id)->first();

        if($user!=null){

            return $user->name;
        }else{

            return null;
        }

    }

    public static function hastaisimal($id){

        $user=Hastalar::where('id',$id)->first();

        if($user!=null){

            return $user->hasta_ad;
        }else{

            return null;
        }

    }

}
