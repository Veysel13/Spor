@extends('backend.app')

@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Egzersiz Listesi<small></small></h3>
                </div>

                <form  method="" action="{{url('/egzersiz')}}">
                    <div align="right" class="col-md-6 col-sm-6 col-xs-12">
                        <button  type="submit" class="btn btn-warning bnt-xs">Egzersiz Ekle</button>
                    </div>
                </form>

                <form action="{{url('/egzersizliste')}}" method="get" >
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">

                                <input type="text" name="arama" class="form-control" placeholder="Egzersiz ismi giriniz..">
                                <span class="input-group-btn">

                                    <button class="btn btn-default"  type="submit">Ara!</button>

                    </span>
                            </div>
                        </div>
                    </div></form>
            </div>

            <div class="clearfix"></div>


            @if($errors->any())

                <div class="alert-danger">
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
                            <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Resim</th>
                                    <th>Resim İki</th>
                                    <th>Ekleyen</th>
                                    <th>Egzersiz İsmi</th>
                                    <th>Egzersiz Kategori</th>
                                    <th>Hareketler</th>
                                    <th>Bölgeler</th>
                                    <th>Eklemler</th>
                                    <th>Hareketler</th>

                                    <th>Eklenme Zamanı</th>
                                    <th>Sil</th>
                                    <th>Görüntüle</th>




                                </tr>
                                </thead>


                                <tbody>

                                @if(isset($_GET['arama']))


                                    <?php $say=0; ?>
                                    @foreach($egzersizarama as $egzersiz)
                                        <tr>
                                            <?php $say++;

                                            $gonderen_id=$egzersiz->ekleyen_id;
                                            $id=App\User::find($gonderen_id);


                                            $kategoriid=$egzersiz->egzersiz_kategori;
                                            $kategori=App\Egzersizkategori::find($kategoriid);


                                                    $hareket_id=$egzersiz->egzersiz_hareket;
                                                    $hareket=App\Hareketolustur::find($hareket_id);




                                            ?>
                                            <td>{{$say}}</td>
                                                <td>@if($egzersiz->resim==null)<img src="/gallery/indir.png" height="70px" width="100px">@else<img src="{{asset($egzersiz->resim)}}" height="70" width="100"> @endif  </td>
                                                <td>@if($egzersiz->resim_iki==null)<img src="/gallery/indir.png" height="70px" width="100px">@else<img src="{{asset($egzersiz->resim_iki)}}" height="70" width="100"> @endif  </td>

                                                <td>{{$id->name}}</td>
                                            <td>{{$egzersiz->egzersiz_isim}}</td>
                                            <td>{{$kategori->kategori_ad}}</td>
                                                <td> {{$hareket->baslik}}</td>


                                                <td>


                                                        <?php
                                                        $a=[];
                                                        $hareket_id=$egzersiz->egzersiz_hareket;
                                                        $hareket=App\Hareketolustur::find($hareket_id);
                                                        $bolge=\App\Bolgeler::find($hareket->bolge);




                                                        //$a=array($bolge->isim,$eklem->isim,$hareket->isim);
                                                        array_push($a,$bolge->isim);





                                                    $b=array_unique($a);
                                                    foreach ($b as $veri){
                                                        echo $veri."<br>";
                                                    }

                                                    ?>

                                                </td>


                                                <td>


                                                    <?php
                                                    $c=[];
                                                    $hareket_id=$egzersiz->egzersiz_hareket;
                                                    $hareket=App\Hareketolustur::find($hareket_id);
                                                    $eklem=\App\Eklemler::find($hareket->eklem);




                                                    //$a=array($bolge->isim,$eklem->isim,$hareket->isim);
                                                    array_push($c,$eklem->isim);





                                                    $d=array_unique($c);
                                                    foreach ($d as $veri){
                                                        echo $veri."<br>";
                                                    }

                                                    ?>

                                                </td>



                                                <td>


                                                    <?php
                                                    $e=[];
                                                    $hareket_id=$egzersiz->egzersiz_hareket;
                                                    $hareket=App\Hareketolustur::find($hareket_id);
                                                    $tur=\App\Bolgeler::find($hareket->hareket);




                                                    //$a=array($bolge->isim,$eklem->isim,$hareket->isim);
                                                    array_push($e,$tur->isim);





                                                    $f=array_unique($e);
                                                    foreach ($f as $veri){
                                                        echo $veri."<br>";
                                                    }

                                                    ?>

                                                </td>

                                            <?php $zaman=$egzersiz->created_at;
                                            $zaman->setlocale('tr');?>

                                            <td>{{$zaman->diffForHumans()}}</td>
                                                <div style="display:none">
                                                    <form action="{{url('/egzersizliste/sil')}}" method="POST" id="silme_form">
                                                        {{csrf_field()}}
                                                        <input id="silinecek_id" name="id">
                                                    </form>
                                                </div>
                                                <td><input onclick="sil(this,'{{$egzersiz->id}}')"  type="button" class="btn btn-danger" value="sil"></td>



                                            <td><a href="{{url('/egzersizliste/guncelle/'.$egzersiz->id)}}" class="btn btn-primary">Görüntüle</a></td>


                                        </tr>
                                    @endforeach



                                @else
                                    <?php $say=0;  ?>
                                    @if(isset($egzersizler))
                                    @foreach($egzersizler as $egzer)



                                        <?php $say++;

                                        $kolon=count($egzer);



                                        $gonderen_id=$egzer[0]->ekleyen_id;
                                        $id=App\User::find($gonderen_id);


                                        $kategoriid=$egzer[0]->egzersiz_kategori;
                                        $kategori=App\Egzersizkategori::find($kategoriid);

                                        ?>

                                        <tr>

                                            <td>{{$say}}</td>
                                            <td>@if($egzer[0]->resim==null)<img src="/gallery/indir.png" height="70px" width="100px">@else<img src="{{asset($egzer[0]->resim)}}" height="70" width="100"> @endif  </td>
                                            <td>@if($egzer[0]->resim_iki==null)<img src="/gallery/indir.png" height="70px" width="100px">@else<img src="{{asset($egzer[0]->resim_iki)}}" height="70" width="100"> @endif  </td>

                                            <td>{{$id->name}}</td>
                                            <td>{{$egzer[0]->egzersiz_isim}}</td>
                                            <td>{{$kategori->kategori_ad}}</td>


                                            <td>
                                                @foreach($egzer as $egzersiz)

                                                    <?php
                                                    $hareket_id=$egzersiz->egzersiz_hareket;
                                                    $hareket=App\Hareketolustur::find($hareket_id);
                                                    ?>

                                                    {{$hareket->baslik}}
                                                    <br>
                                                        <br>
                                                @endforeach
                                            </td>

                                            <td>
                                                <?php $a=[]; ?>
                                                @foreach($egzer as $egzersiz)

                                                    <?php
                                                    $hareket_id=$egzersiz->egzersiz_hareket;
                                                    $hareket=App\Hareketolustur::find($hareket_id);
                                                    $bolge=\App\Bolgeler::find($hareket->bolge);





                                                  //$a=array($bolge->isim,$eklem->isim,$hareket->isim);
                                                        array_push($a,$bolge->isim);
                                                    ?>

                                                @endforeach

                                               <?php
                                                        $b=array_unique($a);
                                                        foreach ($b as $veri){
                                                            echo $veri."<br>";
                                                        }

                                                    ?>

                                            </td>


                                            <td>
                                                <?php $c=[]; ?>
                                                @foreach($egzer as $egzersiz)

                                                    <?php
                                                    $hareket_id=$egzersiz->egzersiz_hareket;
                                                    $hareket=App\Hareketolustur::find($hareket_id);
                                                    $eklem=\App\Eklemler::find($hareket->eklem);





                                                    //$a=array($bolge->isim,$eklem->isim,$hareket->isim);
                                                    array_push($c,$eklem->isim);
                                                    ?>

                                                @endforeach

                                                <?php
                                                $d=array_unique($c);
                                                foreach ($d as $veri){
                                                    echo $veri."<br>";
                                                }

                                                ?>

                                            </td>

                                            <td>
                                                <?php $e=[]; ?>
                                                @foreach($egzer as $egzersiz)

                                                    <?php
                                                    $hareket_id=$egzersiz->egzersiz_hareket;
                                                    $hareket=App\Hareketolustur::find($hareket_id);
                                                    $hareket=\App\Hareketturu::find($hareket->hareket);





                                                    //$a=array($bolge->isim,$eklem->isim,$hareket->isim);
                                                    array_push($e,$hareket->isim);
                                                    ?>

                                                @endforeach

                                                <?php
                                                $f=array_unique($e);
                                                foreach ($f as $veri){
                                                    echo $veri."<br>";
                                                }

                                                ?>

                                            </td>


                                            <?php $zaman=$egzersiz->created_at;
                                            $zaman->setlocale('tr');?>

                                            <td>{{$zaman->diffForHumans()}}</td>
                                            <td>

                                                <div style="display:none">
                                                    <form action="{{url('/egzersizliste/sil')}}" method="POST" id="silme_form">
                                                        {{csrf_field()}}
                                                        <input id="silinecek_id" name="id">
                                                    </form>
                                                </div>
                                            <input onclick="sil(this,'{{$egzer[0]->id}}')"  type="button" class="btn btn-danger" value="sil">


                                        <!--@foreach($egzer as $egzersiz)


                                                    <br>
                                                @endforeach-->
                                            </td>

                                            <td >

                                                <a  href="{{url('/egzersizliste/guncelle/'.$egzer[0]->id)}}" class="btn btn-primary">Görüntüle</a>


                                            </td>



                                        </tr>
                                    @endforeach
                                        @endif

                                @endif
                                </tbody>





                            </table>
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


    <link rel="stylesheet" href="/css/sweetalert2.min.css">


@endsection

@section('js')

    <script type="text/javascript" src="/Back/js/plugins/data-tables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/Back/js/plugins/data-tables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/Back/js/plugins/data-tables/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="/Back/js/plugins/data-tables/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="/Back/js/plugins/data-tables/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/Back/js/data-table.init.js"></script>
@endsection