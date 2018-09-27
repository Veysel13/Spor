<html>


<head>

    <meta charset="utf-8">
<title>Kitap Listesi</title>

</head>

<body>

@if(isset($kitapguncelle))
    <form action="{{url('/guncelle')}}" method="post">

        {{csrf_field()}}



        Kitap ad=<input type="text" name="ad" value="{{$kitapguncelle->ad}}"> <br> <br>
        Kitap turu=<input type="text" name="turu" value="{{$kitapguncelle->turu}}"> <br> <br>
        Kitap sayfa=<input type="text" name="sayfa" value="{{$kitapguncelle->sayfa}}"><br> <br>
        <input hidden name="kitap_id" value="{{$kitapguncelle->id}}">
        <input type="submit" name="guncelle" value="Güncelle"><br> <br>



    </form>
@else
<form action="{{url('/kayit')}}" method="post">

    {{csrf_field()}}



    Kitap ad=<input type="text" name="ad"> <br> <br>
    Kitap turu=<input type="text" name="turu"> <br> <br>
    Kitap sayfa=<input type="text" name="sayfa"><br> <br>
    <input type="submit" name="kayit" value="Kaydet"><br> <br>



</form>
@endif
<hr>

<table border="2px">

    <tr>
        <th>Kitap Adı</th>
        <th>Kitap Turu</th>
        <th>Kitap sayfa</th>
        <th>İşlemler</th>
    </tr>
    @foreach($kitaplar as $veri)
    <tr>

        <td>{{$veri->ad}}</td>
        <td>{{$veri->turu}}</td>
        <td>{{$veri->sayfa}}</td>
        <td><a href="{{url('/sil/'.$veri->id)}}">Sil</a></td>
        <td><a href="{{url('/guncelle/'.$veri->id)}}">Güncelle</a></td>

    </tr>
    @endforeach

</table>



</body>
</html>


