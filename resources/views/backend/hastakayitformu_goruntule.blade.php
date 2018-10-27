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

        <h3>Kişisel Bilgiler</h3>

            <div class="container">
                <div class="row">
        <form action="{{url('/hasta_liste/guncelle')}}"  method="post">

            {{csrf_field()}}
            <div id="formmusteri" class="container col-md-6 col-sm-12 col-12">

                <div  id="image" onclick="openKCFinder(this)"><div style="margin:5px">@if($hasta->hasta_resim!=null)
                            <img src="{{asset($hasta->hasta_resim)}}"  height="165px" width="140px" alt=""> @else Resim Yuklemek Icin Tiklayiniz... @endif</div></div>

                <!--kc finder resim yolunu almak icin-->
                <input type="hidden" value="{{$hasta->hasta_resim}}" name="hasta_resim"  id="inputgorsel">

                <input type="hidden" name="id" value="{{$hasta->id}}">



                <br>
                <label for="fname">Ad*(zorunlu)</label>
                <input type="text" value="{{$hasta->hasta_ad}}" id="fname" name="hasta_ad" required placeholder="Adınız ..">

                <label for="lname">Soyad*(zorunlu)</label>
                <input type="text" id="lname" value="{{$hasta->hasta_soyad}}" name="hasta_soyad" required placeholder="Soyadınız..">



                <label for="subject">Telefon</label>
                <input type="text" id="phone2"  value="{{$hasta->hasta_telefon}}" name="hasta_telefon" placeholder="Telefon..">


                <label for="subject">E Posta</label>
                <input type="email" id="lname" value="{{$hasta->hasta_eposta}}" name="hasta_eposta" placeholder="E posta..">

                <label for="subject">Şifre</label>
                <input type="text" id="lname"  name="hasta_sifre" placeholder="Şifre..">

                <label for="subject">Şifre Tekrar</label>
                <input type="text" id="lname"  name="hasta_sifre_confirmation" placeholder="Şifre Tekrar..">




            </div>



            <div id="tabmenu1" class="card col-md-6 col-sm-7 col-12">
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav tabs-admin" role="tablist">
                        <li role="presentation" class="nav-item"><a class="nav-link" href="#t1" aria-controls="t1" role="tab" data-toggle="tab">Kimlik Bilgileri</a></li>
                        <li role="presentation" class=" nav-item"><a class="nav-link" href="#t2" aria-controls="t2" role="tab" data-toggle="tab">Adress Bilgileri</a></li>
                        <li role="presentation" class=" nav-item"><a class="nav-link active" href="#t3" aria-controls="t3" role="tab" data-toggle="tab">Plan Çizelgesi</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content admin-tab-content">
                        <div role="tabpanel" class="tab-pane" id="t1">
                            <div class="container">

                                <label for="fname">Baba Adı</label>
                                <input type="text" id="fname" value="{{$hasta->hasta_babaadi}}" name="hasta_babaadi" placeholder="Baba Adı..">

                                <label for="lname">Anne Adı</label>
                                <input type="text" id="lname" value="{{$hasta->hasta_anneadi}}" name="hasta_anneadi" placeholder="Anne Adı..">


                                <label for="lname">Tc Kimlik No</label>
                                <input type="text" id="lname" value="{{$hasta->hasta_tc}}" name="hasta_tc" placeholder="Tc Kimlik no..">

                                <label for="country">Dogum Yeri</label>
                                <input type="text" id="lname" value="{{$hasta->hasta_dogumyeri}}" name="hasta_dogumyeri" placeholder="Dogum Yeri..">

                                <label for="subject">Dogum Tarihi</label>
                                <input type="date" id="lname" value="{{$hasta->hasta_dogumtarihi}}" name="hasta_dogumtarihi" placeholder="Dogum Tarihi..">

                                <label for="subject">Cinsiyeti</label>
                                <select id="country" name="hasta_cinsiyet">
                                    <option @if($hasta->hasta_cinsiyet=="NULL") selected @endif value="NULL">Seciniz..</option>
                                    <option @if($hasta->hasta_cinsiyet=="erkek") selected @endif value="erkek">Erkek</option>
                                    <option @if($hasta->hasta_cinsiyet=="kadın") selected @endif value="kadın">Kadın</option>

                                </select>


                                <label for="subject">Medeni Hali</label>
                                <select id="country" name="hasta_medenihali">
                                    <option @if($hasta->hasta_medenihali=="NULL") selected @endif value="NULL">Seciniz..</option>
                                    <option @if($hasta->hasta_medenihali=="bekar") selected @endif value="bekar">Bekar</option>
                                    <option @if($hasta->hasta_medenihali=="evli") selected @endif value="evli">Evli</option>
                                    <option @if($hasta->hasta_medenihali=="dul") selected @endif value="dul">Dul</option>

                                </select>

                                <label for="subject">Kan Gurubu</label>
                                <select id="country" name="hasta_kangurubu">
                                    <option @if($hasta->hasta_kangurubu=="NULL") selected @endif value="NULL">Seciniz..</option>
                                    <option @if($hasta->hasta_kangurubu=="AB Rh+") selected @endif value="AB Rh+">AB Rh+</option>
                                    <option @if($hasta->hasta_kangurubu=="AB Rh-") selected @endif value="AB Rh- ">AB Rh- </option>
                                    <option @if($hasta->hasta_kangurubu=="A Rh+") selected @endif value="A Rh+">A Rh+</option>
                                    <option @if($hasta->hasta_kangurubu=="A Rh-") selected @endif value="A Rh-">A Rh-</option>
                                    <option @if($hasta->hasta_kangurubu=="O Rh-") selected @endif value="O Rh-">O Rh-</option>
                                    <option @if($hasta->hasta_kangurubu=="O Rh+") selected @endif value="O Rh+">O Rh+</option>
                                    <option @if($hasta->hasta_kangurubu=="B Rh+") selected @endif value="B Rh+">B Rh+</option>
                                    <option @if($hasta->hasta_kangurubu=="B Rh-") selected @endif value="B Rh-">B Rh-</option>

                                </select>

                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="t2">
                            <div class="container">
                                <label for="country">Ülke</label>
                                <input type="text" id="fname"  value="{{$hasta->hasta_ulke}}" name="hasta_ulke" placeholder="Ülke..">

                                <label for="fname">İl</label>
                                <input type="text" id="fname"   value="{{$hasta->hasta_il}}" name="hasta_il" placeholder="İl..">

                                <label for="lname">İlce</label>
                                <input type="text" id="lname"   value="{{$hasta->hasta_ilce}}" name="hasta_ilce" placeholder="İlce..">


                                <label for="subject">Acık Adres</label>
                                <textarea id="subject"  cols="20" rows="5" name="hasta_acikadress" placeholder="Acık Adress.." style="height:200px"> {{$hasta->hasta_acikadress}}</textarea>



                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane active show" id="t3">
                            <div class="container">

                                @if(isset($plan_varmi))

                                @if(isset($hasta_id))

                                    <div id="musteri_plan"  style="height: 500px; overflow-x: hidden; overflow-y: scroll;">



                                        <table id="data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                                            <thead>
                                            <tr>


                                                <th>S.No</th>
                                                <th>Ekleyen Kişi</th>
                                                <th>Program Adı</th>
                                                <th>Hasta Adı</th>
                                                <th>Eklenme Zamanı</th>
                                                <th>Görüntüle</th>
                                                <th>Planlama</th>
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
                                                    <td><a href="{{url('/antrenor/planlama/'.$planlar[$i][0]->plan_sayisi.'/'.$planlar[$i][0]->hasta_id)}}" class="btn btn-danger btn-sm">Planlama</a></td>
                                                    <td><a href="{{url('/son/plan/goruntule/'.$planlar[$i][0]->plan_sayisi.'/'.$planlar[$i][0]->hasta_id)}}" class="btn btn-warning btn-sm">Progam</a></td>
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
            <input type="submit" value="Güncelle">
        </form>
                </div>
            </div>

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
            height: 550px;
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


        @media (max-width:768px ){
            #tabmenu1 {
                height: 550px;
                left: -17px;
                top: 20px;
                background-color: rgba(21, 99, 111, 0.11);
                border-radius: 10px;
            }
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


@endsection