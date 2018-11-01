<!DOCTYPE html>
<html lang="tr">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Fizyoterapi Takip</title>
  <!-- Plugins CSS -->
  <link href="/Back/css/plugins/plugins.css" rel="stylesheet">
  <link href="/Back/smart-form/smart-templates/css/smart-forms.css" rel="stylesheet">
  <link href="/Back/css/style.css" rel="stylesheet">

  <style>
    #id{
    }
  </style>
</head>

<body class="layout-accounts">

<div class="account-wrap">
  <div class="account-card">
    <div class="account-content smart-forms">

      @if($errors->any())



          <div id="dikkat" class="alert alert-danger">

            <ul>
              @foreach($errors->all() as $error)
                <li>{{$error}}</li>

              @endforeach




            </ul>

        </div>

      @endif


      <div class="text-center">
        <h2 >Fizyo Takip</h2>
      </div>
      <form id="form" data-parsley-validate class="form-horizontal form-label-left"   method="POST" action="{{ route('login') }}"  >

        {{csrf_field()}}
        <div class="form-body">

          <div class="spacer-b30">
            <div class="tagline"><span>Giriş Yönetim Paneli </span></div><!-- .tagline -->
          </div>





          <div class="section">
            <label class="field prepend-icon">
              <input type="email" name="email" id="username" required="required" class="gui-input" placeholder="Email Giriniz">
              <span class="field-icon"><i class="fa fa-user"></i></span>
            </label>
          </div><!-- end section -->


          <div class="section">
            <label class="field prepend-icon">
              <input type="password" name="password" id="password" required="required" class="gui-input" placeholder="Şifre Giriniz">
              <span class="field-icon"><i class="fa fa-lock"></i></span>
            </label>
          </div><!-- end section -->



          <div id="guvemlik" class="section">
            <label class="field prepend-icon">
              <img id="captcha" src="/securimage/securimage_show.php" alt="CAPTCHA Image">
              <a class="btn btn-danger btn-xs" href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Değiştir ]</a>
            </label>
          </div><!-- end section -->

  <div class="section">
    <label class="field prepend-icon">
      <input type="text" name="guvenlik_kodu" id="username" required="required" class="gui-input" placeholder="Güvenlik kodunu giriniz...">
      <span class="field-icon"><i class="fa fa-user"></i></span>
    </label>
  </div><!-- end section -->

         <!-- <div class="section">
            <label class="switch block">
              <input type="checkbox" name="remember" id="remember" checked>
              <span class="switch-label" for="remember" data-on="Evet" data-off="Hayır"></span>
              <span> Beni Hatırla?</span>
            </label>
          </div><!-- end section -->

        </div><!-- end .form-body section -->
        <p style="margin-left: 25px"><a href="/password/reset">Şİfemi Unuttum</a></p>
        <div class="form-footer">
          <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
        </div><!-- end .form-footer section -->
        <div class="spacer-t30 spacer-b30 pt20">
          <div class="tagline"><span> Hesabınız Yoksa Kayıt Olun</span></div><!-- .tagline -->
        </div>
        <div class='text-center'>
          <a href='/kayit'>Kayıt Ol</a>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script type="text/javascript" src="/Back/js/plugins/plugins.js"></script>
<script type="text/javascript" src="/Back/js/assan.custom.js"></script>
</body>
</html>
