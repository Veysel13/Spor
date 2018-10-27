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


        <form action="{{url('/hastakayitformu')}}" method="post">

            @if(auth()->user()->yetki==1)

                <div class="form-group">
                    <div style="width: 300px;" >

                        <select required name="kurum_id">
                            <option value="">Kurum Seçiniz *(zorunlu)</option>
                            @foreach($kurumlistesi as $kurum)
                                <option value="{{$kurum->id}}">{{$kurum->kurum_adi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            @endif

            {{csrf_field()}}
        <div id="formmusteri" class="container col-md-6 col-sm-12 col-12">

            <div  id="image" onclick="openKCFinder(this)"><div style="margin:5px">Resim Yuklemek Icin Tiklayiniz...</div></div>

        <!--kc finder resim yolunu almak icin-->
            <input type="hidden" name="hasta_resim"  id="inputgorsel">



            <br>
                <label for="fname">Ad*(zorunlu)</label>
                <input type="text" id="fname" name="hasta_ad" required placeholder="Adınız ..">

                <label for="lname">Soyad*(zorunlu)</label>
                <input type="text" id="lname" name="hasta_soyad" required placeholder="Soyadınız..">



            <label for="subject">Telefon</label>
            <input type="text" id="phone2"  name="hasta_telefon" placeholder="Telefon..">


                <label for="subject">E Posta</label>
                <input type="email" id="lname" name="hasta_eposta" placeholder="E posta..">

            <label for="subject">Şifre</label>
            <input type="text" id="lname" name="hasta_sifre" placeholder="Sifre..">

            <label for="subject">Şifre Tekrar</label>
            <input type="text" id="lname" name="hasta_sifre_confirmation" placeholder="Sifre tekrar..">




        </div>




        <div id="tabmenu1" class="card col-md-6 col-sm-7 col-12">
            <div>

                <!-- Nav tabs -->
                <ul class="nav tabs-admin" role="tablist">
                    <li role="presentation" class="nav-item"><a class="nav-link active" href="#t1" aria-controls="t1" role="tab" data-toggle="tab">Kimlik Bilgileri</a></li>
                    <li role="presentation" class=" nav-item"><a class="nav-link" href="#t2" aria-controls="t2" role="tab" data-toggle="tab">Adress Bilgileri</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content admin-tab-content">
                    <div role="tabpanel" class="tab-pane active show" id="t1">
                        <div class="container">

                                <label for="fname">Baba Adı</label>
                                <input type="text" id="fname" name="hasta_babaadi" placeholder="Baba Adı..">

                                <label for="lname">Anne Adı</label>
                                <input type="text" id="lname" name="hasta_anneadi" placeholder="Anne Adı..">


                            <label for="lname">Tc Kimlik No</label>
                            <input type="text" id="lname" name="hasta_tc" placeholder="Tc Kimlik no..">

                                <label for="country">Dogum Yeri</label>
                               <input type="text" id="lname" name="hasta_dogumyeri" placeholder="Dogum Yeri..">

                                <label for="subject">Dogum Tarihi</label>
                                <input type="date" id="lname" name="hasta_dogumtarihi" placeholder="Dogum Tarihi..">

                            <label for="subject">Cinsiyeti</label>
                            <select id="country" name="hasta_cinsiyet">
                                <option value="NULL">Seciniz..</option>
                                <option value="erkek">Erkek</option>
                                <option value="kadın">Kadın</option>

                            </select>


                            <label for="subject">Medeni Hali</label>
                            <select id="country" name="hasta_medenihali">
                                <option value="NULL">Seciniz..</option>
                                <option value="bekar">Bekar</option>
                                <option value="evli">Evli</option>
                                <option value="dul">Dul</option>

                            </select>

                            <label for="subject">Kan Gurubu</label>
                            <select id="country" name="hasta_kangurubu">
                                <option value="NULL">Seciniz..</option>
                                <option value="AB Rh+">AB Rh+</option>
                                <option value="AB Rh- ">AB Rh- </option>
                                <option value="A Rh+">A Rh+</option>
                                <option value="A Rh-">A Rh-</option>
                                <option value="O Rh-">O Rh-</option>
                                <option value="O Rh+">O Rh+</option>
                                <option value="B Rh+">B Rh+</option>
                                <option value="B Rh-">B Rh-</option>

                            </select>

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="t2">
                        <div class="container">
                             <label for="country">Ülke</label>
                            <input type="text" id="fname" value="{{old('hasta_ulke')}}" name="hasta_ulke" placeholder="Ülke..">

                                <label for="fname">İl</label>
                                <input type="text" id="fname" name="hasta_il" placeholder="İl..">

                                <label for="lname">İlçe</label>
                                <input type="text" id="lname" name="hasta_ilce" placeholder="İlce..">


                            <label for="subject">Açık Adres</label>
                            <textarea id="subject"  cols="20" rows="5" name="hasta_acikadress" placeholder="Açık Adress.." style="height:200px"></textarea>



                        </div>
                    </div>

                </div></div>
        </div>

            <br> <br>
                    <input type="submit" value="Kayit">
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
                        div.innerHTML = '<img name="gorsel" id="img" src="' + url + '" />';

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