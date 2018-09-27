<?php

namespace App\Http\Controllers;

use App\Bildirimler;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Mesajcontroller extends Controller
{

    public function get_mesajlar(){

        $bildirimler=Bildirimler::active()
                    ->where('gonderilen_id',auth()->user()->id)
                    ->orderBy('mesaj_durum', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('backend.mesajlar',compact('bildirimler'));
    }


    public function get_mesajlarliste_sil (Request $request)
    {
        $now = Carbon::now();
        $bildirim = Bildirimler::find($request['id']);

        $bildirim->update([
                'mesaj_durum'=>1,
                'aktif' => 0,
                'silinme_tarihi' => $now
            ]);

        $bildirim->save();


            return redirect()->back();

        }


    public function get_mesajlarliste_goruntule (Request $request,$id){

       $mesaj=Bildirimler::find($id);

       $mesaj->update([
           'mesaj_durum'=>1
       ]);

       $mesaj->save();
       //hastanın ıdsıne ulasmak ıcın
       $kullanici_id=User::find($mesaj->gonderilen_id);


       return redirect('/hasta_liste/plan/goruntule/'.$mesaj->plan_sayisi."/".$kullanici_id->hasta_id);
    }
}
