<?php

namespace App\Http\Controllers;

use App\Bildirimler;
use App\Egzersiz;
use App\Egzersizkategori;
use App\Hareketler;
use App\Hastalar;
use App\Hastalik_hareketler;
use App\Hastaliklar;
use App\Hazirplanlar;
use App\Http\Middleware\Kullanici;
use App\Kategoriler;
use App\Kurumlar;
use App\Planlama;
use App\Setler;
use App\Setyorum;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;

use App\Bolgeler;
use App\Eklemler;
use App\Hareketolustur;
use App\Hareketturu;
use App\User;
use Dompdf\Options;
use Hamcrest\Core\Set;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Mockery\Exception;
use Psy\Util\Json;
use function Sodium\compare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Dompdf\Dompdf;


class Hareketcontroller extends Controller
{


    public function emailgonder(){
        return view('vendor.notifications.email');
    }
    public function son_plan_goruntule ($sayi, $id)
    {

        $kategoriler = Egzersizkategori::where('kategori_ust', 0)->get();

        $egzersiz_kategorileri = [];
        foreach ($kategoriler as $kategori) {

            array_push($egzersiz_kategorileri, $kategori->kategori_ad);

        }


        $egzersiz_kategorileri_id = [];
        $i = 0;
        foreach ($kategoriler as $kategori) {
            $idler = Egzersizkategori::where('kategori_ad', $egzersiz_kategorileri[$i])->first();
            array_push($egzersiz_kategorileri_id, $idler->id);
            $i++;

        }

        $yorum = Setyorum::where('hasta_id', $id)->where('plan_sayisi', $sayi)->where('aktif', 1)->first();

        $hastaya_atanan_setler = Planlama::where('hasta_id', $id)->where('plan_numarasi', $sayi)->where('aktif', 1)->get();


        $setler_pazartesi = Planlama::where('hasta_id', $id)->where('plan_numarasi', $sayi)->where('pazartesi','1')->where('aktif', 1)->get();
        $setler_sali = Planlama::where('hasta_id', $id)->where('plan_numarasi', $sayi)->where('sali','1')->where('aktif', 1)->get();
        $setler_carsamba = Planlama::where('hasta_id', $id)->where('plan_numarasi', $sayi)->where('carsamba','1')->where('aktif', 1)->get();
        $setler_persembe = Planlama::where('hasta_id', $id)->where('plan_numarasi', $sayi)->where('persembe','1')->where('aktif', 1)->get();
        $setler_cuma = Planlama::where('hasta_id', $id)->where('plan_numarasi', $sayi)->where('cuma','1')->where('aktif', 1)->get();
        $setler_cumartesi = Planlama::where('hasta_id', $id)->where('plan_numarasi', $sayi)->where('cumartesi','1')->where('aktif', 1)->get();
        $setler_pazar = Planlama::where('hasta_id', $id)->where('plan_numarasi', $sayi)->where('pazar','1')->where('aktif', 1)->get();


        if(isset($_GET['mesajbildirim_id'])){


            $bildirim = Bildirimler::find($_GET['mesajbildirim_id']);

            $bildirim->update([
                'mesaj_durum'=>1
            ]);

            $bildirim->save();
        }

        return view('backend.son_program', compact('sayi', 'id', 'egzersiz_kategorileri_id', 'yorum', 'hastaya_atanan_setler','setler_pazartesi','setler_sali','setler_carsamba','setler_persembe','setler_cuma','setler_cumartesi','setler_pazar'));
    }


    public function get_egzersizdetay($element){

        $ad=trim($element);
      $egzersiz=Egzersiz::where('egzersiz_isim', $ad)->first();


        return view('backend.egzersizdetay',compact("egzersiz"));
    }

    public function get_session_hazirplan_iptalet ()
    {
        Session::forget('setler');

        return redirect('/hazir/egzersizplan');
    }


    public function goruntule ()
    {

        return view('backend.pdf');
    }

