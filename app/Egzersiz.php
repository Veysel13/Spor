<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egzersiz extends Model
{
    protected $table="egzersiz";
    protected $fillable=['ekleyen_id','egzersiz_isim','egzersiz_kategori','egzersiz_hareket','resim',"resim_iki",'video','aciklama','aktif','silme_tarihi'];


    //ekleyen kişinin ismini almak için
    public static function ekleyenisimal($id){

    $user=User::where('id',$id)->first();

    if($user!=null){

        return $user->name;
    }else{

        return null;
    }

}


    //kategoti ismini almak için
    public static function egzersizkategoriisimal($id){
        $veri = Egzersizkategori::where('id',$id)->where('aktif',1)->first();
        if($veri!=null){
            // foreach ($veri as $item) {
            return $veri->kategori_ad;

        }
        else{
            return "Kategorilendirilmemiş";
        }

    }


    //hareket ismini almak için
    public static function egzersizharekeismial($id){
        $veri = Hareketolustur::where('id',$id)->where('aktif',1)->first();
        if($veri!=null){

            return $veri->baslik;

        }
        else{
            return null;
        }

    }

    public static function egzersizozelliklerial($id,$deger){
        $veri = Hareketolustur::where('id',$id)->where('aktif',1)->first();
        if($veri!=null){

            return $deger;

        }
        else{
            return null;
        }

    }

    public static function egzersizbolgeal($id){
        $veri = Hareketolustur::where('id',$id)->where('aktif',1)->first();
        if($veri!=null){

            return $veri->bolge;

        }
        else{
            return null;
        }

    }

    public static function egzersizbolgeisimalal($id){
        $veri = Hareketolustur::where('id',$id)->where('aktif',1)->first();
        $bolge=Bolgeler::where('id',$veri->bolge)->where('aktif',1)->first();

        if($bolge!=null){

            return $bolge->isim;

        }
        else{
            return null;
        }

    }


    public static function egzersizeklemal($id){
        $veri = Hareketolustur::where('id',$id)->where('aktif',1)->first();
        if($veri!=null){

            return $veri->eklem;

        }
        else{
            return null;
        }

    }


    public static function egzersizeklemisimalal($id){
        $veri = Hareketolustur::where('id',$id)->where('aktif',1)->first();
        $eklem=Eklemler::where('id',$veri->eklem)->where('aktif',1)->first();

        if($eklem!=null){

            return $eklem->isim;

        }
        else{
            return null;
        }

    }


    public static function egzersizhareketal($id){
        $veri = Hareketolustur::where('id',$id)->where('aktif',1)->first();
        if($veri!=null){

            return $veri->hareket;

        }
        else{
            return null;
        }

    }



    public static function egzersizhareketisimalal($id){
        $veri = Hareketolustur::where('id',$id)->where('aktif',1)->first();
        $eklem=Hareketturu::where('id',$veri->hareket)->where('aktif',1)->first();

        if($eklem!=null){

            return $eklem->isim;

        }
        else{
            return null;
        }

    }

}
