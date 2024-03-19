<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Təklifim Var" />
    <meta property="og:description" content="“Regional İnkişaf” İctimai Birliyi (RİİB) tərəfindən hazırlanan
                                        www.teklifimvar.az portalına vətəndaşlar müxtəlif sosial-iqtisadi, infrastruktur və
                                        digər məsələlərlə bağlı təkliflərini göndərə biləcəklər" />
{{--    <meta property="og:image" content="{{ asset('/img/logo.svg') }}" />--}}
{{--    <meta property="og:image:width" content="640">--}}
{{--    <meta property="og:image:height" content="320">--}}
    <meta property="og:locale" content="AZ" />
    <meta property="fb:app_id" content="2724757394517647">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{setting('site.google_analytics_tracking_id')}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{setting('site.google_analytics_tracking_id')}}');
    </script>
    <link rel="icon" type="image/svg" href="/img/logo.svg" />
    <script src="https://kit.fontawesome.com/1e9e69eb15.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/style.css?v=0.01" />
    <link rel="stylesheet" href="/css/other.css?v=0.08" />
    @stack('css')
    <link rel="stylesheet" href="/css/snipper.css" />
    <link rel="stylesheet" href="/css/ekko-lightbox.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Təklifim Var</title>
</head>

<body>
<div id="overlay">
    <div class="spinner"></div>
