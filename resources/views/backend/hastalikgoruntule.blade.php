@extends('backend.app')
@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hastalık Görüntüleme</h3>







                </div>



                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br />




                                <form id="form" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data" method="POST" action="{{url('/hastalikliste/guncelle')}}"  >

                                    {{csrf_field()}}



                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Hastalik Kategori</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" name="hastalik_kategori">

                                                {!! kategoriguncelle($hastalik->hastalik_kategori) !!}


                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Hastalık İsmi <span class="">*</span>(zorunlu)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" class="form-control col-md-7 col-xs-12" required="required" value="{{$hastalik->hastalik_isim}}" type="text" name="hastalik_isim">
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Hareketler </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select multiple="multiple" size="8"  name="baslik[]" class="form-control">
                                                <option value="" >Hareket Seçiniz</option>

                                                @foreach($hareketler  as $hareket)

                                                    <option value="{{$hareket->id}}" @foreach($hastalikhareket as $hastahareket)@if($hastahareket->hareket_id==$hareket->id) selected  @endif @endforeach >{{$hareket->baslik}}</option>


                                                @endforeach

                                            </select>
                                        </div>
                                    </div>





                                    <input type="hidden" name="id" value="{{$hastalik->id}}">



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