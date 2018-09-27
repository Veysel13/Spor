@extends('backend.app')

@section('icerik')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Program Plan Çizelgesi<small></small></h3>
                </div>


                <!--<form action="{{url('/bolgelerliste')}}" method="get" >
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">

                                <input type="text" name="arama" class="form-control" placeholder="Bölge ismi giriniz..">
                                <span class="input-group-btn">

                                    <button class="btn btn-default"  type="submit">Ara!</button>

                    </span>
                            </div>
                        </div>
                    </div></form>-->

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
                                    <th>Ekleyen</th>
                                    <th>Program Adı</th>
                                    <th>Program Durum </th>
                                    <th>Eklenme Zamanı </th>
                                    <th>Görüntüle</th>
                                    <th>Planlama Yap</th>

                                </tr>
                                </thead>


                                <tbody>

                                    <?php $say=0; ?>
                                    @foreach($planlamalar as $planlama)
                                        <tr>
                                            <?php $say++;

                                            $gonderen_id=$planlama[0]->ekleyen_id;
                                            $id=App\User::find($gonderen_id);

                                            ?>
                                            <td>{{$say}}</td>
                                            <td>{{ $id->name}}</td>
                                                <td>{{$planlama[0]->program_adi}}</td>
                                            <td>@if($planlama[0]->plan_durum==0)

                                                    <button class="btn btn-warning btn-sm">Planlama Yapılmadı</button>
                                                    @elseif($planlama[0]->plan_durum==1)
                                                    <button class="btn btn-success btn-sm">Planlama Yapıldı</button>
                                                    @endif

                                            </td>
                                            <?php $zaman=$planlama[0]->created_at;
                                            $zaman->setlocale('tr');?>
                                            <td>{{$zaman->diffForHumans()}}</td>

                                           <!--<div style="display:none">
                                                <form action="{{url('/planlamaliste/sil')}}" method="POST" id="planlamasilme_form">
                                                    {{csrf_field()}}
                                                    <input id="plan_numarasi" name="plan_numarasi">
                                                    <input id="hasta_id" name="hasta_id">
                                                </form>
                                            </div>

                                            <td><input onclick="plansil(this,'{{$planlama[0]->plan_numarasi}}','{{$planlama[0]->hasta_id}}')"  type="button" class="btn btn-danger btn-sm" value="sil"></td> -->


                                                 <td><a href="{{url('/planlama/'.$planlama[0]->plan_numarasi.'/'.$planlama[0]->hasta_id)}}" class="btn btn-primary btn-sm">Görüntüle</a></td>
                                                 <td>@if($planlama[0]->plan_durum==0)<a href="{{url('/planlama/'.$planlama[0]->plan_numarasi.'/'.$planlama[0]->hasta_id)}}" class="btn btn-info btn-sm">Planlama Yap</a>
                                                     @else

                                                         <form action="{{url('/planlama/'.$planlama[0]->plan_numarasi.'/'.$planlama[0]->hasta_id)}}" method="get">
                                                             {{csrf_field()}}

                                                             <button type="submit" name="plan_guncelleme" class="btn btn-danger btn-sm">Planlamayı Yeniden Oluştur</button>
                                                         </form>
{{--
                                                         <a href="{{url('/planlama/'.$planlama[0]->plan_numarasi.'/'.$planlama[0]->hasta_id)}}" class="btn btn-danger btn-sm">Planlamayı Yeniden Oluştur</a>
--}}

                                                     @endif</td>


                                        </tr>
                                    @endforeach

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


    <script>
        function plansil(r,plannumarasi,hastaid) {
            var sira=r.parentNode.parentNode.rowIndex;

            swal({
                title: 'Emin misiniz?',
                text: "Sildiğiniz bilgiyi geri alamayacaksınız!",
                type: 'warning',
                showCancelButton: 'iptal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'İptal',
                confirmButtonText: 'Evet, Sil!'
            }).then(function(onay) {
                //onay = onay.value = true
                //onay.dismiss = cancel
                if(onay.value){
                    var form = document.getElementById("planlamasilme_form");
                    var input1 = document.getElementById("plan_numarasi");
                    var input2 = document.getElementById("hasta_id");
                    input1.value = plannumarasi;
                    input2.value = hastaid;
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