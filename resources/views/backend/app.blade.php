<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fizyo Terapi Takip</title>
    <!-- Plugins CSS -->
    <link href="/Back/css/plugins/plugins.css" rel="stylesheet">
    <link href="/Back/smart-form/smart-templates/css/smart-forms.css" rel="stylesheet">
    <link href="/Back/js/plugins/morris-chart/morris.css" rel="stylesheet">
    <link href="/Back/js/plugins/vector-map/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/Back/js/plugins/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/Back/js/plugins/data-tables/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/Back/js/plugins/data-tables/responsive.bootstrap4.min.css" rel="stylesheet">
    <link href="/Back/bower_components/toastr/toastr.min.css" rel="stylesheet">
    <link href="/Back/linearicons/fonts.css" rel="stylesheet">
    <link href="/Back/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/danger.css">
    <link rel="stylesheet" href="/css/sweetalert2.min.css">
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    @yield('css')
</head>

<body class="layout-vertical">

<div class="page-wrapper">
    <nav id="sidebar" class="sidebar-nav light-sidebar">
        <div class="sidebar-inner content-scroll">

            <div class="logo-header">
                <h4>Spor Takip</h4>
            </div><!--logo-->
            <ul class="metismenu" id="menu">
                <li class="nav-heading">
                    <span>Menüler</span>
                </li>

                @if(auth()->user()->yetki==1)
                <li>
                    <a  href="/anasayfa" aria-expanded="false">
                        <i class="icon-home"></i>
                        <span class="nav-text">Özet Ekran</span>
                    </a>
                </li>
                    <li>
                        <a  href="/kurumliste" aria-expanded="false">
                            <i class="fa fa-university"></i>
                            <span class="nav-text">Kurum Listesi</span>
                        </a>
                    </li>
                <li>
                    <a  href="/hastalikkategoriliste" aria-expanded="false">
                        <i class="fa fa-braille"></i>
                        <span class="nav-text">Hastalik Kategori Listesi</span>
                    </a>
                </li>
                <li>
                <a  href="/bolgelerliste" aria-expanded="false">
                    <i class="fa fa-stethoscope"></i>
                    <span class="nav-text">Bölgeler</span>
                </a>
            </li>
                <li>
                    <a  href="/eklemlerliste" aria-expanded="false">
                        <i class="fa fa-street-view"></i>
                        <span class="nav-text">Eklemler</span>
                    </a>
                </li>
                <li>
                    <a  href="/hareketturuliste" aria-expanded="false">
                        <i class="fa fa-blind"></i>
                        <span class="nav-text">Hareket Türleri</span>
                    </a>
                </li>
                <li>
                    <a  href="/hastalikliste" aria-expanded="false">
                        <i class="fa fa-heartbeat"></i>
                        <span class="nav-text">Hastalıklar</span>
                    </a>
                </li>
                <li>
                    <a  href="/hareketolusturliste" aria-expanded="false">
                        <i class="fa fa-child"></i>
                        <span class="nav-text">Oluşturulan Hareketler</span>
                    </a>
                </li>
                <li>
                    <a  href="/hastaliklarhareketlerliste" aria-expanded="false">
                        <i class="fa fa-heart"></i>
                        <span class="nav-text">Hastalıklar için Hareketler</span>
                    </a>
                </li>

                <li>
                    <a  href="/egzersizkategoriliste" aria-expanded="false">
                        <i class="fa fa-braille"></i>
                        <span class="nav-text">Egzersiz Kategori Listesi</span>
                    </a>
                </li>


                <li>
                    <a  href="/egzersizliste" aria-expanded="false">
                        <i class="fa fa-universal-access"></i>
                        <span class="nav-text">Egzersizler</span>
                    </a>
                </li>


                <li>
                    <a  href="/egzersizplan" aria-expanded="false">
                        <i class="fa fa-paper-plane"></i>
                        <span class="nav-text">HPO</span>
                    </a>
                </li>


                    <li>
                        <a  href="/hazir/egzersizplan_liste" aria-expanded="false">
                            <i class="fa fa-paper-plane"></i>
                            <span class="nav-text">Hazır plan liste</span>
                        </a>
                    </li>


                    <li>
                        <a  href="/hastaliste" aria-expanded="false">
                            <i class="fa fa-th-list"></i>
                            <span class="nav-text">Hasta Listesi</span>
                        </a>
                    </li>





                    @elseif(auth()->user()->yetki>=2 && auth()->user()->yetki<=3)



                    <li>
                        <a  href="/egzersizplan" aria-expanded="false">
                            <i class="fa fa-paper-plane"></i>
                            <span class="nav-text">HPO</span>
                        </a>
                    </li>

                    <li>
                        <a  href="/hazir/egzersizplan_liste" aria-expanded="false">
                            <i class="fa fa-paper-plane"></i>
                            <span class="nav-text">Hazır plan liste</span>
                        </a>
                    </li>


                    <li>
                        <a  href="/hastaliste" aria-expanded="false">
                            <i class="fa fa-th-list"></i>
                            <span class="nav-text">Hasta Listesi</span>
                        </a>
                    </li>



                @elseif(auth()->user()->yetki==88)
                    <li>
                        <a  href="/doktor_fizyocu_liste" aria-expanded="false">
                            <i class="icon-home"></i>
                            <span class="nav-text">Kurum Yetkili Listesi</span>
                        </a>
                    </li>


                    <li>
                        <a  href="/hazir/egzersizplan_liste" aria-expanded="false">
                            <i class="fa fa-paper-plane"></i>
                            <span class="nav-text">Hazır plan liste</span>
                        </a>
                    </li>



                    <li>
                        <a  href="/egzersizplan" aria-expanded="false">
                            <i class="fa fa-paper-plane"></i>
                            <span class="nav-text">HPO</span>
                        </a>
                    </li>





                    <li>
                        <a  href="/hastaliste" aria-expanded="false">
                            <i class="fa fa-th-list"></i>
                            <span class="nav-text">Hasta Listesi</span>
                        </a>
                    </li>


                @else

                    <li>
                        <a  href="/hasta_plan_kayit/goruntule" aria-expanded="false">
                            <i class="fa fa-address-card"></i>
                            <span class="nav-text">Hasta Bilgileri</span>
                        </a>
                    </li>

                    <li>
                        <a  href="/hasta_planlarini/goruntule" aria-expanded="false">
                            <i class="fa fa-th-list"></i>
                            <span class="nav-text">Programlarım</span>
                        </a>
                    </li>


                    <li>
                        <a  href="/mesajlar" aria-expanded="false">
                            <i class="fa fa-comments"></i>
                            <span class="nav-text">Bildirimler</span>
                        </a>
                    </li>

                    <li>
                        <a  href="/planlamaliste" aria-expanded="false">
                            <i class="fa fa-balance-scale"></i>
                            <span class="nav-text">Program Plan Listesi</span>
                        </a>
                    </li>
                @endif






            </ul>
        </div>
    </nav><!--sidebar nav-->
    <main class="main-content">
        <!--/////////////////////////////// End navbar////////////////////////////-->
        <header class="header">
            <!--<div class="container">-->
            <div class="">
                <div class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="javascript:void(0)" class=" btn-circle-round sidebar-toggler">
                                <i class="icon-menu"></i>
                            </a>
                        </li>
                        <li class="nav-item ml-3 hidden-md-down">
                           <!-- <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="text" placeholder="Find...">
                                <button class="icon-search" type="submit"><i class="ion-ios-search-strong"></i></button>
                            </form>-->
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">


                        <!--Mesaj baslangıc -->

                        <?php $mesaj_id=auth()->user()->id;
                        $mesajlarim=\App\Bildirimler::where('aktif',1)
                            ->where('gonderilen_id',$mesaj_id)
                            ->where('mesaj_durum',0)
                            ->get();

                        ?>
                        <li class="nav-item dropdown">
                            <a data-toggle="dropdown" href="javascript:void(0)" class="btn-circle-round dropdown-toggle">
                                <i class="icon-bubbles"></i>
                                <span class="badge bg-success">
                                    <?php
                                   echo count($mesajlarim);
                                    ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li class="notification-header">
                                            <span class="float-right">
                                                <a href="/mesajlar">Tüm Bildirimler</a>
                                            </span>
                                    <?php
                                    echo count($mesajlarim)."  mesaj";
                                    ?>
                                </li>


                                @foreach($mesajlarim as $mesaj)
                                    <?php
                                    $kullanici_id=\App\User::find($mesaj->gonderilen_id);
                                    ?>

                    <div style=" margin-top:5px; border:2px; background-color:#cd9993; border-radius: 15px; ">
                                        <li class="clearfix notify-item">

                                            <a href="/hasta_liste/plan/goruntule/{{$mesaj->plan_sayisi}}/{{$kullanici_id->hasta_id}}?mesajbildirim_id=<?php echo $mesaj->id; ?>">
                                            <div class="notify-content">

                                            <span style="color: black;" class="float-right"><?php $zaman = $mesaj->created_at;
                                                $zaman->setlocale('tr');
                                                echo $zaman->diffForHumans();?></span>

                                                    <?php

                                                    $id = App\User::find($mesaj->ekleyen_id);
                                                    echo $id->name;
                                                    ?>

                                                <p style="color: #000;">
                                                    <?php


                                                    echo $mesaj->mesaj_detay;
                                                    ?>
                                                </p>
                                            </div></a>
                                        </li><!--item-->
                    </div>
                                @endforeach

                                <!--  Okunmus mesajların lıstelenmesı-->
                                @if(count($mesajlarim)<7)

                                    <?php
                                    $gosterilecekmesaj=7-count($mesajlarim);
                                    $mesaj_id=auth()->user()->id;
                                    $mesajlarim=\App\Bildirimler::where('aktif',1)
                                        ->where('gonderilen_id',$mesaj_id)
                                        ->where('mesaj_durum',1)
                                        ->limit($gosterilecekmesaj)
                                        ->orderBy('created_at','desc')
                                        ->get();

                                    ?>

                                        @foreach($mesajlarim as $mesaj)
                                            <?php
                                            $kullanici_id=\App\User::find($mesaj->gonderilen_id);
                                            ?>

                                        <div style=" border:3px;   border-radius:15px;  margin-top: 5px; background-color:lightgrey">
                                            <li class="clearfix notify-item">

                                                <a href="/hasta_liste/plan/goruntule/{{$mesaj->plan_sayisi}}/{{$kullanici_id->hasta_id}}?mesajbildirim_id=<?php echo $mesaj->id; ?>">
                                                    <div class="notify-content">

                                            <span style="color: black;" class="float-right"><?php $zaman = $mesaj->created_at;
                                                $zaman->setlocale('tr');
                                                echo $zaman->diffForHumans();?></span>

                                                        <?php

                                                        $id = App\User::find($mesaj->ekleyen_id);
                                                        echo $id->name;
                                                        ?>

                                                        <p style="color: #000;">
                                                            <?php


                                                            echo $mesaj->mesaj_detay;
                                                            ?>
                                                        </p>
                                                    </div></a>
                                            </li><!--item-->
                                        </div>
                                        @endforeach


                                @endif



                            </ul>
                        </li>
                        <!--Mesaj bitis -->



                        <!--Plan Ayarla baslangıc -->

                        <?php $online_id=auth()->user()->id;

                        $kullanici=\App\User::find($online_id);


                       $bildirimler=\App\Planlama::where('aktif',1)
                                    ->where('hasta_id',$kullanici->hasta_id)
                                    ->where('plan_durum','0')
                                    ->limit(5)
                                    ->get()
                                    ->groupBy('plan_numarasi');


                        ?>
                       <li class="nav-item dropdown ">
                              <a data-toggle="dropdown" href="javascript:void(0)" class=" btn-circle-round dropdown-toggle">
                                  <i class="icon-bullhorn"></i>
                                  <span class="badge bg-danger"><?php echo count($bildirimler); ?></span>
                              </a>
                              <ul class="dropdown-menu dropdown-menu-right notification-dropdown">

                                  <li class="notification-header">
                                            <span class="float-right">
                                                <a href="/planlamaliste">Tüm Bildirimler</a>
                                            </span>
                                      <?php
                                      echo count($bildirimler)."  bildirim";
                                      ?>
                                  </li>

                                  @foreach($bildirimler as $bildirim)
                                      <?php
                                      //$kullanici_id=\App\User::find($bildirim->gonderilen_id);
                                      ?>

                                          <div style=" margin-top:5px; border:2px; background-color:#cd9993; border-radius: 15px; ">

                                      <li class="clearfix notify-item">

                                          <a href="/planlama/{{$bildirim[0]->plan_numarasi}}/{{$bildirim[0]->hasta_id}}?plan_numarasi=<?php echo $bildirim[0]->plan_numarasi; ?>">
                                              <div class="notify-content">

                                            <span style="color: black;" class="float-right"><?php $zaman = $bildirim[0]->created_at;
                                                $zaman->setlocale('tr');
                                                echo $zaman->diffForHumans();?></span>

                                                  <?php

                                                  $id = App\User::find($bildirim[0]->ekleyen_id);
                                                  echo $id->name;
                                                  ?>

                                                  <p style="color: #000;">
                                                      Planlamanız gerekn yeni bir çalışma programanız vardır.
                                                  </p>
                                              </div></a>
                                      </li><!--item-->
                                          </div>
                                      @endforeach


                                  @if(count($bildirimler)<7)

                                      <?php

                                          $limit=7-count($bildirimler);
                                      $online_id=auth()->user()->id;

                                      $kullanici=\App\User::find($online_id);


                                      $bildirimler=\App\Planlama::where('aktif',1)
                                      ->where('hasta_id',$kullanici->hasta_id)
                                      ->where('plan_durum','1')
                                      ->limit($limit)
                                      ->orderBy('created_at','desc')
                                      ->get()
                                      ->groupBy('plan_numarasi');


                                      ?>

                                      @foreach($bildirimler as $bildirim)
                                          <?php
                                          $kullanici_id=\App\User::find($mesaj->gonderilen_id);
                                          ?>

                                          <div style=" border:3px;   border-radius:15px;  margin-top: 5px; background-color:lightgrey">
                                              <li class="clearfix notify-item">
                                                  <a href="/planlama/{{$bildirim[0]->plan_numarasi}}/{{$bildirim[0]->hasta_id}}?plan_numarasi=<?php echo $bildirim[0]->plan_numarasi; ?>">
                                                      <div class="notify-content">

                                            <span style="color: black;" class="float-right"><?php $zaman = $bildirim[0]->created_at;
                                                $zaman->setlocale('tr');
                                                echo $zaman->diffForHumans();?></span>

                                                          <?php

                                                          $id = App\User::find($bildirim[0]->ekleyen_id);
                                                          echo $id->name;
                                                          ?>

                                                          <p style="color: #000;">
                                                              Planlamanız gerekn yeni bir çalışma programanız vardır.
                                                          </p>
                                                      </div></a>
                                              </li><!--item-->
                                          </div>
                                      @endforeach


                                  @endif




                              </ul>
                          </li>
                        <!--Plan Ayarla bitis -->


                        <li class="nav-item dropdown user-item">
                            <a data-toggle="dropdown" href="javascript:void(0)" class=" dropdown-toggle">
                               <!-- <img src="images/user3.jpg" width="50" alt="" class="img-fluid rounded-circle">-->
                                <span class="">  @if(Auth::check())
                                        {{auth()->user()->name}}
                                    @endif</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right profile-dropdown">

                                <li class="dropdown-item">
                                    @if(Auth::check()==false) <a href="/">

                                        <span>Giriş</span>
                                    </a>
                                        @endif
                                </li><!--item-->

                                <li class="dropdown-item">
                                     <a href="/kayit/goruntule"><span>Profil Güncelle</span></a>

                                </li><!--item-->

                                <li class="dropdown-item">

                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       Çıkış
                                        <i class="fa fa-sign-out pull-right"></i></a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                {{--<li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>--}}

                                </li><!--item-->
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </header><!--header-->
        <!--/////////////////////////////// End Header////////////////////////////-->


        <div class="content">
            <div class="container">
                <div class="page-title pt30 pb30">
                    <div class="row">
                        <div class="col-sm-12">


                        </div>



                    </div>
                </div><!--page title-->

                @yield('icerik')

            </div><!--container-->
        </div><!--content-->
    </main><!--main content-->
    <!--/////////////////////////////// End Content////////////////////////////-->


    <!--<footer id="footer" class="page-footer">
        <div class="container">
           &copy; Copyright 2018. assan
        </div>
    </footer>-->
