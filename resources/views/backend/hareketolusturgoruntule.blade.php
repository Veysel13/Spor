@extends('backend.app')
@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hareket Güncelle</h3>







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

                                @if(isset($hareketolustur))

                                    <div class="thumbnail" style="width:15%; display: inline-block;">

                                        <div class="image view view-first" >


                                            <img  style="width:100px; display: inline-block;" alt="image"  src="{{asset($hareketolustur->resim)}}"/>



                                            <div class="mask">

                                                <div class="tools tools-bottom">
                                                    <form action="{{url('/hareketolustur/resimsil/'.$hareketolustur->id)}}" method="get">
                                                        <input type="hidden" name="resim">


                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i>
                                                        </button>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif


                                <br>


                                <form id="form" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data" method="POST" action="{{url('/hareketolusturliste/guncelle')}}"  >

                                    {{csrf_field()}}

                                    <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Başlık <span>*</span>(zorunlu)</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="middle-name"  class="form-control col-md-7 col-xs-12" required="required" value="{{$hareketolustur->baslik}}" type="text" name="baslik">
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
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bölge <span>*</span>(zorunlu)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select     name="bolge" class="form-control">
                                                <option value="" >Bolge Seçiniz</option>

                                                <?php $b=$hareketolustur->bolge;
                                                $e=$hareketolustur->eklem;
                                                $h=$hareketolustur->hareket;?>
                                                @foreach($bolgeler  as $bolge)

                                                    <option @if($bolge->id==$b) selected @endif value="{{$bolge->id}}">{{$bolge->isim}}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Eklem <span>*</span>(zorunlu)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select     name="eklem" class="form-control">
                                                <option value="" >Eklem Seçiniz</option>

                                                @foreach($eklemler  as $eklem)

                                                    <option @if($eklem->id==$e) selected @endif value="{{$eklem->id}}">{{$eklem->isim}}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Hareket Türü <span>*</span>(zorunlu)</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select     name="hareket" class="form-control">
                                                <option value="" >Hareket Türü Seçiniz</option>
                                                @foreach($hareketler  as $hareket)

                                                    <option @if($hareket->id==$h) selected @endif value="{{$hareket->id}}">{{$hareket->isim}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Özellikleri</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea name="ozellikleri" id=""  value="" class="form-control col-md-7 col-xs-12" cols="30" rows="10">{{$hareketolustur->ozellikleri}}</textarea>
                                        </div>
                                    </div>






                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">AAOS</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" placeholder="Standart Gİriniz(doube değer)" value="{{$hareketolustur->Aaos}}" class="form-control col-md-7 col-xs-12"  type="text" name="Aaos">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">AMA</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" placeholder="Standart Gİriniz(doube değer)" value="{{$hareketolustur->Ama}}" class="form-control col-md-7 col-xs-12"  type="text" name="Ama">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">KendalMcreacy</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="middle-name" placeholder="Standart Gİriniz(doube değer)" value="{{$hareketolustur->KendalMcreacy}}" class="form-control col-md-7 col-xs-12"  type="text " name="KendalMcreacy">
                                        </div>
                                    </div>


                                  {{--  <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Standartlar

                                        </label>

                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input @if($hareketolustur->Aaos=='4.2') checked @endif type="checkbox" name="Aaos" value="4.2">AAOS
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input @if($hareketolustur->Ama=='5.3') checked @endif type="checkbox" name="Ama" value="5.3">AMA
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input @if($hareketolustur->KendalMcreacy=='3.4') checked @endif type="checkbox"  value="3.4" name="KendalMcreacy">KendalMcreacy
                                                </label>
                                            </div>

                                        </div>
                                    </div>--}}

                                    <input type="hidden" value="{{$hareketolustur->id}}" name="id">



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