@extends('backend.app')
@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hasta Güncelle</h3>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">


                            @if(isset($hastalar->hasta_resim))

                                <div class="thumbnail" style="width:15%; display: inline-block;">

                                    <div class="image view view-first" >


                                        <img  style="width:100px; display: inline-block;" alt="image"  src="{{asset($hastalar->hasta_resim)}}"/>



                                        <div class="mask">

                                            <div class="tools tools-bottom">
                                                <form action="{{url('/hasta/resimsil/'.$hastalar->id)}}" method="get">
                                                    <input type="hidden" name="resim">


                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i>
                                                    </button>
                                                </form>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif




                        @if($errors->any())

                                    <div id="dikkat" class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>

                                        @endforeach




                                    </ul>
                                </div>

                            @endif


                            <div class="x_content">
                                <br />
                                <form id="form" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data" method="POST" action="{{url('/hastaliste/guncelle')}}"  >

                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file" id="first-name" name="hasta_resim"  class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">İsim<span class="">*</span>(zorunlu)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="{{$hastalar->hasta_ad}}" required="required" type="text" name="hasta_ad">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soyisim<span class="">*</span>(</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" class="form-control col-md-7 col-xs-12" required="required" value="{{$hastalar->hasta_soyad}}" type="text" name="hasta_soyad">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tc</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="{{$hastalar->hasta_tc}}"  type="number" name="hasta_tc">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Telefon</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="phone2" class="form-control col-md-7 col-xs-12" value="{{$hastalar->hasta_telefon}}" type="text" name="hasta_telefon">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Dogum Tarihi</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="{{$hastalar->hasta_dogumtarihi}}" type="date" name="hasta_dogumtarihi">
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Yaş</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="{{$hastalar->hasta_yas}}" type="number" name="hasta_yas">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Boy</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="{{$hastalar->hasta_boy}}" type="number" name="hasta_boy">
                                        </div>
                                    </div>

                                    <input type="hidden" value="{{$hastalar->id}}" name="id">

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                            <button type="submit" class="btn btn-success">Güncelle</button>
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

@endsection

@section('css')
    <link href="/css/sweetalert2.min.css" rel="stylesheet">
@endsection


@section('js')
    <script src="/js/jquery.form.min.js"></script>
    <script src="/js/jquery.validate.min.js"></script>
    <script src="/js/messages_tr.min.js"></script>
    <script src="/js/sweetalert2.min.js"></script>
    <script>

        $(document).ready(function () {
            $('form').validate();
            $('form').ajaxForm({
                beforeSubmit:function () {

                },
                success:function (response) {

                    swal(
                        response.baslik,
                        response.icerik,
                        response.durum


                    )
                }
            });

        });
    </script>
@endsection