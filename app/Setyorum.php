<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setyorum extends Model
{
    protected $table="setyorum";

    protected $fillable=['ekleyen_id','hasta_id','yorum','plan_sayisi','aktif','silme_tarihi'];


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
