<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


*/

// Password Reset Routes...
   /* $this->get('password/reset',
        'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email',
        'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}',
        'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');

   */
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/eposta', function()
{
    $data = ['ad' => 'Tuana Şeyma', 'soyad' => 'Eldem'];

    Mail::send('email', $data, function($message) use($data)
    {
        $message->to('veyselakpinar13@gmail.com', $data['ad'])
            ->subject('Günaydın Kızım!')
            ->replyTo('veysel@statikyazilim.com.tr', 'Sinan Eldem');
    });
});


Route::get('/aa', function () {
    return view("auth.login");
});
Route::get('/katiyoll','Hareketcontroller@get_kayit');
Route::get('/deneme','Hareketcontroller@get_deneme');
Route::post('/apihastaliklar', 'Apicontroller@apihastalik');
Route::post('/apibolgeler', 'Apicontroller@apibolgeler');
Route::post('/apiegzersizler', 'Apicontroller@apiegzersiz');
Route::post('/apiegzersizkategorileri', 'Apicontroller@apiegzersizkategori');
Route::post('/apieklemler', 'Apicontroller@apieklemler');
Route::post('/apihareketolustur', 'Apicontroller@apihareketolustur');
Route::post('/apihareketturu', 'Apicontroller@apihareketlerturu');
Route::post('/apihastalikhareketler', 'Apicontroller@apihastalikhareket');
Route::post('/apihastalikkategorileri', 'Apicontroller@apihastalikkategori');
Route::post('/apisetler', 'Apicontroller@apiset');
Route::post('/apisetyorum', 'Apicontroller@apisetyorumlari');
Route::post('/apihastalar', 'Apicontroller@apihasta');
Route::post('/apikurumlar', 'Apicontroller@apikurum');
Route::post('/apihastagirisleri', 'Apicontroller@apihastagiris');


Route::get('/emailgonder', 'Hareketcontroller@emailgonder');


Route::get('/', 'Hareketcontroller@get_giris');

Route::get('/kayit', 'Hareketcontroller@get_kayit');
Route::post('/kayit', 'Hareketcontroller@post_kayit');


Route::post('/upload', 'Kurumlarcontroller@upload');

Route::get('/pdfal', 'Hareketcontroller@goruntule');
Route::post('/pdfal2', 'Hareketcontroller@goruntule2');


/*Route::get('/hastaekle','Hareketcontroller@get_hastaekle');
Route::post('/hastaekle','Hareketcontroller@post_hastaekle');
Route::get('/hastaliste','Hareketcontroller@get_hastaliste');
Route::get('/hasta/resimsil/{id?}','Hareketcontroller@get_hasta_resimsil');
Route::get('/hastaliste/sil/{id?}','Hareketcontroller@get_hastaliste_sil');
Route::get('/hastaliste/guncelle/{id?}','Hareketcontroller@get_hastaliste_goruntule');
Route::post('/hastaliste/guncelle','Hareketcontroller@post_hastaliste_guncelle');

Route::group(['middleware'=>'Doktor'],function() {

});*/


