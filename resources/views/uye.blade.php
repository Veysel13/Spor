<form action="{{url('/uye')}}" method="post">

    {{csrf_field()}}

    Ad <input type="text" name="name"> <br> <br>

    Email <input type="text" name="email"> <br> <br>
    Şifre <input type="text" name="password"> <br> <br>


        <input type="text" class="form-control"  name="password_confirmation">
    <input type="submit" value="Gönder" name="kaydet">


</form>

<?php
if(isset($_POST['kaydet'])){


}

?>

<hr>
@foreach($admin as $ad)
    {{$ad->name}}
    {{$ad->email}}
    <hr>
    @endforeach