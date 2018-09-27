@extends('backend.app')
@section('icerik')


    <div class="content">



        <div class="page-title pt30 pb30">
            <div class="row">
                <div class="col-sm-12">

                    <h4  class="mb0">Hareket Planı Güncelle</h4>


                    <br>
                    <br>

                    @if($errors->any())

                        <div id="dikkat" class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>

                                @endforeach




                            </ul>
                        </div>

                    @endif

                    <div id="tekrarlar">
                    <form id="form" data-parsley-validate class="form-horizontal form-label-left" action={{url('/hazir/egzersizplan_liste/guncelle/'.$plan_id)}} method="get">


                        <div  id="tum-hareketler">

                            <div id="haftalık-tekrarlar" class="select">

                                Haftalık tekrar
                                <select name="haftalik_tekrar">
                                    <option value="">Seçiniz</option>
                                    <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 1") selected @endif @endif value="Haftada 1">Haftada 1</option>
                                    <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 2") selected @endif @endif value="Haftada 2">Haftada 2</option>
                                    <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 3") selected @endif @endif value="Haftada 3">Haftada 3</option>
                                    <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 4") selected @endif @endif value="Haftada 4">Haftada 4</option>
                                    <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 5") selected @endif @endif value="Haftada 5">Haftada 5</option>
                                    <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 6") selected @endif @endif value="Haftada 6">Haftada 6</option>
                                    <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Her gün") selected @endif @endif value="Her gün">Her gün</option>
                                </select>

                            </div>
                            <div id="gunluk-tekrarlar" class="select">

                                Günlük tekar
                                <select name="gunluk_tekrar">
                                    <option value="">Seçiniz</option>
                                    <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 1") selected @endif @endif value="Günde 1">Günde 1</option>
                                    <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 2") selected @endif @endif value="Günde 2">Günde 2</option>
                                    <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 3") selected @endif @endif value="Günde 3">Günde 3</option>
                                    <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 4") selected @endif @endif value="Günde 4">Günde 4</option>
                                    <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 5") selected @endif @endif value="Günde 5">Günde 5</option>
                                    <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 6") selected @endif @endif value="Günde 6">Günde 6</option>
                                </select>

                            </div>


                            <div id="set-tekrarlar" >

                                Set :
                                <input type="number" @if(isset($settekrar)) value="{{$settekrar}}" @endif name="set_tekrar" id="setbilgisi" min="0">

                            </div>
                            <div id="tekrar-tekrarlar" >

                                Tekrar:
                                <input type="number" @if(isset($tekrartekrar)) value="{{$tekrartekrar}}" @endif name="tekrar_tekrar" id="setbilgisi" min="0">

                            </div>


                            <div id="dinlenme-tekrarlar" >

                                Dinlenme:
                                <input type="number" @if(isset($dinlenmetekrar)) value="{{$dinlenmetekrar}}" @endif name="dinlenme_tekrar" id="setbilgisi" min="0">

                            </div>

                            <button type="submit" class="btn btn-danger btn-xs" id="tumhareketlerbutton">Tüm Hareketlere Uygula *</button>
                        </div>

                    </form>

                    </div>



                        <form id="form" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data" method="post" action="{{url('/hazir/egzersizplan_session/guncelle/'.$plan_id)}}"  >

                            {{csrf_field()}}

                            <div id="hazir_plan_imi">
                             <div class="ui-widget">
                                <label>Hazır Plan İsmi: </label>
                                <input type="text" @if(isset($setler)) value="{{$setler[0]->plan_ismi}}" @endif required name="combobox">

                            </div>
                            </div>

                        <!--<button  id="toggle">Hasta isimlerini Göster</button>-->




                </div>
            </div>
        </div><!--page title-->


        <div align="right">
            <button style="margin-left: 18px" type="submit" class="btn btn-success">Programı Kaydet</button>
        </div>
        <br>
        <?php $i=0;
        $j=1;
        ?>




        @if(isset($kategoriler))


            <div id="tabmenu1" class="card">
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav tabs-admin" role="tablist">
                        @foreach( $kategoriler as $kategori)
                            <li role="presentation" class="nav-item"><a @if($j==1)class="nav-link active" @else class="nav-link"  @endif href="#t{{$j}}" aria-controls="t{{$j}}" role="tab" data-toggle="tab">{{$kategori->kategori_ad}}</a></li>
                            <?php $j++; ?>
                        @endforeach


                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content admin-tab-content">
                        @for($a=1;$a<$j;$a++)

                            <div role="tabpanel" @if($a==1) class="tab-pane active show" @else class="tab-pane" @endif  id="t{{$a}}">
                                <div class="container">

                                    <?php $datam=[]; $verim=egzersizkategori_id($egzersiz_kategorileri_id[$a-1]);

                                    ?>

                                    @foreach($verim as $veri)
                                        <?php

                                        $deger=\App\Egzersiz::where('egzersiz_kategori',$veri)->where('aktif',1)->get()->groupBy('egzersiz_isim');

                                        if($deger!=null){
                                            $egzersizler=$deger;
                                            // $i++;
                                        }
                                        else{

                                            $egzersizler=null;

                                        }
                                        ?>


                                        @if($egzersizler!=null)
                                            @foreach($egzersizler as $egzersiz)

                                                <?php  $i++;
                                                $olan_hareket=null;

                                                ?>

                                                @foreach($setler as $setlerim)

                                                    @if($setlerim->egzersiz_isim==$egzersiz[0]->egzersiz_isim)
                                                        <?php
                                                        $olan_hareket=$setlerim;
                                                        ?>

                                                    @endif

                                                @endforeach


                                                <div id="wiget">
                                                    <div >
                                                        <img width="90" height="90" src="{{asset($egzersiz[0]->resim)}}" alt="">

                                                        <h6 align="center" class="text-black">{{$egzersiz[0]->egzersiz_isim}}</h6>

                                                        <div class="widget-content">


                                                            <input type="hidden" name="egzersiz-{{$i}}" value="{{$egzersiz[0]->egzersiz_isim}}">


                                                            <div id="max-min-set">
                                                                set
                                                                <div class="input-group">

                                                  <span class="input-group-btn">
                                                    <button id="set-{{$i}}"  type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                   <span class="glyphicon glyphicon-minus"></span>
                                                    </button>
                                                    </span>
                                                                    <input id="set-{{$i}}" type="text" name="set-{{$i}}"  class="form-control input-number" @if($olan_hareket!=null) value="{{$olan_hareket->set}}" @elseif(isset($set_tekrar)) value="{{$set_tekrar}}" @else value="0" @endif  min="0" max="500">
                                                                    <span class="input-group-btn">
              <button id="set-{{$i}}" type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
                                                                </div>

                                                            </div>






                                                            <div id="max-min-tekrar">
                                                                tekrar
                                                                <div class="input-group">

          <span class="input-group-btn">
              <button id="tekrar-{{$i}}"  type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
                                                                    <input id="tekrar-{{$i}}" type="text" name="tekrar-{{$i}}" class="form-control input-number" @if($olan_hareket!=null) value="{{$olan_hareket->tekrar}}" @elseif(isset($tekrar_tekrar)) value="{{$tekrar_tekrar}}" @else value="0" @endif min="0" max="500">
                                                                    <span class="input-group-btn">
              <button id="tekrar-{{$i}}" type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
                                                                </div>

                                                            </div>



                                                            <div class="center" id="max-min-dinlen">
                                                                dinlenme(sn)
                                                                <div class="input-group">

          <span class="input-group-btn">
              <button id="dinlenme-{{$i}}"  type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
                                                                    <input id="dinlenme-{{$i}}" type="text" name="dinlenme-{{$i}}" class="form-control input-number" @if($olan_hareket!=null) value="{{$olan_hareket->dinlenme}}" @elseif(isset($dinlenme_tekrar)) value="{{$dinlenme_tekrar}}" @else value="0" @endif min="0" max="500">
                                                                    <span class="input-group-btn">
              <button id="dinlenme-{{$i}}" type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
                                                                </div>

                                                            </div>



                                                            <div id="gunler" class="container left">
                                                                <div class="row input-group">
                                                                    <div class="col-md-6">
                                                                        <label for="lebel"> Haftalık T.</label>
                                                                    <select name="haftalik_tekrar-{{$i}}">
                                                                        <option value="">Seçiniz</option>
                                                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 1") selected @endif @else  @if($olan_hareket!=null) @if($olan_hareket->haftalik_tekrar=="Haftada 1") selected @endif @endif @endif value="Haftada 1">Haftada 1</option>
                                                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 2") selected @endif @else  @if($olan_hareket!=null) @if($olan_hareket->haftalik_tekrar=="Haftada 2") selected @endif @endif @endif value="Haftada 2">Haftada 2</option>
                                                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 3") selected @endif @else  @if($olan_hareket!=null) @if($olan_hareket->haftalik_tekrar=="Haftada 3") selected @endif @endif @endif value="Haftada 3">Haftada 3</option>
                                                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 4") selected @endif @else  @if($olan_hareket!=null) @if($olan_hareket->haftalik_tekrar=="Haftada 4") selected @endif @endif @endif value="Haftada 4">Haftada 4</option>
                                                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 5") selected @endif @else  @if($olan_hareket!=null) @if($olan_hareket->haftalik_tekrar=="Haftada 5") selected @endif @endif @endif value="Haftada 5">Haftada 5</option>
                                                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 6") selected @endif @else  @if($olan_hareket!=null) @if($olan_hareket->haftalik_tekrar=="Haftada 6") selected @endif @endif @endif value="Haftada 6">Haftada 6</option>
                                                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Her gün") selected @endif @else    @if($olan_hareket!=null) @if($olan_hareket->haftalik_tekrar=="Her gün") selected @endif @endif   @endif value="Her gün">Her gün</option>
                                                                    </select>
                                                                    </div>


                                                                            <div class="col-md-6">
                                                                                <label for="lebel"> Günlük T.</label>
                                                                    <select name="gunluk_tekrar-{{$i}}">
                                                                        <option value="">Seçiniz</option>
                                                                        <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 1") selected @endif @else @if($olan_hareket!=null) @if($olan_hareket->gunluk_tekrar=="Günde 1") selected @endif @endif @endif  @if($olan_hareket!=null) @if($olan_hareket->gunluk_tekrar=="Günde 1") selected @endif @endif value="Günde 1">Günde 1</option>
                                                                        <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 2") selected @endif @else  @if($olan_hareket!=null) @if($olan_hareket->gunluk_tekrar=="Günde 2") selected @endif @endif @endif value="Günde 2">Günde 2</option>
                                                                        <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 3") selected @endif @else  @if($olan_hareket!=null) @if($olan_hareket->gunluk_tekrar=="Günde 3") selected @endif @endif @endif value="Günde 3">Günde 3</option>
                                                                        <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 4") selected @endif @else  @if($olan_hareket!=null) @if($olan_hareket->gunluk_tekrar=="Günde 4") selected @endif @endif @endif value="Günde 4">Günde 4</option>
                                                                        <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 5") selected @endif @else  @if($olan_hareket!=null) @if($olan_hareket->gunluk_tekrar=="Günde 5") selected @endif @endif @endif value="Günde 5">Günde 5</option>
                                                                        <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 6") selected @endif @else  @if($olan_hareket!=null) @if($olan_hareket->gunluk_tekrar=="Günde 6") selected @endif @endif @endif value="Günde 6">Günde 6</option>
                                                                    </select>
                                                                            </div>
                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>

                                                </div><!--col-->

                                            @endforeach
                                        @endif

                                    @endforeach



                                </div>

                            </div>

                        @endfor
                    </div>
                </div>









                <!-- <button class="btn btn-success btn-xs" type="button" onclick="formgonder()" name="deger">Gönder</button>-->



            </div>
        @endif
        <br>

        <button style="margin-left: 18px" type="submit" class="btn btn-success">Programı Kaydet</button>
        </form>





    </div>






