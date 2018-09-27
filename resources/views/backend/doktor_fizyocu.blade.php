<!DOCTYPE html>
<html lang="tr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <!-- Plugins CSS -->
    <link href="/Back/css/plugins/plugins.css" rel="stylesheet">
    <link href="/Back/smart-form/smart-templates/css/smart-forms.css" rel="stylesheet">
    <link href="/Back/css/style.css" rel="stylesheet">
</head>

<body class="layout-accounts">
<div class="account-wrap">
    <div class="account-card">
        <div class="account-content smart-forms">
            <div class="text-center">
                <a href="index.html"><img src="images/logo.png" alt=""></a>

            </div>



            <div align="right">

                <!-- <p id="yanip-sonen">Eksik Girdiğiniz Egzeriz varsa</p>-->

                <a  href="/doktor_fizyocu_liste"><button type="submit" class="btn btn-success bnt-xs">Geri Dön</button></a>

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
            <form class="form-horizontal" method="POST" action="{{ url('/doktor_fizyocu_ekleme') }}">
                {{ csrf_field() }}
                <div class="form-body">

                    <div class="spacer-b30">
                        <div class="tagline"><span>Kayıt Yönetim Paneli </span></div><!-- .tagline -->
                    </div>


                    <div class="section">
                        <label class="field prepend-icon">
                            <input type="text" name="name" id="name" class="gui-input" required="required" placeholder="Kullanici İsmi Giriniz">
                            <span class="field-icon"><i class="fa fa-user"></i></span>
                        </label>
                    </div><!-- end section -->

                    <div class="section">
                        <label class="field prepend-icon">
                            <input type="email" name="email" id="email" class="gui-input" required="required" placeholder="Email Adresi Giriniz">
                            <span class="field-icon"><i class="fa fa-user"></i></span>
                        </label>
                    </div><!-- end section -->

                    <div class="section">
                        <label class="field prepend-icon">
                            <input type="password" name="password" id="password" class="gui-input" required="required" placeholder="Şifre Giriniz">
                            <span class="field-icon"><i class="fa fa-lock"></i></span>
                        </label>
                    </div><!-- end section -->
                    <div class="section">
                        <label class="field prepend-icon">
                            <input type="password" name="password_confirmation" id="passwordC" required="required" class="gui-input" placeholder="Şİfre Tekrar">
                            <span class="field-icon"><i class="fa fa-lock"></i></span>
                        </label>
                    </div><!-- end section -->

                    <div class="section">
                        <div class="option-group field">
                            <div class="smart-option-group">
                                <label for="city1" class="option">
                                    <input type="radio" id="city1" name="city" value="doktor">
                                    <span class="smart-option smart-radio">
                                                                    <span class="smart-option-ui"> <i class="iconc"></i> Doktor </span>
                                                                </span>
                                </label>

                                <label for="city2" class="option">
                                    <input type="radio" id="city2" name="city" value="fizyoterapist">
                                    <span class="smart-option smart-radio">
                                                                    <span class="smart-option-ui"> <i class="iconc"></i>  Fizyoterapist </span>
                                                                </span>
                                </label>




                            </div><!--  smart-option-group -->
                        </div><!-- end .option-group section -->
                    </div><!-- end section -->






                </div><!-- end .form-body section -->
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Kayıt Ol</button>
                </div><!-- end .form-footer section -->

            </form>

            
            

        </div>
    </div>
</div>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script type="text/javascript" src="/Back/js/plugins/plugins.js"></script>
<script type="text/javascript" src="/Back/js/assan.custom.js"></script>
</body>
</html>
