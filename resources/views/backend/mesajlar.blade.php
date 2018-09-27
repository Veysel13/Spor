@extends('backend.app')

@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Gelen Bildirimler<small></small></h3>
                </div>


                <!--<form action="{{url('/bolgelerliste')}}" method="get" >
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">

                                <input type="text" name="arama" class="form-control" placeholder="Bölge ismi giriniz..">
                                <span class="input-group-btn">

                                    <button class="btn btn-default"  type="submit">Ara!</button>

                    </span>
                            </div>
                        </div>
                    </div></form>-->

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
                                    <th>Ekleyen</th>
                                    <th>Detay</th>
                                    <th>Mesaj Durum </th>
                                    <th>Eklenme Zamanı </th>

                                    <th>Görüntüle</th>
                                    <th>Planlama Yap</th>

                                </tr>
                                </thead>


                                <tbody>

                                    <?php $say=0; ?>
                                    @foreach($bildirimler as $bildirim)
                                        <tr>
                                            <?php $say++;

                                            $gonderen_id=$bildirim->ekleyen_id;
                                            $id=App\User::find($gonderen_id);
                                            $hasta_id=App\User::find($bildirim->gonderilen_id);
                                            ?>
                                            <td>{{$say}}</td>
                                            <td>{{ $id->name}}</td>

                                            <td>{{$bildirim->mesaj_detay}}</td>
                                            <td>@if($bildirim->mesaj_durum==0)

                                                    <button class="btn btn-warning btn-sm">Okunmadı</button>
                                                    @elseif($bildirim->mesaj_durum==1)
                                                    <button class="btn btn-success btn-sm">Okundu</button>
                                                    @endif

                                            </td>
                                            <?php $zaman=$bildirim->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>

                                          <!--  <div style="display:none">
                                                <form action="{{url('/mesajlarliste/sil')}}" method="POST" id="silme_form">
                                                    {{csrf_field()}}
                                                    <input id="silinecek_id" name="id">
                                                </form>
                                            </div>

                                            <td><input onclick="sil(this,'{{$bildirim->id}}')"  type="button" class="btn btn-danger" value="sil"></td> -->


                                                 <td><a href="{{url('/mesajlarliste/goruntule/'.$bildirim->id)}}" class="btn btn-primary">Görüntüle</a></td>
                                                <td><a href="{{url('/planlama/'.$bildirim->plan_sayisi.'/'.$hasta_id->hasta_id)}}" class="btn btn-info">Planlama Yap</a></td>


                                        </tr>
                                    @endforeach

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