<?php

namespace App\Http\Controllers;

use App\Bolgeler;
use App\Egzersiz;
use App\Egzersizkategori;
use App\Eklemler;
use App\Hareketolustur;
use App\Hareketturu;
use App\Hastalar;
use App\Hastalik_hareketler;
use App\Hastaliklar;
use App\Kategoriler;
use App\Kurumlar;
use App\Setler;
use App\Setyorum;
use App\User;
use Hamcrest\Core\Set;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Json;

class Apicontroller extends Controller
{
    public function apihastalik(Request $request){

        $sayac =0;

        //json için dizi açıyoruz
        $hastaliklarapi = array();

        //json key ve value degerlerını olusturuyoruz.
        if($request['token'] == "hastaliklar"){
            $veriler = Hastaliklar::where('aktif',1)->get();
            foreach ($veriler as $item) {
                $hastaliklarapi[$sayac]["id"] = $item->id;
                $hastaliklarapi[$sayac]["ekleyen_id"] = $item->ekleyen_id;
                $hastaliklarapi[$sayac]["ekleyen_isim"] = Hastaliklar::ekleyenisimal($item->ekleyen_id);
                $hastaliklarapi[$sayac]["hastalik_isim"] = $item->hastalik_isim;
                $hastaliklarapi[$sayac]["kategori_id"] = $item->hastalik_kategori;
                $hastaliklarapi[$sayac]["kategori_isim"] = Hastaliklar::hastalikkategoriisimal($item->hastalik_kategori);
                $hastaliklarapi[$sayac]["olusturulma_tarihi"] = $item->created_at;
                //TODO::Hastalık kategori id ek olarak kategori ismi döndürülecek kategori ismi null veya boş ise Kategorilendirlememiş diye döndürülecek
                $sayac++;
            }

            //json verisini nesneye ceviriyotuz
            return Json::encode($hastaliklarapi);

        }
        else{

            //json olusturulmamıssa false dondur.
            return "false";
        }
    }


    public function apibolgeler(Request $request){

        $sayac =0;

        //json için dizi açıyoruz
        $bolgelerarapi = array();

        //json key ve value degerlerını olusturuyoruz.
        if($request['token'] == "bolgeler"){
            $veriler = Bolgeler::where('aktif',1)->get();
            foreach ($veriler as $item) {
                $bolgelerarapi[$sayac]["id"] = $item->id;
                $bolgelerarapi[$sayac]["ekleyen_id"] = $item->ekleyen_id;
                $bolgelerarapi[$sayac]["ekleyen_ismi"] = Bolgeler::ekleyenisimal($item->ekleyen_id);
                $bolgelerarapi[$sayac]["bolge_isim"] = $item->isim;
                $bolgelerarapi[$sayac]["bolge_ozellikleri"] = $item->ozellikleri;
                $bolgelerarapi[$sayac]["bolge_resim"] = "https://verigirisi.fizyobilisim.com".$item->resim;
                $bolgelerarapi[$sayac]["olusturulma_tarihi"] = $item->created_at;

                $sayac++;
            }

            //json verisini nesneye ceviriyotuz
            return Json::encode($bolgelerarapi);

        }
        else{

            //json olusturulmamıssa false dondur.
            return "false";
        }
    }




