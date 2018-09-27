<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hareketturu extends Model
{
    protected $table="hareketturu";
    protected $fillable=['ekleyen_id','isim','hareketturu','silme_tarihi','aktif'];


    public static function ekleyenisimal($id){

        $user=User::where('id',$id)->first();

        if($user!=null){

            return $user->name;
        }else{

            return null;
        }

    }
}
