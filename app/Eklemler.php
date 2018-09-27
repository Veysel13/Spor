<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eklemler extends Model
{
    protected $table="eklemler";
    protected $fillable=['isim','ekleyen_id','ozellikleri','resim','aktif','silinme_tarihi'];


    public static function ekleyenisimal($id){

        $user=User::where('id',$id)->first();

        if($user!=null){

            return $user->name;
        }else{

            return null;
        }

    }
}
