@extends('backend.app')
@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hastalıklar için Hareket Ekle</h3>


                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br />


                                @if($errors->any())


                                        <div id="dikkat" class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>

                                                @endforeach

                                            </ul>

                                    </div>

                                @endif




                                <form id="form" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data" method="POST" action="{{url('/hastaliklarhareketler')}}"  >

                                    {{csrf_field()}}


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Hastalıklar *(zorunlu)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select multiple="multiple" size="8" required="required"   name="hastalik_isim[]" class="form-control">
                                                <option  value="" >Hastalık Seçiniz</option>
                                                @foreach($hastaliklar  as $hastalik)

                                                    <option >{{$hastalik->hastalik_isim}}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Hareketler *(zorunlu)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select multiple="multiple" size="8" required="required"   name="baslik[]" class="form-control">
                                                <option value="" >Hareket Seçiniz</option>

                                                @foreach($hareketler  as $hareket)

                                                    <option >{{$hareket->baslik}}</option>

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