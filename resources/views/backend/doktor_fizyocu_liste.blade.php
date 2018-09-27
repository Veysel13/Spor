@extends('backend.app')

@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Kurum Yetkili Aktif Listesi<small></small></h3>
                </div>




                <form  method="" action="{{url('/doktor_fizyocu_ekleme')}}">
                    <div align="right" class="col-md-6 col-sm-6 col-xs-12">
                        <button  type="submit" class="btn btn-warning bnt-xs">Yetkili Ekle</button>
                    </div>
                </form>


                <form action="{{url('/doktor_fizyocu_liste')}}" method="get" >
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">

                                <input type="text" name="arama" class="form-control" placeholder="Yetkili ismi giriniz..">
                                <span class="input-group-btn">

                                    <button class="btn btn-default"  type="submit">Ara!</button>

                    </span>
                            </div>
                        </div>
                    </div></form>

            </div>

            <div class="clearfix"></div>




            @if($errors->any())



                <div id="dikkat" class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>

                        @endforeach




                    </ul>
                </div>

            @endif


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

                                    <th>İsim</th>
                                    <th>Email</th>
                                    <th>Yetkisi</th>
                                    <th>Kurum Adı</th>
                                    <th>Eklenme Zamanı</th>
                                    <th>Sil</th>
                                    <th>Görüntüle</th>




                                </tr>
                                </thead>


                                <tbody>
                                @if(isset($_GET['arama']))
                                    <?php $say=0; ?>
                                    @foreach($doktorlararama as $doktor)
                                        <tr>
                                            <?php $say++;

                                            $kurum_adi=\App\Kurumlar::where('id',$doktor->kurum_id)->first();
                                            ?>
                                            <td>{{$say}}</td>

                                            <td>{{$doktor->name}}</td>
                                            <td>{{$doktor->email}}</td>
                                            @if($doktor->yetki==2)
                                                <td>Doktor </td>@else
                                                <td>Fizyoterapist</td>
                                            @endif
                                            <td>{{$kurum_adi->kurum_adi}}</td>
                                            <?php $zaman=$doktor->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>


                                            <div style="display:none">
                                                <form action="{{url('/doktor_fizyocu_liste/sil')}}" method="POST" id="silme_form">
                                                    {{csrf_field()}}
                                                    <input id="silinecek_id" name="id">
                                                </form>
                                            </div>
                                            <td><input onclick="sil(this,'{{$doktor->id}}')"  type="button" class="btn btn-danger" value="sil"></td>
                                            <td><a href="{{url('/doktor_fizyocu_liste/guncelle/'.$doktor->id)}}" class="btn btn-primary">Görüntüle</a></td>


                                        </tr>
                                    @endforeach



                                    <?php $sayac=0; ?>
                                    @foreach($fizyoculararama as $fizyocu)
                                        <tr>
                                            <?php $sayac++;

                                            $kurum_adi=\App\Kurumlar::where('id',$fizyocu->kurum_id)->first();
                                            ?>
                                            <td>{{$sayac}}</td>

                                            <td>{{$fizyocu->name}}</td>
                                            <td>{{$fizyocu->email}}</td>
                                            @if($fizyocu->yetki==2)
                                                <td>Doktor </td>@else
                                                <td>Fizyoterapist </td>
                                            @endif
                                            <td>{{$kurum_adi->kurum_adi}}</td>
                                            <?php $zaman=$fizyocu->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>


                                            <div style="display:none">
                                                <form action="{{url('/doktor_fizyocu_liste/sil')}}" method="POST" id="silme_form">
                                                    {{csrf_field()}}
                                                    <input id="silinecek_id" name="id">
                                                </form>
                                            </div>
                                            <td><input onclick="sil(this,'{{$fizyocu->id}}')"  type="button" class="btn btn-danger" value="sil"></td>
                                            <td><a href="{{url('/doktor_fizyocu_liste/guncelle/'.$fizyocu->id)}}" class="btn btn-primary">Görüntüle</a></td>


                                        </tr>
                                    @endforeach

                                @else


                                    <?php $say=0; ?>
                                    @foreach($doktorlar as $doktor)
                                        <tr>
                                            <?php $say++;

                                            $kurum_adi=\App\Kurumlar::where('id',$doktor->kurum_id)->first();
                                            ?>
                                            <td>{{$say}}</td>

                                            <td>{{$doktor->name}}</td>
                                            <td>{{$doktor->email}}</td>
                                                @if($doktor->yetki==2)
                                            <td>Doktor </td>@else
                                                    <td>Fizyoterapi Uzmanı </td>
                                                    @endif
                                                <td>{{$kurum_adi->kurum_adi}}</td>
                                            <?php $zaman=$doktor->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>


                                            <div style="display:none">
                                                <form action="{{url('/doktor_fizyocu_liste/sil')}}" method="POST" id="silme_form">
                                                    {{csrf_field()}}
                                                    <input id="silinecek_id" name="id">
                                                </form>
                                            </div>
                                            <td><input onclick="sil(this,'{{$doktor->id}}')"  type="button" class="btn btn-danger" value="sil"></td>
                                            <td><a href="{{url('/doktor_fizyocu_liste/guncelle/'.$doktor->id)}}" class="btn btn-primary">Görüntüle</a></td>


                                        </tr>
                                    @endforeach



                                    <?php $sayac=0; ?>
                                    @foreach($fizyocular as $fizyocu)
                                        <tr>
                                            <?php $sayac++;

                                            $kurum_adi=\App\Kurumlar::where('id',$fizyocu->kurum_id)->first();
                                            ?>
                                            <td>{{$sayac}}</td>

                                            <td>{{$fizyocu->name}}</td>
                                            <td>{{$fizyocu->email}}</td>
                                            @if($fizyocu->yetki==2)
                                                <td>Doktor </td>@else
                                                <td>Fizyoterapi Uzmanı </td>
                                            @endif
                                            <td>{{$kurum_adi->kurum_adi}}</td>
                                            <?php $zaman=$fizyocu->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>


                                            <div style="display:none">
                                                <form action="{{url('/doktor_fizyocu_liste/sil')}}" method="POST" id="silme_form">
                                                    {{csrf_field()}}
                                                    <input id="silinecek_id" name="id">
                                                </form>
                                            </div>
                                            <td><input onclick="sil(this,'{{$fizyocu->id}}')"  type="button" class="btn btn-danger" value="sil"></td>
                                            <td><a href="{{url('/doktor_fizyocu_liste/guncelle/'.$fizyocu->id)}}" class="btn btn-primary">Görüntüle</a></td>


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



    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Kurum Yetkili Pasif Listesi<small></small></h3>
                </div>




                <form action="{{url('/doktor_fizyocu_liste')}}" method="get" >
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">

                                <input type="text" name="pasif_arama" class="form-control" placeholder="Yetkili ismi giriniz..">
                                <span class="input-group-btn">

                                    <button class="btn btn-default"  type="submit">Ara!</button>

                    </span>
                            </div>
                        </div>
                    </div></form>

            </div>

            <div class="clearfix"></div>




            @if($errors->any())



                <div id="dikkat" class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>

                        @endforeach




                    </ul>
                </div>

            @endif


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

                                    <th>İsim</th>
                                    <th>Email</th>
                                    <th>Yetkisi</th>
                                    <th>Kurum Adı</th>
                                    <th>Eklenme Zamanı</th>
                                    <th>Aktif Et</th>
                                    <th>Görüntüle</th>




                                </tr>
                                </thead>


                                <tbody>
                                @if(isset($_GET['pasif_arama']))
                                    <?php $say=0; ?>
                                    @foreach( $doktorlararama_pasif as $doktor)
                                        <tr>
                                            <?php $say++;

                                            $kurum_adi=\App\Kurumlar::where('id',$doktor->kurum_id)->first();
                                            ?>
                                            <td>{{$say}}</td>

                                            <td>{{$doktor->name}}</td>
                                            <td>{{$doktor->email}}</td>
                                            @if($doktor->yetki==2)
                                                <td>Doktor </td>@else
                                                <td>Fizyoterapist</td>
                                            @endif
                                            <td>{{$kurum_adi->kurum_adi}}</td>
                                            <?php $zaman=$doktor->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>


                                          <!--  <div style="display:none">
                                                <form action="{{url('/doktor_fizyocu_liste/sil')}}" method="POST" id="silme_form">
                                                    {{csrf_field()}}
                                                    <input id="silinecek_id" name="id">
                                                </form>
                                            </div>
                                            <td><input onclick="sil(this,'{{$doktor->id}}')"  type="button" class="btn btn-danger" value="sil"></td>-->

                                                <td><a href="{{url('/doktor_fizyocu_liste/aktifet/'.$doktor->id)}}" class="btn btn-primary">Aktif Et</a></td>

                                                <td><a href="{{url('/doktor_fizyocu_liste/guncelle/'.$doktor->id)}}" class="btn btn-primary">Görüntüle</a></td>


                                        </tr>
                                    @endforeach



                                    <?php $sayac=0; ?>
                                    @foreach($fizyoculararama_pasif as $fizyocu)
                                        <tr>
                                            <?php $sayac++;

                                            $kurum_adi=\App\Kurumlar::where('id',$fizyocu->kurum_id)->first();
                                            ?>
                                            <td>{{$sayac}}</td>

                                            <td>{{$fizyocu->name}}</td>
                                            <td>{{$fizyocu->email}}</td>
                                            @if($fizyocu->yetki==2)
                                                <td>Doktor </td>@else
                                                <td>Fizyoterapist </td>
                                            @endif
                                            <td>{{$kurum_adi->kurum_adi}}</td>
                                            <?php $zaman=$fizyocu->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>


                                          <!--  <div style="display:none">
                                                <form action="{{url('/doktor_fizyocu_liste/sil')}}" method="POST" id="silme_form">
                                                    {{csrf_field()}}
                                                    <input id="silinecek_id" name="id">
                                                </form>
                                            </div>
                                            <td><input onclick="sil(this,'{{$fizyocu->id}}')"  type="button" class="btn btn-danger" value="sil"></td>-->

                                                <td><a href="{{url('/doktor_fizyocu_liste/aktifet/'.$fizyocu->id)}}" class="btn btn-primary">Aktif Et</a></td>

                                                <td><a href="{{url('/doktor_fizyocu_liste/guncelle/'.$fizyocu->id)}}" class="btn btn-primary">Görüntüle</a></td>


                                        </tr>
                                    @endforeach

                                @else


                                    <?php $say=0; ?>
                                    @foreach($doktorlar_pasif as $doktor)
                                        <tr>
                                            <?php $say++;

                                            $kurum_adi=\App\Kurumlar::where('id',$doktor->kurum_id)->first();
                                            ?>
                                            <td>{{$say}}</td>

                                            <td>{{$doktor->name}}</td>
                                            <td>{{$doktor->email}}</td>
                                            @if($doktor->yetki==2)
                                                <td>Doktor </td>@else
                                                <td>Fizyoterapi Uzmanı </td>
                                            @endif
                                            <td>{{$kurum_adi->kurum_adi}}</td>
                                            <?php $zaman=$doktor->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>


                                           <!-- <div style="display:none">
                                                <form action="{{url('/doktor_fizyocu_liste/sil')}}" method="POST" id="silme_form">
                                                    {{csrf_field()}}
                                                    <input id="silinecek_id" name="id">
                                                </form>
                                            </div>
                                            <td><input onclick="sil(this,'{{$doktor->id}}')"  type="button" class="btn btn-danger" value="sil"></td>-->
                                                <td><a href="{{url('/doktor_fizyocu_liste/aktifet/'.$doktor->id)}}" class="btn btn-primary">Aktif Et</a></td>

                                                <td><a href="{{url('/doktor_fizyocu_liste/guncelle/'.$doktor->id)}}" class="btn btn-primary">Görüntüle</a></td>


                                        </tr>
                                    @endforeach



                                    <?php $sayac=0; ?>
                                    @foreach($fizyocular_pasif as $fizyocu)
                                        <tr>
                                            <?php $sayac++;

                                            $kurum_adi=\App\Kurumlar::where('id',$fizyocu->kurum_id)->first();
                                            ?>
                                            <td>{{$sayac}}</td>

                                            <td>{{$fizyocu->name}}</td>
                                            <td>{{$fizyocu->email}}</td>
                                            @if($fizyocu->yetki==2)
                                                <td>Doktor </td>@else
                                                <td>Fizyoterapi Uzmanı </td>
                                            @endif
                                            <td>{{$kurum_adi->kurum_adi}}</td>
                                            <?php $zaman=$fizyocu->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>


                                           <!-- <div style="display:none">
                                                <form action="{{url('/doktor_fizyocu_liste/sil')}}" method="POST" id="silme_form">
                                                    {{csrf_field()}}
                                                    <input id="silinecek_id" name="id">
                                                </form>
                                            </div>
                                            <td><input onclick="sil(this,'{{$fizyocu->id}}')"  type="button" class="btn btn-danger" value="sil"></td>-->
                                                <td><a href="{{url('/doktor_fizyocu_liste/aktifet/'.$fizyocu->id)}}" class="btn btn-primary">Aktif Et</a></td>

                                                <td><a href="{{url('/doktor_fizyocu_liste/guncelle/'.$fizyocu->id)}}" class="btn btn-primary">Görüntüle</a></td>


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


    <link rel="stylesheet" href="/css/sweetalert2.min.css">




