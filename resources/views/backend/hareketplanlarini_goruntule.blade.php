@extends('backend.app')

@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hastaya Atanmış Hareketler
                        <small></small>
                    </h3>


                </div>


            </div>

            <div class="clearfix"></div>


            <div align="right">


                <a href={{url("/hasta_liste/guncelle/".$id)}}>
                    <button type="submit" class="btn btn-success bnt-xs">Geri Dön</button>
                </a>

            </div>


            @if($errors->any())

                <div id="dikkat" class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>

                        @endforeach


                    </ul>
                </div>

            @endif


            <div class="row">


                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="card-content pb20">
                            <p class="text-muted font-13 m-b-30">
                            </p>
                            <?php $hasta_id = \App\Hastalar::find($id);
                            $ekleyen_id = \App\User::find($hasta_id->ekleyen_id);

                            $setleri = \App\Setler::where('plan_sayisi', $sayi)->where('hasta_id', $id)->where('aktif', 1)->first();




                            ?>

                            <div id="eklenme_bilgileri">
                                <h5 id="plan">Hasta
                                    Adı=<?php echo $hasta_id->hasta_ad . " " . $hasta_id->hasta_soyad; ?></h5>
                                <h5 id="plan">Eklenme Zamanı= <?php echo substr($setleri->created_at, 0, 10); ?></h5>
                                <h5 id="plan">Ekleyen Kişi=<?php echo $ekleyen_id->name;?></h5>

                            </div>
                            <br>
                            <br>

                            <div id="program_bilgileri">
                                <h5 id="plan">Başlangıç
                                    Tarihi=<?php echo $hastaya_atanan_setler->baslangic_tarihi; ?></h5>
                                <h5 id="plan">Bitiş Tarihi=<?php echo $hastaya_atanan_setler->bitis_tarihi;?></h5>
                                <h5 id="plan">Program Adı=<?php echo $hastaya_atanan_setler->program_adi;?></h5>
                            </div>

                            <br>
                            <br>
                            <br>
                            <br>


                            <?php  $kategoriler = \App\Egzersizkategori::where('kategori_ust', 0)->where('aktif', 1)->get();
                            $k = 1;
                            ?>
                            @foreach ($kategoriler as $kategori)


                                <?php $egzersiz_var_ilk = 0;
                                $egzersiz_var_sonraki = 0;

                                $datam = []; $verim = egzersizkategori_id($egzersiz_kategorileri_id[$k - 1]);


                                $k++;


                                $setler_id = \App\Setler::where('plan_sayisi', $sayi)->where('hasta_id', $id)->get();


                                for($i = 0;$i < count($setler_id);$i++){


                                $kategori_id = \App\Egzersiz::where('egzersiz_isim', $setler_id[$i]->egzersiz_isim)->first();

                                if (in_array($kategori_id->egzersiz_kategori, $verim)) {

                                ?>



                                <table id="data-table" class="table table-striped table-bordered" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Egzersiz İsmi</th>
                                        <th>Set</th>
                                        <th>Tekrar</th>
                                        <th>Dinlenme</th>
                                        <th>Gunluk Tekrar</th>
                                        <th>Haftalık Tekrar</th>


                                    </tr>
                                    </thead>

                                    <?php $i = count($setler_id) * 2; }}
                                    ?>

                                    <tbody>


                                    <?php
                                    $egzersiz_sayi = \App\Egzersiz::where('aktif', 1)->get()->groupBy('egzersiz_isim');

                                    $say = 1;

                                    $setler_id = \App\Setler::where('plan_sayisi', $sayi)->where('hasta_id', $id)->where('aktif', 1)->get();





                                    for($i = 0;$i < count($setler_id);$i++){


                                    $kategori_id = \App\Egzersiz::where('egzersiz_isim', $setler_id[$i]->egzersiz_isim)->where('aktif', 1)->first();

                                    if (in_array($kategori_id->egzersiz_kategori, $verim)) {


                                    $egzersiz_var_ilk++;

                                    ?>

                                    <tr onclick="haro('{{$setler_id[$i]->egzersiz_isim }}')">

                                        <?php $egzersizisim = $setler_id[$i]->egzersiz_isim;?>
                                        <td>{{$say++}}</td>
                                        <td id="mytablet_tr">{{$setler_id[$i]->egzersiz_isim }}</td>
                                        <td>{{$setler_id[$i]->set }}</td>
                                        <td>{{$setler_id[$i]->tekrar }}</td>
                                        <td>{{$setler_id[$i]->dinlenme }}</td>
                                        <td>{{$setler_id[$i]->gunluk_tekrar }}</td>
                                        <td>{{$setler_id[$i]->haftalik_tekrar }}</td>

                                    </tr>
                                    <?php }}?>

                                    @if($egzersiz_var_ilk>$egzersiz_var_sonraki)
                                        <h4 id="plan">Egzersiz kategorisi:{{$kategori->kategori_ad}}</h4>
                                        <?php $egzersiz_var_sonraki = $egzersiz_var_ilk;?>
                                    @endif

                                    @endforeach


                                    </tbody>
                                </table>

                                <br>
                                <br>

                                @if(isset($yorum))
                                    <?php
                                    $yorum_ismi = \App\User::where('id', $yorum->ekleyen_id)->first();
                                    ?>
                                    <div class="container">
                                        <!-- <h2>Oluşturulan Egzersiz Planı İçin Yorum Yazabilirsiniz</h2>-->
                                        <div class="alert alert-success">
                                            <i class="fa fa-user-md"></i>
                                            <strong>{{$yorum_ismi->name}}</strong>
                                            <strong> {{$yorum->created_at}}</strong> <br>
                                            {{$yorum->yorum}}
                                        </div>

                                    </div>

                                @endif



                                @if(auth()->user()->yetki!=4)

                                    <div align="left">

                                        <a href={{url("/hasta_liste/plan/guncelle/".$sayi."/".$id)}}>
                                            <button type="submit" class="btn btn-success bnt-xs">Plan Güncelle</button>
                                        </a>

                                    </div>
                            @endif


                            <!--  <div align="right">
                                        <form method="post" action="{{url('/upload')}}">

                                            {{csrf_field()}}
                                    <input type="hidden" name="plan_sayisi" value="{{$sayi}}">
                                            <input type="hidden" name="hasta_id" value="{{$id}}">

                                            <input type="submit" id="MyButton" value="Word Çıktısı Al">
                                        </form>


                                    </div>-->

                                <div align="right">
                                    <form method="post" action="{{url('/pdfal2')}}">

                                        {{csrf_field()}}

                                        <input type="hidden" name="plan_sayisi" value="{{$sayi}}">
                                        <input type="hidden" name="hasta_id" value="{{$id}}">

                                        <input type="submit" id="MyButton" value="Pdf Çıktısı Al">
                                    </form>
                                </div>


                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection

@section('css')
    <link href="/Back/css/plugins/plugins.css" rel="stylesheet">
    <link href="/Back/js/plugins/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/Back/js/plugins/data-tables/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/Back/js/plugins/data-tables/responsive.bootstrap4.min.css" rel="stylesheet">
    <link href="/Back/linearicons/fonts.css" rel="stylesheet">
    <link href="/Back/css/style.css" rel="stylesheet">

    <style>

        #dikkat {
            margin-top: 20px;
            width: 600px;
            margin-left: 200px;
            color: black;
        }

        #eklenme_bilgileri {

        }

        #program_bilgileri {

            margin-top: 30px;
        }

        #plan {
            float: left;
            margin: 0px 50px 15px 0px;
            background-size: 50px;
            background-color: rgba(21, 99, 111, 0.11);
            border-radius: 5px;
            font-family: Segoe UI, Helvetica, Arial, sans-serif;
            color: grey;
            padding: 5px 5px 5px 5px;

        }

        #yanip-sonen {

            background-color: #c484bf;
            height: 30px;
            width: 200px;
            color: #ffbcd1;
            font-size: 15px;
        }
    </style>

@endsection

@section('js')


    <script>
        function haro(element) {
            var deger=element;
            $(location).attr('href', '/EgzersizDetay/'+deger);
        }
    </script>
    <script>
        $('#myButton').click(function () {
            //get your Div HTML tring
            var s = $('#myHTMLDiv').text();
            $('#htmlstring').val(s);
        });
    </script>
@endsection