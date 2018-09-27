@extends('backend.app')
@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Eklemler Görüntüle</h3>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">



                                @if(isset($eklem))

                                    <div class="thumbnail" style="width:15%; display: inline-block;">

                                        <div class="image view view-first" >


                                            <img  style="width:100px; display: inline-block;" alt="image"  src="{{asset($eklem->resim)}}"/>



                                            <div class="mask">

                                                <div class="tools tools-bottom">
                                                    <form action="{{url('/eklemler/resimsil/'.$eklem->id)}}" method="get">
                                                        <input type="hidden" name="tablo_ismi" value="resim">


                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i>
                                                        </button>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif









                                <br />
                                <form id="form" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data" method="POST" action="{{url('/eklemlerliste/guncelle')}}"  >

                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file" id="first-name" name="resim"  class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>


                                    <input type="hidden" name="id" value="{{$eklem->id}}">

                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">İsim <span class="required">*</span>(zorunlu)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" value="{{$eklem->isim}}" class="form-control col-md-7 col-xs-12" required="required" type="text" name="isim">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Özellikleri</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea name="ozellikleri" id=""  value="" class="form-control col-md-7 col-xs-12" cols="30" rows="10">{{$eklem->ozellikleri}}</textarea>
                                        </div>
                                    </div>








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