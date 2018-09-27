@extends('backend.app')
@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hastalik Ekle</h3>







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




                                <form id="form" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data" method="POST" action="{{url('/hastaliklarhareketlerliste/guncelle')}}"  >

                                    {{csrf_field()}}


                                    <input type="hidden" value="{{$hastaliklar->id}}" name="hastalik_id">
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Hastalık İsmi <span class="">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="{{$hastaliklar->hastalik_isim}}" required="required" type="text" name="hastalik_isim">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Hareketler *</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select multiple="multiple" size="8"  name="baslik[]" class="form-control">


                                                @foreach($hareketliste  as $hareket)

                                                    <option @for($i=0;$i<count($hareket_idleri);$i++) @if($hareket_idleri[$i]==$hareket->id) selected @endif @endfor value="{{$hareket->id}}" >{{$hareket->baslik}}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id" value="{{$idsi}}">



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