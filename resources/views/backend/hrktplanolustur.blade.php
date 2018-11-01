@extends('backend.app')
@section('icerik')


    <div class="content">
            <div class="page-title pt30 pb30">
                <div class="row">
                    <div class="col-sm-12">

                        <h4  class="mb0">Hareket Planı Oluştur</h4>


                        <div align="right" class="hastaekle">
                            <a   href="/hastakayitformu"><button  type="submit" class="btn btn-warning bnt-xs">Hasta ekle</button></a>
                        </div>


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
                        <form id="form" data-parsley-validate class="form-horizontal form-label-left" action="/egzersizplan" method="get">


                            <div  id="tum-hareketler">

                            <div id="haftalık-tekrarlar" class="select22">

                                   Haftalık T. :

                                    <select name="haftalik_tekrar">

                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 1") selected @endif @endif value="Haftada 1">Haftada 1</option>
                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 2") selected @endif @endif value="Haftada 2">Haftada 2</option>
                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 3") selected @endif @endif value="Haftada 3">Haftada 3</option>
                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 4") selected @endif @endif value="Haftada 4">Haftada 4</option>
                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 5") selected @endif @endif value="Haftada 5">Haftada 5</option>
                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 6") selected @endif @endif value="Haftada 6">Haftada 6</option>
                                        <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Her gün") selected @endif @endif value="Her gün">Her gün</option>
                                    </select>

                                </div>


                                <br class="asagiyaatma">

                               <div id="gunluk-tekrarlar" class="select">

                                   Günlük T. :

                                    <select name="gunluk_tekrar">

                                        <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 1") selected @endif @else selected @endif value="Günde 1">Günde 1</option>
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


                                <br class="asagiyaatma">
                                <br class="asagiyaatma">
                                <br class="asagiyaatma">

                                <div id="tekrar-tekrarlar" >

                                    Tekrar:
                                    <input type="number" @if(isset($tekrartekrar)) value="{{$tekrartekrar}}" @endif name="tekrar_tekrar" id="setbilgisi" min="0">

                                </div>


                                <br class="asagiyaatma">


                                <div id="dinlenme-tekrarlar" >

                                    Dinlenme:
                                    <input type="number" @if(isset($dinlenmetekrar)) value="{{$dinlenmetekrar}}" @endif name="dinlenme_tekrar" id="setbilgisi" min="0">

                                </div>


                                    <button id="tumhareketlereuygula" style="font-size: 11px"  type="submit" id="tumhareketlerbutton" class="btn btn-danger btn-xs">Tüm Hareketlere Uygula *</button>
                                <button id="tumhareketlereuygulaplus"   type="submit" id="tumhareketlerbutton" class="btn btn-danger btn-xs"><i class="fa fa-plus"></i>  *</button>
                            </div>




                        </form>

  </div>





                     <!--   <div id="set_tekrarları">

                            <form id="form" data-parsley-validate class="form-horizontal form-label-left" action="/egzersizplan" method="get">


                                <div  id="tum-hareketler2">

                                    <div id="set-tekrarlar" >

                                        Set :
                                        <input type="number" @if(isset($settekrar)) value="{{$settekrar}}" @endif name="set_tekrar" id="setbilgisi">

                                    </div>
                                    <div id="tekrar-tekrarlar" >

                                       Tekrar:
                                        <input type="number" @if(isset($tekrartekrar)) value="{{$tekrartekrar}}" @endif name="tekrar_tekrar" id="setbilgisi">

                                    </div>

                                    <div id="dinlenme-tekrarlar" >

                                        Dinlenme:
                                        <input type="number" @if(isset($dinlenmetekrar)) value="{{$dinlenmetekrar}}" @endif name="dinlenme_tekrar" id="setbilgisi">

                                    </div>

                                    <button type="submit" class="btn btn-danger btn-xs">Tüm Hareketlere Uygula *</button>
                                </div>

                            </form>


                        </div>-->
                        <br>

                        <div id="hazir_planlaricin">
                        <form id="form" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data" method="get" action="{{url('/hazir/egzersizplan/ata')}}"  >

                                <div class="ui-widget">
                                    <label>Hareket Planı Seciniz : </label>
                                    <select style="width: 300px" id="combobox_plan"  name="combobox_plan" class="select2">
                                        <option value="">Plan İsimleri...</option>
                                        @foreach($planlar as $plan)
                                            <option  ><?php echo $plan[0]->plan_ismi;?></option>
                                        @endforeach
                                    </select>
                                        <button   type="submit" class="btn-success btn-xs hazirplan">Hazir Planı  Ata</button>
                                </div>

                        </form>

                        </div>






                            <form id="form" data-parsley-validate class="form-horizontal form-label-left"  enctype="multipart/form-data" method="POST" action="{{url('/egzersizplan_session')}}"  >

                                {{csrf_field()}}







                                <div id="program_bilgisi">
                                    <div id="baslangıc_tarihi" >
                                        <label for="">Program Başlangıç Tarihi *:</label>
                                        <br>
                                        <input type="date" required @if(isset( $id['baslangic_tarihi'])) value="{{$id['baslangic_tarihi']}}" @else  @endif name="baslangic_tarihi">
                                    </div>

                                    <br class="asagiyaatma">
                                    <br class="asagiyaatma">
                                    <br class="asagiyaatma">
                                    <br class="asagiyaatma">

                                    <div id="bitis_tarihi">
                                        <label for="">Program Bitiş Tarihi *:</label>
                                        <br>
                                        <input type="date" required name="bitis_tarihi" @if(isset( $id['bitis_tarihi'])) value="{{$id['bitis_tarihi']}}" @endif>
                                    </div>

                                    <br class="asagiyaatma">
                                    <br class="asagiyaatma">
                                    <br class="asagiyaatma">
                                    <br class="asagiyaatma">
                                    <div id="program_adı">
                                        <label for="">Program Adı *:</label>
                                        <br>
                                        <input type="text" required name="program_adi" @if(isset( $id['program_adi'])) value="{{$id['program_adi']}}" @endif>
                                    </div>

                                </div>



                                @if(isset($hastalar))
                    <div id="hasta_combabox">
                        <div class="ui-widget">
                            <label>Hasta İsmi Seciniz <span>*(zorunlu)</span>: </label>
                            <select id="combobox" required name="combobox" class="select2">
                                <option value="">Hasta İsimleri...</option>
                                @foreach($hastalar as $hasta)
                                    <option @if(isset($id['hasta_id'])) @if($id['hasta_id']==$hasta->id) selected @endif @endif value="{{$hasta->id}}"><?php echo $hasta->hasta_ad."  ".$hasta->hasta_soyad;?></option>
                               @endforeach
                            </select>
                        </div>
                    </div>
                            @endif
                        <!--<button  id="toggle">Hasta isimlerini Göster</button>-->




                    </div>
                </div>
            </div><!--page title-->


        <div align="right" id="ilave_buton">
            <button type="submit" class="btn btn-success">Programı Kaydet</button>
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

                                                    <?php  $i++; ?>

                                        <div id="wiget">
                                            <div>
                                                <img style="margin-left:15%; ;width:100px; height: 90px; "  src="{{asset($egzersiz[0]->resim)}}" alt="">
                                                <img style="width:100px; height: 90px; "  src="{{asset($egzersiz[0]->resim_iki)}}" alt="">



                                                <h6 onclick="haro('{{$egzersiz[0]->egzersiz_isim}}')"  align="center" id="h6_baslik" class="text-black">{{$egzersiz[0]->egzersiz_isim}}</h6>
                                                    <script>
                                                function haro(element) {

                                                var deger=element;
                                                $(location).attr('href', '/EgzersizDetay/'+deger);
                                                }
                                                    </script>
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
                                                            <input id="set-{{$i}}" type="text" name="set-{{$i}}"  class="form-control input-number" @if(isset( $id['set-'.$i])) value="{{$id['set-'.$i]}}" @elseif(isset($settekrar)) value="{{$settekrar}}"  @else value="0"@endif min="0" max="500">
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
                                                            <input id="tekrar-{{$i}}" type="text" name="tekrar-{{$i}}" class="form-control input-number" @if(isset( $id['tekrar-'.$i])) value="{{$id['tekrar-'.$i]}}" @elseif(isset($tekrartekrar)) value="{{$tekrartekrar}}"  @else value="0"@endif min="0" max="500">
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
                                                            <input id="dinlenme-{{$i}}" type="text" name="dinlenme-{{$i}}" class="form-control input-number" @if(isset( $id['dinlenme-'.$i])) value="{{$id['dinlenme-'.$i]}}" @elseif(isset($dinlenmetekrar)) value="{{$dinlenmetekrar}}" @else value="0"@endif min="0" max="500">
                                                            <span class="input-group-btn">
              <button id="dinlenme-{{$i}}" type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
                                                        </div>

                                                    </div>

                                                    <div id="gunler" class="container left">
                                                        <div class="row input-group">
                                                            <div class="col-md-6 col-sm-6 col-6 ">
                                                                <label for="lebel"> Haftalık T.</label>
                                                            <select name="haftalik_tekrar-{{$i}}">

                                                                <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 1") selected @endif @endif  @if(isset( $id['haftalik_tekrar-'.$i])) @if($id['haftalik_tekrar-'.$i]=="Haftada 1") selected @endif @endif value="Haftada 1">Haftada 1</option>
                                                                <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 2") selected @endif @endif  @if(isset( $id['haftalik_tekrar-'.$i])) @if($id['haftalik_tekrar-'.$i]=="Haftada 2") selected @endif @endif value="Haftada 2">Haftada 2</option>
                                                                <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 3") selected @endif @endif  @if(isset( $id['haftalik_tekrar-'.$i])) @if($id['haftalik_tekrar-'.$i]=="Haftada 3") selected @endif @endif value="Haftada 3">Haftada 3</option>
                                                                <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 4") selected @endif @endif  @if(isset( $id['haftalik_tekrar-'.$i])) @if($id['haftalik_tekrar-'.$i]=="Haftada 4") selected @endif @endif value="Haftada 4">Haftada 4</option>
                                                                <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 5") selected @endif @endif  @if(isset( $id['haftalik_tekrar-'.$i])) @if($id['haftalik_tekrar-'.$i]=="Haftada 5") selected @endif @endif value="Haftada 5">Haftada 5</option>
                                                                <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Haftada 6") selected @endif @endif  @if(isset( $id['haftalik_tekrar-'.$i])) @if($id['haftalik_tekrar-'.$i]=="Haftada 6") selected @endif @endif value="Haftada 6">Haftada 6</option>
                                                                <option @if(isset($haftalik_tekrar))@if($haftalik_tekrar=="Her gün") selected @endif @endif    @if(isset( $id['haftalik_tekrar-'.$i])) @if($id['haftalik_tekrar-'.$i]=="Her gün") selected @endif @endif  value="Her gün">Her gün</option>
                                                            </select>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-6">
                                                                <label for="label">Günlük T.</label>
                                                            <select name="gunluk_tekrar-{{$i}}">

                                                                <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 1") selected @endif @endif  @if(isset( $id['gunluk_tekrar-'.$i]))  @if($id['gunluk_tekrar-'.$i]=="Günde 1") selected @endif @else selected @endif value="Günde 1">Günde 1</option>
                                                                <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 2") selected @endif @endif  @if(isset( $id['gunluk_tekrar-'.$i]))  @if($id['gunluk_tekrar-'.$i]=="Günde 2") selected @endif @endif value="Günde 2">Günde 2</option>
                                                                <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 3") selected @endif @endif  @if(isset( $id['gunluk_tekrar-'.$i]))  @if($id['gunluk_tekrar-'.$i]=="Günde 3") selected @endif @endif value="Günde 3">Günde 3</option>
                                                                <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 4") selected @endif @endif  @if(isset( $id['gunluk_tekrar-'.$i]))  @if($id['gunluk_tekrar-'.$i]=="Günde 4") selected @endif @endif value="Günde 4">Günde 4</option>
                                                                <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 5") selected @endif @endif  @if(isset( $id['gunluk_tekrar-'.$i]))  @if($id['gunluk_tekrar-'.$i]=="Günde 5") selected @endif @endif value="Günde 5">Günde 5</option>
                                                                <option  @if(isset($gunluk_tekrar))@if($gunluk_tekrar=="Günde 6") selected @endif @endif  @if(isset( $id['gunluk_tekrar-'.$i]))  @if($id['gunluk_tekrar-'.$i]=="Günde 6") selected @endif @endif value="Günde 6">Günde 6</option>
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
      <script>


          options = [];

          // create an array of select options for a lookup
          $('.custom-select option').each(function(idx) {
              options.push({id: $(this).val(), text: $(this).text()});
          });


          $(".custom-select").select2({
              tags: "true",
              placeholder: "Select an option",
              allowClear: true,
              width: '100%',
              createTag: function (params) {
                  var term = $.trim(params.term);

                  if (term === '') {
                      return null;
                  }

                  // check whether the term matches an id
                  var search = $.grep(options, function( n, i ) {
                      return ( n.id === term || n.text === term); // check against id and text
                  });

                  // if a match is found replace the term with the options' text
                  if (search.length)
                      term = search[0].text;
                  else
                      return null; // didn't match id or text value so don't add it to selection

                  return {
                      id: term,
                      text: term,
                      value: true // add additional parameters
                  }
              }
          });

          $('.custom-select').on('select2:select', function (evt) {
              //console.log(evt);
              //return false;
          });




          <!-- Hazır plan atamma aıcın-->




          options = [];

          // create an array of select options for a lookup
          $('#combobox_plan option').each(function(idx) {
              options.push({id: $(this).val(), text: $(this).text()});
          });


          $("#combobox_plan").select2({
              tags: "true",
              placeholder: "Select an option",
              allowClear: true,
              width: '100%',
              createTag: function (params) {
                  var term = $.trim(params.term);

                  if (term === '') {
                      return null;
                  }

                  // check whether the term matches an id
                  var search = $.grep(options, function( n, i ) {
                      return ( n.id === term || n.text === term); // check against id and text
                  });

                  // if a match is found replace the term with the options' text
                  if (search.length)
                      term = search[0].text;
                  else
                      return null; // didn't match id or text value so don't add it to selection

                  return {
                      id: term,
                      text: term,
                      value: true // add additional parameters
                  }
              }
          });

          $('#combobox_plan').on('select2:select', function (evt) {
              //console.log(evt);
              //return false;
          });






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

        $("#combobox").select2({
            allowClear:true,
            placeholder: 'Position'
        });

    </script>

    <!--combobax hasta isinlerini gostermek icin scriptler-->
   <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
   <!-- <script>
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
                        .attr( "title ", value + " Hasta Eşleşmesi Yapılmadı" )
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

    <script>
        $( function() {
            $.widget( "custom.combobox_plan", {
                _create: function() {
                    this.wrapper = $( "<span>" )
                        .addClass( "custom-combobox_plan" )
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
                        .addClass( "custom-combobox_plan-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
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
                        .addClass( "custom-combobox_plan-toggle ui-corner-right" )
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
                        .attr( " title ", value +" Hasta Eşleşmesi Yapılmadı" )
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

            $( "#combobox_plan" ).combobox();
            $( "#toggle" ).on( "click", function() {
                $( "#combobox_plan" ).toggle();
            });
        } );
    </script>-->


@endsection

@section('css')

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://resources/demos/style.css">
    <link rel="stylesheet" href="/css/hpo.css">
    <link rel="stylesheet" href="/css/custom.css">

@endsection