@endsection

@section('js')



    <script type="text/javascript" src="/Back/js/plugins/data-tables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/Back/js/plugins/data-tables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/Back/js/plugins/data-tables/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="/Back/js/plugins/data-tables/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="/Back/js/plugins/data-tables/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/Back/js/data-table.init.js"></script>


    <script src="/js/sweetalert2.min.js"></script>

    <script>
        function sil(r,id) {
            var sira=r.parentNode.parentNode.rowIndex;

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: 'iptal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, Sil!'
            }).then(function(onay) {
                //onay = onay.value = true
                //onay.dismiss = cancel
                if(onay.value){
                    var form = document.getElementById("silme_form");
                    var input = document.getElementById("silinecek_id");
                    input.value = id;
                    form.submit();

                }
                return false;


                /* console.log('dsdsdsd');
                 var CSRF_TOKEN=$('meta[name="csrf-token"]').attr('content');
                 $.ajax({

                     type :"GET",
                     url: "  '/bolgelerliste/sil/'"+'/'+id,
                     data :{
                         'id':id,
                         '_token':CSRF_TOKEN,
                         'onay':onay

                     },
                     beforeSubmit:function() {
                         swal({
                             title:'<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
                             text:'Yükleniyor lütfen bekleyiniz...',
                             showConfirmButton:false
                         })
                     },
                     success :function(response)
                     {
                         console.log('dsdsdsd');

                         if(response.durum=='success'){
                             document.getElementById("datatable-buttons").deleteRow(sira);
                         }
                         swal(
                             response.baslik,
                             response.icerik,
                             response.durum
                         );
                     }

                 });*/
            });

        }

    </script>







@endsection