Route::group(['middleware' => 'Admin'], function () {

    Route::group(['middleware' => 'Doktor'], function () {
        Route::get('/anasayfa', 'Hareketcontroller@get_anasayfa');

        Route::get('/kurumlar', 'Kurumlarcontroller@get_kurumlar');
        Route::post('/kurumlar', 'Kurumlarcontroller@post_kurumlar');
        Route::get('/kurumliste', 'Kurumlarcontroller@get_kurumliste');
        Route::post('/kurum/sil', 'Kurumlarcontroller@post_kurum_sil');
        Route::get('/kurumliste/goruntule/{id?}', 'Kurumlarcontroller@get_kurumliste_goruntule');
        Route::post('/kurumliste/guncelle', 'Kurumlarcontroller@post_kurumliste_guncelle');


        Route::get('/bolgeler', 'Hareketcontroller@get_bolgeler');
        Route::post('/bolgeler', 'Hareketcontroller@post_bolgeler');
        Route::get('/bolgelerliste', 'Hareketcontroller@get_bolgelerliste');
        Route::get('/bolgeler/resimsil/{id?}', 'Hareketcontroller@get_bolgeler_resimsil');

        Route::post('/bolgelerliste/sil', 'Hareketcontroller@get_bolgelerliste_sil');
        Route::get('/bolgelerliste/guncelle/{id?}', 'Hareketcontroller@get_bolgelerliste_goruntule');
        Route::post('/bolgelerliste/guncelle', 'Hareketcontroller@post_bolgelerliste_guncelle');


        Route::get('/eklemler', 'Hareketcontroller@get_eklemler');
        Route::post('/eklemler', 'Hareketcontroller@post_eklemler');
        Route::get('/eklemlerliste', 'Hareketcontroller@get_eklemlerliste');
        Route::get('/eklemler/resimsil/{id?}', 'Hareketcontroller@get_eklemler_resimsil');
        Route::post('/eklemlerliste/sil', 'Hareketcontroller@get_eklemlerliste_sil');
        Route::get('/eklemler/guncelle/{id?}', 'Hareketcontroller@get_eklemlerliste_goruntule');
        Route::post('/eklemlerliste/guncelle', 'Hareketcontroller@get_eklemlerliste_guncelle');


        Route::get('/hareketturu', 'Hareketcontroller@get_hareketturu');
        Route::post('/hareketturu', 'Hareketcontroller@post_hareketturu');
        Route::get('/hareketturuliste', 'Hareketcontroller@get_hareketturuliste');
        Route::post('/hareketturuliste/sil', 'Hareketcontroller@get_hareketturuliste_sil');
        Route::get('/hareketturuliste/guncelle/{id?}', 'Hareketcontroller@get_hareketturuliste_goruntule');
        Route::post('/hareketturuliste/guncelle', 'Hareketcontroller@post_hareketturuliste_guncelle');


        Route::get('/hareketolustur', 'Hareketcontroller@get_hareketolustur');
        Route::post('/hareketolustur', 'Hareketcontroller@post_hareketolustur');
        Route::get('/hareketolusturliste', 'Hareketcontroller@get_hareketolusturliste');
        Route::get('/hareketolustur/resimsil/{id?}', 'Hareketcontroller@get_hareketolustur_resimsil');
        Route::post('/hareketolusturliste/sil', 'Hareketcontroller@get_hareketolusturliste_sil');
        Route::get('/hareketolusturliste/guncelle/{id?}', 'Hareketcontroller@get_hareketolusturliste_goruntule');
        Route::post('/hareketolusturliste/guncelle', 'Hareketcontroller@post_hareketolusturliste_guncelle');


        Route::get('/hastalik', 'Hareketcontroller@get_hastalik');
        Route::post('/hastalik', 'Hareketcontroller@post_hastalik');
        Route::get('/hastalikliste', 'Hareketcontroller@get_hastalikliste');
        Route::post('/hastalikliste/sil', 'Hareketcontroller@get_hastalikliste_sil');
        Route::get('/hastalikliste/guncelle/{id?}', 'Hareketcontroller@get_hastalikliste_goruntule');
        Route::post('/hastalikliste/guncelle', 'Hareketcontroller@post_hastalikliste_guncelle');


        Route::get('/hastaliklarhareketler', 'Hareketcontroller@get_hastaliklarhareketler');
        Route::post('/hastaliklarhareketler', 'Hareketcontroller@post_hastaliklarhareketler');
        Route::get('/hastaliklarhareketlerliste', 'Hareketcontroller@get_hastaliklarhareketlerliste');
        Route::post('/hastaliklarhareketlerliste/sil', 'Hareketcontroller@get_hastaliklarhareketlerliste_sil');
        Route::get('/hastaliklarhareketlerliste/guncelle/{id?}', 'Hareketcontroller@get_hastaliklarhareketlerliste_goruntule');
        Route::post('/hastaliklarhareketlerliste/guncelle', 'Hareketcontroller@post_hastaliklarhareketlerliste_guncelle');


        Route::get('/hastalikkategori', 'Hareketcontroller@get_kategoriler');
        Route::post('/hastalikkategori', 'Hareketcontroller@post_kategoriler');
        Route::get('/hastalikkategoriliste', 'Hareketcontroller@get_kategorilerliste');
        Route::post('/hastalikkategoriliste/sil', 'Hareketcontroller@get_kategoriliste_sil');
        Route::get('/hastalikkategoriliste/guncelle/{id?}', 'Hareketcontroller@get_kategoriliste_goruntule');
        Route::post('/hastalikkategoriliste/guncelle', 'Hareketcontroller@post_kategoriliste_guncelle');


        Route::get('/egzersizkategori', 'Hareketcontroller@get_egzersizkategori');
        Route::post('/egzersizkategori', 'Hareketcontroller@post_egzersizkategori');
        Route::get('/egzersizkategoriliste', 'Hareketcontroller@get_egzersizkategoriliste');
        Route::post('/egzersizkategoriliste/sil', 'Hareketcontroller@get_egzersizkategoriliste_sil');
        Route::get('/egzersizkategoriliste/guncelle/{id?}', 'Hareketcontroller@get_egzersizkategoriliste_goruntule');
        Route::post('/egzersizkategoriliste/guncelle', 'Hareketcontroller@post_egzersizkategoriliste_guncelle');


        Route::get('/egzersiz', 'Hareketcontroller@get_egzersiz');
        Route::post('/egzersiz', 'Hareketcontroller@post_egzersiz');
        Route::get('/egzersizliste', 'Hareketcontroller@get_egzersizliste');
        Route::get('/egzersiz/resimsil/{id?}', 'Hareketcontroller@get_egzersiz_resimsil');
        Route::get('/egzersiz/video/{id?}', 'Hareketcontroller@get_egzersiz_videosil');
        Route::post('/egzersizliste/sil', 'Hareketcontroller@get_egzersizliste_sil');
        Route::get('/egzersizliste/guncelle/{id?}', 'Hareketcontroller@get_egzersizliste_goruntule');
        Route::post('/egzersizliste/guncelle', 'Hareketcontroller@post_egzersizliste_guncelle');

    });


    Route::group(['middleware' => 'Kullanici'], function () {

        Route::get('/doktor_fizyocu_ekleme', 'Kurumlarcontroller@get_doktor_fizyocu_ekleme');
        Route::post('/doktor_fizyocu_ekleme', 'Kurumlarcontroller@post_doktor_fizyocu_ekleme');
        Route::get('/doktor_fizyocu_liste', 'Kurumlarcontroller@get_doktor_fizyocu_liste');
        Route::post('/doktor_fizyocu_liste/sil', 'Kurumlarcontroller@get_doktor_fizyocu_liste_sil');
        Route::get('/doktor_fizyocu_liste/guncelle/{id?}', 'Kurumlarcontroller@get_doktor_fizyocu_liste_goruntule');
        Route::post('/doktor_fizyocu_liste/guncelle', 'Kurumlarcontroller@post_doktor_fizyocu_liste_guncelle');
        Route::get('/doktor_fizyocu_liste/aktifet/{id?}', 'Kurumlarcontroller@post_doktor_fizyocu_liste_aktifet');

    });

    Route::group(['middleware' => 'Yetkili'], function () {

//ılk defa plan olusturmka ıcın
        //ikincisi post tu get yaptım
        Route::get('/egzersizplan', 'Hareketcontroller@get_egzersizplan');
        Route::post('/egzersizplan_session', 'Hareketcontroller@post_egzersizplan');
        Route::post('/sessionhareket_plan/kaydet/', 'Hareketcontroller@post_session_kaydet');
        Route::get('/egzersizplan/iptalet', 'Hareketcontroller@get_session_plan_iptalet');
        Route::post('/egzersizplan/taslakolarak/kaydet', 'Hareketcontroller@get_session_plan_taslak_kaydet');


        //hazır egzersiz planı listelemk  ıcın
        Route::get('/hazir/egzersizplan_liste', 'Hareketcontroller@get_hazir_egzersizplan_liste');
        Route::post('/hazir/egzersizplan_liste/sil', 'Hareketcontroller@get_hazir_egzersizplan_liste_sil');

        Route::get('/hazir/egzersizplan_liste/goruntule/{id?}', 'Hareketcontroller@get_hazir_egzersizplan_liste_goruntule');
        Route::get('/hazir/egzersizplan_liste/guncelle/{id?}', 'Hareketcontroller@get_hazir_egzersizplan_liste_guncelle');
        Route::post('/hazir/egzersizplan_session/guncelle/{id?}', 'Hareketcontroller@post_hazir_egzersizplan_guncelle');

        //hazır egzersiz planı olusturmk   ıcın
        Route::get('/hazir/egzersizplan', 'Hareketcontroller@get_hazir_egzersizplan');
        Route::post('/hazir/egzersizplan_session', 'Hareketcontroller@post_hazir_egzersizplan');
        Route::post('/hazir/sessionhareket_plan/kaydet', 'Hareketcontroller@post_session__hazir_kaydet');
        Route::get('hazir/egzersizplan/iptalet', 'Hareketcontroller@get_session_hazirplan_iptalet');
        //Route::get('/hareketplan','Hareketcontroller@get_hareketplan');

        Route::get('/hazir/egzersizplan/ata', 'Hareketcontroller@get_hazir_egzersizplan_atama');


        Route::get('/hastakayitformu', 'Hareketcontroller@get_hastakayitformu');
        Route::post('/hastakayitformu', 'Hareketcontroller@post_hastakayitformu');
        Route::get('/hastaliste', 'Hareketcontroller@get_plan_hastaliste');
        Route::post('/hasta_liste/sil', 'Hareketcontroller@get_hastalistem_sil');
        Route::get('/hasta_liste/guncelle/{id?}', 'Hareketcontroller@get_hastalistem_goruntule');
        Route::post('/hasta_liste/guncelle', 'Hareketcontroller@post_hastalistem_guncelle');


    });

    Route::get('/hasta_plan_kayit/goruntule', 'Hareketcontroller@get_hasta_plan_kayıt_goruntule');

    Route::get('/hasta_planlarini/goruntule', 'Hareketcontroller@get_hasta_planlarini_goruntule');

    Route::post('/hasta_plan_kayit/goruntule', 'Hareketcontroller@post_hasta_plan_kayıt_guncelle');

    Route::get('/hasta_liste/plan/goruntule/{sayi?}/{id?}', 'Hareketcontroller@get_hastaliste_plan_goruntule');


    Route::get('/hasta_liste/plan/guncelle/{sayi?}/{id?}', 'Hareketcontroller@get_hastaliste_plan_guncelle');
    Route::post('/egzersizplan_session/{sayi?}/{hasta_id?}', 'Hareketcontroller@post_egzersizplan_guncelleme');


    Route::get('/kayit/goruntule', 'Hareketcontroller@get_kayit_goruntule');
    Route::post('/kayit/goruntule', 'Hareketcontroller@post_kayit_goruntule');


    Route::get('/mesajlar', 'Mesajcontroller@get_mesajlar');
    Route::get('/mesajlarliste', 'Mesajcontroller@get_mesajlarliste');
    Route::post('/mesajlarliste/sil', 'Mesajcontroller@get_mesajlarliste_sil');
    Route::get('/mesajlarliste/goruntule/{id?}', 'Mesajcontroller@get_mesajlarliste_goruntule');


    Route::get('/planlama/{sayi?}/{id?}', 'Planlamacontroller@get_planlama');
    Route::post('/program/planlama', 'Planlamacontroller@post_planlama');
    Route::get('/planlamaliste','Planlamacontroller@get_planlamaliste');
    Route::post('/planlamaliste/sil','Planlamacontroller@get_planlamaliste_sil');
    Route::get('/planlamaliste/goruntule/{id?}','Planlamacontroller@get_planlamaliste_goruntule');


    Route::get('/antrenor/planlama/{sayi?}/{id?}', 'Planlamacontroller@get_planlama_antrenor');
    Route::post('/antrenor/program/planlama', 'Planlamacontroller@post_planlama_antrenor');


    Route::get('/EgzersizDetay/{element?}','Hareketcontroller@get_egzersizdetay');

    Route::get('/son/plan/goruntule/{sayi?}/{id?}', 'Hareketcontroller@son_plan_goruntule');

});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