</div>
<header>
    <nav>
        <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 right">
                        <ul>
                            <li>
                                <a href="#"><img src="/img/tel.svg" alt=""> 150</a>
                            </li>
                            <li>
                                <a target="_blank" href="mailto:info@teklifimvar.az"><img src="/img/message.svg" alt=""> info@teklifimvar.az</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-12 left networks">
                        <ul>
                            <li>
                                <a href="{{ setting('site.twitter_url') }}"><img src="/img/twit.svg" alt=""></a>
                            </li>
                            <li>
                                <a href="{{ setting('site.facebook_url') }}"><img src="/img/facebook.svg" alt=""></a>
                            </li>
                            <li>
                                <a href="{{ setting('site.instagram_url') }}"><img src="/img/insta.svg" alt=""></a>
                            </li>
                            <li>
                                <a href="{{ setting('site.youtube_url') }}"><img src="/img/you.svg" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-top main-menu">
            <div class="container">
                <div class="row">
                    <div class="logo col-lg-3 col-7">
                        <a href="{{ URL::to('/') }}">
                            <ul>
                                <li class="logo-img"><img src="/img/logo.svg" alt="" /></li>
                                <li class="logo-img"><img src="/img/logo-2.svg" alt="" /></li>
                            </ul>
                        </a>
                    </div>
                    <div class="col-5 mobil-button d-lg-none">
                        <button class="hamburger"><i class="fas fa-align-right"></i></button>
                    </div>
                    <div class="menu col-12 col-lg-9" id="mainMenu">
                        <ul>
                            <li><a href="{{ Url::to('/') }}">Ana Səhifə</a></li>
                            <li><a href="{{ route('all.offers') }}">Tǝkliflǝr</a></li>
                            <li><a href="{{ route('all.results') }}">Nǝticǝlǝr</a></li>
                            <li><a href="{{ route('about') }}">Haqqımızda</a></li>
                            @guest('site-user')
                                <li>
                                    <button data-toggle="modal" data-target="#modal-login" class="login">Daxil ol</button>
                                </li>
                                <li>
                                    <button data-toggle="modal" data-target="#modal-singUp" class="singUp">Qeydiyyat</button>
                                </li>
                            @endguest

                            @auth('site-user')
                                @php
                                    $user = auth('site-user')->user();
                                @endphp

                                <li class="parent">
                                    <a href="#"><i class="far fa-user-circle"></i>{{ $user->name }} </a>
                                    <ul class="sub-menu">
                                        <li> <a href="{{ route('user.profile', $user->id) }}">Şǝxsi kabinet</a> </li>
                                        <li><a href="{{ route('my.offers') }}">Mǝnim tǝkliflǝrim</a></li>
                                        <li><a href="{{ route('my.results') }}">Mǝnim nǝticǝlǝrim</a></li>
                                        <li data-toggle="modal" data-target="#modal-password"> <a>Şifrǝni dǝyiş</a></li>
                                        <li><a href="{{ route('user.logout') }}">Çıxış</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="{{ route('make.offer') }}" class="offer"><i class="fas fa-clipboard-list"></i>Tǝklif ver</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="modal fade " id="modal-login" tabindex="-1" role="dialog" aria-labelledby="modal-login" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content col-12">
                <div class="modal-body">
                    <div class="m-header">
                        <h4 class="modal-title"> Daxil ol</h4>
                        <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <label for="email">E-mail*</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="aykhansafarli@gmail.com">
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="">Şifrǝ*</label>
                            <span class="show_hide_password"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                            <input type="password" name="password" id="password" class="form-control"
                                   placeholder="****************">
                        </div>
                        <a href="#"  data-toggle="modal" data-target="#modal-password-new"><span>Şifrǝni unutdunuz mu?</span></a>
                        <div class="button">
                            <button type="submit" id="userLogin" class="">Daxil ol</button>
                            <button   data-toggle="modal" href="#modal-singUp" type="button" id="userRegister" class="">Qeydiyyatdan keç</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-singUp" tabindex="-1" role="dialog" aria-labelledby="modal-singUp"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content col-12">
                <div class="modal-body">
                    <div class="m-header">
                        <h4 class="modal-title"> Qeydiyyatdan keç</h4>
                        <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    <form action="" style="margin-top:25px!important;">
                        <div class="group" style="height: 557px; min-height: 300px;">
                        @csrf
                        <div class="form-group">
                            <label for="name">Ad*</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Aykhan">
                        </div>
                        <div class="form-group">
                                <label for="name">Soyad*</label>
                                <input type="text" name="surname" id="surname" class="form-control" placeholder="Safarli">
                        </div>
                        <div class="form-group">
                            <label for="fatherName">Ata adı*</label>
                            <input type="text" name="fatherName" id="fatherName" class="form-control" placeholder="Aykhan">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail*</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="aykhansafarli@gmail.com">
                        </div>
                        <div class="form-group" style="position: relative;">
                            <label for="">Şifrǝ*</label>
                                <span class="show_hide_password"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="****************">
                        </div>

                        <div class="form-group" style="position:relative;">
                            <label for="repeat-password">Şifrǝ tǝkrar*</label>
                            <span class="show_hide_password"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                            <input type="password" name="passwordConfirmation" id="passwordConfirmation" class="form-control"
                                   placeholder="****************">
                        </div>
                        <div class="form-group">
                            <label for="">Telefon nömrǝsi*</label>
                            <input type="tel"    value="+994 (__) ___-__-__" pattern="^\+994(\s+)?\(?(17|25|29|33|44)\)?(\s+)?[0-9]{3}-?[0-9]{2}-?[0-9]{2}$" name="phonenumber" id="phonenumber" class="form-control" >
                        </div>

                           <div class="form-group">
                               <button  data-toggle="modal" data-target="#rules" style="width:auto;background-color: transparent;padding:0;margin:0;color: #297fb8;font-weight: 400;text-align: left;" type="button" class="btn btn-link">Qaydalar və Şərtlər</button>
                           </div>

                        <div>
                            <div>
                                <input type="checkbox" id="cb1"> <label class="check" for="cb1">Qaydalar vǝ şǝrtlǝri qǝbul edirǝm</label>
                            </div>
                        </div>

                        <div class="button">
                            <button disabled style="opacity: .5" type="button" id="registerButton" onclick="registerUser(this)" class="">Qeydiyyatdan keç</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="modal-password"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content col-12">
                <div class="modal-body">
                    <div class="m-header">
                        <h4 class="modal-title"> Şifrǝni dǝyiş</h4>
                        <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    <form action="/change/user/password">
                        @csrf
                        <div class="form-group" style="position: relative">
                            <label for="">Köhnǝ şifrǝ</label>
                            <span class="show_hide_password"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                            <input type="password" name="old_password" id="old_password" class="form-control" placeholder="*******">
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="">Yeni şifrǝ</label>
                            <span class="show_hide_password"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="*******">
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="">Yeni şifrǝ tǝkrar</label>
                            <span class="show_hide_password"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="*******">
                        </div>
                        <div class="button">
                            <button type="button" class="" id="changePasswordButton" onclick="changePassword(this)">Yadda saxla</button>
                            <button type="button" >İmtina et</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-password-new" tabindex="-1" role="dialog" aria-labelledby="modal-singUp"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-header">
                        <h4 class="modal-title"> Şifrəni yenilə</h4>
                        <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="/img/x.svg" alt="">
                        </div>
                    </div>
                    <form action="">
                        @csrf
                        <div class="group">
                            <div class="form-group">
                                <label for="email">Zəhmət olmasa e-mailinizi daxil edin</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="aykhansafarli@gmail.com">
                            </div>
                        </div>
                        <div class="button">
                            <button type="button" onclick="sendPasswordResetLink(this)" class="" data-toggle="modal" data-target="#modal-sms">Şifrə yeniləmə linkini göndərin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="modal-forgot-password-success" tabindex="-1" role="dialog" aria-labelledby="modal-login"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/img/x.svg" alt="">
                    </div>
                    <div class="m-header">
                        <h4 class="modal-title" id="passwordForgot"></h4>

                    </div>
                    <div>
                        <img src="/img/123456 (1).svg" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade " id="modal-login-yes" tabindex="-1" role="dialog" aria-labelledby="modal-login"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/img/x.svg" alt="">
                    </div>
                    <div class="m-header">
                        <h4 class="modal-title" id="loginModalSuccess"></h4>
                    </div>
                    <div>
                        <img src="/img/123456 (1).svg" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="modal-password-change" tabindex="-1" role="dialog" aria-labelledby="modal-login"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/img/x.svg" alt="">
                    </div>
                    <div class="m-header">
                        <h4 class="modal-title" id="passwordChange"></h4>

                    </div>
                    <div>
                        <img src="/img/123456 (1).svg" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="modal-user-registration" tabindex="-1" role="dialog" aria-labelledby="modal-login"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/img/x.svg" alt="">
                    </div>
                    <div class="m-header">
                        <h4 class="modal-title" id="userRegistration"></h4>

                    </div>
                    <div>
                        <img src="/img/123456 (1).svg" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-xl" id="rules" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Elektron portaldan istifadə qaydaları</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Giriş</strong></p>
                    <p>Bu qaydalar “Təklifim var” portalından, onun xidmətlərindən, proqram
                        təminatı və vasitələrindən istifadənin şərt və müddəalarını özündə əks
                        etdirir.
                    </p>
                    <p>Vətəndaşlar portala ölkəmizin inkişafı, vətəndaşların həyat keyfiyyətinin
                        daha da yaxşılaşdırılması ilə bağlı ictimai əhəmiyyət kəsb edən və
                        cəmiyyətin mənafeyini əks etdirən məsələlər barədə təkliflərini göndərə
                        bilərlər.
                    </p>
                    <p>Portal üzrə xidmətləri “Regional İnkişaf” İctimai Birliyi həyata keçirir.</p>
                    <p>İstifadəçi portala məlumatları Azərbaycan, rus və ya ingilis dilində göndərə bilər.</p>
                    <p><strong>Qeydiyyat və öhdəliklər</strong><strong></strong></p>
                    <p>Portalın xidmətlərindən yalnız qeydiyyatdan keçən istifadəçilər yararlana bilər.</p>
                    <p>Qeydiyyatdan keçdikdən sonra siz portalın xidmətlərindən istifadə etmək
                        üçün email ünvanınız və təyin etdiyiniz paroldan istifadə edə bilərsiniz.
                    </p>
                    <p>Siz istifadəçi parolunuzun təhlükəsizliyinə, portalda etdiyiniz bütün
                        əməliyyatlara görə məsuliyyət daşıyırsınız.
                    </p>
                    <p>İstifadəçinin e-mail ünvanına qeydiyyatdan keçməsi barədə bildiriş göndərilir.</p>
                    <p>Qeydiyyat zamanı siz özünüz və təklifiniz barədə tam və düzgün məlumat verməyə məsuliyyət daşıyırsınız.</p>
                    <p>Portalda verilən informasiyanın düzgünlüyünə görə portalın rəhbərliyi heç bir məsuliyyət daşımır.</p>
                    <p>Aşağıdakılar qadağandır:</p>
                    <p> - portalın normal fəaliyyətinə mane olmaq;</p>
                    <p> - yanlış, aldadıcı, böhtan xarakterli məlumatlar yerləşdirmək;</p>
                    <p> - portalın iş prinsipinə mane olacaq spam və virusları yaymaq;</p>
                    <p> - üçüncü tərəfin müəllif hüquqlarını və portaldan istifadə şərtlərini pozmaq.</p>
                    <p><strong>Məlumatların yerləşdirilməsi</strong></p>
                    <p>Qeydiyyatdan keçmiş istifadəçi “Təklif ver” bölümünə daxil olmaqla
                        təklifini və ona aid foto və ya video materialları təqdim edir. Təklifin
                        qəbul və ya imtina edilməsi barədə 2 həftə ərzində onun e-mail ünvanına
                        məlumat göndərilir.
                    </p>
                    <p>“Təklifin məzmunu “teklifimvar.az” portalının qaydalarına və şərtlərinə uyğun olmadıqda, qeyri-etik,
                        alçaldıcı və böhtan xarakterli ifadələr işlədildikdə “Təklifim var” komandası tərəfindən onun portalda
                        yerləşdirilməsindən imtina ediləcək.”
                    </p>
                    <p>Göndərilən təklif araşdırıldıqdan sonra icraya yönəldirilir. Təkliflə bağlı
                        görülən işlərin nəticəsi barədə məlumat portalın "Nəticələr" bölməsində,
                        eləcə də şəxsi kabinetdə yerləşdirilir.
                    </p>
                    <p>Portalda göstərilən xidmətlər ödənişsizdir.</p>
                    <p><strong>Mübahisələrin həlli</strong></p>
                    <p>Bu portal üzrə tərəflər arasında yaranan mübahisələr danışıqlar yolu ilə həll edilməlidir.</p>
                    <p>Tərəflər arasında mübahisənin həlli qaydası haqqında razılaşma olmadıqda,
                        mübahisələr Azərbaycan Respublikasının məhkəmələrində həll olunacaqdır.
                    </p>
                </div>
            </div>
        </div>
    </div>


