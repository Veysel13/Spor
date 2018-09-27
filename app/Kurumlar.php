<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurumlar extends Model
{
    protected $table="kurumlar";
    protected $fillable=['ekleyen_id','kurum_resim','kurum_arayanad','kurum_arayansoyad','kurum_arayantelefon','kurum_arayaneposta','kurum_arayansifre','kurum_adi','kurum_yetkiliadi','kurum_yetkilinumara','kurum_vergidairesi','kurum_verginumarasi','kurum_yetkilicinsiyet','kurum_ulke','kurum_il','kurum_ilce','kurum_acikadress','aktif','silme_tarihi'];


    public static function ekleyenisimal($id){

        $user=User::where('id',$id)->first();

        if($user!=null){

            return $user->name;
        }else{

            return null;
        }

    }


}