    public function apiegzersiz (Request $request){

        $sayac =0;
        $sayi=0;

        //json için dizi açıyoruz
        $egzersizlerarapi = array();

        //json key ve value degerlerını olusturuyoruz.
        if($request['token'] == "egzersizler"){
            $veriler = Egzersiz::where('aktif',1)->get()->groupBy('egzersiz_isim');
            foreach ($veriler as $item) {
                $egzersizlerarapi[$sayac]["id"] = $item[0]->id;
                $egzersizlerarapi[$sayac]["ekleyen_id"] = $item[0]->ekleyen_id;
                $egzersizlerarapi[$sayac]["ekleyen_ismi"] = Egzersiz::ekleyenisimal($item[0]->ekleyen_id);
                $egzersizlerarapi[$sayac]["egzersiz_isim"] = $item[0]->egzersiz_isim;
                $egzersizlerarapi[$sayac]["kategori_id"] = $item[0]->egzersiz_kategori;
                $egzersizlerarapi[$sayac]["kategori_isim"] = Egzersiz::egzersizkategoriisimal($item[0]->egzersiz_kategori);

                foreach ($item as $veri) {
                    $egzersizlerarapi[$sayac]["hareketler"][$sayi]["egzersizhareket_id"] = $veri->egzersiz_hareket;
                    $egzersizlerarapi[$sayac]["hareketler"][$sayi]["egzersizhareket_ismi"] = Egzersiz::egzersizharekeismial($veri->egzersiz_hareket);
                    $egzersizlerarapi[$sayac]["hareketler"][$sayi]["egzersizhareket_resim"] = Egzersiz::egzersizozelliklerial($veri->egzersiz_hareket,$veri->resim);
                    $egzersizlerarapi[$sayac]["hareketler"][$sayi]["egzersizhareket_Aaos"] = Egzersiz::egzersizozelliklerial($veri->egzersiz_hareket,$veri->Aaos);
                    $egzersizlerarapi[$sayac]["hareketler"][$sayi]["egzersizhareket_Ama"] = Egzersiz::egzersizozelliklerial($veri->egzersiz_hareket,$veri->Ama);
                    $egzersizlerarapi[$sayac]["hareketler"][$sayi]["egzersizhareket_KendalMcreacy"] =Egzersiz::egzersizozelliklerial($veri->egzersiz_hareket,$veri->KendalMcreacy);

                    $egzersizlerarapi[$sayac]["hareketler"][$sayi]["egzersizhareket_bolge_id"] =Egzersiz::egzersizbolgeal($veri->egzersiz_hareket);
                    $egzersizlerarapi[$sayac]["hareketler"][$sayi]["egzersizhareket_bolge_isim"] =Egzersiz::egzersizbolgeisimalal($veri->egzersiz_hareket);

                    $egzersizlerarapi[$sayac]["hareketler"][$sayi]["egzersizhareket_eklem_id"] =Egzersiz::egzersizeklemal($veri->egzersiz_hareket);
                    $egzersizlerarapi[$sayac]["hareketler"][$sayi]["egzersizhareket_eklem_isim"] =Egzersiz::egzersizeklemisimalal($veri->egzersiz_hareket);


                    $egzersizlerarapi[$sayac]["hareketler"][$sayi]["egzersizhareket_hareket_id"] =Egzersiz::egzersizhareketal($veri->egzersiz_hareket);
                    $egzersizlerarapi[$sayac]["hareketler"][$sayi]["egzersizhareket_hareket_isim"] =Egzersiz::egzersizhareketisimalal($veri->egzersiz_hareket);

                    $sayi++;
                }
                $egzersizlerarapi[$sayac]["egzersiz_resim"] = "https://verigirisi.fizyobilisim.com".$item[0]->resim;
                $egzersizlerarapi[$sayac]["egzersiz_video"] = $item[0]->video;
                $egzersizlerarapi[$sayac]["olusturulma_tarihi"] = $item[0]->created_at;

                $sayac++;
                $sayi=0;
            }

            //json verisini nesneye ceviriyotuz
            return Json::encode($egzersizlerarapi);

        }
        else{

            //json olusturulmamıssa false dondur.
            return "false";
        }
    }


public function apiegzersizkategori(Request $request){

        $sayac=0;

        $egzersizkategorileriapi=array();

        if($request['token']=="egzersizkategori"){
            $veriler=Egzersizkategori::where('aktif',1)->get();

            foreach ($veriler as $veri){

                $egzersizkategorileriapi[$sayac]["id"]=$veri->id;
                $egzersizkategorileriapi[$sayac]["kategori_ad"]=$veri->kategori_ad;
                $egzersizkategorileriapi[$sayac]["kategori_ust_id"]=$veri->kategori_ust;
                $egzersizkategorileriapi[$sayac]["kategori_ust"]=Egzersizkategori::ustkategorial($veri->kategori_ust);
                $egzersizkategorileriapi[$sayac]["olusturulma_tarihi"] = $veri->created_at;

                $sayac++;
            }

            //json verisini nesneye ceviriyotuz
            return Json::encode($egzersizkategorileriapi);

        }else{

            return "false";
        }
}



public function apieklemler(Request $request){


    $sayac=0;

    $eklemlerapi=array();

    if($request['token']=="eklemler"){
        $veriler=Eklemler::where('aktif',1)->get();

        foreach ($veriler as $veri){

            $eklemlerapi[$sayac]["id"]=$veri->id;
            $eklemlerapi[$sayac]["ekleyen_id"]=$veri->ekleyen_id;
            $eklemlerapi[$sayac]["ekleyen_isim"]=Eklemler::ekleyenisimal($veri->ekleyen_id);
            $eklemlerapi[$sayac]["eklem_ozellikleri"]=$veri->ozellikleri;
            $eklemlerapi[$sayac]["resim"]="https://verigirisi.fizyobilisim.com".$veri->resim;
            $eklemlerapi[$sayac]["olusturulma_tarihi"] = $veri->created_at;

            $sayac++;
        }

        //json verisini nesneye ceviriyotuz
        return Json::encode($eklemlerapi);

    }else{

        return "false";
    }

}


public function apihareketlerturu(Request $request){

    $sayac=0;

    $hareletlerapi=array();

    if($request['token']=="hareketler"){
        $veriler=Hareketturu::where('aktif',1)->get();

        foreach ($veriler as $veri){

            $hareletlerapi[$sayac]["id"]=$veri->id;
            $hareletlerapi[$sayac]["ekleyen_id"]=$veri->ekleyen_id;
            $hareletlerapi[$sayac]["ekleyen_isim"]=Hareketturu::ekleyenisimal($veri->ekleyen_id);
            $hareletlerapi[$sayac]["hareket_isim"]=$veri->isim;
            $hareletlerapi[$sayac]["hareketturu"]=$veri->hareketturu;
            $hareletlerapi[$sayac]["olusturulma_tarihi"] = $veri->created_at;

            $sayac++;
        }

        //json verisini nesneye ceviriyotuz
        return Json::encode($hareletlerapi);

    }else{

        return "false";
    }

}

public function apihareketolustur(Request $request){

    $sayac=0;

    $hareketolusturapi=array();

    if($request['token']=="olusturulanhareketler"){
        $veriler=Hareketolustur::where('aktif',1)->get();

        foreach ($veriler as $veri){

            $hareketolusturapi[$sayac]["id"]=$veri->id;
            $hareketolusturapi[$sayac]["ekleyen_id"]=$veri->ekleyen_id;
            $hareketolusturapi[$sayac]["ekleyen_isim"]=Hareketolustur::ekleyenisimal($veri->ekleyen_id);
            $hareketolusturapi[$sayac]["baslik"]=$veri->baslik;
            $hareketolusturapi[$sayac]["resim"]="https://verigirisi.fizyobilisim.com".$veri->resim;

            $hareketolusturapi[$sayac]["Aaos"]=$veri->Aaos;
            $hareketolusturapi[$sayac]["Ama"]=$veri->Ama;
            $hareketolusturapi[$sayac]["KendalMcreacy"]=$veri->KendalMcreacy;

            $hareketolusturapi[$sayac]["bolge_id"]=$veri->bolge;
            $hareketolusturapi[$sayac]["bolge_isim"]=Hareketolustur::bolgeismial($veri->bolge);

            $hareketolusturapi[$sayac]["eklem_id"]=$veri->eklem;
            $hareketolusturapi[$sayac]["eklem_isim"]=Hareketolustur::eklemismial($veri->eklem);

            $hareketolusturapi[$sayac]["hareket_id"]=$veri->hareket;
            $hareketolusturapi[$sayac]["hareket_isim"]=Hareketolustur::hareketismial($veri->hareket);

            $hareketolusturapi[$sayac]["ozellikleri"] = $veri->ozellikleri;
            $hareketolusturapi[$sayac]["olusturulma_tarihi"] = $veri->created_at;

            $sayac++;
        }

        //json verisini nesneye ceviriyotuz
        return Json::encode($hareketolusturapi);

    }else{

        return "false";
    }

}


public  function apihastalikhareket(Request $request){

    $sayac=0;

    $hastalikhareket=array();

    if($request['token']=="hastalikhareketler"){
        $veriler=Hastalik_hareketler::where('aktif',1)->get();

        foreach ($veriler as $veri){

            $hastalikhareket[$sayac]["id"]=$veri->id;
            $hastalikhareket[$sayac]["hastalik_id"]=$veri->hastalik_id;
            $hastalikhareket[$sayac]["hastalik_isim"]=Hastalik_hareketler::hastalikisimal($veri->hastalik_id);
            $hastalikhareket[$sayac]["hareket_id"]=$veri->hareket_id;
            $hastalikhareket[$sayac]["hareket_isim"]=Hastalik_hareketler::hareketisimal($veri->hareket_id);
            $hastalikhareket[$sayac]["olusturulma_tarihi"] = $veri->created_at;

            $sayac++;
        }

        //json verisini nesneye ceviriyotuz
        return Json::encode($hastalikhareket);

    }else{

        return "false";
    }
}


public function apihastalikkategori(Request $request){

    $sayac=0;

    $hastalikkategoriapi=array();

    if($request['token']=="hastalikkategori"){
        $veriler=Kategoriler::where('aktif',1)->get();

        foreach ($veriler as $veri){

            $hastalikkategoriapi[$sayac]["id"]=$veri->id;
            $hastalikkategoriapi[$sayac]["kategori_ad"]=$veri->kategori_ad;
            $hastalikkategoriapi[$sayac]["ustkategori_id"]=$veri->kategori_ust;
            $hastalikkategoriapi[$sayac]["ustkategori_ad"]=Kategoriler::kategoriisimal($veri->kategori_ust);

            $hastalikkategoriapi[$sayac]["olusturulma_tarihi"] = $veri->created_at;

            $sayac++;
        }

        //json verisini nesneye ceviriyotuz
        return Json::encode($hastalikkategoriapi);

    }else{

        return "false";
    }

}

public function apiset(Request $request){

    $sayac=0;

    $setapi=array();

    if($request['token']=="setler"){
        $veriler=Setler::where('aktif',1)->get();

        foreach ($veriler as $veri){

            $setapi[$sayac]["id"]=$veri->id;
            $setapi[$sayac]["ekleyen_id"]=$veri->ekleyen_id;
            $setapi[$sayac]["ekleyen_isim"]=Setler::ekleyenisimal($veri->ekleyen_id);

            $setapi[$sayac]["hasta_id"]=$veri->hasta_id;
            $setapi[$sayac]["hasta_isim"]=Setler::hastaisimal($veri->hasta_id);
            $setapi[$sayac]["egzersiz_isim"]=$veri->egzersiz_isim;
            $setapi[$sayac]["set"]=$veri->set;
            $setapi[$sayac]["tekrar"]=$veri->tekrar;
            $setapi[$sayac]["dinlenme"]=$veri->dinlenme;
            $setapi[$sayac]["plan_sayisi"]=$veri->plan_sayisi;

            $setapi[$sayac]["olusturulma_tarihi"] = $veri->created_at;

            $sayac++;
        }

        //json verisini nesneye ceviriyotuz
        return Json::encode($setapi);

    }else{

        return "false";
    }
}



public function apisetyorumlari(Request $request){

    $sayac=0;

    $setyorumlariapi=array();

    if($request['token']=="setyorumlari"){
        $veriler=Setyorum::where('aktif',1)->get();

        foreach ($veriler as $veri){

            $setyorumlariapi[$sayac]["id"]=$veri->id;
            $setyorumlariapi[$sayac]["ekleyen_id"]=$veri->ekleyen_id;
            $setyorumlariapi[$sayac]["ekleyen_isim"]=Setyorum::ekleyenisimal($veri->ekleyen_id);

            $setyorumlariapi[$sayac]["hasta_id"]=$veri->hasta_id;
            $setyorumlariapi[$sayac]["hasta_isim"]=Setyorum::hastaisimal($veri->hasta_id);

            $setyorumlariapi[$sayac]["egzersiz_yorum"]=$veri->yorum;
            $setyorumlariapi[$sayac]["plan_sayisi"]=$veri->plan_sayisi;

            $setyorumlariapi[$sayac]["olusturulma_tarihi"] = $veri->created_at;

            $sayac++;
        }

        //json verisini nesneye ceviriyotuz
        return Json::encode($setyorumlariapi);

    }
    else{

        return "false";
    }
}


public function apihasta(Request $request){

    $sayac=0;

    $hastalarapi=array();

    if($request['token']=="hastalar"){
        $veriler=Hastalar::where('aktif',1)->get();

        foreach ($veriler as $veri){

            $hastalarapi[$sayac]["id"]=$veri->id;
            $hastalarapi[$sayac]["ekleyen_id"]=$veri->ekleyen_id;
            $hastalarapi[$sayac]["ekleyen_isim"]=Hastalar::ekleyenisimal($veri->ekleyen_id);

            $hastalarapi[$sayac]["hasta_resim"]="https://verigirisi.fizyobilisim.com".$veri->hasta_resim;
            $hastalarapi[$sayac]["hasta_ad"]=$veri->hasta_ad;

            $hastalarapi[$sayac]["hasta_soyad"]=$veri->hasta_soyad;
            $hastalarapi[$sayac]["hasta_telefon"]=$veri->hasta_telefon;
            $hastalarapi[$sayac]["hasta_eposta"]=$veri->hasta_eposta;
            $hastalarapi[$sayac]["hasta_sifre"]=$veri->hasta_sifre;
            $hastalarapi[$sayac]["hasta_babaadi"]=$veri->hasta_babaadi;
            $hastalarapi[$sayac]["hasta_anneadi"]=$veri->hasta_anneadi;

            $hastalarapi[$sayac]["hasta_tc"]=$veri->hasta_tc;
            $hastalarapi[$sayac]["hasta_dogumyeri"]=$veri->hasta_dogumyeri;
            $hastalarapi[$sayac]["hasta_dogumtarihi"]=$veri->hasta_dogumtarihi;
            $hastalarapi[$sayac]["hasta_cinsiyet"]=$veri->hasta_cinsiyet;
            $hastalarapi[$sayac]["hasta_medenihali"]=$veri->hasta_medenihali;
            $hastalarapi[$sayac]["hasta_anneadi"]=$veri->hasta_anneadi;
            $hastalarapi[$sayac]["hasta_kangurubu"]=$veri->hasta_kangurubu;

            $hastalarapi[$sayac]["hasta_ulke"]=$veri->hasta_ulke;
            $hastalarapi[$sayac]["hasta_il"]=$veri->hasta_il;
            $hastalarapi[$sayac]["hasta_ilce"]=$veri->hasta_ilce;
            $hastalarapi[$sayac]["hasta_acikadress"]=$veri->hasta_acikadress;

            $hastalarapi[$sayac]["kurum_id"]=$veri->kurum_id;
            $hastalarapi[$sayac]["kurum_ad"]=Hastalar::kurumisimal($veri->kurum_id);

            $hastalarapi[$sayac]["olusturulma_tarihi"] = $veri->created_at;

            $sayac++;
        }

        //json verisini nesneye ceviriyotuz
        return Json::encode($hastalarapi);

    }else{

        return "false";
    }

}


public  function apikurum(Request $request){

    $sayac=0;

    $kurumlarapi=array();

    if($request['token']=="kurumlar"){
        $veriler=Kurumlar::where('aktif',1)->get();

        foreach ($veriler as $veri){

            $kurumlarapi[$sayac]["id"]=$veri->id;
            $kurumlarapi[$sayac]["ekleyen_id"]=$veri->ekleyen_id;
            $kurumlarapi[$sayac]["ekleyen_isim"]=Kurumlar::ekleyenisimal($veri->ekleyen_id);

            $kurumlarapi[$sayac]["kurum_resim"]="https://verigirisi.fizyobilisim.com".$veri->kurum_resim;
            $kurumlarapi[$sayac]["kurum_arayanad"]=$veri->kurum_arayanad;

            $kurumlarapi[$sayac]["kurum_arayansoyad"]=$veri->kurum_arayansoyad;
            $kurumlarapi[$sayac]["kurum_arayantelefon"]=$veri->kurum_arayantelefon;
            $kurumlarapi[$sayac]["kurum_arayaneposta"]=$veri->kurum_arayaneposta;
            $kurumlarapi[$sayac]["kurum_arayansifre"]=$veri->kurum_arayansifre;
            $kurumlarapi[$sayac]["kurum_adi"]=$veri->kurum_adi;
            $kurumlarapi[$sayac]["kurum_yetkiliadi"]=$veri->kurum_yetkiliadi;

            $kurumlarapi[$sayac]["kurum_yetkilinumara"]=$veri->kurum_yetkilinumara;
            $kurumlarapi[$sayac]["kurum_vergidairesi"]=$veri->kurum_vergidairesi;
            $kurumlarapi[$sayac]["kurum_yetkilicinsiyet"]=$veri->kurum_yetkilicinsiyet;
            $kurumlarapi[$sayac]["kurum_ulke"]=$veri->kurum_ulke;
            $kurumlarapi[$sayac]["kurum_il"]=$veri->kurum_il;
            $kurumlarapi[$sayac]["kurum_ilce"]=$veri->kurum_ilce;
            $kurumlarapi[$sayac]["kurum_acikadress"]=$veri->kurum_acikadress;

            $kurumlarapi[$sayac]["olusturulma_tarihi"] = $veri->created_at;

            $sayac++;
        }

        //json verisini nesneye ceviriyotuz
        return Json::encode($kurumlarapi);

    }else{

        return "false";
    }
}


