@extends('backend.app')

@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hastalıklara Göre Hareketler Listesi<small></small></h3>
                </div>



                <form action="{{url('/hastaliklarhareketlerliste')}}" method="get" >
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">

                                <input type="text" name="arama" class="form-control" placeholder="Hastalik ismi giriniz..">
                                <span class="input-group-btn">

                                    <button class="btn btn-default"  type="submit">Ara!</button>

                    </span>
                            </div>
                        </div>
                    </div></form>

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
                            <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Hastalik İsmi</th>
                                    <th>Hareketler</th>
                                    <th>Eklenme Zamanı</th>
                                    <th>Sil</th>
                                    <th>Görüntüle</th>





                                </tr>
                                </thead>


                                <tbody>

                                @if(isset($_GET['arama']))


                                    <?php $say=0; ?>
                                    @foreach($hastalikhareket2 as $hareket)
                                        <tr>

                                            <?php
                                            $say++;

                                            $hastalik=$hareket[0]->hastalik_id;
                                            $hastalikisim=App\Hastaliklar::where('id','=',$hastalik)->where('aktif',1)->first();







                                        $hareketisimler=App\Hastalik_hareketler::where('hastalik_id','=',$hastalik)->where('aktif',1)->get();




                                            ?>


                                            <td>{{$say}}</td>
                                            <td>{{$hastalikisim->hastalik_isim}}</td>
                                            <td>@foreach($hareketisimler as $hareketisim)
                                                    <?php $hareket_id=\App\Hareketolustur::where('id',$hareketisim->hareket_id)->where('aktif',1)->first();
                                                    echo $hareket_id->baslik;
                                                    echo "<br>";?>
                                                @endforeach</td>





                                            <?php $zaman=$hareket[0]->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>

                                                <div style="display:none">
                                                    <form action="{{url('/hastaliklarhareketlerliste/sil')}}" method="POST" id="silme_form">
                                                        {{csrf_field()}}
                                                        <input id="silinecek_id" name="id">
                                                    </form>
                                                </div>
                                                <td><input onclick="sil(this,'{{$hareket[0]->id}}')"  type="button" class="btn btn-danger" value="sil"></td>


                                                <td><a href="{{url('/hastaliklarhareketlerliste/guncelle/'.$hareket[0]->id)}}" class="btn btn-primary">Görüntüle</a></td>






                                        </tr>
                                    @endforeach


                                    @else

                                <?php $say=0; ?>
                                @foreach($hastalikhareket as $hareket)
                                    <tr>


                                        <?php $say++;



                                        $hastalik=$hareket[0]->hastalik_id;
                                        $hastalikisim=App\Hastaliklar::where('id','=',$hastalik)->where('aktif',1)->first();

                                        ?>

                                        <?php

                                        $hareketisimler=App\Hastalik_hareketler::where('hastalik_id','=',$hastalik)->where('aktif',1)->get();


                                        ?>


                                        <td>{{$say}}</td>
                                            <td>{{$hastalikisim->hastalik_isim}}</td>
                                            <td>
                                                @foreach($hareketisimler as $hareketisim)
                                                    <?php $hareket_id=\App\Hareketolustur::where('id',$hareketisim->hareket_id)->where('aktif',1)->first();
                                                    echo $hareket_id->baslik;
                                                    echo "<br>";?>
                                                @endforeach

                                            </td>


                                        <?php $zaman=$hareket[0]->created_at;
                                        $zaman->setlocale('tr');?>
                                        <td>{{$zaman->diffForHumans()}}</td>
                                            <div style="display:none">
                                                <form action="{{url('/hastaliklarhareketlerliste/sil')}}" method="POST" id="silme_form">
                                                    {{csrf_field()}}
                                                    <input id="silinecek_id" name="id">
                                                </form>
                                            </div>
                                            <td><input onclick="sil(this,'{{$hareket[0]->id}}')"  type="button" class="btn btn-danger" value="sil"></td>


                                             <td><center><a href="{{url('/hastaliklarhareketlerliste/guncelle/'.$hareket[0]->id)}}" class="btn btn-primary">Güncelle</a></center></td>

                                            {{-- <td><a href="{{url('/hastaliklarhareketlerliste/guncelle/'.$hareket->id)}}" class="btn btn-primary">Görüntüle</a></td>--}}




                                    </tr>
                                @endforeach

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