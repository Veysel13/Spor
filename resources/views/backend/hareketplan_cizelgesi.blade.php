@extends('backend.app')

@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Seçilen Hareketler<small></small></h3>

                    <div id="dikkat" align="center" class="alert alert-danger">
                        <strong>Dikkat!!!</strong>Eksik girdiğiniz egzersiz varsa.Lütfen Geri Dönünüz.
                    </div>

                    <div align="right">

                       <!-- <p id="yanip-sonen">Eksik Girdiğiniz Egzeriz varsa</p>-->

                        <a  href="/egzersizplan"><button type="submit" class="btn btn-warning bnt-xs">Geri Dön</button></a>

                    </div>

                </div>



            </div>

            <div class="clearfix"></div>




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
                            <?php $hasta_id=\App\Hastalar::find($id['hasta_id']);
                                  $ekleyen_id=\App\User::find($id['ekleyen_id']);
                            ?>

                            <div id="eklenme_bilgileri">

                            <h5 id="plan">Hasta Adı=<?php echo $hasta_id->hasta_ad." ".$hasta_id->hasta_soyad; ?></h5>
                            <h5 id="plan">Eklenme Zamanı=<?php echo $id['eklenme_zamani']; ?></h5>
                            <h5 id="plan">Ekleyen Kişi=<?php echo $ekleyen_id->name;?></h5>
                            </div>

                            <br>
                            <br>
                            <div id="program_bilgileri">
                                <h5 id="plan">Başlangıç Tarihi=<?php echo $id['baslangic_tarihi'];?></h5>
                                <h5 id="plan">Bitiş Tarihi=<?php echo $id['bitis_tarihi'];?></h5>
                                <h5 id="plan">Program Adı=<?php echo $id['program_adi'];?></h5>
                            </div>


                            <br>
                            <br><br>






                            <form id="form" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data" method="POST" action="{{url('/sessionhareket_plan/kaydet/')}}"  >

                                {{csrf_field()}}




                                <?php //$kategoriler=\App\Egzersizkategori::where('aktif',1)->get()->groupBy('kategori_ust');
                                $kategoriler=\App\Egzersizkategori::where('kategori_ust',0)->where('aktif',1)->get();
                                      $k=1; ?>
                                @foreach ($kategoriler as $kategori)


                                   <?php $egzersiz_var_ilk=0;
                                         $egzersiz_var_sonraki=0;

                                          $datam=[];
                                          $verim=egzersizkategori_id($egzersiz_kategorileri_id[$k-1]);


                                    $k++;


                                    $sayac=\App\Egzersiz::where('aktif',1)->get()->groupBy('egzersiz_isim');

                                    for($i=1;$i<=count($sayac);$i++){

                                    if( isset($id['egzersiz-'.$i])){

                                    $kategori_id=\App\Egzersiz::where('egzersiz_isim',$id['egzersiz-'.$i])->where('aktif',1)->first();

                                    if (in_array($kategori_id->egzersiz_kategori, $verim)) {
                                    ?>







                                    <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>


                                        <tr>
                                            <th>S.No</th>
                                            <th>Egzersiz İsmi</th>
                                            <th>Set</th>
                                            <th>Tekrar</th>
                                            <th>Dinlenme</th>
                                            <th>Günlük Tekrar</th>
                                            <th>Haftalık Tekrar</th>


                                        </tr>

                                        </thead>

                                        <?php $i=count($sayac)*2; }}}
                                        ?>
                                        <tbody>


                                        <?php

                                        $sayi=\App\Egzersiz::where('aktif',1)->get()->groupBy('egzersiz_isim');

                                        $say=1;

                                        for($i=1;$i<=count($sayi);$i++){

                                        if( isset($id['egzersiz-'.$i])){

                                        $kategori_id=\App\Egzersiz::where('egzersiz_isim',$id['egzersiz-'.$i])->where('aktif',1)->first();

                                        if (in_array($kategori_id->egzersiz_kategori, $verim)) {

                                        $egzersiz_var_ilk++;


                                        ?>

                                        <tr>

                                            <td>{{$say++}}</td>
                                            <td>{{ $id['egzersiz-'.$i]}}</td>
                                            <td>{{ $id['set-'.$i]}}</td>
                                            <td>{{ $id['tekrar-'.$i]}}</td>
                                            <td>{{ $id['dinlenme-'.$i]}}</td>
                                            <td>{{ $id['gunluk_tekrar-'.$i]}}</td>
                                            <td>{{ $id['haftalik_tekrar-'.$i]}}</td>

                                        </tr>


                                        <?php }}}
                                        ?>

                                        @if($egzersiz_var_ilk>$egzersiz_var_sonraki)
                                        <h4 id="plan">Egzersiz kategorisi:{{$kategori->kategori_ad}}</h4>
                                       <?php $egzersiz_var_sonraki=$egzersiz_var_ilk;?>
                                        @endif


                                @endforeach




                                </tbody>
                            </table>

                                       <br>
                                       <br>

                                       <div class="container">
                                          <!-- <h2>Oluşturulan Egzersiz Planı İçin Yorum Yazabilirsiniz</h2>-->


                                               <div class="form-group">
                                                   <label for="comment">Yorum Alanı:</label>
                                                   <textarea class="form-control" placeholder="Oluşturlan plana ait yarum yazabilirsiniz" rows="5" autofocus id="comment" name="yorum"></textarea>
                                               </div>

                                       </div>




                                       <div class="account-wrap">
                                           <div class="account-card">
                                               <div class="account-content smart-forms">





                                                                <button type="submit" class="btn btn-success">Hastaya Ata</button>


                                                               <label for="rate1" class="option">
                                                                   <input type="checkbox" id="rate1" name="taslak_program">
                                                                   <span class="smart-option  smart-checkbox">
                                                                            <span class="smart-option-ui"> <i class="iconc"></i> Taslak Olarak Kaydet </span>
                                                                        </span>
                                                               </label>





                                               </div>
                                           </div>
                                       </div>



                            </form>

                            <div align="right">

                            <a href="{{url('/egzersizplan/iptalet')}}"><button type="submit" class="btn btn-danger">İptal Et</button></a>


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
    <link href="/Back/smart-form/smart-templates/css/smart-forms.css" rel="stylesheet">
    <link href="/Back/css/style.css" rel="stylesheet">
    <link href="/Back/js/plugins/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/Back/js/plugins/data-tables/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/Back/js/plugins/data-tables/responsive.bootstrap4.min.css" rel="stylesheet">

    <link href="/Back/css/plugins/plugins.css" rel="stylesheet">
    <link href="/Back/smart-form/smart-templates/css/smart-forms.css" rel="stylesheet">
    <link href="/Back/css/style.css" rel="stylesheet">


    <style>
        #dikkat{
            margin-top: 20px;
            width: 600px;
            margin-left:200px;
            color: black;
        }

        #eklenme_bilgileri{


        }
        #program_bilgileri{


        }

        #plan{
            float: left;
            margin: 0px 50px 15px 0px;
            background-size: 50px;
            background-color: rgba(21, 99, 111, 0.11);
            border-radius: 5px;
            font-family: Segoe UI, Helvetica, Arial, sans-serif;
            color:grey;
            padding: 5px 5px 5px 5px;

        }

        #program{
            margin-left: 0px;
        }

        #yanip-sonen{

            background-color: #c484bf;
            height: 30px;
            width:200px;
            color: #ffbcd1;
            font-size:15px;
        }
    </style>


@endsection

@section('js')

    <script type="text/javascript" src="/Back/js/plugins/plugins.js"></script>
    <script type="text/javascript" src="/Back/js/assan.custom.js"></script>


@endsection