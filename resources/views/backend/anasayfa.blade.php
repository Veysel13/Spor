@extends('backend.app')
@section('icerik')


    <div class="content">
        <div class="container">
            <div class="page-title pt30 pb30">
                <div class="row">
                    <div class="col-sm-12">
                    <!--  <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>-->
                        <h4 class="mb0">Hoş Geldin @if(Auth::check())
                                {{auth()->user()->name}}
                            @endif</h4>
                    </div>
                </div>
            </div><!--page title-->

            <div class="row">

                <div class="col-md-6 col-lg-3 col-sm-12">
                    <div class="widget-info clearfix mb30 bg-warning">
                        <i class="fa fa-child"></i>
                        <div class="widget-content">
                            <h4 class="text-white">{{count($hareketsayi)}}</h4>
                            <span class="text-white-gray">Oluşturulan Hareket Sayısı</span>
                        </div>
                    </div>

                </div><!--col-->

                <div class="col-md-6 col-lg-3 col-sm-12">
                    <div class="widget-info clearfix mb30 bg-primary">
                        <i class="fa fa-street-view"></i>
                        <div class="widget-content">
                            <h4 class="text-white">{{count($eklemlersayi)}}</h4>
                            <span class="text-white-gray">Eklenen Eklem Sayısı</span>
                        </div>
                    </div>
                </div><!--col-->

                <div class="col-md-6 col-lg-3 col-sm-12">
                    <div class="widget-info clearfix mb30 bg-success">
                        <i class="fa fa-blind"></i>
                        <div class="widget-content">
                            <h4 class="text-white">{{count($hareketturusayi)}}</h4>
                            <span class="text-white-gray">Eklenen Hrkt Tür Sayısı</span>
                        </div>
                    </div>
                </div><!--col-->

                <div class="col-md-6 col-lg-3 col-sm-12">
                    <div class="widget-info clearfix mb30 bg-danger">
                        <i class="fa fa-heartbeat"></i>
                        <div class="widget-content">
                            <h4 class="text-white">{{count($hastaliklarsayi)}}</h4>
                            <span class="text-white-gray">Eklenen Hastalik Sayısı</span>
                        </div>
                    </div>
                </div><!--col-->
                <div class="col-md-6 col-lg-3 col-sm-12">
                    <div class="card mb30">
                        <div class="card-top">
                            <h4 class="card-title">Son Oluşturulan Hareketler</h4>
                            <div class="card-options">

                            </div><!--card options-->
                        </div><!--card top-->
                        <div class="card-content">
                            <ul class="list-group activity-widget">
                                @foreach($hareketler as $hareket)
                                <li class="list-group-item">
                                    <div class="widget-icon-left">
                                        <div class="pull-left mr-3">
                                            <i class="fa fa-plus-square"></i>
                                        </div>
                                        <div class="widget-icon-left-body clearfix">
                                            <?php $zaman=$hareket->created_at;
                                            $zaman->setlocale('tr');?>

                                            <small class="text-muted pull-right ml">{{$zaman->diffForHumans()}}</small>
                                            <div class="media-box-heading"><a href="#" class="text-primary m0">{{$hareket->baslik}}</a>
                                            </div>

                                        </div>
                                    </div>
                                </li><!--/item-->
                                    @endforeach

                            </ul>
                        </div><!--content-->
                    </div><!--card-->
                </div>
                <div class="col-md-6 col-lg-3 col-sm-12">
                    <div class="card mb30">
                        <div class="card-top">
                            <h4 class="card-title">Son Eklenen Eklemler</h4>
                            <div class="card-options">

                            </div><!--card options-->
                        </div><!--card top-->
                        <div class="card-content">
                            <ul class="list-group activity-widget">
                                @foreach($eklemler as $eklem)
                                    <li class="list-group-item">
                                        <div class="widget-icon-left">
                                            <div class="pull-left mr-3">
                                                <i class="fa fa-plus-square"></i>
                                            </div>
                                            <div class="widget-icon-left-body clearfix">
                                                <?php $zaman=$eklem->created_at;
                                                $zaman->setlocale('tr');?>

                                                <small class="text-muted pull-right ml">{{$zaman->diffForHumans()}}</small>
                                                <div class="media-box-heading"><a href="#" class="text-primary m0">{{$eklem->isim}}</a>
                                                </div>

                                            </div>
                                        </div>
                                    </li><!--/item-->
                                @endforeach

                            </ul>
                        </div><!--content-->
                    </div><!--card-->
                </div>
                <div class="col-md-6 col-lg-3 col-sm-12">
                    <div class="card mb30">
                        <div class="card-top">
                            <h4 class="card-title">Son Eklenen Hareketler</h4>
                            <div class="card-options">

                            </div><!--card options-->
                        </div><!--card top-->
                        <div class="card-content">
                            <ul class="list-group activity-widget">
                                @foreach($hareketturu as $hareket)
                                    <li class="list-group-item">
                                        <div class="widget-icon-left">
                                            <div class="pull-left mr-3">
                                                <i class="fa fa-plus-square"></i>
                                            </div>
                                            <div class="widget-icon-left-body clearfix">
                                                <?php $zaman=$hareket->created_at;
                                                $zaman->setlocale('tr');?>

                                                <small class="text-muted pull-right ml">{{$zaman->diffForHumans()}}</small>
                                                <div class="media-box-heading"><a href="#" class="text-primary m0">{{$hareket->isim}}</a>
                                                </div>

                                            </div>
                                        </div>
                                    </li><!--/item-->
                                @endforeach

                            </ul>
                        </div><!--content-->
                    </div><!--card-->
                </div>
                <div class="col-md-6 col-lg-3 col-sm-12">
                    <div class="card mb30">
                        <div class="card-top">
                            <h4 class="card-title">Son Eklenen Hastaliklar</h4>
                            <div class="card-options">

                            </div><!--card options-->
                        </div><!--card top-->
                        <div class="card-content">
                            <ul class="list-group activity-widget">
                                @foreach($hastaliklar as $hasta)
                                    <li class="list-group-item">
                                        <div class="widget-icon-left">
                                            <div class="pull-left mr-3">
                                                <i class="fa fa-plus-square"></i>
                                            </div>
                                            <div class="widget-icon-left-body clearfix">
                                                <?php $zaman=$hasta->created_at;
                                                $zaman->setlocale('tr');?>

                                                <small class="text-muted pull-right ml">{{$zaman->diffForHumans()}}</small>
                                                <div class="media-box-heading"><a href="#" class="text-primary m0">{{$hasta->hastalik_isim}}</a>
                                                </div>

                                            </div>
                                        </div>
                                    </li><!--/item-->
                                @endforeach

                            </ul>
                        </div><!--content-->
                    </div><!--card-->
                </div>
            </div>

        </div>
    </div>











@endsection

@section('js')
@endsection

@section('css')
@endsection