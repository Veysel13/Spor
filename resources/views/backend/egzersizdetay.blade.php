@extends('backend.app')
@section('icerik')

<section id="detay">
    <div id="video_icerik">
        <h3  id="video_baslik">{{$egzersiz->egzersiz_isim}}</h3>
        <div id="video">
            <div class="container">
                <div class="row">
            <div class="col-md-4" >

                <iframe width="300" height="315" src="{{asset($egzersiz->video)}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>

            <div style="margin:auto auto; "  class="col-md-4 col-md-offset-2" >
                <label for=""><b>Kategori:</b> {{\App\Egzersiz::egzersizkategoriisimal($egzersiz->egzersiz_kategori)}}</label>
                <br>
                <label for=""><b>Hareket:</b> {{$egzersiz->egzersiz_isim}}</label>

            </div>
                </div>
            </div>

        </div>
    </div>


    <section id="section_resim">
    <div id="resim">
        <h3 id="video_baslik" >{{$egzersiz->egzersiz_isim}} Fotografları</h3>
        <div id="resim">
            <div class="container">
                <div class="row">
                    <div class="col-md-4" >

                        <img style="width: 300px; height: 300px" src="{{asset($egzersiz->resim)}}" alt="">
                    </div>

                    <div style="margin:auto auto; "  class="col-md-4" >

                        <img style="width: 300px; height: 300px" src="{{asset($egzersiz->resim_iki)}}" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
    </section>
    <section id="section_aciklama">
        <div id="aciklama">
            <h3 id="video_baslik" >{{$egzersiz->egzersiz_isim}} Açıklaması</h3>
            <div id="aciklama">
                <div class="container">
                    <div class="row">
                        <div style="margin:auto 0px; "  class="col-md-4" >
                            <?php
                              $resim=\App\Egzersizkategori::kategoriresim($egzersiz->egzersiz_kategori);

                          ?>
                            <img style="width: 300px; height: 300px" src="{{asset($resim)}}" alt="">
                        </div>

                        <div style="margin:auto auto; "  class="col-md-6 col-md-offset-1" >

                            {!! $egzersiz->aciklama !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</section>
@endsection



@section('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style>
#video_baslik{
    margin-bottom: 40px;
}
    #section_resim{
 margin-top: 50px;
     }
    #section_aciklama{
        margin-top: 50px;
     }

    #detay{
        background-color: #f2f2f2;
        width: 900px;
    }

</style>

@endsection

@section('jss')

@endsection