<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hareketolustur extends Model
{
    protected $table="hareketolustur";
    protected $fillable=['ekleyen_id','baslik','Aaos','Ama','KendalMcreacy','resim','bolge','eklem','hareket','ozellikleri','aktif','silme_tarihi'];


    public function hasta(){

        return $this->belongsToMany(\App\Hastaliklar::class);

    }


    public static function ekleyenisimal($id){

        $user=User::where('id',$id)->first();

        if($user!=null){

            return $user->name;
        }else{

            return null;
        }

    }

    public static function bolgeismial($id){
        $veriler=Bolgeler::where('aktif',1)->where('id',$id)->first();

        if($veriler!=null){
            return $veriler->isim;
        }
        else{
            return null;
        }
    }


    public static function eklemismial($id){
        $veriler=Eklemler::where('aktif',1)->where('id',$id)->first();

        if($veriler!=null){
            return $veriler->isim;
        }
        else{
            return null;
        }
    }



    public static function hareketismial($id){
        $veriler=Hareketturu::where('aktif',1)->where('id',$id)->first();

        if($veriler!=null){
            return $veriler->isim;
        }
        else{
            return null;
        }
    }

}