</div><!--page wrapper-->
<!-- jQuery first, then Tether, then Bootstrap JS. -->
<!--dashboard plugins-->





<script src="/Back/js/raphael-min.js"></script>
<script src="/Back/js/plugins/morris-chart/morris.min.js"></script>
<script src="/Back/bower_components/chart.js/dist/Chart.min.js"></script>
<script src="/Back/js/plugins/vector-map/jquery-jvectormap-2.0.2.min.js"></script>
<script src="/Back/js/plugins/vector-map/jquery-jvectormap-world-mill-en.js"></script>

<script type="text/javascript" src="/Back/js/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Back/js/plugins/data-tables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="/Back/js/plugins/data-tables/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="/Back/js/plugins/data-tables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="/Back/js/plugins/data-tables/responsive.bootstrap4.min.js"></script>
<script type="text/javascript" src="/Back/bower_components/toastr/toastr.min.js"></script>
<script type="text/javascript" src="/Back/js/dashboard.custom.js"></script>

<script type="text/javascript" src="/Back/js/data-table.init.js"></script>

<script type="text/javascript" src="/Back/js/plugins/plugins.js"></script>
<script type="text/javascript" src="/Back/js/assan.custom.js"></script>
<script src="/js/sweetalert2.min.js"></script>
<script>
    function sil(r,id) {
        var sira=r.parentNode.parentNode.rowIndex;

        swal({
            title: 'Emin misiniz?',
            text: "Sildiğiniz bilgiyi geri alamayacaksınız!",
            type: 'warning',
            showCancelButton: 'iptal',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'İptal',
            confirmButtonText: 'Evet, Sil!'
        }).then(function(onay) {
            //onay = onay.value = true
            //onay.dismiss = cancel
            if(onay.value){
                var form = document.getElementById("silme_form");
                var input = document.getElementById("silinecek_id");
                input.value = id;
                form.submit();

            }
            return false;
        });

    }

