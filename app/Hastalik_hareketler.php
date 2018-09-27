<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hastalik_hareketler extends Model
{
    protected $table="hastalik_hareket";
    protected $fillable=['hastalik_id','hareket_id','aktif','silme_tarihi'];



    public static function hastalikisimal($id){

        $user=Hastaliklar::where('id',$id)->first();

        if($user!=null){

            return $user->hastalik_isim;
        }else{

            return null;
        }

    }




    public static function hareketisimal($id){

        $user=Hareketolustur::where('id',$id)->first();

        if($user!=null){

            return $user->baslik;
        }else{

            return null;
        }

    }
}
