@extends('backend.app')

@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Bölgeler Liste<small></small></h3>
                </div>




                <form  method="" action="{{url('/bolgeler')}}">
                    <div align="right" class="col-md-6 col-sm-6 col-xs-12">
                        <button  type="submit" class="btn btn-warning bnt-xs">Bölge Ekle</button>
                    </div>
                </form>


                <form action="{{url('/bolgelerliste')}}" method="get" >
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">

                                <input type="text" name="arama" class="form-control" placeholder="Bölge ismi giriniz..">
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
                                    <th>Bölge İsmi</th>
                                    <th>Özellikleri</th>
                                    <th>Eklenme Zamanı</th>
                                    <th>Sil</th>
                                    <th>Görüntüle</th>




                                </tr>
                                </thead>


                                <tbody>
                                @if(isset($_GET['arama']))

                                    <?php $say=0; ?>
                                    @foreach($bolgearama as $arama)

                                    <tr>
                                        <?php $say++;

                                        $gonderen_id=$arama->ekleyen_id;
                                        $id=App\User::find($gonderen_id);
                                        ?>
                                        <td>{{$say}}</td>
                                        <td>{{$id->name}}</td>
                                        <td>@if($arama->resim==null)<img src="/gallery/indir.png" height="70px" width="100px">@else<img src="{{asset($arama->resim)}}" height="70" width="100"> @endif  </td>

                                        <td>{{$arama->isim}}</td>
                                        <td>{{$arama->ozellikleri}}</td>
                                        <?php $zaman=$arama->created_at;
                                        $zaman->setlocale('tr');?>
                                        <td>{{$zaman->diffForHumans()}}</td>

                                      <!--  <td><a href="{{url('/bolgelerliste/sil/'.$arama->id)}}"  class="btn btn-danger">Sil</a></td>-->
                                            <div style="display:none">
                                                <form action="{{url('/bolgelerliste/sil')}}" method="POST" id="silme_form">
                                                    {{csrf_field()}}
                                                    <input id="silinecek_id" name="id">
                                                </form>
                                            </div>
                                            <td><input onclick="sil(this,'{{$arama->id}}')"  type="button" class="btn btn-danger" value="sil"></td>

                                            <td><a href="{{url('/bolgelerliste/guncelle/'.$arama->id)}}" class="btn btn-primary">Görüntüle</a></td>


                                    </tr>
                                    @endforeach
                                    @else


                                <?php $say=0; ?>
                                @foreach($bolgeler as $bolge)
                                    <tr>
                                        <?php $say++;

                                         $gonderen_id=$bolge->ekleyen_id;
                                        $id=App\User::find($gonderen_id);
                                        ?>
                                        <td>{{$say}}</td>
                                            <td>{{$id->name}}</td>
                                        <td>@if($bolge->resim==null)<img src="/gallery/indir.png" height="70px" width="100px">@else<img src="{{asset($bolge->resim)}}" height="70" width="100"> @endif  </td>

                                            <td>{{$bolge->isim}}</td>
                                        <td>{{$bolge->ozellikleri}}</td>
                                        <?php $zaman=$bolge->created_at;
                                        $zaman->setlocale('tr');?>
                                        <td>{{$zaman->diffForHumans()}}</td>

                                        <!-- <td><a href="{{url('/bolgelerliste/sil/'.$bolge->id)}}"  class="btn btn-danger bt">Sil</a></td>-->
                                         <div style="display:none">
                                             <form action="{{url('/bolgelerliste/sil')}}" method="POST" id="silme_form">
                                                 {{csrf_field()}}
                                                 <input id="silinecek_id" name="id">
                                             </form>
                                         </div>
                                            <td><input onclick="sil(this,'{{$bolge->id}}')"  type="button" class="btn btn-danger" value="sil"></td>
                                        <td><a href="{{url('/bolgelerliste/guncelle/'.$bolge->id)}}" class="btn btn-primary">Görüntüle</a></td>


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