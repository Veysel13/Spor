<?php

namespace App\Http\Controllers;

use App\Hastalar;
use App\Http\Middleware\Hasta;
use App\Kurumlar;
use App\Setler;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Kurumlarcontroller extends Controller
{



    public function upload(Request $request)
    {

        $veriler=Setler::where('plan_sayisi',$request['plan_sayisi'])
            ->where('hasta_id',$request['hasta_id'])
            ->get();

        $hasta_id=$veriler[0]->hasta_id;

        $hastalar=Hastalar::find($hasta_id);


        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();

// Adding Text element with font customized using explicitly created font style object...
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $fontStyle->setLineHeight(50);
        $fontStyle->setName('Tahoma');
        $fontStyle->setSize(20);
        $myTextElement = $section->addText('                      Egzersiz Plan Çizelgesi');
        $myTextElement->setFontStyle($fontStyle);

        $section->addText('');

        $fontStyle_hasta = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle_hasta->setBold(true);
        $fontStyle_hasta->setLineHeight(25);
        $fontStyle_hasta->setName('Tahoma');
        $fontStyle_hasta->setSize(15);
        $myTextElement2 = $section->addText('Hasta Adı='.$hastalar->hasta_ad);
        $myTextElement2->setFontStyle($fontStyle_hasta);



        $section->addText('');

        $fontStyle_hasta = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle_hasta->setBold(true);
        $fontStyle_hasta->setLineHeight(25);
        $fontStyle_hasta->setName('Tahoma');
        $fontStyle_hasta->setSize(15);
        $myTextElement2 = $section->addText('Program Süresi='.$veriler[0]->baslangic_tarihi. '-->' .$veriler[0]->bitis_tarihi);
        $myTextElement2->setFontStyle($fontStyle_hasta);



        $fancyTableStyleName='Veysel Akpınar Table';
        $fancyTableStyle=array('bordersize'=>2,'bordercolor'=>'d2d2d2','cellMargin'=>100);
        $fancyTableFirstRowStyle=array('bgColor'=>'DDDDDD');
        $fancyTableCellStyle=array('valign'=>'center');

        $fancyTableFontStyle=array('bold'=>true,'fontsize'=>80);






        $phpWord->addTableStyle($fancyTableStyleName,$fancyTableStyle,$fancyTableFirstRowStyle);
        $table=$section->addTable($fancyTableStyleName);

        $table->addRow(500);
        $table->addCell(3000,$fancyTableCellStyle)->addText('Egzersiz',$fancyTableFontStyle);
        $table->addCell(3000,$fancyTableCellStyle)->addText('Set',$fancyTableFontStyle);
        $table->addCell(3000,$fancyTableCellStyle)->addText('Tekrar',$fancyTableFontStyle);
        $table->addCell(3000,$fancyTableCellStyle)->addText('Pzt',$fancyTableFontStyle);
        $table->addCell(3000,$fancyTableCellStyle)->addText('Sl',$fancyTableFontStyle);
        $table->addCell(3000,$fancyTableCellStyle)->addText('Çrş',$fancyTableFontStyle);
        $table->addCell(3000,$fancyTableCellStyle)->addText('Per',$fancyTableFontStyle);
        $table->addCell(3000,$fancyTableCellStyle)->addText('Cm',$fancyTableFontStyle);
        $table->addCell(3000,$fancyTableCellStyle)->addText('Cmt',$fancyTableFontStyle);
        $table->addCell(3000,$fancyTableCellStyle)->addText('Pz',$fancyTableFontStyle);





        for ($i=0;$i<\count($veriler);$i++){
            $table->addRow();
            $table->addCell(3000)->addText($veriler[$i]->	egzersiz_isim);
            $table->addCell(3000)->addText($veriler[$i]->set);
            $table->addCell(3000)->addText($veriler[$i]->tekrar);
            $table->addCell(3000)->addText("");
            $table->addCell(3000)->addText("");
            $table->addCell(3000)->addText("");
            $table->addCell(3000)->addText("");
            $table->addCell(3000)->addText("");
            $table->addCell(3000)->addText("");
            $table->addCell(3000)->addText("");

        }


        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment;filename="Worddenemesi.docx"');
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');


        /* $wordtest = new \PhpOffice\PhpWord\PhpWord();

         $newsection = $wordtest->addSection();


         $desc1 = "dffffffffffdfdfdsssssssssssssssssssssssssssss";
         $desc2 = "dssdfdsfdsfdsfdsfdssssssssssssssssssssssssssssssssssss";

         $newsection->addText($desc1);
         $newsection->addText($desc2);

         $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordtest, 'Word2007');


         $objectWriter->save(storage_path('TestWordFile.docx'));


         response()->download(storage_path('TestWordFile.docx'));*/
    }


   public function get_kurumlar(){

       return view('backend.kurum_ekleme');
   }


   public function post_kurumlar(Request $request){

       $data=$request->all();
       $data['ekleyen_id']=auth()->user()->id;
       $data['kurum_arayansifre']=bcrypt($request['kurum_arayansifre']);

       Kurumlar::create($data);

       //son eklenen ıd yı alır
       $kurumlar=Kurumlar::all()->last();

       if (isset($request['kurum_arayaneposta']) && isset($request['kurum_arayansifre'])){

       if ($request['kurum_arayansifre']!=$request['kurum_arayansifre_confirmation']){

           return redirect()->back()->withErrors(['message' => 'Girdiginiz Sifreler Uyusmamaktadir.Lutfen Kontrol Ediniz']);

       }else{
           User::create([
               'name'=>$request['kurum_arayanad'],
               'email'=>$request['kurum_arayaneposta'],
               'password'=>bcrypt($request['kurum_arayansifre']),
               'yetki'=>88,
               'onay'=>1,
               'kurum_id'=>$kurumlar->id
           ]);

       }


       }

       return redirect('/kurumliste');

   }



   public function get_kurumliste(Request $request){

       $aranan=$request['arama'];

       $kurumarama=Kurumlar::where('aktif','=',1)
           ->where('kurum_adi','like',"%$aranan%")
           ->get();
       $kurumlar=Kurumlar::where('aktif','=',1)->get();

       return view('backend.kurum_liste',compact('kurumlar','kurumarama'));
   }


   public  function post_kurum_sil(Request $request){


       $now= Carbon::now();
       $kurum=Kurumlar::find($request['id']);
       $kurumid=$kurum->id;

       $kurumvar=User::where('kurum_id','=',$kurumid)->first();

       if ($kurumvar!=null){

           return redirect()->back()->withErrors(['message'=>'Bu kurumun user tablosunda bilgileri bulunmaktadır.lütfen onları kontrol ediniz']);

       }
       else{

           $kurum->update([
               'aktif'=>0,
               'silinme_tarihi'=>$now
           ]);

           $kurum->save();

           return redirect()->back();
       }

   }


   public  function  get_kurumliste_goruntule($id){

       $kurum=Kurumlar::find($id);

       return view('backend.kurum_goruntule',compact('kurum'));
   }

   public function post_kurumliste_guncelle(Request $request){

       $kurum=Kurumlar::find($request['kurum_id']);

       $data=$request->all();
       $data['kurum_arayansifre']=bcrypt($request['kurum_arayansifre']);
       $kurum->update($data);
       $kurum->save();


       $kurum_user_eposta=User::where('yetki',88)->where('kurum_id',$request['kurum_id'])->first();
       $kurum_user_eposta->update([
           'email'=>$request['kurum_arayaneposta']
       ]);
       $kurum_user_eposta->save();


       if($request['kurum_arayansifre']!=null){
           if($request['kurum_arayansifre']==$request['kurum_arayansifre_confirmation']){

               $kurum_user=User::where('yetki',88)->where('kurum_id',$request['kurum_id'])->first();
               $kurum_user->update([
                   'email'=>$request['kurum_arayaneposta'],
                   'password'=>$request['kurum_arayansifre']
               ]);
               $kurum_user->save();
           }else{
               return redirect()->back()->withErrors(['message'=>'Girdiğiniz Şifreler Uyuşmamaktadır.Lütfen tekrar deneyiniz.']);

           }
       }

       return redirect('/kurumliste');
   }

   public function  get_doktor_fizyocu_ekleme(){


       return view('backend.doktor_fizyocu');
   }

   public function post_doktor_fizyocu_ekleme(Request $request){

      echo $request['name'];
      echo $request['email'];
      echo $request['password'];



       if ( $request['password']!=$request['password_confirmation']){
           return redirect()->back()->withErrors(['message'=>'Girdiğiniz şifreler uyuşmamktadır.Lütfen tekrar deneyiniz']);

       }

       if ( $request['city']==null){
           return redirect()->back()->withErrors(['message'=>'Kayıt olan kişinin yetkisini belirleyiniz.Doktor veya Fizyoterapi']);

       }




       if($request['city']=="doktor"){
           $yetki=2;
       }else{
           $yetki=3;
       }

       echo $yetki;

      User::create([
          'name'=>$request['name'],
          'email'=>$request['email'],
          'password'=>bcrypt($request['password']),
          'yetki'=>$yetki,
          'onay'=>1,
          'kurum_id'=>auth()->user()->kurum_id
      ]);


       return redirect('/doktor_fizyocu_liste');
   }


   public  function get_doktor_fizyocu_liste(Request $request){


       $aranan=$request['arama'];
       $pasif_aranan=$request['pasif_arama'];

       $doktorlararama=User::where('yetki',2)
           ->where('onay',1)
           ->where('kurum_id',auth()->user()->kurum_id)
           ->where('aktif',1)
           ->where('name','like',"%$aranan%")
           ->get();

       $fizyoculararama=User::where('yetki',3)
           ->where('onay',1)
           ->where('kurum_id',auth()->user()->kurum_id)
           ->where('aktif',1)
           ->where('name','like',"%$aranan%")
           ->get();


       $doktorlararama_pasif=User::where('yetki',2)
           ->where('onay',1)
           ->where('kurum_id',auth()->user()->kurum_id)
           ->where('aktif',0)
           ->where('name','like',"%$pasif_aranan%")
           ->get();

       $fizyoculararama_pasif=User::where('yetki',3)
           ->where('onay',1)
           ->where('kurum_id',auth()->user()->kurum_id)
           ->where('aktif',0)
           ->where('name','like',"%$pasif_aranan%")
           ->get();

       $doktorlar=User::where('yetki',2)->where('onay',1)->where('kurum_id',auth()->user()->kurum_id)->where('aktif',1)->get();

           $fizyocular=User::where('yetki',3)->where('onay',1)->where('kurum_id',auth()->user()->kurum_id)->where('aktif',1)->get();



       $doktorlar_pasif=User::where('yetki',2)->where('onay',1)->where('kurum_id',auth()->user()->kurum_id)->where('aktif',0)->get();

       $fizyocular_pasif=User::where('yetki',3)->where('onay',1)->where('kurum_id',auth()->user()->kurum_id)->where('aktif',0)->get();


       return view('backend.doktor_fizyocu_liste',compact('doktorlar','fizyocular','doktorlar_pasif','fizyocular_pasif','doktorlararama','doktorlararama_pasif','fizyoculararama','fizyoculararama_pasif'));
   }



   public function get_doktor_fizyocu_liste_sil(Request $request){

       $zaman=Carbon::now();

           $kullanici=User::find($request['id']);

           $kullanici->update([
               'aktif'=>0,
               'silinme_tarihi'=>$zaman
           ]);

           $kullanici->save();

       return redirect()->back();

   }


   public  function post_doktor_fizyocu_liste_aktifet($id){
       $user=User::find($id);

       $user->update([
           'aktif'=>1
       ]);
       $user->save();

       return redirect()->back();

   }

   public  function get_doktor_fizyocu_liste_goruntule($id){

       $kullanici=User::find($id);

       return view('backend.doktor_fizyocugoruntule',compact('kullanici'));

   }


   public  function post_doktor_fizyocu_liste_guncelle(Request $request){

       $kisi=User::find($request['id']);

       if($request['city']=="doktor"){
           $yetki=2;
       }else{
           $yetki=3;
       }

       if($request['password']!=null){
           if($request['password']==$request['password_confirmation']){

               $kisi->update([
                   'name'=>$request['name'],
                   'email'=>$request['email'],
                   'password'=>bcrypt($request['password']),
                   'yetki'=>$yetki
               ]);
               $kisi->save();

           }else{
               return redirect()->back()->withErrors(['message'=>'Girdiğiniz şifreler uyuşmamktadır.Lütfen tekrar giriniz']);

           }
       }else{
           $kisi->update([
               'name'=>$request['name'],
               'email'=>$request['email'],
               'yetki'=>$yetki
           ]);
           $kisi->save();

       }


       return redirect('/doktor_fizyocu_liste');
   }
}
