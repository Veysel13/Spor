@extends('backend.app')


@section('icerik')




    <div class="content">

        @if($errors->any())

            <div id="dikkat" class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>

                    @endforeach




                </ul>
            </div>

        @endif


        <h3>Hastaya Atanmış Hareketler</h3>


        <form action="{{url('/hasta_liste/guncelle')}}"  method="post">

            {{csrf_field()}}

            <div id="tabmenu1" class="card">
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav tabs-admin" role="tablist">
                        <li role="presentation" class=" nav-item"><a class="nav-link active" href="#t3" aria-controls="t3" role="tab" data-toggle="tab">Plan Çizelgesi</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content admin-tab-content">

                        <div role="tabpanel" class="tab-pane active show" id="t3">
                            <div class="container">

                                @if(isset($plan_sayisi))

                                    @if(isset($hasta_id))

                                        <div id="musteri_plan" style="height: 500px; overflow-x: hidden; overflow-y: scroll;">

                                            <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                                                <thead>
                                                <tr>


                                                    <th>S.No</th>
                                                    <th>Ekleyen Kişi</th>
                                                    <th>Program Adı</th>
                                                    <th>Hasta Adı</th>
                                                    <th>Eklenme Zamanı</th>
                                                    <th>Hareketler</th>
                                                    <th>Planlama</th>
                                                    <th>Program</th>
                                                </tr>
                                                </thead>
                                                <tbody>



                                                <?php
                                                //$hasta_ad=auth()->user()->name;echo "dfdfdf";
                                                $hasta=\App\Hastalar::where('id',$hasta_id)->where('aktif',1)->first();
                                                $planlar=\App\Setler::where('hasta_id',$hasta->id)->where('aktif',1)->get()->groupBy('plan_sayisi');

                                                ?>

                                                @for($i=1;$i<=count($planlar);$i++)
                                                    <?php $ekleyen_id=$planlar[$i][0]->ekleyen_id;
                                                    $ekleyen=\App\User::find($ekleyen_id);
                                                    $hasta_id=\App\Hastalar::find($planlar[$i][0]->hasta_id);

                                                    ?>

                                                    <tr>

                                                        <td>{{$i+1}}</td>
                                                        <td>{{$ekleyen->name}}@if($ekleyen->yetki==1)(Admin)@elseif($ekleyen->yetki==2) (Doktor) @elseif($ekleyen->id==3) (Fizto Terapist) @endif</td>
                                                        <td>{{$planlar[$i][0]->program_adi}}</td>
                                                        <td>{{$hasta_id->hasta_ad." ".$hasta_id->hasta_soyad}}</td>
                                                        <td>{{$planlar[$i][0]->created_at}}</td>


                                                        <td><a href="{{url('/hasta_liste/plan/goruntule/'.$planlar[$i][0]->plan_sayisi.'/'.$planlar[$i][0]->hasta_id)}}" class="btn btn-primary btn-sm">Hareketler</a></td>
                                                        <td>
                                                            <a href="{{url('/planlama/'.$planlar[$i][0]->plan_sayisi.'/'.$planlar[$i][0]->hasta_id)}}" class="btn btn-danger btn-sm">Progam Planlaması</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{url('/planlama/'.$planlar[$i][0]->plan_sayisi.'/'.$planlar[$i][0]->hasta_id)}}" class="btn btn-warning btn-sm">Progam</a>
                                                        </td>
                                                    </tr>




                                                @endfor



                                                </tbody>
                                            </table>


                                        </div>


                                    @endif

                                @else
                                    <div class="alert alert-info">
                                        <strong>Bilgi!</strong> Bu hastaya henüz hareket plani atanmamıştır.
                                    </div>

                                @endif
                            </div>

                        </div>
                    </div></div>
            </div>
            <br> <br>
            <!--<input type="submit" value="Güncelle">-->
        </form>


    </div><!--content-->





@endsection

@section('css')

    <link href="/Back/css/plugins/plugins.css" rel="stylesheet">
    <link href="/Back/js/plugins/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/Back/js/plugins/data-tables/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/Back/js/plugins/data-tables/responsive.bootstrap4.min.css" rel="stylesheet">
    <link href="/Back/linearicons/fonts.css" rel="stylesheet">
    <link href="/Back/css/style.css" rel="stylesheet">

    <style>

        #formmusteri{
            float: left;
            right: 20px;
            width: 300px;
            background-color: rgba(21, 99, 111, 0.11);
            border-radius: 10px;

        }
        #tabmenu1{
            height: 100%;
            left: 15px;
            background-color: rgba(21, 99, 111, 0.11);
            border-radius: 10px;
        }
        input[type=text], select, textarea  {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-top: 0px;
            margin-bottom: 0px;
            resize: vertical;
        }

        input[type=date]{

            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-top: 0px;
            margin-bottom: 0px;
            resize: vertical;
        }

        input[type=email]{

            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-top: 0px;
            margin-bottom: 0px;
            resize: vertical;
        }
        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #76a07c;
        }

        #image{
            background-color: black;
            height:165px;
            width: 155px;
            font-size: 18px;
            color: red;

        }

        #musteri_plan {

        }




    </style>

@endsection

@section('js')


    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script> CKEDITOR.replace('editor1'); </script>









    <script type="text/javascript">
        function openKCFinder(div) {
            window.KCFinder = {
                callBack: function(url) {
                    window.KCFinder = null;
                    div.innerHTML = '<div style="margin:5px">Loading...</div>';
                    var img = new Image();
                    img.src = url;
                    img.onload = function() {
                        div.innerHTML = '<img name="gorsel" id="img"  src="' + url + '" />';

                        var resim=document.getElementById('inputgorsel');
                        resim.value=url;

                        var img = document.getElementById('img');
                        var o_w = img.offsetWidth;
                        var o_h = img.offsetHeight;
                        var f_w = div.offsetWidth;
                        var f_h = div.offsetHeight;
                        if ((o_w > f_w) || (o_h > f_h)) {
                            if ((f_w / f_h) > (o_w / o_h))
                                f_w = parseInt((o_w * f_h) / o_h);
                            else if ((f_w / f_h) < (o_w / o_h))
                                f_h = parseInt((o_h * f_w) / o_w);
                            img.style.width = f_w + "px";
                            img.style.height =f_h + "px";
                        } else {
                            f_w = o_w;
                            f_h = o_h;
                        }
                        img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                        img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
                        img.style.visibility = "visible";

                    }
                }
            };
            window.open('/kcfinder/browse.php?type=images&dir=images/public',
                'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
                'directories=0, resizable=1, scrollbars=0, width=800, height=600'
            );
        }
    </script>

    <!--
    <script>

        $(document).ready(function () {

            $('#nav').children('li').first().children('a').addClass('active')
                .next().addClass('is-open').show();

            $('#nav').on('click', 'li > a', function() {

                if (!$(this).hasClass('active')) {

                    $('#nav .is-open').removeClass('is-open').hide();
                    $(this).next().toggleClass('is-open').toggle();

                    $('#nav').find('.active').removeClass('active');
                    $(this).addClass('active');
                } else {
                    $('#nav .is-open').removeClass('is-open').hide();
                    $(this).removeClass('active');
                }
            });
        });

    </script>-->


@endsection