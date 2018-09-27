@extends('backend.app')

@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Egzersiz Çalışma Planı Oluşturma
                        <small></small>
                    </h3>

                    <div id="dikkat" align="center" class="alert alert-danger">
                        <strong>Dikkat!!!</strong>Bu alanda size ait olan planların çalışma günlerini
                        belirleyeblirsiniz.Kendinize göre özelleştirme yapınız.
                    </div>


                </div>


            </div>

            <div class="clearfix"></div>


            <div align="right">


                <a href={{url("/planlamaliste")}}>
                    <button type="submit" class="btn btn-success btn-sm">Geri Dön</button>
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
                            $ekleyen_id = \App\User::find($hastaya_atanan_setler->ekleyen_id);

                            $setleri = \App\Planlama::where('plan_numarasi', $sayi)->where('hasta_id', $id)->where('aktif', 1)->first();

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


                                $setler_id = \App\Planlama::where('plan_numarasi', $sayi)->where('hasta_id', $id)->get();


                                for($i = 0;$i < count($setler_id);$i++){


                                $kategori_id = \App\Egzersiz::where('egzersiz_isim', $setler_id[$i]->egzersiz_isim)->first();

                                if (in_array($kategori_id->egzersiz_kategori, $verim)) {


                                ?>


                                <form action="{{url('/program/planlama')}}" method="post">
                                    {{csrf_field()}}
                                    <table id="data-table" class="table table-striped table-bordered" cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Egzersiz İsmi</th>
                                            <th>Haftalık Tekrar</th>
                                            <th>Pazartesi</th>
                                            <th>Salı</th>
                                            <th>Çarşamba</th>
                                            <th>Perşembe</th>
                                            <th>Cuma</th>
                                            <th>Cumartesi</th>
                                            <th>Pazar</th>


                                        </tr>
                                        </thead>

                                        <?php $i = count($setler_id) * 2; }}
                                        ?>

                                        <tbody>


                                        <?php
                                        $egzersiz_sayi = \App\Egzersiz::where('aktif', 1)->get()->groupBy('egzersiz_isim');

                                        $say = 1;

                                        $setler_id = \App\Planlama::where('plan_numarasi', $sayi)->where('hasta_id', $id)->where('aktif', 1)->get();




                                        $sayac = 0;
                                        for($i = 0;$i < count($setler_id);$i++){

                                        $sirasi = 1;

                                        $kategori_id = \App\Egzersiz::where('egzersiz_isim', $setler_id[$i]->egzersiz_isim)->where('aktif', 1)->first();

                                        if (in_array($kategori_id->egzersiz_kategori, $verim)) {


                                        $egzersiz_var_ilk++;

                                        $tekrar_sayisi = explode(" ", $setler_id[$i]->haftalik_tekrar)

                                        ?>


                                        <tr>
                                            <input type="hidden" id="planlama-{{$sayac}}" value="{{$tekrar_sayisi[1]}}">

                                            <input type="hidden" name="egzersiz_isim-{{$sayac}}"
                                                   value="{{$setler_id[$i]->egzersiz_isim}}">
                                            <input type="hidden" name="hasta_id" value="{{$setler_id[$i]->hasta_id}}">
                                            <input type="hidden" name="plan_numarasi" value="{{$sayi}}">


                                            <td>{{$say++}}</td>
                                            <td>{{$setler_id[$i]->egzersiz_isim}}</td>
                                            <td>
                                                <div align="center">{{$setler_id[$i]->haftalik_tekrar}}</div>
                                            </td>
                                            <td>
                                                <div align="center"><input class="a-{{$sayac}}" onclick="gunsay(this)"
                                                                           id="planlama-{{$sayac}}" type="checkbox"
                                                                           @if($setler_id[$i]->pazartesi=='1') checked="checked" @endif
                                                                           name="pazartesi-{{$sayac}}"></div>
                                            </td>

                                            <td>
                                                <div align="center"><input class="a-{{$sayac}}"  onclick="gunsay(this)"
                                                                           @if($setler_id[$i]->sali=='1') checked @endif
                                                                           id="planlama-{{$sayac}}" type="checkbox"
                                                                           name="sali-{{$sayac}}"></div>
                                            </td>

                                            <td>
                                                <div align="center"><input class="a-{{$sayac}}" onclick="gunsay(this)"
                                                                           id="planlama-{{$sayac}}" type="checkbox"
                                                                           @if($setler_id[$i]->carsamba=='1') checked @endif
                                                                           name="carsamba-{{$sayac}}"></div>
                                            </td>

                                            <td>
                                                <div align="center"><input class="a-{{$sayac}}" onclick="gunsay(this)"
                                                                           id="planlama-{{$sayac}}" type="checkbox"
                                                                           @if($setler_id[$i]->persembe=='1') checked @endif
                                                                           name="persembe-{{$sayac}}"></div>
                                            </td>

                                            <td>
                                                <div align="center"><input class="a-{{$sayac}}" onclick="gunsay(this)"
                                                                           id="planlama-{{$sayac}}" type="checkbox"
                                                                           @if($setler_id[$i]->cuma=='1') checked @endif
                                                                           name="cuma-{{$sayac}}"></div>
                                            </td>

                                            <td>
                                                <div align="center"><input class="a-{{$sayac}}" onclick="gunsay(this)"
                                                                           id="planlama-{{$sayac}}" type="checkbox"
                                                                           @if($setler_id[$i]->cumartesi=='1') checked @endif
                                                                           name="cumartesi-{{$sayac}}"></div>
                                            </td>

                                            <td>
                                                <div align="center"><input class="a-{{$sayac}}" onclick="gunsay(this)"
                                                                           id="planlama-{{$sayac}}" type="checkbox"
                                                                           @if($setler_id[$i]->pazar=='1') checked @endif
                                                                           name="pazar-{{$sayac}}"></div>
                                            </td>

                                        </tr>


                                        <?php  }$sayac++;

                                        }?>

                                        @if($egzersiz_var_ilk>$egzersiz_var_sonraki)
                                            <h4 id="plan">Egzersiz kategorisi:{{$kategori->kategori_ad}}</h4>
                                            <?php $egzersiz_var_sonraki = $egzersiz_var_ilk;?>
                                        @endif

                                        @endforeach


                                        </tbody>
                                    </table>

                                    <input type="hidden" id="veri_sayisi" name="veri_sayisi" value="{{$sayac}}">

                                    <button onclick="return plansay()" class="btn btn-success">Planı Gönder</button>
                                </form>

                                <br>
                                <br>




                                @if(auth()->user()->yetki!=4)

                                    <div align="left">

                                        <a href={{url("/hasta_liste/plan/guncelle/".$sayi."/".$id)}}>
                                            <button type="submit" class="btn btn-success bnt-xs">Plan Güncelle</button>
                                        </a>

                                    </div>
                                @endif


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

        function numberOfChecked(checkboxclass) {
            var boxes = document.getElementsByClassName(checkboxclass);
            var number = 0;
            for (var i = 0; i < boxes.length; i++) {
                if (boxes[i].checked) number++;
            }
            return number;
        }

        function gunsay(element) {

            //her tıklanan elementın class name ını alıyoruz
            var boxes = element.className;

            //her tıklanan elementin id sini alıyoruz
            var id = element.id;

            //id sı gelen degerın value sını cekıyoruz
            var deger = parseInt(document.getElementById(id).value);

            //yukarda yazdıgımız fonksıyondan gelen classname inin checked sayısını donduruyoruz
            var number = numberOfChecked(boxes);

            //checked sayısı ile bızım sakladıgımız değeri karşılaştırıyoruz
            //o degerden buyuk olursa işaretlemeyi engelliyoruz
            if (number > deger && element.checked == true) {
                element.checked = false;
                alert('Egzersiz için planlama yapılmıştır. \nBu egzersiz haftada ' + deger + ' gun olarak belirlenmiştir')
            }

            console.log(boxes)
            console.log(id);
            console.log(deger);
            console.log(number);

        }

    </script>




    <script>

        //butun egzerszilerın uygun degerlere gore doldurulması kontrooleri
        function plansay() {

            var if_girme = 0;
            //dongu sayısı nı bulmak ıcn
            var verisayisi = document.getElementById("veri_sayisi").value;


            for (var i = 0; i < parseInt(verisayisi); i++) {

                var inputdeger = parseInt(document.getElementById("planlama-" + i).value);

                var boxes = document.getElementsByClassName("a-" + i);
                var sayac = 0;
                for (var j = 0; j < boxes.length; j++) {
                    if (boxes[j].checked) {
                        sayac++;
                    }
                }

                if (sayac < inputdeger && if_girme == 0) {
                    alert('Egzersizler için gün seçimleriniz eksik girilmiştir.\nLütfen girdilerinizi kontrol edin ');

                    var sonuc = "olumsuz";

                    if_girme++;
                } else if (if_girme >= 1) {

                    var sonuc = "olumsuz";
                } else {

                    var sonuc = "uygun";
                }
                console.log(inputdeger);
                console.log(verisayisi);
            }

            if (sonuc == "uygun") {
                return true;
            }
            else {
                return false;
            }

        }
    </script>
@endsection