<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hastaliklar extends Model
{
    protected $table="hastaliklar";
    protected $fillable=['ekleyen_id','hastalik_isim','hastalik_kategori','aktif','silme_tarihi'];

    public function hareket(){

        return $this->belongsToMany(\App\Hareketolustur::class);

    }

    public static function hastalikkategoriisimal($id){
        $veri = Kategoriler::where('id',$id)->where('aktif',1)->first();
        if($veri!=null){
           // foreach ($veri as $item) {
                return $veri->kategori_ad;

        }
        else{
            return "Kategorilendirilmemiş";
        }

    }

    public static function ekleyenisimal($id){

        $user=User::where('id',$id)->first();

        if($user!=null){

            return $user->name;
        }else{

            return null;
        }

    }
}
