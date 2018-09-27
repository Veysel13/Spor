<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">



    <style>
        *,h4{
            font-family:"DeJaVu Sans Mono",monospace;
        }
    </style>
</head>
<body>

<?php
$planlar=\App\Setler::where('aktif',1)
    ->where('plan_sayisi',$plan_sayisi)
    ->where('hasta_id',$hasta_id)
    ->get();

$program_baslangic=$planlar[0]->baslangic_tarihi;
$program_bitis=$planlar[0]->bitis_tarihi;

$hasta=\App\Hastalar::find($planlar[0]->hasta_id);
$hastaadi=$hasta->hasta_ad." ".$hasta->hasta_soyad;?>


<div class="container">
<h2 style="margin-left: 400px;">Egzersiz Plan Çizelgesi</h2>

    <br>
    <h4>Hasta Adı={{$hastaadi}} </h4>
    <br>
    <h4>Program Süresi={{$program_baslangic}}-->{{$program_bitis}}</h4>
    <br><br>

    <table class="table">
        <thead>
        <tr>
            <th>Egzersiz</th>
            <th>Set</th>
            <th>Tekrar</th>
            <th>Günlük Tekrar</th>
            <th>Haftalık Tekrar</th>
            <th>Pzt</th>
            <th>Sl</th>
            <th>Çrş</th>
            <th>Per</th>
            <th>Cm</th>
            <th>Cmt</th>
            <th>Pz</th>
        </tr>
        </thead>
        <tbody>
        @foreach($planlar as $plan)

            <tr>
                <td>{{$plan->egzersiz_isim}}</td>
                <td>{{$plan->set}}</td>
                <td>{{$plan->tekrar}}</td>
                <td>{{$plan->gunluk_tekrar}}</td>
                <td>{{$plan->haftalik_tekrar}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

        @endforeach


        </tbody>
    </table>
</div>

</body>
</html>
