<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egzersizkategori extends Model
{
    protected $table = "egzersiz_kategori";
    protected $fillable = ['kategori_ad', 'kategori_ust', 'aktif', 'silme_tarihi','resim'];

    public function children ()
    {

        return $this->hasMany('\App\Egzersizkategori', 'kategori_ust');
    }


    public static function ustkategorial ($id)
    {

        if ($id == 0) {
            return "Üst Kategori";

        } else {

            $veri = Egzersizkategori::where('aktif', 1)->where('id',$id)->first();

            return $veri->kategori_ad;
             }
    }

    public static function kategoriresim ($id)
    {
            $veri = Egzersizkategori::where('aktif', 1)->where('id',$id)->first();

            return $veri->resim;
    }
}