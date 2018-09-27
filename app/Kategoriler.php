<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategoriler extends Model
{
    protected $table="kategoriler";
    protected $fillable=['kategori_ad','kategori_ust','aktif','silme_tarihi'];


    public function children(){

        return $this->hasMany('\App\Kategoriler','kategori_ust');
    }


    public static function kategoriisimal($id){

        $kategori=Kategoriler::where('id',$id)->first();

        if($kategori!=null){

            return $kategori->kategori_ad;
        }else{

            return null;
        }

    }
}
