@extends('backend.app')

@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Egzersiz Kategori Güncelle</h3>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            @if($errors->any())

                                <div id="dikkat" class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>

                            @endif

                            @if(isset($kategori->resim))
                                    <img  style="width:100px; height: 100px; display: inline-block;" alt="image"  src="{{asset($kategori->resim)}}"/>
                            @endif

                            <div class="x_content">
                                <br />

                                <form id="form" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data"  method="POST" action="{{url('/egzersizkategoriliste/guncelle')}}"  >

                                    {{csrf_field()}}



                                    <br>



                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Üst Kategori Seçiniz
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control"  name="kategori_ust">


                                                {!!  egzersizkategoriguncelle($kategori->kategori_ust) !!}

                                            </select>




                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Adı<span class="">*</span>(zorunlu)</label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <input id="middle-name" class="form-control col-md-7 col-xs-12" required="required" value="{{$kategori->kategori_ad}}" type="text" name="kategori_ad">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file" id="first-name" name="resim" value="{{$kategori->resim}}" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <input type="hidden" name="id" value="{{$kategori->id}}">

                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                            <button type="submit" name="mail_ayarlar" class="btn btn-success">Güncelle</button>
                                        </div>
                                    </div>
                                </form>




                            </div>





                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <!-- /page content -->


@endsection



@section('css')


@endsection


@section('js')



@endsection