</script>


<script src="/Back/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="/Back/vendors/jquery.inputmask/dist/inputmask/inputmask.phone.extension.js"></script>

<script>
    $("#phone2").mask("(999) 999-9999");
</script>

<!--telefon maskleme ıcın-->
<script>
    window.onload = function() {
        MaskedInput({
            elm: document.getElementById('kurum_arayantelefon'), // select only by id
            format: '0 (___) ___-__-__',
            separator: '0 ()-'
        });

        MaskedInput({
            elm: document.getElementById('phone2'), // select only by id
            format: '0 (___) ___-__-__',
            separator: '0 ()-'
        });
    };

    // masked_input_1.4-min.js
    // angelwatt.com/coding/masked_input.php
    (function(a){a.MaskedInput=function(f){
        if(!f||!f.elm||!f.format)
        {
            return null}
            if(!(this instanceof a.MaskedInput))
            {
                return new a.MaskedInput(f)}
                var o=this,d=f.elm,s=f.format,i=f.allowed||"0123456789",h=f.allowedfx||function(){return true},p=f.separator||"/:-",n=f.typeon||"_YMDhms",c=f.onbadkey||function(){},q=f.onfilled||function(){},w=f.badkeywait||0,A=f.hasOwnProperty("preserve")?!!f.preserve:true,l=true,y=false,t=s,j=(function(){if(window.addEventListener){return function(E,C,D,B){E.addEventListener(C,D,(B===undefined)?false:B)}}if(window.attachEvent){return function(D,B,C){D.attachEvent("on"+B,C)}}return function(D,B,C){D["on"+B]=C}}()),u=function(){for(var B=d.value.length-1;B>=0;B--){for(var D=0,C=n.length;D<C;D++){if(d.value[B]===n[D]){return false}}}return true},x=function(C){try{C.focus();if(C.selectionStart>=0){return C.selectionStart}if(document.selection){var B=document.selection.createRange();return -B.moveStart("character",-C.value.length)}return -1}catch(D){return -1}},b=function(C,E){try{if(C.selectionStart){C.focus();C.setSelectionRange(E,E)}else{if(C.createTextRange){var B=C.createTextRange();B.move("character",E);B.select()}}}catch(D){return false}return true},m=function(D){D=D||window.event;var C="",E=D.which,B=D.type;if(E===undefined||E===null){E=D.keyCode}if(E===undefined||E===null){return""}switch(E){case 8:C="bksp";break;case 46:C=(B==="keydown")?"del":".";break;case 16:C="shift";break;case 0:case 9:case 13:C="etc";break;case 37:case 38:case 39:case 40:C=(!D.shiftKey&&(D.charCode!==39&&D.charCode!==undefined))?"etc":String.fromCharCode(E);break;default:C=String.fromCharCode(E);break}return C},v=function(B,C){if(B.preventDefault){B.preventDefault()}B.returnValue=C||false},k=function(B){var D=x(d),F=d.value,E="",C=true;switch(C){case (i.indexOf(B)!==-1):D=D+1;if(D>s.length){return false}while(p.indexOf(F.charAt(D-1))!==-1&&D<=s.length){D=D+1}if(!h(B,D)){c(B);return false}E=F.substr(0,D-1)+B+F.substr(D);if(i.indexOf(F.charAt(D))===-1&&n.indexOf(F.charAt(D))===-1){D=D+1}break;case (B==="bksp"):D=D-1;if(D<0){return false}while(i.indexOf(F.charAt(D))===-1&&n.indexOf(F.charAt(D))===-1&&D>1){D=D-1}E=F.substr(0,D)+s.substr(D,1)+F.substr(D+1);break;case (B==="del"):if(D>=F.length){return false}while(p.indexOf(F.charAt(D))!==-1&&F.charAt(D)!==""){D=D+1}E=F.substr(0,D)+s.substr(D,1)+F.substr(D+1);D=D+1;break;case (B==="etc"):return true;default:return false}d.value="";d.value=E;b(d,D);return false},g=function(B){if(i.indexOf(B)===-1&&B!=="bksp"&&B!=="del"&&B!=="etc"){var C=x(d);y=true;c(B);setTimeout(function(){y=false;b(d,C)},w);return false}return true},z=function(C){if(!l){return true}C=C||event;if(y){v(C);return false}var B=m(C);if((C.metaKey||C.ctrlKey)&&(B==="X"||B==="V")){v(C);return false}if(C.metaKey||C.ctrlKey){return true}if(d.value===""){d.value=s;b(d,0)}if(B==="bksp"||B==="del"){k(B);v(C);return false}return true},e=function(C){if(!l){return true}C=C||event;if(y){v(C);return false}var B=m(C);if(B==="etc"||C.metaKey||C.ctrlKey||C.altKey){return true}if(B!=="bksp"&&B!=="del"&&B!=="shift"){if(!g(B)){v(C);return false}if(k(B)){if(u()){q()}v(C,true);return true}if(u()){q()}v(C);return false}return false},r=function(){if(!d.tagName||(d.tagName.toUpperCase()!=="INPUT"&&d.tagName.toUpperCase()!=="TEXTAREA")){return null}if(!A||d.value===""){d.value=s}j(d,"keydown",function(B){z(B)});j(d,"keypress",function(B){e(B)});j(d,"focus",function(){t=d.value});j(d,"blur",function(){if(d.value!==t&&d.onchange){d.onchange()}});return o};o.resetField=function(){d.value=s};o.setAllowed=function(B){i=B;o.resetField()};o.setFormat=function(B){s=B;o.resetField()};o.setSeparator=function(B){p=B;o.resetField()};o.setTypeon=function(B){n=B;o.resetField()};o.setEnabled=function(B){l=B};return r()}}(window));
</script>

@yield('js')
</body>
</html>