@endsection

@section('js')
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>





    <script>
        $('.btn-number').click(function(e){
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type      = $(this).attr('data-type');
                id=$(this).attr('id');

                var input = $("input[id='"+id+"']");
                var currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    if(type == 'minus') {

                        if(currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if(parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if(type == 'plus') {

                        if(currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if(parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            }

        );

        $('.input-number').focusin(function(){
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {

                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }



            }

        );
        $(".input-number").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            }

        );

        function formgonder(){

            var data = {},inp;
            var val;
            var id;
            var idler = ["set", "tekrar", "dinlenme"];

            //optiondan gelen veriyi aliyoruz
            var option = document.getElementById('combobox');
            data['combobox']=option.value;


            for(var j = 0; j < idler.length; j++){
                for(var i = 1; i <= parseInt("{{count($egzersizler_sayi)}}"); i++){
                    id = idler[j] + "-" + i;
                    inp = document.getElementsByName(id)[0];
                    val = inp.value;
                    data[id] = val;
                }
            }

            data["_token"] = "{{csrf_token()}}";

            $.ajax({
                type: "POST",
                url: "{{url('/egzersizplan')}}",
                data: data
            }).then(function(response) {
                if(response.result=="dogru"){
                    alert('kaydiniz gerceklesmistir');
                }else{
                    alert('!kaydiniz gerceklesmemistir');
                }
                console.log(response);
            });
        }

    </script>





    <!--combobax hasta isinlerini gostermek icin scriptler-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $.widget( "custom.combobox", {
                _create: function() {
                    this.wrapper = $( "<span>" )
                        .addClass( "custom-combobox" )
                        .insertAfter( this.element );

                    this.element.hide();
                    this._createAutocomplete();
                    this._createShowAllButton();
                },

                _createAutocomplete: function() {
                    var selected = this.element.children( ":selected" ),
                        value = selected.val() ? selected.text() : "";

                    this.input = $( "<input>" )
                        .appendTo( this.wrapper )
                        .val( value )
                        .attr( "title", "" )
                        .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
                        .autocomplete({
                            delay: 0,
                            minLength: 0,
                            source: $.proxy( this, "_source" )
                        })
                        .tooltip({
                            classes: {
                                "ui-tooltip": "ui-state-highlight"
                            }
                        });

                    this._on( this.input, {
                        autocompleteselect: function( event, ui ) {
                            ui.item.option.selected = true;
                            this._trigger( "select", event, {
                                item: ui.item.option
                            });
                        },

                        autocompletechange: "_removeIfInvalid"
                    });
                },

                _createShowAllButton: function() {
                    var input = this.input,
                        wasOpen = false;

                    $( "<a>" )
                        .attr( "tabIndex", -1 )
                        .attr( "title", "Bütün verileri göster" )
                        .tooltip()
                        .appendTo( this.wrapper )
                        .button({
                            icons: {
                                primary: "ui-icon-triangle-1-s"
                            },
                            text: false
                        })
                        .removeClass( "ui-corner-all" )
                        .addClass( "custom-combobox-toggle ui-corner-right" )
                        .on( "mousedown", function() {
                            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
                        })
                        .on( "click", function() {
                            input.trigger( "focus" );

                            // Close if already visible
                            if ( wasOpen ) {
                                return;
                            }

                            // Pass empty string as value to search for, displaying all results
                            input.autocomplete( "search", "" );
                        });
                },

                _source: function( request, response ) {
                    var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                    response( this.element.children( "option" ).map(function() {
                        var text = $( this ).text();
                        if ( this.value && ( !request.term || matcher.test(text) ) )
                            return {
                                label: text,
                                value: text,
                                option: this
                            };
                    }) );
                },

                _removeIfInvalid: function( event, ui ) {

                    // Selected an item, nothing to do
                    if ( ui.item ) {
                        return;
                    }

                    // Search for a match (case-insensitive)
                    var value = this.input.val(),
                        valueLowerCase = value.toLowerCase(),
                        valid = false;
                    this.element.children( "option" ).each(function() {
                        if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                            this.selected = valid = true;
                            return false;
                        }
                    });

                    // Found a match, nothing to do
                    if ( valid ) {
                        return;
                    }

                    // Remove invalid value
                    this.input
                        .val( "" )
                        .attr( "title", value + "Hasta Eşleşmesi Yapılmadı" )
                        .tooltip( "open" );
                    this.element.val( "" );
                    this._delay(function() {
                        this.input.tooltip( "close" ).attr( "title", "" );
                    }, 2500 );
                    this.input.autocomplete( "instance" ).term = "";
                },

                _destroy: function() {
                    this.wrapper.remove();
                    this.element.show();
                }
            });

            $( "#combobox" ).combobox();
            $( "#toggle" ).on( "click", function() {
                $( "#combobox" ).toggle();
            });
        } );
    </script>



@endsection

@section('css')

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://resources/demos/style.css">
    <style>
        .custom-combobox {
            position: relative;
            display: inline-block;
        }
        .custom-combobox-toggle {
            position: absolute;
            top: 0;
            bottom: 0;
            margin-left: -1px;
            padding: 0;
        }
        .custom-combobox-input {
            margin: 0;
            padding: 5px 10px;
        }
    </style>



    //tab menuler ıcın

    <style>



        #wiget{
            float: left;
            width:280px;
            margin-left:30px;
            margin-bottom: 30px;
            border-radius: 10px;
            font-family: Arial;
            color: black;

            background-color: aliceblue;

        }
        #max-min-set{
            width: 100px;
            height: 30px;
            margin-top: -30px;



        }


        #max-min-tekrar{
            width: 100px;
            height: 30px;
            margin-top:-30px ;
            margin-left: 150px;


        }

        #max-min-dinlen{
            width: 100px;
            height: 30px;
            margin-top:50px ;
            margin-left: 70px;

        }

        #gunler{
            margin-top: 50px;

        }

        #haftalık-tekrarlar{

            float: left;
            margin-right: 50px;
        }

        #gunluk-tekrarlar{
            margin-right: 40px;
            margin-bottom: 25px;

        }

        #tum-hareketler{


            margin-top: 30px;
            margin-bottom: 50px;

        }

        .select{
            font-family: Arial;
            font-size: 19px;
        }

        .ui-widget{
            font-family: Arial;
            font-size: 17px;

        }
        #tabmenu1{
            height: 100%;
            width:100%;
            left: 15px;
            background-color: rgba(21, 99, 111, 0.11);
            border-radius: 10px;
        }


        input[type=submit]:hover {
            background-color: #76a07c;
        }


    </style>


    <style>
        #tekrarlar{
            margin-top: 20px;
            background-color:rgba(21, 99, 111, 0.11);
            height: 150px;
            padding: 5px;
            width: 1040px;
            border-radius: 10px;
            color: black;
            margin-left: 15px;
        }

        #tum-hareketler{
            margin-top: 30px;
            margin-bottom: 50px;

        }

        #haftalık-tekrarlar{

            float: left;
            margin-right: 50px;
        }

        #gunluk-tekrarlar{
            margin-right: 40px;
            margin-bottom: 25px;

        }

        #set-tekrarlar{
            float: left;
            color: black;
            font-size: 20px;

        }
        #tekrar-tekrarlar{
            float: left;
            font-size: 20px;
        }


        input[id=setbilgisi]{
            width: 138px;
            border-radius: 8px;
            height: 40px;
            margin-right: 30px;
        }
        #dinlenme-tekrarlar{
            float: left;
            margin-right: 75px;
            font-size: 20px;
        }
        button[id=tumhareketlerbutton]{

            margin-top: -50px;
        }

        select[name=gunluk_tekrar]{

            width: 200px;
            border-radius: 8px;
            height: 38px;
        }


        select[name=haftalik_tekrar]{

            width: 200px;
            height: 38px;
            border-radius: 8px;
        }

        #hazir_plan_imi{
            margin-top: 20px;
            background-color:rgba(21, 99, 111, 0.11);
            height: 100px;
            padding: 5px;
            width: 1040px;
            border-radius: 10px;
            color: black;
            margin-left: 15px;
            padding-top: 25px;
        }

        input[name=combobox]{

            width: 250px;
            border-radius: 8px;
            height: 38px;
        }

    </style>

@endsection