    public function apihastagiris (Request $request)
    {

        $kullanici_var = User::where('aktif', 1)
        ->where('email', $request['email'])
        ->first();

        $sayac = 0;

        $kullanicigirisapi = array();

        if ($request['token'] == "kullanicigirisi") {

            if ($kullanici_var != null) {

                if (Auth::attempt(['email' => $kullanici_var->email, 'password' => $request['password']])) {


                        $token = str_random(32);
                        $kullanici_var->update([
                            'token' => $token
                        ]);

                        $kullanici_var->save();


                    $setlerim = Setler::where('aktif', 1)
                        ->where('hasta_id', $kullanici_var->hasta_id)
                        ->get()
                        ->groupBy('plan_sayisi');


                    $kullanicigirisapi[$sayac]["kisi_id"] = $kullanici_var->id;
                    $kullanicigirisapi[$sayac]["token"] = $kullanici_var->token;

                    $sayi = 0;
                    $sayi2 = 0;
                    foreach ($setlerim as $setim) {

                        $kullanicigirisapi[$sayac]["hasta"][$sayi]["ekleyen_id"] = $setim[0]->ekleyen_id;
                        $kullanicigirisapi[$sayac]["hasta"][$sayi]["ekleyen_isim"] = Setler::ekleyenisimal($setim[0]->id);
                        $kullanicigirisapi[$sayac]["hasta"][$sayi]["program_adi"] = $setim[0]->program_adi;
                        $kullanicigirisapi[$sayac]["hasta"][$sayi]["hasta_adi"] = Setler::hastaisimal($setim[0]->id);
                        $kullanicigirisapi[$sayac]["hasta"][$sayi]["eklenme_zamani"] = $setim[0]->created_at;
                        $kullanicigirisapi[$sayac]["hasta"][$sayi]["plan_sayisi"] = $setim[0]->plan_sayisi;

                        foreach ($setim as $set) {

                            $kullanicigirisapi[$sayac]["hasta"][$sayi]["program"][$sayi2]["Baslangıç tarihi"] = $set->baslangic_tarihi;
                            $kullanicigirisapi[$sayac]["hasta"][$sayi]["program"][$sayi2]["Bitis tarihi"] = $set->bitis_tarihi;
                            $kullanicigirisapi[$sayac]["hasta"][$sayi]["program"][$sayi2]["Program adı"] = $set->program_adi;
                            $kullanicigirisapi[$sayac]["hasta"][$sayi]["program"][$sayi2]["Egzersiz ismi"] = $set->egzersiz_isim;
                            $kullanicigirisapi[$sayac]["hasta"][$sayi]["program"][$sayi2]["set sayisi"] = $set->set;
                            $kullanicigirisapi[$sayac]["hasta"][$sayi]["program"][$sayi2]["tekrar sayisi"] = $set->tekrar;
                            $kullanicigirisapi[$sayac]["hasta"][$sayi]["program"][$sayi2]["dinlenme"] = $set->dinlenme;
                            $kullanicigirisapi[$sayac]["hasta"][$sayi]["program"][$sayi2]["haftalik tekrar"] = $set->haftalik_tekrar;
                            $kullanicigirisapi[$sayac]["hasta"][$sayi]["program"][$sayi2]["gunluk tekrar"] = $set->gunluk_tekrar;

                            $sayi2++;

                        }

                        $sayi++;
                    }

                    return Json::encode($kullanicigirisapi);

                }


            } else {

                return "kullanici bulunamadı";
            }


        } else {

            return "false";
        }


    }


}