</header>

 @yield('content')

<footer>
    <div class="container">
        <div class="footer">
            <div class="row">
                <div class="logo col-12 col-lg-2">
                    <img src="/img/logo_footer.svg" alt="" />
                </div>
                <div class="menu col-12 col-lg-10">
                    <ul>
                        <li><a href="{{ route('all.offers') }}">Tǝkliflǝr</a></li>
                        <li><a href="{{ route('all.results') }}">Nǝticǝlǝr</a></li>
                        <li><a href="{{ route('about') }}">Haqqımızda</a></li>
{{--                        <li><a href="{{ route('questions') }}">FAQ</a></li>--}}
                        <li>
                            <ul class="networks">
                                <li>
                                    <a href="{{ setting('site.twitter_url') }}"><img src="/img/tw2.svg" alt=""></a>
                                </li>
                                <li>
                                    <a href="{{ setting('site.facebook_url') }}"><img src="/img/face2.svg" alt=""></a>
                                </li>
                                <li>
                                    <a href="{{ setting('site.instagram_url') }}"><img src="/img/inst.svg" alt=""></a>
                                </li>
                                <li>
                                    <a href="{{ setting('site.youtube_url') }}"><img src="/img/you2.svg" alt=""></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-fotter">
            <div class="row">
                <div class="logo col-lg-2">
                    <img src="/img/logo-2.svg" alt="" />
                </div>
                <div class="col-lg-4 right">
                    <span>2019 © teklifimvar.az All Rights Reserved</span>
                </div>
                <div class="left col-lg-6">
            <span>
{{--              <img src="/img/geo.svg" alt="">--}}
{{--              info@teklifimvar.az--}}
            </span>
                    <span>
             <img src="/img/tel2.svg" alt="">
              150
            </span>
                    <span>
              <img src="/img/message2.svg" alt="">
              info@teklifimvar.az
            </span>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/70923c8f65.js"></script>
