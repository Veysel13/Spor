@extends('backend.app')

@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hasta Liste<small></small></h3>
                </div>




                <form  method="" action="{{url('/hastakayitformu')}}">
                    <div align="right" class="col-md-6 col-sm-6 col-xs-12">
                        <button  type="submit" class="btn btn-warning bnt-xs">Hasta Ekle</button>
                    </div>
                </form>


                <form action="{{url('/hastaliste')}}" method="get" >
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">

                                <input type="text" name="arama" class="form-control" placeholder="Hasta ismi giriniz..">
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
                                    <th>Ekleyen</th>
                                    <th>Gorsel</th>
                                    <th>Hasta Ad</th>
                                    <th>Hasta Soyad</th>
                                    <th>Hasta Tc</th>
                                    <th>Hasta Telefon</th>
                                    <th>Eklenme Zamanı</th>
                                    <th>Sil</th>
                                    <th>Görüntüle</th>




                                </tr>
                                </thead>


                                <tbody>
                                @if(isset($_GET['arama']))

                                    <?php $say=0; ?>
                                    @foreach($hastaarama as $hasta)

                                        <tr>
                                            <?php $say++;

                                            $gonderen_id=$hasta->ekleyen_id;
                                            $id=App\User::find($gonderen_id);
                                            ?>
                                            <td>{{$say}}</td>
                                            <td>{{$id->name}}</td>
                                            <td>@if($hasta->hasta_resim==null)<img src="/gallery/indir.png" height="70px" width="100px">@else<img src="{{asset($hasta->hasta_resim)}}" height="70" width="100"> @endif  </td>

                                            <td>{{$hasta->hasta_ad}}</td>
                                            <td>{{$hasta->hasta_soyad}}</td>
                                            <td>{{$hasta->hasta_tc}}</td>
                                            <td>{{$hasta->hasta_telefon}}</td>
                                            <?php $zaman=$hasta->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>

                                                <div style="display:none">
                                                    <form action="{{url('/hasta_liste/sil')}}" method="POST" id="silme_form">
                                                        {{csrf_field()}}
                                                        <input id="silinecek_id" name="id">
                                                    </form>
                                                </div>
                                                <td><input onclick="sil(this,'{{$hasta->id}}')"  type="button" class="btn btn-danger" value="sil"></td>

                                                <td><a href="{{url('/hastaliste/guncelle/'.$hasta->id)}}" class="btn btn-primary">Görüntüle</a></td>


                                        </tr>
                                    @endforeach
                                @else


                                    <?php $say=0; ?>
                                    @foreach($hastalar as $hasta)
                                        <tr>
                                            <?php $say++;

                                            $gonderen_id=$hasta->ekleyen_id;
                                            $id=App\User::find($gonderen_id);
                                            ?>
                                            <td>{{$say}}</td>
                                            <td>{{$id->name}}</td>
                                            <td>@if($hasta->hasta_resim==null)<img src="/gallery/indir.png" height="70px" width="100px">@else<img src="{{asset($hasta->hasta_resim)}}" height="70" width="100"> @endif  </td>

                                            <td>{{$hasta->hasta_ad}}</td>
                                                <td>{{$hasta->hasta_soyad}}</td>
                                                <td>{{$hasta->hasta_tc}}</td>
                                                <td>{{$hasta->hasta_telefon}}</td>
                                            <?php $zaman=$hasta->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>

                                                <div style="display:none">
                                                    <form action="{{url('/hasta_liste/sil')}}" method="POST" id="silme_form">
                                                        {{csrf_field()}}
                                                        <input id="silinecek_id" name="id">
                                                    </form>
                                                </div>
                                                <td><input onclick="sil(this,'{{$hasta->id}}')"  type="button" class="btn btn-danger" value="sil"></td>


                                                <td><a href="{{url('/hastaliste/guncelle/'.$hasta->id)}}" class="btn btn-primary">Görüntüle</a></td>


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


@endsection

@section('js')



    <script type="text/javascript" src="/Back/js/plugins/data-tables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/Back/js/plugins/data-tables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/Back/js/plugins/data-tables/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="/Back/js/plugins/data-tables/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="/Back/js/plugins/data-tables/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/Back/js/data-table.init.js"></script>
@endsection