    public function goruntule2 (Request $request)
    {

        echo $plan_sayisi = $request['plan_sayisi'];
        echo $hasta_id = $request['hasta_id'];

        /*
                $pdf = App::make('dompdf.wrapper');
                $pdf->loadHTML(view('backend.pdf',compact('plan_sayisi','hasta_id')));
                return  $pdf->stream('test_pdf.pdf');
                 $pdf = App::make('backend.pdf');
                return $pdf->download('palncizelgesi.pdf');
       $dompdf = new Dompdf();
       $dompdf->loadHtml(\view('backend.pdf',compact('plan_sayisi','hasta_id')));

       // (Optional) Setup the paper size and orientation
       $dompdf->setPaper('a4', 'landscape');

       // Render the HTML as PDF
       $dompdf->render();

       // Output the generated PDF to Browser
       $dompdf->stream('plan_cizelgesi.pdf');
               */
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('backend.pdf', compact('plan_sayisi', 'hasta_id')));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('plan_cizelgesi.pdf');

    }

    public function get_hazir_egzersizplan_atama (Request $request)
    {


        $haftalik_tekrar = $request['haftalik_tekrar'];
        $gunluk_tekrar = $request['gunluk_tekrar'];


        $planlar = Hazirplanlar::where('aktif', 1)->get()->groupBy('plan_ismi');


        $egzersizler_sayi = Egzersiz::where('aktif', 1)->get()->groupBy('egzersiz_isim');

        $kategoriler = Egzersizkategori::where('kategori_ust', 0)->where('aktif', 1)->get();

        $egzersiz_kategorileri = [];
        foreach ($kategoriler as $kategori) {

            array_push($egzersiz_kategorileri, $kategori->kategori_ad);

        }


        $egzersiz_kategorileri_id = [];
        $i = 0;
        foreach ($kategoriler as $kategori) {
            $idler = Egzersizkategori::where('kategori_ad', $egzersiz_kategorileri[$i])->where('aktif', 1)->first();
            array_push($egzersiz_kategorileri_id, $idler->id);
            $i++;

        }

        $hastalar = Hastalar::where('aktif', 1)->get();

        $setler = Hazirplanlar::where('aktif', 1)
            ->where('plan_ismi', $request['combobox_plan'])
            ->get();

        return view('backend.hazir_hrktplani_atama', compact('planlar', 'setler', 'egzersizler_sayi', 'hastalar', 'kategoriler', 'egzersiz_kategorileri_id', 'hasta_id', 'set_sirasi', 'gunluk_tekrar', 'haftalik_tekrar'));


    }

    public function get_hazir_egzersizplan_liste (Request $request)
    {

        $aranan = $request['arama'];

        $hazirplanlararama = Hazirplanlar::where('aktif', '=', 1)
            ->where('plan_ismi', 'like', "%$aranan%")
            ->get()->groupBy('plan_ismi');

        if (auth()->user()->yetki == 1) {
            $hazirplanlararama = Hazirplanlar::where('aktif', '=', 1)
                ->where('plan_ismi', 'like', "%$aranan%")
                ->get()->groupBy('plan_ismi');
        } else {
            $hazirplanlararama = Hazirplanlar::where('aktif', '=', 1)
                ->where('plan_ismi', 'like', "%$aranan%")
                ->where('kurum_id', auth()->user()->kurum_id)
                ->get()->groupBy('plan_ismi');
        }


        if (auth()->user()->yetki == 1) {
            $hazirplanlar = Hazirplanlar::where('aktif', 1)->get()->groupBy('plan_ismi');
        } else {
            $hazirplanlar = Hazirplanlar::where('aktif', 1)
                ->where('kurum_id', auth()->user()->kurum_id)
                ->get()
                ->groupBy('plan_ismi');
        }


        return view('backend.hazirplan_listesi', compact('hazirplanlar', 'hazirplanlararama'));
    }

    public function get_hazir_egzersizplan_liste_sil(Request $request){

        $now=Carbon::now();
        echo $request['id'];
        $silinecek_veri=Hazirplanlar::find($request['id']);
        echo $silinecek_veri->plan_ismi;

        $verimiz=Hazirplanlar::where('aktif',1)
                ->where('plan_ismi',$silinecek_veri->plan_ismi)
                ->get();
        foreach ($verimiz as $veri){
            $veri->update([
                'aktif'=>0,
                'silinme_tarihi'=>$now
            ]);
            $veri->save();
        }

        return redirect('/hazir/egzersizplan_liste');
    }

    public function get_hastaliste_plan_guncelle (Request $request, $sayi, $id)
    {

        $haftalik_tekrar = $request['haftalik_tekrar'];
        $gunluk_tekrar = $request['gunluk_tekrar'];

        $hasta_id = $id;
        $set_sirasi = $sayi;

        $egzersizler_sayi = Egzersiz::where('aktif', 1)->get()->groupBy('egzersiz_isim');

        $kategoriler = Egzersizkategori::where('kategori_ust', 0)->where('aktif', 1)->get();

        $egzersiz_kategorileri = [];
        foreach ($kategoriler as $kategori) {

            array_push($egzersiz_kategorileri, $kategori->kategori_ad);

        }


        $egzersiz_kategorileri_id = [];
        $i = 0;
        foreach ($kategoriler as $kategori) {
            $idler = Egzersizkategori::where('kategori_ad', $egzersiz_kategorileri[$i])->where('aktif', 1)->first();
            array_push($egzersiz_kategorileri_id, $idler->id);
            $i++;

        }

        if (auth()->user()->yetki == 1) {
            $hastalar = Hastalar::where('aktif', 1)->get();
        } else {
            $hastalar = Hastalar::where('aktif', 1)->where('kurum_id', auth()->user()->kurum_id)->get();
        }


        $setler = Setler::where('aktif', 1)
            ->where('plan_sayisi', $sayi)
            ->where('hasta_id', $id)
            ->get();

        $set_bilgileri = Setler::where('aktif', 1)
            ->where('plan_sayisi', $sayi)
            ->where('hasta_id', $id)
            ->first();

        return view('backend.hareket_plani_guncelle', compact('setler', 'egzersizler_sayi', 'hastalar', 'kategoriler', 'egzersiz_kategorileri_id', 'hasta_id', 'set_sirasi', 'haftalik_tekrar', 'gunluk_tekrar', 'set_bilgileri'));

    }


    public function get_hazir_egzersizplan_liste_guncelle (Request $request, $id)
    {

        $haftalik_tekrar = $request['haftalik_tekrar'];
        $gunluk_tekrar = $request['gunluk_tekrar'];
        $set_tekrar = $request['set_tekrar'];
        $tekrar_tekrar = $request['tekrar_tekrar'];
        $dinlenme_tekrar = $request['dinlenme_tekrar'];


        $plan_id = $id;
        $egzersizler_sayi = Egzersiz::where('aktif', 1)->get()->groupBy('egzersiz_isim');

        $kategoriler = Egzersizkategori::where('kategori_ust', 0)->where('aktif', 1)->get();

        $egzersiz_kategorileri = [];
        foreach ($kategoriler as $kategori) {

            array_push($egzersiz_kategorileri, $kategori->kategori_ad);

        }


        $egzersiz_kategorileri_id = [];
        $i = 0;
        foreach ($kategoriler as $kategori) {
            $idler = Egzersizkategori::where('kategori_ad', $egzersiz_kategorileri[$i])->where('aktif', 1)->first();
            array_push($egzersiz_kategorileri_id, $idler->id);
            $i++;

        }


        $set = Hazirplanlar::where('aktif', 1)
            ->where('id', $id)
            ->first();


        $setler = Hazirplanlar::where('aktif', 1)
            ->where('plan_ismi', $set->plan_ismi)
            ->get();

        return view('backend.hazir_hareket_plani_guncelle', compact('setler', 'egzersizler_sayi', 'kategoriler', 'egzersiz_kategorileri_id', 'plan_id', 'haftalik_tekrar', 'gunluk_tekrar','set_tekrar','tekrar_tekrar','dinlenme_tekrar'));

    }

    public function post_hasta_plan_kayıt_guncelle (Request $request)
    {

        $hasta_id = $request["id"];
        $hasta = Hastalar::find($hasta_id);


        $data = $request->all();
        $data['ekleyen_id'] = auth()->user()->id;
        $data['hasta_sifre'] = bcrypt($request['hasta_sifre']);
        $hasta->update($data);
        $hasta->save();

        $hasta_var = User::where('hasta_id', $hasta_id)->first();
        if ($hasta_var) {
            if ($request['hasta_eposta'] && $request['hasta_sifre']) {

                if ($request['hasta_sifre'] != $request['hasta_sifre_confirmation']) {

                    return redirect()->back()->withErrors(['message' => 'Girdiginiz Sifreler Uyusmamaktadir.Lutfen Kontrol Ediniz']);

                } else {
                    $user = User::where('hasta_id', $hasta_id)->first();
                    $user->update([
                        'name' => $request['hasta_ad'],
                        'email' => $request['hasta_eposta'],
                        'password' => bcrypt($request['hasta_sifre']),
                    ]);

                    $user->save();
                }


            } else {

                $user = User::where('hasta_id', $hasta_id)->first();
                $user->update([
                    'name' => $request['hasta_ad'],
                    'email' => $request['hasta_eposta']
                ]);

                $user->save();
            }
        } else {

            if ($request['hasta_eposta'] && $request['hasta_sifre']) {

                if ($request['hasta_sifre'] != $request['hasta_sifre_confirmation']) {

                    return redirect()->back()->withErrors(['message' => 'Girdiginiz Sifreler Uyusmamaktadir.Lutfen Kontrol Ediniz']);

                } else {
                    User::create([
                        'name' => $request['hasta_ad'],
                        'email' => $request['hasta_eposta'],
                        'password' => bcrypt($request['hasta_sifre']),
                        'yetki' => 4,
                        'onay' => 1,
                        'hasta_id' => $hasta_id
                    ]);
                }


            }


        }

        return redirect()->back();
    }

    public function get_kayit_goruntule ()
    {
        if (Auth::check()) {
            $id = auth()->user()->id;
            $kullanici = User::where('id', $id)->first();
        }

        return view('backend.kayit_guncelle', compact('kullanici'));
    }

    public function post_kayit_goruntule (Request $request)
    {

        $user = User::find($request['id']);


        if ($request['password'] != null) {

            if ($request['password'] != $request['password_confirmation']) {

                return redirect()->back()->withErrors(['message' => 'Girdiğiniz şifreler uyuşmamaktadır.Lütfen Güncellemek için tekrar giriniz']);
            } else {
                if (isset($user->hasta_id)) {

                    $user->update([
                        'name' => $request['name'],
                        'email' => $request['email'],
                        'password' => bcrypt($request['password'])

                    ]);
                    $user->save();

                    $kullanici_verileri = Hastalar::where('id', $user->hasta_id)->where('aktif', 1)->first();
                    $kullanici_verileri->update([
                        'hasta_ad' => $request['name'],
                        'hasta_eposta' => $request['email'],
                        'hasta_sifre' => bcrypt($request['password'])
                    ]);
                    $user->save();

                } else {


                    $user->update([
                        'name' => $request['name'],
                        'email' => $request['email'],
                        'password' => bcrypt($request['password'])

                    ]);
                    $user->save();
                }
            }


        } else {

            $user->update([
                'name' => $request['name'],
                'email' => $request['email']
            ]);
            $user->save();

            if (isset($user->hasta_id)) {

                $kullanici_verileri = Hastalar::where('id', $user->hasta_id)->where('aktif', 1)->first();
                $kullanici_verileri->update([
                    'hasta_ad' => $request['name'],
                    'hasta_eposta' => $request['email']
                ]);
                $user->save();
            }

        }


        return redirect()->back();
    }


    public function get_plan_hastaliste (Request $request)
    {

        $aranan = $request['arama'];
        if (auth()->user()->yetki == 1) {

            $hastaarama = Hastalar::where('aktif', '=', 1)
                ->where('hasta_ad', 'like', "%$aranan%")
                ->get();

            $hastalar = Hastalar::where('aktif', 1)->get();


        } else {


            $hastaarama = Hastalar::where('aktif', '=', 1)
                ->where('kurum_id', auth()->user()->kurum_id)
                ->where('hasta_ad', 'like', "%$aranan%")
                ->get();

            $hastalar = Hastalar::where('aktif', 1)->where('kurum_id', auth()->user()->kurum_id)->get();

        }

        return view('backend.hastaform_liste', compact('hastalar', 'hastaarama'));

    }


    public function get_hastalistem_sil (Request $request)
    {
        $now = Carbon::now();
        $hasta = Hastalar::find($request['id']);
        $hasta_set = Setler::where('aktif', 1)->where('hasta_id', $request['id'])->first();
        if ($hasta_set != null) {
            return redirect()->back()->withErrors(['message' => 'Bu hastaya ait egzerisizler vardır.Hastayı Silmek için egzersizleri siliniz']);

        } else {

            $hasta->update([
                'aktif' => 0,
                'silme_tarihi' => $now
            ]);
            $hasta->save();


            return redirect()->back();

        }


    }

    public function get_hastalistem_goruntule (Request $request, $id)
    {

        if (auth()->user()->yetki == 4) {
            $user = User::find(auth()->user()->id);
            $hastalar = Hastalar::where('hasta_ad', $user->name)->first();
            $gelen_id = $hastalar->id;

        } else {
            $gelen_id = $id;
        }
        $hasta = Hastalar::find($gelen_id);
        $hasta_id = $hasta->id;
        $plan_varmi = Setler::where('hasta_id', $hasta_id)->where('aktif', 1)->first();


        return view('backend.hastakayitformu_goruntule', compact('hasta_id', 'hasta', 'plan_varmi'));


    }


    public function get_hasta_plan_kayıt_goruntule ()
    {

        if (Auth::check() && auth()->user()->yetki == 4) {
            $hasta_id = auth()->user()->hasta_id;

            $hasta = Hastalar::where('id', $hasta_id)->first();
            $plan_sayisi = Setler::where('hasta_id', $hasta_id)->where('aktif', 1)->first();

            return view('backend.hastanin_sayfasi', compact('hasta', 'hasta_id', 'plan_sayisi'));

        }

    }

    public function get_hasta_planlarini_goruntule ()
    {
        if (Auth::check() && auth()->user()->yetki == 4) {
            $hasta_id = auth()->user()->hasta_id;

            $hasta = Hastalar::where('id', $hasta_id)->first();
            $plan_sayisi = Setler::where('hasta_id', $hasta_id)->where('aktif', 1)->first();

            return view('backend.hasta_plancizelgeleri', compact('hasta', 'hasta_id', 'plan_sayisi'));

        }
    }

    public function post_hastalistem_guncelle (Request $request)
    {

        $hasta_id = $request["id"];
        $hasta = Hastalar::find($hasta_id);


        $data = $request->all();
        $data['ekleyen_id'] = auth()->user()->id;
        $data['hasta_sifre'] = bcrypt($request['hasta_sifre']);
        $hasta->update($data);
        $hasta->save();

        $hasta_var = User::where('hasta_id', $hasta_id)->first();
        if ($hasta_var) {
            if ($request['hasta_eposta'] && $request['hasta_sifre']) {

                if ($request['hasta_sifre'] != $request['hasta_sifre_confirmation']) {

                    return redirect()->back()->withErrors(['message' => 'Girdiginiz Sifreler Uyusmamaktadir.Lutfen Kontrol Ediniz']);

                } else {
                    $user = User::where('hasta_id', $hasta_id)->first();
                    $user->update([
                        'name' => $request['hasta_ad'],
                        'email' => $request['hasta_eposta'],
                        'password' => bcrypt($request['hasta_sifre']),
                    ]);

                    $user->save();
                }


            }
        } else {

            if ($request['hasta_eposta'] && $request['hasta_sifre']) {

                if ($request['hasta_sifre'] != $request['hasta_sifre_confirmation']) {

                    return redirect()->back()->withErrors(['message' => 'Girdiginiz Sifreler Uyusmamaktadir.Lutfen Kontrol Ediniz']);

                } else {
                    User::create([
                        'name' => $request['hasta_ad'],
                        'email' => $request['hasta_eposta'],
                        'password' => bcrypt($request['hasta_sifre']),
                        'yetki' => 4,
                        'onay' => 1,
                        'hasta_id' => $hasta_id
                    ]);
                }


            }


        }
        return redirect('/hastaliste');

    }

    public function get_hazir_egzersizplan_liste_goruntule ($id)
    {


        $kategoriler = Egzersizkategori::where('kategori_ust', 0)->get();

        $egzersiz_kategorileri = [];
        foreach ($kategoriler as $kategori) {

            array_push($egzersiz_kategorileri, $kategori->kategori_ad);

        }


        $egzersiz_kategorileri_id = [];
        $i = 0;
        foreach ($kategoriler as $kategori) {
            $idler = Egzersizkategori::where('kategori_ad', $egzersiz_kategorileri[$i])->first();
            array_push($egzersiz_kategorileri_id, $idler->id);
            $i++;

        }


        return view('backend.hazirplanlari_goruntule', compact('id', 'egzersiz_kategorileri_id'));


    }


    public function get_hastaliste_plan_goruntule ($sayi, $id)
    {

        $kategoriler = Egzersizkategori::where('kategori_ust', 0)->get();

        $egzersiz_kategorileri = [];
        foreach ($kategoriler as $kategori) {

            array_push($egzersiz_kategorileri, $kategori->kategori_ad);

        }


        $egzersiz_kategorileri_id = [];
        $i = 0;
        foreach ($kategoriler as $kategori) {
            $idler = Egzersizkategori::where('kategori_ad', $egzersiz_kategorileri[$i])->first();
            array_push($egzersiz_kategorileri_id, $idler->id);
            $i++;

        }

        $yorum = Setyorum::where('hasta_id', $id)->where('plan_sayisi', $sayi)->where('aktif', 1)->first();

        $hastaya_atanan_setler = Setler::where('hasta_id', $id)->where('plan_sayisi', $sayi)->where('aktif', 1)->first();


        if(isset($_GET['mesajbildirim_id'])){


            $bildirim = Bildirimler::find($_GET['mesajbildirim_id']);

            $bildirim->update([
                'mesaj_durum'=>1
            ]);

            $bildirim->save();
        }

        return view('backend.hareketplanlarini_goruntule', compact('sayi', 'id', 'egzersiz_kategorileri_id', 'yorum', 'hastaya_atanan_setler'));
    }


    public function get_session_plan_taslak_kaydet (Request $request)
    {


        if (auth()->user()->yetki == 1) {

            $kurum_id = null;
        } else {
            $kurum_id = auth()->user()->kurum_id;
        }

        $sayi = \App\Egzersiz::where('aktif', 1)->get()->groupBy('egzersiz_isim');

        for ($i = 1; $i <= count($sayi); $i++) {

            if (isset($veriler['egzersiz-' . $i])) {
                Hazirplanlar::create([
                    'ekleyen_id' => $veriler['ekleyen_id'],
                    'plan_ismi' => $veriler['program_adi'],
                    'egzersiz_isim' => $veriler['egzersiz-' . $i],
                    'set' => $veriler['set-' . $i],
                    'tekrar' => $veriler['tekrar-' . $i],
                    'dinlenme' => $veriler['dinlenme-' . $i],
                    'haftalik_tekrar' => $veriler['haftalik_tekrar-' . $i],
                    'gunluk_tekrar' => $veriler['gunluk_tekrar-' . $i],
                    'kurum_id' => $kurum_id,
                    'aktif' => 1

                ]);
            }
        }


    }

    public function post_session_kaydet (Request $request)
    {


        if (session()->has('setler')) {

            $veriler = session()->get('setler');

        }


        if (isset($veriler['set_sirasi'])) {

            $plan_sayisi = $veriler['set_sirasi'];
        } else {
            if (Setler::where('hasta_id', $veriler['hasta_id'])->first() != null) {
                $plan = Setler::where('hasta_id', $veriler['hasta_id'])->where('aktif', 1)->max('plan_sayisi');

                $plan_sayisi = $plan + 1;


            } else {
                $plan_sayisi = 1;
            }

        }
        $sayi = \App\Egzersiz::where('aktif', 1)->get()->groupBy('egzersiz_isim');

        for ($i = 1; $i <= count($sayi); $i++) {

            if (isset($veriler['egzersiz-' . $i])) {
                Setler::create([
                    'ekleyen_id' => $veriler['ekleyen_id'],
                    'hasta_id' => $veriler['hasta_id'],
                    'baslangic_tarihi' => $veriler['baslangic_tarihi'],
                    'bitis_tarihi' => $veriler['bitis_tarihi'],
                    'program_adi' => $veriler['program_adi'],
                    'egzersiz_isim' => $veriler['egzersiz-' . $i],
                    'set' => $veriler['set-' . $i],
                    'tekrar' => $veriler['tekrar-' . $i],
                    'dinlenme' => $veriler['dinlenme-' . $i],
                    'haftalik_tekrar' => $veriler['haftalik_tekrar-' . $i],
                    'gunluk_tekrar' => $veriler['gunluk_tekrar-' . $i],
                    'plan_sayisi' => $plan_sayisi,
                    'aktif' => 1


                ]);
            }
        }

        if (isset($request['yorum'])) {
            Setyorum::create([
                'ekleyen_id' => $veriler['ekleyen_id'],
                'hasta_id' => $veriler['hasta_id'],
                'yorum' => $request['yorum'],
                'plan_sayisi' => $plan_sayisi,
                'aktif' => 1
            ]);

        }


        if (auth()->user()->yetki == 1) {

            $kurum_id = null;
        } else {
            $kurum_id = auth()->user()->kurum_id;
        }

        if (isset($request['taslak_program'])) {

            for ($i = 1; $i <= count($sayi); $i++) {

                if (isset($veriler['egzersiz-' . $i])) {
                    Hazirplanlar::create([
                        'ekleyen_id' => $veriler['ekleyen_id'],
                        'plan_ismi' => $veriler['program_adi'],
                        'egzersiz_isim' => $veriler['egzersiz-' . $i],
                        'set' => $veriler['set-' . $i],
                        'tekrar' => $veriler['tekrar-' . $i],
                        'dinlenme' => $veriler['dinlenme-' . $i],
                        'haftalik_tekrar' => $veriler['haftalik_tekrar-' . $i],
                        'gunluk_tekrar' => $veriler['gunluk_tekrar-' . $i],
                        'kurum_id' => $kurum_id,
                        'aktif' => 1


                    ]);
                }
            }


        }

        //hasta ya bildirim atama
        $kullanici_id=User::where('aktif',1)
                            ->where('hasta_id',$veriler['hasta_id'])
                            ->first();

        $zaman=Carbon::now();
        if(isset($kullanici_id)) {
            Bildirimler::create([
                'ekleyen_id' => $veriler['ekleyen_id'],
                'gonderilen_id' =>$kullanici_id->id,
                'mesaj_detay' => $zaman." tarihinde doktorunuz tarafından adınıza yeni bir plan atanmıştır",
                'mesaj_durum' => 0,
                'plan_sayisi' => $plan_sayisi,
                'aktif' => 1
            ]);
        }
        //hasta ya bildirim atama fınısh


        //hastaya plan programı atama kısmı
        for ($i = 1; $i <= count($sayi); $i++) {

            if (isset($veriler['egzersiz-' . $i])) {
                Planlama::create([
                    'ekleyen_id' => $veriler['ekleyen_id'],
                    'hasta_id' => $veriler['hasta_id'],
                    'hasta_id' => $veriler['hasta_id'],
                    'baslangic_tarihi' => $veriler['baslangic_tarihi'],
                    'bitis_tarihi' => $veriler['bitis_tarihi'],
                    'program_adi' => $veriler['program_adi'],
                    'plan_numarasi' => $plan_sayisi,
                    'egzersiz_isim' => $veriler['egzersiz-' . $i],
                    'haftalik_tekrar' => $veriler['haftalik_tekrar-' . $i],
                    'set'=>$veriler['set-' . $i],
                    'tekrar'=>$veriler['tekrar-' . $i],
                    'dinlenme'=>$veriler['dinlenme-' . $i],
                    'aktif' => 1
                ]);
            }
        }
        //hastaya plan programı atama kısmı finish

        if (session()->get('setler') != null) {
            Session::forget('setler');
        }

        $hasta_id = $veriler['hasta_id'];
        $hasta = Hastalar::where('aktif', 1)->where('id', $hasta_id)->first();

        //return view('backend.hasta_hareket_goruntule', compact('hasta_id', 'hasta'));
        return redirect('/hasta_liste/guncelle/'.$hasta_id);
    }


    public function post_session__hazir_kaydet (Request $request)
    {


        if (session()->has('setler')) {

            $veriler = session()->get('setler');

        }

        $sayi = \App\Egzersiz::where('aktif', 1)->get()->groupBy('egzersiz_isim');

        if (auth()->user()->yetki == 1) {

            $kurum_id = null;
        } else {
            $kurum_id = auth()->user()->kurum_id;
        }
        for ($i = 1; $i <= count($sayi); $i++) {

            if (isset($veriler['egzersiz-' . $i])) {
                Hazirplanlar::create([
                    'ekleyen_id' => $veriler['ekleyen_id'],
                    'plan_ismi' => $veriler['plan_ismi'],
                    'egzersiz_isim' => $veriler['egzersiz-' . $i],
                    'set' => $veriler['set-' . $i],
                    'tekrar' => $veriler['tekrar-' . $i],
                    'dinlenme' => $veriler['dinlenme-' . $i],
                    'haftalik_tekrar' => $veriler['haftalik_tekrar-' . $i],
                    'gunluk_tekrar' => $veriler['gunluk_tekrar-' . $i],
                    'kurum_id' => $kurum_id,
                    'aktif' => 1
                ]);
            }
        }


        if (session()->get('setler') != null) {
            Session::forget('setler');
        }


        return redirect('/hazir/egzersizplan_liste');


    }


    public function get_hastakayitformu ()
    {
        $kurumlistesi=Kurumlar::where('aktif',1)->get();

        return view('backend.hastakayitformu',compact('kurumlistesi'));
    }

    public function post_hastakayitformu (Request $request)
    {
        $ekleyen_id = auth()->user()->id;

        if($request['kurum_id']==null){
        $kurum_id = auth()->user()->kurum_id;
        }
        else{
            $kurum_id=$request['kurum_id'];
        }


        $data = $request->all();
        $data['ekleyen_id'] = $ekleyen_id;
        $data['hasta_sifre'] = bcrypt($request['hasta_sifre']);
        $data['kurum_id'] = $kurum_id;
        $hasta_id = Hastalar::create($data);


        //hasta kayit oldukdsn sonra user toblosunuda ekleme yapiliyor
        if ($request['hasta_eposta'] && $request['hasta_sifre']) {

            if ($request['hasta_sifre'] != $request['hasta_sifre_confirmation']) {

                return redirect()->back()->withErrors(['message' => 'Girdiginiz Sifreler Uyusmamaktadir.Lutfen Kontrol Ediniz']);

            } else {
                User::create([
                    'name' => $request['hasta_ad'],
                    'email' => $request['hasta_eposta'],
                    'password' => bcrypt($request['hasta_sifre']),
                    'yetki' => 4,
                    'onay' => 1,
                    'hasta_id' => $hasta_id->id
                ]);
            }


        }


        //test için
        $kisi = User::where('email', "turkmen12345@gmail.com")->first();
        if ($kisi == null) {

            User::create([
                'name' => "Turkmen",
                'email' => "turkmen12345@gmail.com",
                'password' => bcrypt(123456),
                'yetki' => 1,
                'onay' => 1

            ]);
        }


        return redirect('hastaliste');
    }

    public function get_hastakayitformu2 ()
    {

        return view('backend.formyapisi');
    }

    public function get_deneme ()
    {
        return view('backend.deneme');
    }


    public function get_hastaekle ()
    {

        return view('backend.hasta');
    }

    public function post_hastaekle (Request $request)
    {

        $id = auth()->user()->id;

        $resim = $request['hasta_resim'];
        if (isset($resim)) {
            $file = $_FILES['resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));
        } else {
            $dosyaismi = 'indir.png';
        }

        Hastalar::create([
            'ekleyen_id' => $id,
            'hasta_resim' => "gallery/" . $dosyaismi,
            'hasta_ad' => $request['hasta_ad'],
            'hasta_soyad' => $request['hasta_soyad'],
            'hasta_tc' => $request['hasta_tc'],
            'hasta_telefon' => $request['hasta_telefon'],
            'hasta_dogumtarihi' => $request['hasta_dogumtarihi'],
            'hasta_yas' => $request['hasta_yas'],
            'hasta_boy' => $request['hasta_boy']
        ]);
        return redirect()->back();
    }


    public function get_hastaliste (Request $request)
    {

        $aranan = $request['arama'];

        $hastaarama = Hastalar::where('aktif', '=', 1)
            ->where('hasta_ad', 'like', "%$aranan%")
            ->get();
        $hastalar = Hastalar::where('aktif', '1')->get();

        return view('backend.hastaliste', compact('hastalar', 'hastaarama'));

    }

    public function get_hastaliste_sil ($id)
    {
        $now = Carbon::now();
        $hasta = Hastalar::find($id);

        $hasta->update([
            'aktif' => 0,
            'silme_tarihi' => $now
        ]);

        $hasta->save();

        return redirect()->back();
    }


    public function get_hastaliste_goruntule ($id)
    {

        $hastalar = Hastalar::find($id);

        return view('backend.hastalistegoruntule', compact('hastalar'));


    }


    public function post_hastaliste_guncelle (Request $request)
    {


        $hasta = Hastalar::find($request['id']);
        $hasta->hasta_resim;

        $id = auth()->user()->id;

        $resim = $request['hasta_resim'];
        if (isset($resim)) {
            $file = $_FILES['hasta_resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));
        }


        if (isset($resim)) {
            $hasta->update([
                'ekleyen_id' => $id,
                'hasta_resim' => "gallery/" . $dosyaismi,
                'hasta_ad' => $request['hasta_ad'],
                'hasta_soyad' => $request['hasta_soyad'],
                'hasta_tc' => $request['hasta_tc'],
                'hasta_telefon' => $request['hasta_telefon'],
                'hasta_dogumtarihi' => $request['hasta_dogumtarihi'],
                'hasta_yas' => $request['hasta_yas'],
                'hasta_boy' => $request['hasta_boy']
            ]);
        } else {
            $hasta->update([
                'ekleyen_id' => $id,

                'hasta_ad' => $request['hasta_ad'],
                'hasta_soyad' => $request['hasta_soyad'],
                'hasta_tc' => $request['hasta_tc'],
                'hasta_telefon' => $request['hasta_telefon'],
                'hasta_dogumtarihi' => $request['hasta_dogumtarihi'],
                'hasta_yas' => $request['hasta_yas'],
                'hasta_boy' => $request['hasta_boy']
            ]);

        }
        $hasta->save();
        return redirect()->back();


    }


    public function get_hasta_resimsil ($id)
    {
        /*$resimid=Hasta::find($id);
        $gorsel=Hasta::where('hasta_ad',$resimid->hasta)->get();

        $dosyaismi='indir.png';

        for ($i=0;$i<count($gorsel);$i++) {
            $gorsel[$i]->update([
                'resim' => "gallery/" . $dosyaismi
            ]);
        }
        return redirect()->back();*/

    }

    public function get_egzersizplan (Request $request)
    {
        /*if (isset($_GET['haftalik_tekrar']) || isset($_GET['gunluk_tekrar']) ){
            $haftalik_tekrar=$_GET['haftalik_tekrar'];
            $gunluk_tekrar=$_GET['gunluk_tekrar'];
        }else{
            $haftalik_tekrar = $request['haftalik_tekrar'];
            $gunluk_tekrar = $request['gunluk_tekrar'];

        }

        if (isset($_GET['set_tekrar']) || isset($_GET['tekrar_tekrar']) || isset($_GET['dinlenme_tekrar'])){
            $settekrar=$_GET['set_tekrar'];
            $tekrartekrar=$_GET['tekrar_tekrar'];
            $dinlenmetekrar=$_GET['dinlenme_tekrar'];
        }else{
            $settekrar = $request['set_tekrar'];
            $tekrartekrar = $request['tekrar_tekrar'];
            $dinlenmetekrar = $request['dinlenme_tekrar'];

        }*/

        $haftalik_tekrar = $request['haftalik_tekrar'];
        $gunluk_tekrar = $request['gunluk_tekrar'];

        $settekrar = $request['set_tekrar'];
        $tekrartekrar = $request['tekrar_tekrar'];
        $dinlenmetekrar = $request['dinlenme_tekrar'];


        $egzersizler_sayi = Egzersiz::all()->groupBy('egzersiz_isim');

        $kategoriler = Egzersizkategori::where('kategori_ust', 0)->where('aktif', 1)->get();

        $egzersiz_kategorileri = [];
        foreach ($kategoriler as $kategori) {

            array_push($egzersiz_kategorileri, $kategori->kategori_ad);

        }


        $egzersiz_kategorileri_id = [];
        $i = 0;
        foreach ($kategoriler as $kategori) {
            $idler = Egzersizkategori::where('kategori_ad', $egzersiz_kategorileri[$i])->where('aktif', 1)->first();
            array_push($egzersiz_kategorileri_id, $idler->id);
            $i++;

        }

        if (auth()->user()->yetki == 1) {
            $hastalar = Hastalar::where('aktif', 1)->get();
        } else {
            $hastalar = Hastalar::where('aktif', 1)->where('kurum_id', auth()->user()->kurum_id)->get();
        }


        if (auth()->user()->yetki == 1) {
            $planlar = Hazirplanlar::where('aktif', 1)->get()->groupBy('plan_ismi');
        } else {
            $planlar = Hazirplanlar::where('aktif', 1)->where('kurum_id', auth()->user()->kurum_id)->get()->groupBy('plan_ismi');
        }


        if (session()->has('setler')) {

            $id = session()->get('setler');

        }

        return view('backend.hrktplanolustur', compact('egzersizler_sayi', 'hastalar', 'planlar', 'kategoriler', 'egzersiz_kategorileri_id', 'id', 'haftalik_tekrar', 'gunluk_tekrar','settekrar','dinlenmetekrar','tekrartekrar'));
    }


    public function get_hazir_egzersizplan (Request $request)
    {

        $gunluk_tekrar = $request['gunluk_tekrar'];
        $haftalik_tekrar = $request['haftalik_tekrar'];
        $dinlenmetekrar = $request['set_tekrar'];
        $tekrartekrar = $request['tekrar_tekrar'];
        $settekrar = $request['dinlenme_tekrar'];

        $egzersizler_sayi = Egzersiz::all()->groupBy('egzersiz_isim');

        $kategoriler = Egzersizkategori::where('kategori_ust', 0)->where('aktif', 1)->get();

        $egzersiz_kategorileri = [];
        foreach ($kategoriler as $kategori) {

            array_push($egzersiz_kategorileri, $kategori->kategori_ad);

        }


        $egzersiz_kategorileri_id = [];
        $i = 0;
        foreach ($kategoriler as $kategori) {
            $idler = Egzersizkategori::where('kategori_ad', $egzersiz_kategorileri[$i])->where('aktif', 1)->first();
            array_push($egzersiz_kategorileri_id, $idler->id);
            $i++;

        }


        if (session()->has('setler')) {

            $id = session()->get('setler');

        }

        return view('backend.hazirhrkt_planiolustur', compact('egzersizler_sayi', 'kategoriler', 'egzersiz_kategorileri_id', 'id', 'gunluk_tekrar', 'haftalik_tekrar','settekrar','dinlenmetekrar','tekrartekrar'));

    }


    public function get_session_plan_iptalet ()
    {
        Session::forget('setler');

        return redirect('/egzersizplan');
    }

    public function post_egzersizplan (Request $request)
    {


        $zaman = Carbon::now();
        if (!$request['combobox']) {
            return redirect('/egzersizplan')->withErrors(['message' => 'Lütfen hasta İsmi seçiniz']);
        }

        if (session()->get('setler') != null) {
            Session::forget('setler');
        }


        $egzersizler = Egzersiz::all()->groupBy('egzersiz_isim');
        //egzersız isimlerinin adını almak ıcın
        $keydizi = [];
        foreach (array_keys($egzersizler->toArray()) as $key) {

            array_push($keydizi, $key);
        }


        $ekleyen = auth()->user()->id;


        $data['ekleyen_id'] = $ekleyen;
        $data['eklenme_zamani'] = $zaman->toDateString('H:i:s', 1375057836);
        $data['hasta_id'] = $request['combobox'];

        $data['baslangic_tarihi'] = $request['baslangic_tarihi'];
        $data['bitis_tarihi'] = $request['bitis_tarihi'];
        $data['program_adi'] = $request['program_adi'];

        for ($i = 1; $i <= count($egzersizler); $i++) {

            if ($request['set-' . $i] == 0) {

            } else {


                $data['egzersiz-' . $i] = $request['egzersiz-' . $i];
                $data['set-' . $i] = $request['set-' . $i];
                $data['tekrar-' . $i] = $request['tekrar-' . $i];
                $data['dinlenme-' . $i] = $request['dinlenme-' . $i];
                $data['haftalik_tekrar-' . $i] = $request['haftalik_tekrar-' . $i];
                $data['gunluk_tekrar-' . $i] = $request['gunluk_tekrar-' . $i];
                $data['veri_var'] = "veri_var";

                if (session()->has('setler')) {
                    $s = session()->get('setler');
                    $s[] = $data;

                } else {
                    $s = [$data];

                }
                session()->put('setler', $data);

            }


        }


        if (!isset($data['veri_var'])) {

            return redirect()->back()->withErrors(['message' => 'Hastaya atanmış egzersiz bulunmamaktadır.Lütfen bilgilerinizi kontrol ediniz.']);

            Session::forget('setler');
        }
        session()->put($data);


        if (session()->has('setler')) {

            $id = session()->get('setler');

        }


        $kategoriler = Egzersizkategori::where('kategori_ust', 0)->get();

        $egzersiz_kategorileri = [];
        foreach ($kategoriler as $kategori) {

            array_push($egzersiz_kategorileri, $kategori->kategori_ad);

        }


        $egzersiz_kategorileri_id = [];
        $i = 0;
        foreach ($kategoriler as $kategori) {
            $idler = Egzersizkategori::where('kategori_ad', $egzersiz_kategorileri[$i])->first();
            array_push($egzersiz_kategorileri_id, $idler->id);
            $i++;

        }


        // return ['result'=>"dogru"];

        return view('backend.hareketplan_cizelgesi', compact('id', 'egzersiz_kategorileri_id', 'kategoriler'));

    }


    public function post_hazir_egzersizplan (Request $request)
    {

        $egzersizler = Egzersiz::all()->groupBy('egzersiz_isim');

        $zaman = Carbon::now();

        if (!$request['combobox']) {
            return redirect('/hazir/egzersizplan')->withErrors(['message' => 'Lütfen  plan  ismi giriniz']);
        }

        if (session()->get('setler') != null) {
            Session::forget('setler');
        }


        //egzersız isimlerinin adını almak ıcın
        $keydizi = [];
        foreach (array_keys($egzersizler->toArray()) as $key) {

            array_push($keydizi, $key);
        }


        $ekleyen = auth()->user()->id;
        $data['ekleyen_id'] = $ekleyen;
        $data['eklenme_zamani'] = $zaman->toDateString('H:i:s', 1375057836);
        $data['plan_ismi'] = $request['combobox'];

        for ($i = 1; $i <= count($egzersizler); $i++) {

            if ($request['set-' . $i] == 0) {

            } else {
                $data['egzersiz-' . $i] = $request['egzersiz-' . $i];
                $data['set-' . $i] = $request['set-' . $i];
                $data['tekrar-' . $i] = $request['tekrar-' . $i];
                $data['dinlenme-' . $i] = $request['dinlenme-' . $i];
                $data['haftalik_tekrar-' . $i] = $request['haftalik_tekrar-' . $i];
                $data['gunluk_tekrar-' . $i] = $request['gunluk_tekrar-' . $i];
                $data['veri_var'] = "veri_var";

                if (session()->has('setler')) {
                    $s = session()->get('setler');
                    $s[] = $data;

                } else {
                    $s = [$data];

                }
                session()->put('setler', $data);

            }


        }


        if (!isset($data['veri_var'])) {
            return redirect()->back()->withErrors(['message' => 'Hastaya atamak için herhangi bir egzersiz şeçilmemiştir.Lütfen bilgilerinizi kontrol ediniz']);

            Session::forget('setler');
        }
        session()->put($data);


        if (session()->has('setler')) {

            $id = session()->get('setler');

        }


        $kategoriler = Egzersizkategori::where('kategori_ust', 0)->where('aktif', 1)->get();

        $egzersiz_kategorileri = [];
        foreach ($kategoriler as $kategori) {

            array_push($egzersiz_kategorileri, $kategori->kategori_ad);

        }


        $egzersiz_kategorileri_id = [];
        $i = 0;
        foreach ($kategoriler as $kategori) {
            $idler = Egzersizkategori::where('kategori_ad', $egzersiz_kategorileri[$i])->where('aktif', 1)->first();
            array_push($egzersiz_kategorileri_id, $idler->id);
            $i++;

        }


        // return ['result'=>"dogru"];

        return view('backend.hazir_hareketplan_cizelgesi', compact('id', 'egzersiz_kategorileri_id', 'kategoriler'));

    }

    public function post_hazir_egzersizplan_guncelle (Request $request, $id)
    {

        $zaman = Carbon::now();

        $plan_id = Hazirplanlar::find($id);

        if (auth()->user()->yetki == 1) {
            $setim = Hazirplanlar::where('plan_ismi', $plan_id->plan_ismi)
                ->where('aktif', 1)
                ->get();
        } else {
            $setim = Hazirplanlar::where('plan_ismi', $plan_id->plan_ismi)
                ->where('aktif', 1)
                ->where('kurum_id', auth()->user()->kurum_id)
                ->get();
        }


        for ($i = 0; $i < count($setim); $i++) {

            $setim[$i]->update([
                'aktif' => 0,
                'silinme_tarihi' => $zaman
            ]);
            $setim[$i]->save();
        }


        if (session()->get('setler') != null) {
            Session::forget('setler');
        }


        if (!$request['combobox']) {
            return redirect('/egzersizplan')->withErrors(['message' => 'Lütfen plan İsmi giriniz']);
        }
        $egzersizler = Egzersiz::all()->groupBy('egzersiz_isim');
        //egzersız isimlerinin adını almak ıcın
        $keydizi = [];
        foreach (array_keys($egzersizler->toArray()) as $key) {

            array_push($keydizi, $key);
        }


        $ekleyen = auth()->user()->id;


        $data['ekleyen_id'] = $ekleyen;
        $data['eklenme_zamani'] = $zaman->toDateString('H:i:s', 1375057836);
        $data['plan_ismi'] = $request['combobox'];

        for ($i = 1; $i <= count($egzersizler); $i++) {

            if ($request['set-' . $i] == 0) {

            } else {


                $data['egzersiz-' . $i] = $request['egzersiz-' . $i];
                $data['set-' . $i] = $request['set-' . $i];
                $data['tekrar-' . $i] = $request['tekrar-' . $i];
                $data['dinlenme-' . $i] = $request['dinlenme-' . $i];
                $data['haftalik_tekrar-' . $i] = $request['haftalik_tekrar-' . $i];
                $data['gunluk_tekrar-' . $i] = $request['gunluk_tekrar-' . $i];

                if (session()->has('setler')) {
                    $s = session()->get('setler');
                    $s[] = $data;

                } else {
                    $s = [$data];

                }
                session()->put('setler', $data);

            }


        }
        session()->put($data);


        if (session()->has('setler')) {

            $id = session()->get('setler');

        }


        $kategoriler = Egzersizkategori::where('kategori_ust', 0)->where('aktif', 1)->get();

        $egzersiz_kategorileri = [];
        foreach ($kategoriler as $kategori) {

            array_push($egzersiz_kategorileri, $kategori->kategori_ad);

        }


        $egzersiz_kategorileri_id = [];
        $i = 0;
        foreach ($kategoriler as $kategori) {
            $idler = Egzersizkategori::where('kategori_ad', $egzersiz_kategorileri[$i])->where('aktif', 1)->first();
            array_push($egzersiz_kategorileri_id, $idler->id);
            $i++;

        }


        // return ['result'=>"dogru"];
        return view('backend.hazir_hareketplan_cizelgesi', compact('id', 'egzersiz_kategorileri_id', 'kategoriler'));

    }

//$sayi
    public function post_egzersizplan_guncelleme (Request $request, $sayi, $hasta_id)
    {


        $zaman = Carbon::now();


        $setim = Setler::where('hasta_id', $hasta_id)
            ->where('plan_sayisi', $sayi)
            ->where('aktif', 1)
            ->get();
        Setyorum::where('hasta_id', $hasta_id)
            ->where('plan_sayisi', $sayi)
            ->where('aktif', 1)
            ->delete();
        for ($i = 0; $i < count($setim); $i++) {

            $setim[$i]->update([
                'aktif' => 0,
                'silinme_tarihi' => $zaman
            ]);
            $setim[$i]->save();
        }


        if (session()->get('setler') != null) {
            Session::forget('setler');
        }


        if (!$request['combobox']) {
            return redirect('/egzersizplan')->withErrors(['message' => 'Lütfen hasta İsmi seçiniz']);
        }
        $egzersizler = Egzersiz::all()->groupBy('egzersiz_isim');
        //egzersız isimlerinin adını almak ıcın
        $keydizi = [];
        foreach (array_keys($egzersizler->toArray()) as $key) {

            array_push($keydizi, $key);
        }


        $ekleyen = auth()->user()->id;


        $data['set_sirasi'] = $sayi;
        $data['ekleyen_id'] = $ekleyen;
        $data['eklenme_zamani'] = $zaman->toDateString('H:i:s', 1375057836);
        $data['hasta_id'] = $request['combobox'];

        $data['baslangic_tarihi'] = $request['baslangic_tarihi'];
        $data['bitis_tarihi'] = $request['bitis_tarihi'];
        $data['program_adi'] = $request['program_adi'];

        for ($i = 1; $i <= count($egzersizler); $i++) {

            if ($request['set-' . $i] == 0) {

            } else {


                $data['egzersiz-' . $i] = $request['egzersiz-' . $i];
                $data['set-' . $i] = $request['set-' . $i];
                $data['tekrar-' . $i] = $request['tekrar-' . $i];
                $data['dinlenme-' . $i] = $request['dinlenme-' . $i];
                $data['gunluk_tekrar-' . $i] = $request['gunluk_tekrar-' . $i];
                $data['haftalik_tekrar-' . $i] = $request['haftalik_tekrar-' . $i];

                if (session()->has('setler')) {
                    $s = session()->get('setler');
                    $s[] = $data;

                } else {
                    $s = [$data];

                }
                session()->put('setler', $data);

            }


        }
        session()->put($data);


        if (session()->has('setler')) {

            $id = session()->get('setler');

        }


        $kategoriler = Egzersizkategori::where('kategori_ust', 0)->get();

        $egzersiz_kategorileri = [];
        foreach ($kategoriler as $kategori) {

            array_push($egzersiz_kategorileri, $kategori->kategori_ad);

        }


        $egzersiz_kategorileri_id = [];
        $i = 0;
        foreach ($kategoriler as $kategori) {
            $idler = Egzersizkategori::where('kategori_ad', $egzersiz_kategorileri[$i])->first();
            array_push($egzersiz_kategorileri_id, $idler->id);
            $i++;

        }


       // print_r($id);
       // print_r($egzersiz_kategorileri_id);
        //die();



        // return ['result'=>"dogru"];

        return view('backend.hareketplan_cizelgesi', compact('id', 'egzersiz_kategorileri_id', 'kategoriler'));

    }

    public function get_hareketplan ()
    {


        $hareketler = Hareketolustur::where('aktif', 1)->get();

        return view('backend.olusturulanharektplan', compact('hareketler'));
    }


    public function get_egzersiz ()
    {

        $egzersiz = Egzersiz::where('id', 6)->first();
        $hareketler = Hareketolustur::where('aktif', 1)->get();

        return view('backend.egzersiz', compact('hareketler', 'egzersiz'));
    }


    public function post_egzersiz (Request $request)
    {

        $baslik = $request['baslik'];

        if (Auth::check()) {
            $ekleyenid = auth()->user()->id;

        }

        $resim = $request['resim'];
        if (isset($resim)) {
            $file = $_FILES['resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));
        } else {
            $dosyaismi = 'indir.png';
        }


        $resim_iki = $request['resim_iki'];
        if (isset($resim_iki)) {
            $file = $_FILES['resim_iki'];
            $dosyaismiiki = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismiiki));
        } else {
            $dosyaismiiki = 'indir.png';
        }


        $video = $request['video'];
        if (isset($video)) {
            $file = $_FILES['video'];
            $dosyavideoismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            move_uploaded_file($tmp_name, "gallery/" . utf8_encode($dosyavideoismi));
            //copy($tmp_name, "gallery/" . utf8_encode($dosyavideoismi));
        } else {
            $dosyavideoismi = 'indir.png';
        }


        for ($i = 0; $i < count($baslik); $i++) {


            Egzersiz::create([
                'resim' => "gallery/" . $dosyaismi,
                'resim_iki' => "gallery/" . $dosyaismiiki,
                'video' => "gallery/" . $dosyavideoismi,
                'egzersiz_isim' => $request['egzersiz_isim'],
                'aciklama' => $request['aciklama'],
                'egzersiz_kategori' => $request['egzersiz_kategori'],
                'egzersiz_hareket' => $baslik[$i],
                'ekleyen_id' => $ekleyenid

            ]);
        }


        return redirect('/egzersizliste');
    }


    public function get_egzersizliste (Request $request)
    {

        $aranan = $request['arama'];

        $egzersizarama = Egzersiz::where('aktif', '=', 1)
            ->where('egzersiz_isim', 'like', "%$aranan%")
            ->get();


        $egzersizler = Egzersiz::where('aktif', '=', 1)->get()->groupBy('egzersiz_isim');


        return view('backend.egzersizliste', compact('egzersizler', 'egzersizarama'));

    }


    public function get_egzersizliste_sil (Request $request)
    {

        $now = Carbon::now();
        $egzersiz_id = Egzersiz::find($request['id']);
        $egzersiz_isim = $egzersiz_id->egzersiz_isim;

        $egzersizler = Egzersiz::where('egzersiz_isim', $egzersiz_isim)->get();

        foreach ($egzersizler as $egzersiz) {
            $egzersiz->update([
                'aktif' => 0,
                'silme_tarihi' => $now
            ]);

            $egzersiz->save();
        }


        return redirect()->back();


    }


    public function get_egzersiz_resimsil (Request $request, $id)
    {

        $resimid = Egzersiz::find($id);
        $gorsel = Egzersiz::where('egzersiz_isim', $resimid->egzersiz_isim)->get();


        $dosyaismi = 'indir.png';

        for ($i = 0; $i < count($gorsel); $i++) {
            $gorsel[$i]->update([
                'resim' => "gallery/" . $dosyaismi
            ]);
        }
        return redirect()->back();

    }


    public function get_egzersiz_videosil (Request $request, $id)
    {

        $videoid = Egzersiz::find($id);
        $gorsel = Egzersiz::where('egzersiz_isim', $videoid->egzersiz_isim)->get();


        $dosyaismi = 'indir.png';

        for ($i = 0; $i < count($gorsel); $i++) {
            $gorsel[$i]->update([
                'video' => null
            ]);
        }
        return redirect()->back();

    }


    public function get_egzersizliste_goruntule ($id)
    {

        $egzersiz = Egzersiz::find($id);

        $hareketler = Hareketolustur::where('aktif', 1)->get();


        return view('backend.egzersizgoruntule', compact('egzersiz', 'hareketler'));
    }


    public function post_egzersizliste_guncelle (Request $request)
    {

        $kategori = Egzersiz::find($request['id']);

        $eski = Egzersiz::where('egzersiz_isim', $kategori->egzersiz_isim)->where('aktif', 1)->first();
        $eskiresim = $eski->resim;
        $eskiresim_iki = $eski->resim_iki;
        $eskivideo = $eski->video;


        Egzersiz::where('egzersiz_isim', $kategori->egzersiz_isim)->delete();

        $baslik = $request['baslik'];


        if (Auth::check()) {
            $id = auth()->user()->id;
        }


        $r = $request['resim'];
        $r2 = $request['resim_iki'];
        $v = $request['video'];

        if ($r == null && $v == null) {


            for ($i = 0; $i < count($request['baslik']); $i++) {

                Egzersiz::create([
                    'ekleyen_id' => $id,
                    'egzersiz_isim' => $request['egzersiz_isim'],
                    'aciklama' => $request['aciklama'],
                    'egzersiz_kategori' => $request['egzersiz_kategori'],
                    'egzersiz_hareket' => $baslik[$i],
                    'resim' => $eskiresim,
                    'resim_iki' => $eskiresim_iki,
                    'video' => $eskivideo

                ]);
            }
        } elseif ($r && $r2 && $v == null) {


            $file = $_FILES['resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));

            $file = $_FILES['resim_iki'];
            $dosyaismiiki = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismiiki));


            for ($i = 0; $i < count($request['baslik']); $i++) {

                Egzersiz::create([
                    'ekleyen_id' => $id,
                    'egzersiz_isim' => $request['egzersiz_isim'],
                    'aciklama' => $request['aciklama'],
                    'egzersiz_kategori' => $request['egzersiz_kategori'],
                    'egzersiz_hareket' => $baslik[$i],
                    'resim' => "gallery/" . $dosyaismi,
                    'resim_iki' => "gallery/" . $dosyaismiiki,
                    'video' => $eskivideo
                ]);
            }

        } elseif ($v && $r == null) {

            $file = $_FILES['video'];
            $dosyavideoismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            move_uploaded_file($tmp_name, "gallery/" . utf8_encode($dosyavideoismi));


            for ($i = 0; $i < count($request['baslik']); $i++) {

                Egzersiz::create([
                    'ekleyen_id' => $id,
                    'egzersiz_isim' => $request['egzersiz_isim'],
                    'aciklama' => $request['aciklama'],
                    'egzersiz_kategori' => $request['egzersiz_kategori'],
                    'egzersiz_hareket' => $baslik[$i],
                    'resim' => $eskiresim,
                    'video' => "gallery/" . $dosyavideoismi
                ]);
            }

        } else {

            $file = $_FILES['resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));

            $file = $_FILES['resim_iki'];
            $dosyaismiiki = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismiiki));

            $file = $_FILES['video'];
            $dosyavideoismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            move_uploaded_file($tmp_name, "gallery/" . utf8_encode($dosyavideoismi));

            for ($i = 0; $i < count($request['baslik']); $i++) {

                Egzersiz::create([
                    'ekleyen_id' => $id,
                    'egzersiz_isim' => $request['egzersiz_isim'],
                    'aciklama' => $request['aciklama'],
                    'egzersiz_kategori' => $request['egzersiz_kategori'],
                    'egzersiz_hareket' => $baslik[$i],
                    'resim' => "gallery/" . $dosyaismi,
                    'resim_iki' => "gallery/" . $dosyaismiiki,
                    'video' => "gallery/" . $dosyavideoismi
                ]);
            }

        }

        return redirect('/egzersizliste');

    }


    public function get_egzersizkategori ()
    {


        return view('backend.egzersizkategori');


    }


    public function post_egzersizkategori (Request $request)
    {
        $tarih=Carbon::now();
        $resim = $request['resim'];
        if (isset($resim)) {
            $file = $_FILES['resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));
        } else {
            $dosyaismi = 'indir.png';
        }

        // $request->all(),
        Egzersizkategori::create([
            'kategori_ad'=>$request['kategori_ad'],
            'kategori_ust'=>$request['kategori_ust'],
            'resim' => "gallery/" . $dosyaismi,
            'aktif'=>1,
            'created_at'=>$tarih
        ]);


        return redirect('/egzersizkategoriliste');


    }


    public function get_egzersizkategoriliste (Request $request)
    {

        $aranan = $request['arama'];

        $kategoriarama = Egzersizkategori::where('aktif', '=', 1)
            ->where('kategori_ad', 'like', "%$aranan%")
            ->get();

        $kategoriler = Egzersizkategori::where('aktif', '=', 1)->get();

        return view('backend.egzersizkategorilistesi', compact('kategoriler', 'kategoriarama'));
    }


    public function get_egzersizkategoriliste_sil (Request $request)
    {

        $now = Carbon::now();
        $kategori = Egzersizkategori::find($request['id']);
        $kategoriid = $kategori->id;

        $kategoriparent = $kategori->kategori_ust;
        $kategoriparentvar = Egzersizkategori::where('id', '=', $kategoriparent)->where('aktif', '=', 1)->first();
        $kategorichildvar = Egzersizkategori::where('kategori_ust', '=', $request['id'])->where('aktif', '=', 1)->first();


        /*$hareketvar=Hastaliklar::where('hastalik_kategori','=',$kategoriid)->where('aktif','=',1)->first();

        if ($hareketvar){

            return redirect()->back()->withErrors(['message'=>'Bu kategori hastaliklara atanmıştır.Oluşturulan hastaliklarınızı lütfen kontrol ediniz']);

        }*/

        if ($kategoriparentvar || $kategorichildvar) {

            return redirect()->back()->withErrors(['message' => 'Bu kategori diğer kategoriler ile ilişkilendirilmiştir.']);

        } else {

            $kategori->update([
                'aktif' => 0,
                'silme_tarihi' => $now
            ]);

            $kategori->save();

            return redirect()->back();

        }

    }


    public function get_egzersizkategoriliste_goruntule ($id)
    {

        $kategori = Egzersizkategori::find($id);

        return view('backend.egzersizkategorigoruntule', compact('kategori'));
    }


    public function post_egzersizkategoriliste_guncelle (Request $request)
    {

        $id = $request['id'];

        $resim = $request['resim'];
        if (isset($resim)) {
            $file = $_FILES['resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));
        } else {
            $dosyaismi = 'indir.png';
        }



        $kategori = Egzersizkategori::find($id);


        if (isset($resim)){
            $kategori->update([
                'resim' => 'gallery/'.$dosyaismi,
            ]);
        }

        if ($request['kategori_ust'] == 0) {

            $kategori->update([

                'kategori_ad' => $request['kategori_ad'],
                'kategori_ust' => 0,

            ]);


        } else {

            $kategoriid = Egzersizkategori::where('id', $request['kategori_ust'])->first();

            $kategori->update([

                'kategori_ad' => $request['kategori_ad'],
                'kategori_ust' => $kategoriid->id,

            ]);
        }


        $kategori->save();

        return redirect('/egzersizkategoriliste');


    }


    public function get_kategoriler ()
    {


        return view('backend.kategori');


    }

    public function post_kategoriler (Request $request)
    {


        Kategoriler::create($request->all());


        return redirect('/hastalikkategoriliste');


    }


    public function get_kategorilerliste (Request $request)
    {

        $aranan = $request['arama'];

        $kategoriarama = Kategoriler::where('aktif', '=', 1)
            ->where('kategori_ad', 'like', "%$aranan%")
            ->get();

        $kategoriler = Kategoriler::where('aktif', '=', 1)->get();

        return view('backend.kategoriliste', compact('kategoriler', 'kategoriarama'));
    }


    public function get_kategoriliste_sil (Request $request)
    {

        $now = Carbon::now();
        $kategori = Kategoriler::find($request['id']);
        $kategoriid = $kategori->id;

        $kategoriparent = $kategori->kategori_ust;
        $kategoriparentvar = Kategoriler::where('id', '=', $kategoriparent)->where('aktif', '=', 1)->first();
        $kategorichildvar = Kategoriler::where('kategori_ust', '=', $request['id'])->where('aktif', '=', 1)->first();


        $hareketvar = Hastaliklar::where('hastalik_kategori', '=', $kategoriid)->where('aktif', '=', 1)->first();

        if ($hareketvar) {

            return redirect()->back()->withErrors(['message' => 'Bu kategori hastaliklara atanmıştır.Oluşturulan hastaliklarınızı lütfen kontrol ediniz']);

        } elseif ($kategoriparentvar || $kategorichildvar) {

            return redirect()->back()->withErrors(['message' => 'Bu kategori diger kategoriler ile ilişkendirilmiştir.']);

        } else {

            $kategori->update([
                'aktif' => 0,
                'silme_tarihi' => $now
            ]);

            $kategori->save();

            return redirect()->back();
        }

    }


    public function get_kategoriliste_goruntule ($id)
    {

        $kategori = Kategoriler::find($id);

        return view('backend.kategorigoruntule', compact('kategori'));
    }


    public function post_kategoriliste_guncelle (Request $request)
    {

        $id = $request['id'];

        $kategori = Kategoriler::find($id);

        if ($request['kategori_ust'] == 0) {

            $kategori->update([

                'kategori_ad' => $request['kategori_ad'],
                'kategori_ust' => 0,

            ]);


        } else {

            $kategoriid = Kategoriler::where('id', $request['kategori_ust'])->first();

            $kategori->update([

                'kategori_ad' => $request['kategori_ad'],
                'kategori_ust' => $kategoriid->id,

            ]);
        }

        $kategori->save();

        return redirect('/hastalikkategoriliste');


    }


    public function get_giris ()
    {


        if (Auth::check()) {
            return redirect('/anasayfa');
        } else {
            return view('backend.login');
        }


    }

    public function post_bolgelerliste_guncelle (Request $request)
    {

        $id = $request['id'];

        $bolge = Bolgeler::find($id);

        $a = $request['resim'];
        if ($a) {

            $file = $_FILES['resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));

            $bolge->update([
                'resim' => "gallery/" . $dosyaismi,
                'isim' => $request['isim'],
                'ozellikleri' => $request['ozellikleri']
            ]);

        } else {

            $bolge->update([
                'isim' => $request['isim'],
                'ozellikleri' => $request['ozellikleri']
            ]);
        }


        $bolge->save();

        return redirect('/bolgelerliste');


    }


    public function get_bolgelerliste_goruntule ($id)
    {

        $bolge = Bolgeler::find($id);

        return view('backend.bolgelergoruntule', compact('bolge'));
    }

    public function get_bolgelerliste_sil (Request $request)
    {

        $now = Carbon::now();
        $bolge = Bolgeler::find($request['id']);
        $bolgeid = $bolge->id;

        $hareketvar = Hareketolustur::where('bolge', '=', $bolgeid)->active()->first();

        if ($hareketvar != null) {

            return redirect()->back()->withErrors(['message' => 'Bu bölgeye ait hareketoluşturulmuş.Oluşturulan hareketlerinizi lütfen kontrol ediniz']);

        } else {

            $bolge->update([
                'aktif' => 0,
                'silinme_tarihi' => $now
            ]);

            $bolge->save();

            return redirect()->back();
        }


        /* try{

             $now= Carbon::now();
             $bolge=Bolgeler::where('aktif',1)->where('id',$request->id)->first();

             $bolge->update([
                 'aktif'=>0,
                 'silinme_tarihi'=>$now
             ]);

           //  return ['result'=>"dogru"];
             return response(['durum'=>'success','baslik'=>'Başarili','icerik'=>'Silme İşlemi Başarili']);


         }
         catch (Exception $e){

             return response(['durum'=>'error','baslik'=>'Hatalı','icerik'=>'Silme İşlemi Hatalı','hata'=>$e]);
         }*/


    }


    public function get_eklemlerliste_guncelle (Request $request)
    {

        $id = $request['id'];

        $eklem = Eklemler::find($id);

        $a = $request['resim'];

        if ($a) {

            $file = $_FILES['resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));

            $eklem->update([
                'resim' => "gallery/" . $dosyaismi,
                'isim' => $request['isim'],
                'ozellikleri' => $request['ozellikleri'],

            ]);

        } else {

            $eklem->update([
                'isim' => $request['isim'],
                'ozellikleri' => $request['ozellikleri']

            ]);
        }


        $eklem->save();

        return redirect('/eklemlerliste');


    }


    public function get_eklemlerliste_goruntule ($id)
    {

        $eklem = Eklemler::find($id);

        return view('backend.eklemlergoruntule', compact('eklem'));
    }


    public function get_eklemlerliste_sil (Request $request)
    {

        $now = Carbon::now();

        $eklem = Eklemler::find($request['id']);

        $eklemid = $eklem->id;

        $eklemvar = Hareketolustur::where('eklem', '=', $eklemid)->where('aktif', '=', 1)->first();

        if ($eklemvar) {

            return redirect()->back()->withErrors(['message' => 'Bu eklem türüne ait hareketoluşturulmuş.Oluşturulan hareketlerinizi lütfen kontrol ediniz']);

        } else {

            $eklem->update([
                'aktif' => 0,
                'silinme_tarihi' => $now
            ]);

            $eklem->save();

            return redirect()->back();
        }

    }

    public function get_eklemlerliste (Request $request)
    {


        $aranan = $request['arama'];

        $eklemarama = Eklemler::where('aktif', '=', 1)
            ->where('isim', 'like', "%$aranan%")
            ->get();

        $eklemler = Eklemler::where('aktif', '=', 1)->get();

        return view('backend.eklemlerliste', compact('eklemler', 'eklemarama'));

    }

    public function get_bolgelerliste (Request $request)
    {

        $aranan = $request['arama'];

        $bolgearama = Bolgeler::where('aktif', '=', 1)
            ->where('isim', 'like', "%$aranan%")
            ->get();
        $bolgeler = Bolgeler::active()->get();

        return view('backend.bolgelerliste', compact('bolgeler', 'bolgearama'));
    }

    public function get_hareketolustur ()
    {

        $bolgeler = Bolgeler::where('aktif', '=', 1)->get();

        $hareketler = Hareketturu::where('aktif', '=', 1)->get();

        $eklemler = Eklemler::where('aktif', '=', 1)->get();


        return view('backend.hareketolustur', compact('bolgeler', 'eklemler', 'hareketler'));
    }

    public function post_hareketolustur (Request $request)
    {


        if ($request['baslik'] == null && $request['bolge'] == null && $request['hareket'] == null && $request['eklem'] == null) {

            return redirect()->back()->withErrors(['message' => 'Lütfen zorunlu alanları doldurunuz']);

        }
        $isnumeric1 = is_numeric($request['Aaos']);
        $isnumeric2 = is_numeric($request['Ama']);
        $isnumeric3 = is_numeric($request['KendalMcreacy']);


        if (strpos($request['Aaos'], ',') || strpos($request['Ama'], ',') || strpos($request['KendalMcreacy'], ',')) {

            return redirect()->back()->withErrors(['message' => 'Girdiğiniz Standart değerlerinin double değer olup olmadığını kontrol ediniz']);
        }

        if (Auth::check()) {
            $ekleyenid = auth()->user()->id;

        }

        $a = $request['resim'];

        if (isset($a)) {

            $file = $_FILES['resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));

        } else {

            $dosyaismi = 'indir.png';
        }


        $bolge = $request['bolge'];
        $eklem = $request['eklem'];
        $hareket = $request['hareket'];
        $Aaos = $request['Aaos'];
        $Ama = $request['Ama'];
        $KendalMcreacy = $request['KendalMcreacy'];


        Hareketolustur::create([
            'resim' => "gallery/" . $dosyaismi,
            'baslik' => $request['baslik'],
            'ekleyen_id' => $ekleyenid,
            'bolge' => $bolge,
            'eklem' => $eklem,
            'hareket' => $hareket,
            'ozellikleri' => $request['ozellikleri'],
            'Aaos' => $Aaos,
            'Ama' => $Ama,
            'KendalMcreacy' => $KendalMcreacy
        ]);

        return redirect('/hareketolusturliste');

    }

    public function get_hareketolusturliste (Request $request)
    {


        $aranan = $request['arama'];

        $hareketolusturarama = Hareketolustur::where('aktif', '=', 1)
            ->where('baslik', 'like', "%$aranan%")
            ->get();

        $hareketler = Hareketolustur::where('aktif', '=', 1)->get();

        return view('backend.hareketolusturliste', compact('hareketler', 'hareketolusturarama'));
    }


    public function get_hareketolusturliste_sil (Request $request)
    {

        $now = Carbon::now();

        $hareketler = Hareketolustur::find($request['id']);

        $hareketler->update([
            'aktif' => 0,
            'silme_tarihi' => $now
        ]);
        $hareketler->save();

        return redirect()->back();

    }


    public function get_hareketolusturliste_goruntule ($id)
    {

        $hareketolustur = Hareketolustur::find($id);

        $bolgeler = Bolgeler::all();

        $hareketler = Hareketturu::all();

        $eklemler = Eklemler::all();

        return view('backend.hareketolusturgoruntule', compact('hareketolustur', 'bolgeler', 'hareketler', 'eklemler'));
    }


    public function post_hareketolusturliste_guncelle (Request $request)
    {

        $isnumeric1 = is_numeric($request['Aaos']);
        $isnumeric2 = is_numeric($request['Ama']);
        $isnumeric3 = is_numeric($request['KendalMcreacy']);

        if (strpos($request['Aaos'], ',') || strpos($request['Ama'], ',') || strpos($request['KendalMcreacy'], ',')) {

            return redirect()->back()->withErrors(['message' => 'Girdiğiniz Standart değerlerinin double değer olup olmadığını kontrol ediniz']);

        }

        $id = $request['id'];

        $hareket = Hareketolustur::find($id);

        $a = $request['resim'];
        if ($a) {
            $file = $_FILES['resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));

            $hareket->update([

                'resim' => "gallery/" . $dosyaismi,
                'baslik' => $request['baslik'],
                'isim' => $request['isim'],
                'bolge' => $request['bolge'],
                'eklem' => $request['eklem'],
                'hareket' => $request['hareket'],
                'ozellikleri' => $request['ozellikleri'],
                'Aaos' => $request['Aaos'],
                'Ama' => $request['Ama'],
                'KendalMcreacy' => $request['KendalMcreacy']

            ]);

        } else {

            $hareket->update([
                'baslik' => $request['baslik'],
                'isim' => $request['isim'],
                'bolge' => $request['bolge'],
                'eklem' => $request['eklem'],
                'hareket' => $request['hareket'],
                'ozellikleri' => $request['ozellikleri'],
                'Aaos' => $request['Aaos'],
                'Ama' => $request['Ama'],
                'KendalMcreacy' => $request['KendalMcreacy']

            ]);

        }


        $hareket->save();

        return redirect('/hareketolusturliste');

    }


    public function get_hareketturu ()
    {
        return view('backend.hareketturu');
    }

    public function post_hareketturu (Request $request)
    {


        $var = Hareketturu::where('isim', $request['isim'])
            ->where('aktif', 1)
            ->first();
        if ($var) {

            return redirect()->back()->withErrors(['message' => 'Bu hareketturu isminde veri bulunmaktadır']);

        }


        if (Auth::check()) {
            $ekleyenid = auth()->user()->id;

        }

        Hareketturu::create([
            'ekleyen_id' => $ekleyenid,

            'isim' => $request['isim'],
            'hareketturu' => $request['hareketturu']
        ]);

        return redirect('/hareketturuliste');
    }


    public function get_hareketturuliste ()
    {

        $hareketler = Hareketturu::where('aktif', '=', 1)->get();

        return view('backend.hareketturuliste', compact('hareketler'));
    }


    public function get_hareketolustur_resimsil (Request $request, $id)
    {

        $gorsel = Hareketolustur::find($id);

        $dosyaismi = 'indir.png';

        $gorsel->update([
            'resim' => "gallery/" . $dosyaismi]);

        return redirect()->back();

    }


    public function get_hareketturuliste_sil (Request $request)
    {

        $now = Carbon::now();

        $hareket = Hareketturu::find($request['id']);

        $hareketid = $hareket->id;

        $hareketvar = Hareketolustur::where('hareket', '=', $hareketid)->where('aktif', '=', 1)->first();

        if ($hareketvar) {

            return redirect()->back()->withErrors(['message' => 'Bu hareket türüne  ait hareketoluşturulmuş.Oluşturulan hareketlerinizi lütfen kontrol ediniz']);

        } else {

            $hareket->update([
                'aktif' => 0,
                'silme_tarihi' => $now
            ]);
            $hareket->save();

            return redirect()->back();
        }
    }


    public function get_hareketturuliste_goruntule ($id)
    {

        $hareket = Hareketturu::find($id);

        return view('backend.hareketturugoruntule', compact('hareket'));
    }


    public function post_hareketturuliste_guncelle (Request $request)
    {

        $id = $request['id'];
        $hareketturu = Hareketturu::find($id);
        $hareketturu->update(request()->all());
        $hareketturu->save();

        return redirect('/hareketturuliste');
    }


    public function get_eklemler ()
    {
        return view('backend.eklemler');
    }


    public function get_eklemler_resimsil (Request $request, $id)
    {

        $gorsel = Eklemler::find($id);

        $dosyaismi = 'indir.png';

        $gorsel->update([
                'resim' => "gallery/" . $dosyaismi]
        );

        return redirect()->back();

    }


    public function post_eklemler (Request $request)
    {


        $var = Eklemler::where('isim', $request['isim'])
            ->where('aktif', 1)
            ->first();
        if ($var) {

            return redirect()->back()->withErrors(['message' => 'Bu eklemler isminde veri bulunmaktadır']);

        }


        if (Auth::check()) {
            $ekleyenid = auth()->user()->id;

        }

        $a = $request['resim'];
        if ($a) {

            $file = $_FILES['resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));
        } else {
            $dosyaismi = 'indir.png';
        }
        Eklemler::create([
            'resim' => "gallery/" . $dosyaismi,
            'isim' => $request['isim'],
            'ozellikleri' => $request['ozellikleri'],
            'ekleyen_id' => $ekleyenid

        ]);

        return redirect('/eklemlerliste');
    }


    public function get_bolgeler ()
    {
        return view('backend.bolgeler');
    }


    public function get_bolgeler_resimsil (Request $request, $id)
    {

        $gorsel = Bolgeler::find($id);

        $dosyaismi = 'indir.png';

        $gorsel->update([
            'resim' => "gallery/" . $dosyaismi
        ]);

        return redirect()->back();

    }


    public function post_bolgeler (Request $request)
    {

        // $blog=Bolgeler::create($request->all());

        $var = Bolgeler::where('isim', $request['isim'])
            ->where('aktif', 1)
            ->first();
        if ($var) {

            return redirect()->back()->withErrors(['message' => 'Bu bölgeler isminde veri bulunmaktadır']);

        }
        if (Auth::check()) {
            $ekleyenid = auth()->user()->id;

        }

        $a = $request['resim'];
        if (isset($a)) {
            $file = $_FILES['resim'];
            $dosyaismi = $file['name'];
            $tmp_name = $file['tmp_name'];
            copy($tmp_name, "gallery/" . utf8_encode($dosyaismi));
        } else {
            $dosyaismi = 'indir.png';
        }


        Bolgeler::create([
            'resim' => "gallery/" . $dosyaismi,
            'isim' => $request['isim'],
            'ozellikleri' => $request['ozellikleri'],
            'ekleyen_id' => $ekleyenid

        ]);

        return redirect('/bolgelerliste');
    }


    public function post_kayit (Request $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'yetki' => 1,
            'onay' => 0,
            'password' => bcrypt($data['password']),
        ]);

        /* if($user){
             return response(['durum'=>'success','baslik'=>'Başarılı','icerik'=>'Kayit Başarılı ile yapıldı']);

         }
         else{
             return response(['durum'=>'error','baslik'=>'Hatalı','icerik'=>'Kayit Yapılamadı']);
         }*/

        return redirect('/');

    }

    public function get_kayit ()
    {

        return view('backend.register');
    }


    public function get_anasayfa ()
    {

        $hareketsayi = Hareketolustur::all();
        $eklemlersayi = Eklemler::all();
        $hareketturusayi = Hareketturu::all();
        $hastaliklarsayi = Hastaliklar::all();

        $hareketler = Hareketolustur::where('aktif', 1)->orderBy('baslik', 'desc')->limit(5)->get();

        $eklemler = Eklemler::where('aktif', 1)->orderBy('isim', 'desc')->limit(5)->get();
        $hareketturu = Hareketturu::where('aktif', 1)->orderBy('isim', 'desc')->limit(5)->get();
        $hastaliklar = Hastaliklar::where('aktif', 1)->orderBy('hastalik_isim', 'desc')->limit(5)->get();


        return view('backend.anasayfa', compact('hareketsayi', 'eklemlersayi', 'hareketturusayi', 'hastaliklarsayi', 'hareketler', 'eklemler', 'hareketturu', 'hastaliklar'));
    }

    public function get_hastalik ()
    {

        $hareketler = Hareketolustur::all();

        return view('backend.hastalik', compact('hareketler'));
    }

    public function post_hastalik (Request $request)
    {


        $var = Hastaliklar::where('hastalik_isim', $request['hastalik_isim'])
            ->where('aktif', 1)
            ->first();
        if ($var) {

            return redirect()->back()->withErrors(['message' => 'Bu hastalik isminde veri bulunmaktadır']);

        }

        if (Auth::check()) {
            $ekleyenid = auth()->user()->id;

        }

        Hastaliklar::create([
            'ekleyen_id' => $ekleyenid,
            'hastalik_isim' => $request['hastalik_isim'],
            'hastalik_kategori' => $request['hastalik_kategori']
        ]);


        $hastalik = Hastaliklar::where('hastalik_isim', '=', $request['hastalik_isim'])
            ->where('aktif', 1)
            ->get();
        $hastalik_id = $hastalik[0]->id;


        $hareket = [];
        $hareket = ['baslik' => request('baslik')];

        $hareketler = [];

        for ($i = 0; $i < count($hareket['baslik']); $i++) {

            $hareketler[$i] = Hareketolustur::where('baslik', '=', $hareket['baslik'][$i])
                ->where('aktif', 1)
                ->get();


        }


        for ($i = 0; $i < count($hareket['baslik']); $i++) {
            Hastalik_hareketler::create([
                'hastalik_id' => $hastalik_id,
                'hareket_id' => $hareketler[$i][0]->id,
            ]);
        }


        return redirect('/hastalikliste');

    }

    public function get_hastalikliste (Request $request)
    {

        $aranan = $request['arama'];

        $hastalikarama = Hastaliklar::where('aktif', '=', 1)
            ->where('hastalik_isim', 'like', "%$aranan%")
            ->get();

        $hastaliklar = Hastaliklar::where('aktif', '=', 1)->get();

        return view('backend.hastalikliste', compact('hastaliklar', 'hastalikarama'));

    }

    public function get_hastalikliste_sil (Request $request)
    {


        $now = Carbon::now();

        $hastalik = Hastaliklar::find($request['id']);

        $hastalik->update([
            'aktif' => 0,
            'silme_tarihi' => $now
        ]);

        $hastalik->save();

        Hastalik_hareketler::where('hastalik_id', $request['id'])->delete();

        return redirect()->back();

    }

    public function get_hastalikliste_goruntule ($id)
    {
        $hastalik = Hastaliklar::find($id);
        $hareketler = Hareketolustur::all();
        $hastalikhareket = Hastalik_hareketler::where('hastalik_id', $id)->get();

        return view('backend.hastalikgoruntule', compact('hastalik', 'hareketler', 'hastalikhareket'));

    }

    public function post_hastalikliste_guncelle (Request $request)
    {

        $id = $request['id'];
        $hastalik = Hastaliklar::find($id);
        $hareketler = request('baslik');

        Hastalik_hareketler::where('hastalik_id', $hastalik->id)->delete();

        for ($i = 0; $i < count($hareketler); $i++) {

            Hastalik_hareketler::create([
                'hastalik_id' => $hastalik->id,
                'hareket_id' => $hareketler[$i]
            ]);

        }

        $hastalik->update([
            'hastalik_isim' => $request['hastalik_isim'],
            'hastalik_kategori' => $request['hastalik_kategori']
        ]);
        $hastalik->save();

        return redirect('/hastalikliste');

    }


    public function get_hastaliklarhareketler ()
    {

        $hastaliklar = Hastaliklar::all();

        $hareketler = Hareketolustur::all();

        return view('backend.hastaliklarhareketler', compact('hastaliklar', 'hareketler'));
    }


    public function post_hastaliklarhareketler (Request $request)
    {


        $hastalik = [];
        $hastalik = ['hastalik_isim' => request('hastalik_isim')];


        $hareket = [];
        $hareket = ['baslik' => request('baslik')];


        $hastaliklar = [];
        for ($i = 0; $i < count($hastalik['hastalik_isim']); $i++) {

            $hastaliklar[$i] = Hastaliklar::where('hastalik_isim', '=', $hastalik['hastalik_isim'][$i])
                ->where('aktif', 1)
                ->get();

        }


        $hareketler = [];
        for ($i = 0; $i < count($hareket['baslik']); $i++) {

            $hareketler[$i] = Hareketolustur::where('baslik', '=', $hareket['baslik'][$i])
                ->where('aktif', 1)
                ->get();

        }


        if (count($hastalik['hastalik_isim']) > 1) {
            for ($i = 0; $i < count($hastalik['hastalik_isim']); $i++) {
                Hastalik_hareketler::create([
                    'hastalik_id' => $hastaliklar[$i][0]->id,
                    'hareket_id' => $hareketler[0][0]->id,
                ]);

            }
        }


        if (count($hareket['baslik']) > 1) {
            for ($i = 0; $i < count($hareket['baslik']); $i++) {
                Hastalik_hareketler::create([
                    'hastalik_id' => $hastaliklar[0][0]->id,
                    'hareket_id' => $hareketler[$i][0]->id,
                ]);

            }
        }

        if (count($hareket['baslik']) == 1 && count($hastalik['hastalik_isim']) == 1) {

            Hastalik_hareketler::create([
                'hastalik_id' => $hastaliklar[0][0]->id,
                'hareket_id' => $hareketler[0][0]->id,
            ]);


        }

        return redirect('/hastaliklarhareketlerliste');


    }


    public function get_hastaliklarhareketlerliste (Request $request)
    {


        $aranan = $request['arama'];


        $hasta = Hastaliklar::where('aktif', '=', 1)
            ->where('hastalik_isim', 'like', "%$aranan%")
            ->get();

        $hastalikhareket2 = [];
        foreach ($hasta as $has) {
            $hastaid = $has->id;
            $hastalikhareket2 = Hastalik_hareketler::where('hastalik_id', '=', $hastaid)
                ->where('aktif', 1)
                ->get()->groupBy('hastalik_id');
        }


        $hastaliklar = Hastaliklar::all();
        $hareketler = Hareketolustur::all();
        $hastalikhareket = Hastalik_hareketler::where('aktif', '=', 1)->get()->groupBy('hastalik_id');


        return view('backend.hastalikhareketliste', compact('hastaliklar', 'hareketler', 'hastalikhareket', 'hastalikhareket2'));

    }

    public function get_hastaliklarhareketlerliste_sil (Request $request)
    {

        $now = Carbon::now();
        $hastalik_id = Hastalik_hareketler::find($request['id']);
        $hastaliklar = Hastalik_hareketler::where('hastalik_id', $hastalik_id->hastalik_id)->get();

        foreach ($hastaliklar as $hastalik) {
            $hastalik->update([
                'aktif' => 0,
                'silinme_tarihi' => $now
            ]);
            $hastalik->save();
        }


        return redirect()->back();

    }


    public function get_hastaliklarhareketlerliste_goruntule ($id)
    {

        $idsi = $id;

        $gelenid = Hastalik_hareketler::find($id);

        $hastalikid = $gelenid->hastalik_id;

        $hastalik_hareketler = Hastalik_hareketler::where('hastalik_id', $hastalikid)->where('aktif', 1)->get();
        $hareket_idleri = [];
        foreach ($hastalik_hareketler as $hareketler) {
            array_push($hareket_idleri, $hareketler->hareket_id);
        }


        $hastaliklar = Hastaliklar::find($hastalikid);


        $hareketliste = Hareketolustur::where('aktif', 1)->get();

        return view('backend.hastalikhareketlistegoruntule', compact('hastaliklar', 'hareket_idleri', 'hareketliste', 'idsi'));

    }


    public function post_hastaliklarhareketlerliste_guncelle (Request $request)
    {

        $now = Carbon::now();
        $hastalik = $request['hastalik_isim'];
        $hareketler = $request['baslik'];


        //eski atanmış hareketlerin aktıflıgını sıfır yaptık
        $hastalik_hareketler = Hastalik_hareketler::where('hastalik_id', $request['hastalik_id'])->where('aktif', 1)->get();
        foreach ($hastalik_hareketler as $hareket) {


            $hareket->update([
                'aktif' => 0,
                'silme_tarihi' => $now
            ]);

            $hareket->save();
        }


        //yenı hastalıklar ıcın hareketler eklıcez
        foreach ($hareketler as $hareket) {
            $hastalikhareket = Hastalik_hareketler::create([
                'hastalik_id' => $request['hastalik_id'],
                'hareket_id' => $hareket,
                'aktif' => 1
            ]);

        }


        //aktifi sıfır olan ları verı kalabalıgından dolayı sılıyorum
        Hastalik_hareketler::where('aktif', 0)->delete();

        return redirect('/hastaliklarhareketlerliste');

    }


}
