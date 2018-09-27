@extends('backend.app')
@section('icerik')


    <div class="content">
        <div class="container">
            <div class="page-title pt30 pb30">
                <div class="row">
                    <div class="col-sm-12">
                        <!--  <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>-->
                        <h4 class="mb0">Hareket Planı Oluştur</h4>
                    </div>
                </div>
            </div><!--page title-->

            <form  class="float-left"  action="{{url('/egzersizplan')}}">

                <button class="btn btn-primary">Hrkt Plani</button>
                &nbsp;&nbsp;&nbsp;
            </form>




            <form  action="{{url('/hareketplan')}}">

                <button class="btn btn-primary">Hrkt Plani Olustur</button>
            </form>

            <br>
            <form action="{{url('/egzersizplan')}}" method="post">
                {{csrf_field()}}
                <div class="row">


                    <?php $i=0 ?>

                    @foreach($hareketler as $hareket)

                        <?php $i++; ?>
                        <div class="col-md-12 col-lg-3 col-sm-pull-3">
                            <div class="widget-info clearfix mb30 bg-success">
                                <img width="80" height="130" src="{{$hareket->resim}}" alt="">



                                <div class="widget-content">
                                    <h6 align="left" class="text-black">{{$hareket->baslik}}</h6>





                                    set
                                    <div class="center">

                                        <div class="input-group">

                                                  <span class="input-group-btn">
                                                    <button id="set-{{$i}}"  type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                   <span class="glyphicon glyphicon-minus"></span>
                                                    </button>
                                                    </span>
                                            <input id="set-{{$i}}" type="text" name="set-{{$i}}" class="form-control input-number" value="0" min="1" max="100">
                                            <span class="input-group-btn">
              <button id="set-{{$i}}" type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
                                        </div>

                                    </div>




                                    tekrar

                                    <div class="center">

                                        <div class="input-group">

          <span class="input-group-btn">
              <button id="tekrar-{{$i}}"  type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
                                            <input id="tekrar-{{$i}}" type="text" name="tekrar-{{$i}}" class="form-control input-number" value="0" min="1" max="100">
                                            <span class="input-group-btn">
              <button id="tekrar-{{$i}}" type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
                                        </div>

                                    </div>

                                    dinlenme<div class="center">

                                        <div class="input-group">

          <span class="input-group-btn">
              <button id="dinlenme-{{$i}}"  type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
                                            <input id="dinlenme-{{$i}}" type="text" name="dinlenme-{{$i}}" class="form-control input-number" value="0" min="1" max="100">
                                            <span class="input-group-btn">
              <button id="dinlenme-{{$i}}" type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
                                        </div>

                                    </div>





                                </div>
                            </div>

                        </div><!--col-->
                    @endforeach













                </div>
                <button type="submit" name="deger">Gönder</button>

            </form>


        </div>
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


    </script>



@endsection

@section('css')


@endsection