<script src="{{ mix('/js/shave.js') }}"></script>
<script src="{{ mix('/js/main.js') }}?v=0.02"></script>
<script src="{{ mix('/js/jquery.custom-file-input.js') }}"></script>
<script src="/js/masked_input_1.4-min.js"></script>
<script src="/js/ekko-lightbox.min.js"></script>

<script>console.log('asdaasdasdasdassd')</script>
    <script>
        $(document)
            .ajaxStart(function () {
              $('#overlay').show();
            })
            .ajaxStop(function () {
                $('#overlay').fadeOut(500);
            });

       /* $('.modal').on('show.bs.modal', function () {
            $('.modal').not($(this)).each(function () {
                $(this).modal('hide');
            });
        });*/

        var userRegisterFlag =0;
        function registerUser(element) {
        let elem =   $(element).parents('.modal-body');
        let data = elem.find('form').serialize();

          if(userRegisterFlag) {
              return false;
          }

            $.ajax({
                url: '/user',
                method: 'POST',
                dataType: 'json',
                context : elem,
                data: data,
                success: function (data) {
                    userRegisterFlag = 1;
                    errorMessageReset(elem);

                    $("#userRegistration").html(data.message);
                    $("#modal-user-registration").modal('show');

                    setTimeout(function(){
                        window.location.href = "/";
                    }, 1500);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    errorMessageReset(elem);

                    $.each(jqXHR.responseJSON.errors, function (key, value) {
                            let msg = '<p class="text-danger" style="font-size:12px;" for="' + key + '">' + value + '</p>';
                            elem.find("#" + key).css('border', '1px solid red').after(msg);
                    });

                }
            });
        }

        $("#userLogin").parents('form').submit(function () {
            loginUser('#userLogin');
            return false;
        });
        var loginFlag = 0;

        function loginUser(element) {
            let elem =   $(element).parents('.modal-body');
            let data = elem.find('form').serialize();

            if(loginFlag) {
               return false;
            }

             $.ajax({
                url: '/login',
                method: 'POST',
                dataType: 'json',
                context : elem,
                data: data,
                success: function (data) {
                    loginFlag = 1;
                    errorMessageReset(elem);

                    $("#loginModalSuccess").html(data.message);
                    $("#modal-login-yes").modal('show');

                    setTimeout(function(){
                        window.location.href = "/";
                    }, 1500);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    errorMessageReset(elem);
                    if ("errors" in jqXHR.responseJSON) {
                        $.each(jqXHR.responseJSON.errors, function(key,value) {
                            let msg = '<p class="text-danger" style="font-size:12px;" for="'+key+'">'+value+'</p>';
                            elem.find("#"+key).css('border','1px solid red').css('border','1px solid red').after(msg);
                        });
                    } else if (jqXHR.status === 404) {
                        let msg = '<p class="text-danger" style="font-size:12px;">'+jqXHR.responseJSON.message+'</p>';
                        elem.find('#email').css('border','1px solid red').after(msg)
                    } else if (jqXHR.status === 400) {
                        let msg = '<p class="text-danger" style="font-size:12px;">'+jqXHR.responseJSON.message+'</p>';
                        elem.find('#password').css('border','1px solid red').after(msg)
                    }
                }
            });
        }

        function userProfileUpdate(element) {
            let elem =   $(element).parents('form');
            let data = elem.serialize();
            let url = elem.attr('action');

            $.ajax({
                url: url,
                method: 'PUT',
                dataType: 'json',
                context : elem,
                data: data,
                success: function (data) {
                    errorMessageReset(elem);

                    $("#userProfileUpdate").html(data.message);
                    $("#modal-profile-update").modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    errorMessageReset(elem);

                    if ("errors" in jqXHR.responseJSON) {
                        $.each(jqXHR.responseJSON.errors, function(key,value) {
                            let msg = '<p class="text-danger" style="font-size:12px;" for="'+key+'">'+value+'</p>';
                            elem.find("#"+key).css('border','1px solid red').css('border','1px solid red').after(msg);
                        });
                    } else if (jqXHR.status === 403) {
                        let msg = '<h5 class="text-danger text-center">'+jqXHR.responseJSON.message+'</h5>';
                        elem.before(msg)
                    }
                }
            });
        }

        var changePasswordFlag =0
        function changePassword(element)
        {
            let elem =   $(element).parents('.modal-body');
            let data = elem.find('form').serialize();
            let url = elem.find('form').attr('action');

            if(changePasswordFlag) {
                return false;
            }

            $.ajax({
                url: url,
                method: 'PUT',
                dataType: 'json',
                context : elem,
                data: data,
                success: function (data) {
                    changePasswordFlag = 1;
                    errorMessageReset(elem);


                    $("#passwordChange").html(data.message);
                    $("#modal-password-change").modal('show');

                    setTimeout(function(){
                        window.location.href = "/logout";
                    }, 1500);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    errorMessageReset(elem);
                    console.log(jqXHR);
                    if ("errors" in jqXHR.responseJSON) {
                        $.each(jqXHR.responseJSON.errors, function(key,value) {
                            let msg = '<p class="text-danger" style="font-size:12px;" for="'+key+'">'+value+'</p>';
                            elem.find("#"+key).css('border','1px solid red').css('border','1px solid red').after(msg);
                        });
                    } else if (jqXHR.status === 400) {
                        let msg = '<p class="text-danger" style="font-size:12px;">'+jqXHR.responseJSON.message+'</p>';
                        elem.find('#old_password').css('border','1px solid red').after(msg)
                    }
                }
            });
        }

        var offerMakeFlag = 0

        $("form#offerMake").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let elem = $(this);

            if(offerMakeFlag) {
                return false;
            }

            $.ajax({
                url: '/offer',
                type: 'POST',
                data: formData,
                success: function (data) {
                    offerMakeFlag = 1;
                    errorMessageReset(elem);
                    elem.find('#makeOfferButton').attr('disabled', 'disabled');
                    $("#createOffer").html(data.message);
                    $("#modal-offer-yes").modal('show');
                   // return true;

                    setTimeout(function(){
                        window.location.href = "/";
                    }, 1500);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    errorMessageReset(elem);
                    if ("errors" in jqXHR.responseJSON) {
                        $.each(jqXHR.responseJSON.errors, function(key,value) {

                            if(key.indexOf('.') != -1){
                                let msg = '<p class="text-danger" style="font-size:12px;" for="'+key+'">'+value+'</p>';
                                elem.find("#"+ key.substring(0, 6)).css('border','1px solid red').css('border','1px solid red').after(msg);
                            }else{
                                let msg = '<p class="text-danger" style="font-size:12px;" for="'+key+'">'+value+'</p>';
                                elem.find("#"+key).css('border','1px solid red').css('border','1px solid red').after(msg);
                            }

                        });
                    } else if (jqXHR.status === 400) {
                        let msg = '<p class="text-danger" style="font-size:12px;">'+jqXHR.responseJSON.message+'</p>';
                        elem.find('#old_password').css('border','1px solid red').after(msg)
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        var offerLikeFlag = 0;

       function offerLike(element) {
           let elem =   $(element).parents('form');
           let data = elem.serialize();
           let url = elem.attr('action');
           let _this = $(element);

           if(offerLikeFlag) {
               return false;
           }

           $.ajax({
               url: url,
               method: 'POST',
               dataType: 'json',


               context : _this,
               data: data,
               success: function (data) {
                   offerLikeFlag = 1;
                   errorMessageReset(elem);
                   let msg = '<i class="far fa-thumbs-up"></i>'+data.message;
                   _this.html(msg);
               },
               error: function (jqXHR, textStatus, errorThrown) {
                   errorMessageReset(elem);
                   if ("errors" in jqXHR.responseJSON) {
                       $.each(jqXHR.responseJSON.errors, function(key,value) {
                           let msg = '<p class="text-danger" style="font-size:12px;" for="'+key+'">'+value+'</p>';
                           elem.find("#"+key).css('border','1px solid red').css('border','1px solid red').after(msg);
                       });
                   } else if (jqXHR.status === 404) {
                       let msg = '<p class="text-danger" style="font-size:13px;margin-top:15px;">'+jqXHR.responseJSON.message+'</p>';
                       elem.after(msg)
                   } else if (jqXHR.status === 400) {
                       let msg = '<p class="text-danger" style="font-size:13px;margin-top:15px;">'+jqXHR.responseJSON.message+'</p>';
                       elem.after(msg)
                   }
               }
           });
       }


        var resultLikeFlag = 0;

        function resultLike(element) {
            let elem =   $(element).parents('form');
            let data = elem.serialize();
            let url = elem.attr('action');
            let _this = $(element);

            if(resultLikeFlag) {
                return false;
            }

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',


                context : _this,
                data: data,
                success: function (data) {
                    resultLikeFlag = 1;
                    errorMessageReset(elem);
                    let msg = '<i class="far fa-thumbs-up"></i>'+data.message;
                    _this.html(msg);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    errorMessageReset(elem);
                    if ("errors" in jqXHR.responseJSON) {
                        $.each(jqXHR.responseJSON.errors, function(key,value) {
                            let msg = '<p class="text-danger" style="font-size:12px;" for="'+key+'">'+value+'</p>';
                            elem.find("#"+key).css('border','1px solid red').css('border','1px solid red').after(msg);
                        });
                    } else if (jqXHR.status === 404) {
                        let msg = '<p class="text-danger" style="font-size:13px;margin-top:15px;">'+jqXHR.responseJSON.message+'</p>';
                        elem.after(msg)
                    } else if (jqXHR.status === 400) {
                        let msg = '<p class="text-danger" style="font-size:13px;margin-top:15px;">'+jqXHR.responseJSON.message+'</p>';
                        elem.after(msg)
                    }
                }
            });
        }

       function forgotPasswordReset(element)
       {
           let elem =   $(element).parents('form');
           let data = elem.serialize();
           let url = elem.attr('action');
           let _this = $(element);
          /*
           if(offerLikeFlag) {
               return false;
           }*/

           $.ajax({
               url: url,
               method: 'POST',
               dataType: 'json',
               context : _this,
               data: data,
               success: function (data) {
                   offerLikeFlag = 1;
                   errorMessageReset(elem);
                   $("#passwordReset").html(data.message);
                   $("#modal-password-reset").modal('show');
               },
               error: function (jqXHR, textStatus, errorThrown) {
                   errorMessageReset(elem);
                   if ("errors" in jqXHR.responseJSON) {
                       $.each(jqXHR.responseJSON.errors, function(key,value) {
                           let msg = '<p class="text-danger" style="font-size:12px;" for="'+key+'">'+value+'</p>';
                           elem.find("#"+key).css('border','1px solid red').css('border','1px solid red').after(msg);
                       });
                   } else if (jqXHR.status === 404) {
                       let msg = '<p class="text-danger" style="font-size:13px;">'+jqXHR.responseJSON.message+'</p>';
                       elem.find('#email').after(msg)
                   } else if (jqXHR.status === 400) {
                       let msg = '<p class="text-danger" style="font-size:13px;">'+jqXHR.responseJSON.message+'</p>';
                       elem.find('#token').after(msg)
                   }
               }
           });
       }

       function sendPasswordResetLink(element)
       {
           let elem =   $(element).parents('.modal-body');
           let data = elem.find('form').serialize();

           $.ajax({
               url: '/password/email',
               method: 'POST',
               dataType: 'json',
               context : elem,
               data: data,
               success: function (data) {
                   errorMessageReset(elem);
                   $("#passwordForgot").html(data.message);
                   $("#modal-forgot-password-success").modal('show');
               },
               error: function (jqXHR, textStatus, errorThrown) {
                   errorMessageReset(elem);
                   if ("errors" in jqXHR.responseJSON) {
                       $.each(jqXHR.responseJSON.errors, function(key,value) {
                           let msg = '<p class="text-danger" style="font-size:12px;" for="'+key+'">'+value+'</p>';
                           elem.find("#"+key).css('border','1px solid red').css('border','1px solid red').after(msg);
                       });
                   } else if (jqXHR.status === 404) {
                       let msg = '<p class="text-danger" style="font-size:12px;">'+jqXHR.responseJSON.message+'</p>';
                       elem.find('#email').css('border','1px solid red').after(msg)
                   } else if (jqXHR.status === 400) {
                       let msg = '<p class="text-danger" style="font-size:12px;">'+jqXHR.responseJSON.message+'</p>';
                       elem.find('#password').css('border','1px solid red').after(msg)
                   }
               }
           });
       }

        $("form#offerUpdate").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let elem = $(this);
            $.ajax({
                url: elem.attr('action'),
                type: 'POST',
                data: formData,
                success: function (data) {
                    errorMessageReset(elem);
                    $("#createOffer").html(data.message);
                    $("#modal-offer-yes").modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    errorMessageReset(elem);
                    if ("errors" in jqXHR.responseJSON) {
                        $.each(jqXHR.responseJSON.errors, function(key,value) {

                            if(key.indexOf('.') != -1){
                                let msg = '<p class="text-danger" style="font-size:12px;" for="'+key+'">'+value+'</p>';
                                elem.find("#"+ key.substring(0, 6)).css('border','1px solid red').css('border','1px solid red').after(msg);
                            }else{
                                let msg = '<p class="text-danger" style="font-size:12px;" for="'+key+'">'+value+'</p>';
                                elem.find("#"+key).css('border','1px solid red').css('border','1px solid red').after(msg);
                            }

                        });
                    } else if (jqXHR.status === 400) {
                        let msg = '<p class="text-danger" style="font-size:12px;">'+jqXHR.responseJSON.message+'</p>';
                        elem.find('#old_password').css('border','1px solid red').after(msg)
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function errorMessageReset(element) {
            element.find('.text-danger').remove();
            element.find('input,textarea').css('border','1px solid #ced4da');
        }

        $(document).ready(function(){

            $('.image-area').on('click', '.remove-image', function (e) {
                $('#delete_form')[0].action = '{{ route('voyager.offer.image.destroy', '__id') }}'.replace('__id', $(this).data('id'));
                $('#delete_modal').modal('show');
            });

            $('.video-area').on('click', '.remove-video', function (e) {
                $('#delete_form')[0].action = '{{ route('voyager.offer.video.destroy', '__id') }}'.replace('__id', $(this).data('id'));
                $('#delete_modal').modal('show');
            });

            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });

            $("label[for='cb1']").click(function(){
                if(!$('#cb1').is(':checked')) {
                    $('#registerButton').removeAttr('style');
                    $('#registerButton').removeAttr('disabled');
                }
                else {
                    $('#registerButton').attr('disabled','disabled');
                    $('#registerButton').css('opacity','.5');
                }
            })

        });

        window.onload = function() {
            MaskedInput({
                elm: document.getElementById('phonenumber'), // select only by id
                format: '+994 (__) ___-__-__',
                separator: '+994 (   )-'
            });
        };

        $(".show_hide_password").on('click', function(event) {
            if($(this).next().attr("type") == "text"){
                $(this).next().attr('type', 'password');
                $(this).find('i').addClass( "fa-eye-slash" );
                $(this).find('i').removeClass( "fa-eye" );
            }else if($(this).next().attr("type") == "password"){
                $(this).next().attr('type', 'text');
                $(this).find('i').removeClass( "fa-eye-slash" );
                $(this).find('i').addClass( "fa-eye" );
            }
        });


    </script>
    @stack('js')
</body>
</html>
