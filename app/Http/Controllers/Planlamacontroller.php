<?php

namespace App\Http\Controllers;

use App\Egzersizkategori;
use App\Planlama;
use App\Setler;
use App\Setyorum;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Planlamacontroller extends Controller
{
    public function get_planlama(Request $request,$sayi,$id){

        if (isset($_GET['plan_guncelleme'])){

            $hastaya_atanan_setler_guncelleme = Planlama::where('hasta_id', $id)
                ->where('plan_numarasi', $sayi)
                ->where('aktif', 1)
                ->where('plan_durum', '1')
                ->get();



            foreach ($hastaya_atanan_setler_guncelleme as $guncelleme){

                $guncelleme->update([
                    'plan_durum'=>'0',
                    'pazartesi'=>'0',
                    'sali'=>'0',
                    'carsamba'=>'0',
                    'persembe'=>'0',
                    'cuma'=>'0',
                    'cumartesi'=>'0',
                    'pazar'=>'0',

                ]);
                $guncelleme->save();
            }


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


        $hastaya_atanan_setler = Planlama::where('hasta_id', $id)->where('plan_numarasi', $sayi)->where('aktif', 1)->first();




        return view('backend.schedule', compact('sayi', 'id', 'egzersiz_kategorileri_id','hastaya_atanan_setler'));



    }


    public function post_planlama(Request $request){

     echo $dongu=(int)$request['veri_sayisi'];
     echo $request['hasta_id'];
        echo $request['plan_numarasi'];

        $planlarim=Planlama::where('aktif',1)
            ->where('hasta_id',$request['hasta_id'])
            ->where('plan_numarasi',$request['plan_numarasi'])
            ->get();


      for ($i=0;$i<count($planlarim);$i++){

          if ($request['pazartesi-'.$i]=="on"){
             $pazartesi='1';
          }else{
              $pazartesi='0';
          }

          if ($request['sali-'.$i]=="on"){
              $sali='1';
          }else{
              $sali='0';
          }

          if ($request['carsamba-'.$i]=="on"){
              $carsamba='1';
          }else{
              $carsamba='0';
          }

          if ($request['persembe-'.$i]=="on"){
              $persembe='1';
          }else{
              $persembe='0';
          }

          if ($request['cuma-'.$i]=="on"){
              $cuma='1';
          }else{
              $cuma='0';
          }

          if ($request['cumartesi-'.$i]=="on"){
              $cumartesi='1';
          }else{
              $cumartesi='0';
          }

          if ($request['pazar-'.$i]=="on"){
              $pazar='1';
          }else{
              $pazar='0';
          }

          $planlarim[$i]->update([
              'plan_durum'=>'1',
              'pazartesi'=>$pazartesi,
              'sali'=>$sali,
              'carsamba'=>$carsamba,
              'persembe'=>$persembe,
              'cuma'=>$cuma,
              'cumartesi'=>$cumartesi,
              'pazar'=>$pazar,

          ]);

          $planlarim[$i]->save();

      }

      return redirect('planlamaliste');

    }

    public function get_planlamaliste(){

        $id=auth()->user()->id;
        $hasta_id=User::find($id);

        $planlamalar=Planlama::active()
            ->where('hasta_id',$hasta_id->hasta_id)
            ->orderBy('plan_durum')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('program_adi');

        return view('backend.planlama_cizelgesi',compact('planlamalar'));
    }

    public function get_planlamaliste_sil(Request $request){

        $now=Carbon::now();
       echo $hasta_id=$request['hasta_id'];
       echo $plan_numarasi=$request['plan_numarasi'];

       $plan_update=Planlama::active()
                    ->where('hasta_id',$hasta_id)
                    ->where('plan_numarasi',$plan_numarasi)
                    ->get();

       print_r($plan_update);

       foreach ($plan_update as $update){
           $update->update([
               'aktif'=>0,
               'silinme_tarihi'=>$now
           ]);

           $update->save();
       }



return redirect()->back();
    }






    //anrtenor program plnlaması  ıcın

    public function get_planlama_antrenor(Request $request,$sayi,$id){

        if (isset($_GET['plan_guncelleme'])){

            $hastaya_atanan_setler_guncelleme = Planlama::where('hasta_id', $id)
                ->where('plan_numarasi', $sayi)
                ->where('aktif', 1)
                ->where('plan_durum', '1')
                ->get();



            foreach ($hastaya_atanan_setler_guncelleme as $guncelleme){

                $guncelleme->update([
                    'plan_durum'=>'0',
                    'pazartesi'=>'0',
                    'sali'=>'0',
                    'carsamba'=>'0',
                    'persembe'=>'0',
                    'cuma'=>'0',
                    'cumartesi'=>'0',
                    'pazar'=>'0',

                ]);
                $guncelleme->save();
            }


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


        $hastaya_atanan_setler = Planlama::where('hasta_id', $id)->where('plan_numarasi', $sayi)->where('aktif', 1)->first();




        return view('backend.antrenor_schedule', compact('sayi', 'id', 'egzersiz_kategorileri_id','hastaya_atanan_setler'));



    }


    public function post_planlama_antrenor(Request $request){

        echo $dongu=(int)$request['veri_sayisi'];
        $id= $request['hasta_id'];
        echo $request['plan_numarasi'];

        $planlarim=Planlama::where('aktif',1)
            ->where('hasta_id',$request['hasta_id'])
            ->where('plan_numarasi',$request['plan_numarasi'])
            ->get();


        for ($i=0;$i<count($planlarim);$i++){

            if ($request['pazartesi-'.$i]=="on"){
                $pazartesi='1';
            }else{
                $pazartesi='0';
            }

            if ($request['sali-'.$i]=="on"){
                $sali='1';
            }else{
                $sali='0';
            }

            if ($request['carsamba-'.$i]=="on"){
                $carsamba='1';
            }else{
                $carsamba='0';
            }

            if ($request['persembe-'.$i]=="on"){
                $persembe='1';
            }else{
                $persembe='0';
            }

            if ($request['cuma-'.$i]=="on"){
                $cuma='1';
            }else{
                $cuma='0';
            }

            if ($request['cumartesi-'.$i]=="on"){
                $cumartesi='1';
            }else{
                $cumartesi='0';
            }

            if ($request['pazar-'.$i]=="on"){
                $pazar='1';
            }else{
                $pazar='0';
            }

            $planlarim[$i]->update([
                'plan_durum'=>'1',
                'pazartesi'=>$pazartesi,
                'sali'=>$sali,
                'carsamba'=>$carsamba,
                'persembe'=>$persembe,
                'cuma'=>$cuma,
                'cumartesi'=>$cumartesi,
                'pazar'=>$pazar,

            ]);

            $planlarim[$i]->save();

        }

       // return redirect('hasta_liste/guncelle/',compact("id"));
        return redirect()->back();
    }




}
