@extends('backend.app')
@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Egzersiz Ekle</h3>

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





                            <div class="x_content">




                                <br />




                                <form id="form" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data" method="POST" action="{{url('/egzersiz')}}"  >

                                    {{csrf_field()}}


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file" id="first-name" name="video"  class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file" id="first-name" name="resim"  class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim İki
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file" id="first-name" name="resim_iki"  class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Egzersiz İsmi <span class="">*</span>(zorunlu)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="egzersiz_isim">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Egzersiz Açıklaması <span class="">*</span>(zorunlu)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea id="middle-name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="aciklama" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>





                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Egzersiz Kategori </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" name="egzersiz_kategori">

                                                {!! egzersiz_kategori() !!}


                                            </select>
                                        </div>
                                    </div>







                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Hareketler </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select multiple="multiple"   name="baslik[]" class="form-control">

                                                <option value="1">KOl</option>
                                                @foreach($hareketler  as $hareket)

                                                    <option value="{{$hareket->id}}" >{{$hareket->baslik}}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>



                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                            <button type="submit" class="btn btn-success">Kaydet</button>
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

    <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
    <script>

        CKEDITOR.replace( 'aciklama' );
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