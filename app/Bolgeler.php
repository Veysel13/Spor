<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bolgeler extends Model
{
    protected $table="bolgeler";
    protected $fillable=['isim','ekleyen_id','ozellikleri','resim','aktif','silinme_tarihi'];


    public static function ekleyenisimal($id){

        $user=User::where('id',$id)->first();

        if($user!=null){

            return $user->name;
        }else{

            return null;
        }

    }


    //activescope ile controllerde direk ->active() diyip cagırabiliriz.
    public  function scopeActive($query){
        return $query->where('aktif',1);
    }
}
