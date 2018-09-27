<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hastalar extends Model
{
    protected $table="hasta";
    protected $fillable=['ekleyen_id','hasta_resim','hasta_ad','hasta_soyad','hasta_telefon','hasta_eposta','hasta_sifre','hasta_babaadi','hasta_anneadi','hasta_tc','hasta_dogumyeri','hasta_dogumtarihi','hasta_cinsiyet','hasta_medenihali','hasta_kangurubu','hasta_ulke','hasta_il','hasta_ilce','hasta_acikadress','kurum_id','aktif','silme_tarihi'];

    public static function ekleyenisimal($id){

        $user=User::where('id',$id)->first();

        if($user!=null){

            return $user->name;
        }else{

            return null;
        }

    }



    public static function kurumisimal($id){

        $kurum=Kurumlar::where('id',$id)->where('aktif',1)->first();

        if($kurum!=null){

            return $kurum->kurum_adi;
        }else{

            return null;
        }

    }
}