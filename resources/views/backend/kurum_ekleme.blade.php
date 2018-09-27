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


        <form action="{{url('/kurumlar')}}" method="post">

            {{csrf_field()}}
            <div id="formmusteri" class="container">

                <div  id="image" onclick="openKCFinder(this)"><div style="margin:5px">Resim Yuklemek Icin Tiklayiniz...</div></div>

                <!--kc finder resim yolunu almak icin-->
                <input type="hidden" name="kurum_resim"  id="inputgorsel">



                <br>
                <label for="fname">Ad*(zorunlu)</label>
                <input type="text" id="fname" name="kurum_arayanad" required placeholder="Adınız ..">

                <label for="lname">Soyad*(zorunlu)</label>
                <input type="text" id="lname" name="kurum_arayansoyad" required placeholder="Soyadınız..">


                <label for="phone">Telefon*(zorunlu)</label>
                <input type="tel" id="phone2" required  name="kurum_arayantelefon" class="form-control" data-inputmask="'mask' : '(999) 999-9999'" placeholder="Telefon..">

                <label for="subject">E Posta*(zorunlu)</label>
                <input type="email" id="lname" name="kurum_arayaneposta" required placeholder="E posta..">

                <label for="subject">Şifre*(zorunlu)</label>
                <input type="text" id="lname" name="kurum_arayansifre" required placeholder="Sifre..">

                <label for="subject">Şifre Tekrar*(zorunlu)</label>
                <input type="text" id="lname" name="kurum_arayansifre_confirmation" required placeholder="Sifre tekrar..">




            </div>



            <div id="tabmenu1" class="card">
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav tabs-admin" role="tablist">
                        <li role="presentation" class="nav-item"><a class="nav-link active" href="#t1" aria-controls="t1" role="tab" data-toggle="tab">Kurum Bilgileri</a></li>
                        <li role="presentation" class=" nav-item"><a class="nav-link" href="#t2" aria-controls="t2" role="tab" data-toggle="tab">Adress Bilgileri</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content admin-tab-content">
                        <div role="tabpanel" class="tab-pane active show" id="t1">
                            <div class="container">

                                <label for="fname">Kurum Adı</label>
                                <input type="text" id="fname" name="kurum_adi" placeholder="Kurum Adı..">

                                <label for="lname">Kurum Yetkili Adı</label>
                                <input type="text" id="lname" name="kurum_yetkiliadi" placeholder="Kurum Yetkili Adı..">


                                <label for="lname">Kurum Yetkili Numarası</label>
                                <input type="text" id="phone2"  name="kurum_yetkilinumara" placeholder="Yetkili Numara..">

                                <label for="country">Kurum Vergi Dairesi</label>
                                <input type="text" id="lname" name="kurum_vergidairesi" placeholder="Vergi Dairesi..">

                                <label for="subject">Kurum Vergi Numarası</label>
                                <input type="text" id="lname" name="kurum_verginumarasi" placeholder="Vergi Numarası..">

                                <label for="subject">Kurum Yetkili Cinsiyeti</label>
                                <select id="country" name="kurum_yetkilicinsiyet">
                                    <option value="NULL">Seciniz..</option>
                                    <option value="erkek">Erkek</option>
                                    <option value="kadın">Kadın</option>

                                </select>



                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="t2">
                            <div class="container">
                                <label for="country">Kurum Ülke</label>
                                <input type="text" id="fname"  name="kurum_ulke" placeholder="Ülke..">

                                <label for="fname">Kurum İl</label>
                                <input type="text" id="fname" name="kurum_il" placeholder="İl..">

                                <label for="lname">Kurum İlce</label>
                                <input type="text" id="lname" name="kurum_ilce" placeholder="İlce..">


                                <label for="subject">Kurum Acık Adres</label>
                                <textarea id="subject"  cols="20" rows="5" name="kurum_acikadress" placeholder="Acık Adress.." style="height:200px"></textarea>



                            </div>
                        </div>

                    </div></div>
            </div>
            <br> <br>
            <input type="submit" value="Kayit">
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

        input[type=tel]{

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


    <!--<script src="/Back/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

    <script src="/js/jquery.inputmask.bundle.min.js"></script>-->


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

    </script>

    <script>
        $(document).ready(function () {
            $('.telmask').mask('(000) 000-00-00',{placeholder:"(___) ___-__-__"});
        });
    </script>-->
@endsection