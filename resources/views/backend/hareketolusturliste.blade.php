@extends('backend.app')

@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Oluşturulan Hareket Listesi<small></small></h3>
                </div>

                <form  method="" action="{{url('/hareketolustur')}}">
                    <div align="right" class="col-md-6 col-sm-6 col-xs-12">
                        <button  type="submit" class="btn btn-warning bnt-xs">Hareket Olustur</button>
                    </div>
                </form>


                <form action="{{url('/hareketolusturliste')}}" method="get" >
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">

                                <input type="text" name="arama" class="form-control" placeholder="Hareket ismi giriniz..">
                                <span class="input-group-btn">

                                    <button class="btn btn-default"  type="submit">Ara!</button>

                    </span>
                            </div>
                        </div>
                    </div>
                </form>



            </div>

            <div class="clearfix">


            </div>

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
                                    <th>Hareket İsmi</th>
                                    <th>Resim</th>
                                    <th>Aaos</th>
                                    <th>Ama</th>
                                    <th>Kendal Mcreacy</th>
                                    <th>Bölge İsmi</th>
                                    <th>Eklem İsmi</th>
                                    <th>Hareket Türü</th>
                                    <th>Eklenme Zamanı</th>
                                    <th>Sil</th>
                                    <th>Görüntüle</th>




                                </tr>
                                </thead>


                                <tbody>


                                @if(isset($_GET['arama']))



                                    <?php $say=0; ?>
                                    @foreach($hareketler as $hareket)
                                        <tr>
                                            <?php $say++;

                                             $gonderen_id=$hareket->ekleyen_id;
                                            $id=App\User::find($gonderen_id);


                                             $bolgeid=$hareket->bolge;
                                            $bolgelerid=App\Bolgeler::find($bolgeid);


                                             $eklemid=$hareket->eklem;
                                            $eklemlerid=App\Eklemler::find($eklemid);


                                             $hareketid=$hareket->hareket;
                                            $hareketlerid=App\Hareketturu::find($hareketid);


                                            ?>


                                            <td>{{$say}}</td>
                                            <td>{{$id->name}}</td>
                                            <td>{{$hareket->baslik}}</td>
                                            <td>@if($hareket->resim==null)<img src="/gallery/indir.png" height="20px" width="20px"> @else <img src="{{asset($hareket->resim)}}" height="20px" width="20px"> @endif</td>


                                            <td>@if($hareket->Aaos==null)<img src="/gallery/indir.png" height="20px" width="20px"> @else{{$hareket->Aaos}}@endif</td>
                                            <td>@if($hareket->Ama==null)<img src="/gallery/indir.png" height="20px" width="20px"> @else{{$hareket->Ama}}@endif</td>
                                            <td>@if($hareket->KendalMcreacy==null)<img src="/gallery/indir.png" height="20px" width="20px"> @else{{$hareket->KendalMcreacy}}@endif</td>
                                            <td>{{$bolgelerid->isim}}</td>
                                            <td>{{$eklemlerid->isim}}</td>
                                            <td>{{$hareketlerid->isim}}</td>
                                            <?php $zaman=$hareket->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>

                                                <div style="display:none">
                                                    <form action="{{url('/hareketolusturliste/sil')}}" method="POST" id="silme_form">
                                                        {{csrf_field()}}
                                                        <input id="silinecek_id" name="id">
                                                    </form>
                                                </div>
                                                <td><input onclick="sil(this,'{{$hareket->id}}')"  type="button" class="btn btn-danger" value="sil"></td>


                                            <td><a href="{{url('/hareketolusturliste/guncelle/'.$hareket->id)}}" class="btn btn-primary">Görüntüle</a></td>


                                        </tr>
                                    @endforeach




                                    @else


                                    <?php $say=0; ?>
                                    @foreach($hareketolusturarama as $hareket)
                                        <tr>
                                            <?php $say++; ?>

                                            <?php $gonderen_id=$hareket->ekleyen_id;
                                            $id=App\User::find($gonderen_id);
                                            ?>

                                            <?php $bolgeid=$hareket->bolge;
                                            $bolgelerid=App\Bolgeler::find($bolgeid);
                                            ?>
                                            <?php $eklemid=$hareket->eklem;
                                            $eklemlerid=App\Eklemler::find($eklemid);
                                            ?>

                                            <?php $hareketid=$hareket->hareket;
                                            $hareketlerid=App\Hareketturu::find($hareketid);
                                            ?>


                                            <td>{{$say}}</td>
                                            <td>{{$id->name}}</td>
                                            <td>{{$hareket->baslik}}</td>
                                            <td>@if($hareket->resim==null)<img src="/gallery/indir.png" height="20px" width="20px"> @else <img src="{{asset($hareket->resim)}}" height="20px" width="20px"> @endif</td>


                                            <td>@if($hareket->Aaos==null)<img src="/gallery/indir.png" height="20px" width="20px"> @else{{$hareket->Aaos}}@endif</td>
                                            <td>@if($hareket->Ama==null)<img src="/gallery/indir.png" height="20px" width="20px"> @else{{$hareket->Ama}}@endif</td>
                                            <td>@if($hareket->KendalMcreacy==null)<img src="/gallery/indir.png" height="20px" width="20px"> @else{{$hareket->KendalMcreacy}}@endif</td>
                                            <td>{{$bolgelerid->isim}}</td>
                                            <td>{{$eklemlerid->isim}}</td>
                                                <td>{{$hareketlerid->isim}}</td>
                                            <?php $zaman=$hareket->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>
                                                <div style="display:none">
                                                    <form action="{{url('/hareketolusturliste/sil')}}" method="POST" id="silme_form">
                                                        {{csrf_field()}}
                                                        <input id="silinecek_id" name="id">
                                                    </form>
                                                </div>
                                                <td><input onclick="sil(this,'{{$hareket->id}}')"  type="button" class="btn btn-danger" value="sil"></td>
                                               <td><a href="{{url('/hareketolusturliste/guncelle/'.$hareket->id)}}" class="btn btn-primary">Görüntüle</a></td>


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