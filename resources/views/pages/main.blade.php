@extends('layout')
@push('css')
        <meta property="og:image" content="{{ asset('/img/logo.svg') }}" />
    <style>
        video {
            width: 100%!important;
            height: auto!important;
        }
        @media (max-width: 992px) {
            #main .head:first-child {
                margin-bottom: 20px;
            }
        }
    </style>
@endpush
@section('content')
<main id="main">
    <div class="baner" style="margin-bottom: 60px">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-5 head" style="align-items: baseline">
                    <div class="head-main mb-4">
                        <!--<h4>Ölkəmiz üçün faydalı</h4>
                        <h1>Təklifin var? </h1>-->
                        <p>
                            Ölkəmizin inkişafı, vətəndaşların həyat keyfiyyətinin daha da yaxşılaşdırılması<br> üçün <br> TƏKLİFİNİZ var?
                        </p>
                        <br>
                        @guest('site-user')
                         <a data-toggle="modal" href="#modal-login" class="offer"><img src="/img/tac.svg" alt="">Tǝklif ver</a>
                        @endguest

                        @auth('site-user')
                            <a href="{{ route('make.offer') }}" class="offer"><img src="/img/tac.svg" alt="">Tǝklif ver</a>
                        @endauth
                    </div>

                </div>
                <div class=" col-12 col-lg-7 head">
                    <img class="banner" src="img/illustration.png" alt="" style="">
{{--                                  <video controls="" poster="img/main.svg">--}}
{{--                                        <source src="/videos/LowRes-TeklifimVar.mp4" type="video/mp4">--}}
{{--                                        <iframe src="/videos/LowRes-TeklifimVar.mp4"></iframe>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-6">
                <h4 class="name">Tǝkliflǝr</h4>
            </div>
            <div class="col-6 all">
                <a href="{{ route('all.offers') }}"><span>Hamısına bax<i class="fas fa-arrow-right"></i></span></a>
            </div>
            @if (is_array($mainOffers) || is_object($mainOffers))
            @foreach($mainOffers as $mainOffer)
            <div class="col-12 col-lg-4 col-md-4 d-flex">
                <div class="column ">
                    <div class="content">
{{--                        <a href="{{ route('offer.info', $mainOffer['id']) }}"><img src="{{ ImageManager::getImagePath(public_path() .'/storage/'.$mainOffer['image']['path'], 350, 197, 'crop') }}" class="card-img-top" alt="..."></a>--}}
                        <div class="card-body">
                <span class="date">
                   {{ $mainOffer['date_format'] }} / {{ $mainOffer['area'] }}
                </span>
                            <a href="{{ route('offer.info', $mainOffer['id']) }}">
                                <h5 class="card-title">{!!  $mainOffer['title']  !!}</h5>
                            </a>
                            <p class="card-text">{!!  \Illuminate\Support\Str::words($mainOffer['description'], 11, '...')   !!}</p>
                            @if($mainOffer['likes_count'] >= 0)
                                <div><span class="like">{{ $mainOffer['likes_count'] }} nəfər təklifi bəyənib</span></div>
                            @endif
                            <div class="buttons">
                                <button><a style="color: #fff;" href="{{ route('offer.info', $mainOffer['id']) }}">Daha ǝtraflı</a></button>
                                <button class=""><span><i class="fas fa-star"></i></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <!--
            <div class="col-12 d-flex">
                <div class="col-6">
                    <h4 class="name">Nəticələr</h4>
                </div>
                <div class="col-6 all">
                    <span>Hamisina bax<i class="fas fa-arrow-right"></i></span>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-4 d-flex">
                <div class="column ">
                    <div class="content">
                        <img src="img/Bitmap.png" class="card-img-top" alt="...">
                        <div class="card-body">
                <span class="date">
                  03.03.2020 / Bakı,Azǝrbaycan
                </span>
                            <a href="">
                                <h5 class="card-title">A.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdur</h5>
                            </a>

                            <p class="card-text">Saytımızda daxil olmuş tǝklif ǝsasında Akim Abbasov ünvanında piyada keçidindǝ
                                pandus olmadığı müǝyy…</p>
                            <div class="buttons">
                                <button>Daha ǝtraflı</button>
                                <button class=""><span><i class="fas fa-star"></i></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-4 d-flex">
                <div class="column ">
                    <div class="content">
                        <img src="img/Bitmap2.png" class="card-img-top" alt="...">
                        <div class="card-body">
                <span class="date">
                  03.03.2020 / Bakı,Azǝrbaycan
                </span>
                            <a href="">
                                <h5 class="card-title">A.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdur</h5>
                            </a>

                            <p class="card-text">Saytımızda daxil olmuş tǝklif ǝsasında Akim Abbasov ünvanında piyada keçidindǝ
                                pandus olmadığı müǝyy…</p>
                            <div class="buttons">
                                <button>Daha ǝtraflı</button>
                                <button class=""><span><i class="fas fa-star"></i></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-4 d-flex">
                <div class="column ">
                    <div class="content">
                        <img src="img/Bitmap5.png" class="card-img-top" alt="...">
                        <div class="card-body">
                <span class="date">
                  03.03.2020 / Bakı,Azǝrbaycan
                </span>
                            <a href="">
                                <h5 class="card-title">A.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdur</h5>
                            </a>

                            <p class="card-text">Saytımızda daxil olmuş tǝklif ǝsasında Akim Abbasov ünvanında piyada keçidindǝ
                                pandus olmadığı müǝyy…</p>
                            <div class="buttons">
                                <button>Daha ǝtraflı</button>
                                <button class=""><span><i class="fas fa-star"></i></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-4 d-flex">
                <div class="column ">
                    <div class="content">
                        <img src="img/Bitmap6.png" class="card-img-top" alt="...">
                        <div class="card-body">
                <span class="date">
                  03.03.2020 / Bakı,Azǝrbaycan
                </span>
                            <a href="">
                                <h5 class="card-title">A.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdur</h5>
                            </a>

                            <p class="card-text">Saytımızda daxil olmuş tǝklif ǝsasında Akim Abbasov ünvanında piyada keçidindǝ
                                pandus olmadığı müǝyy…</p>
                            <div class="buttons">
                                <button>Daha ǝtraflı</button>
                                <button class=""><span><i class="fas fa-star"></i></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-4 d-flex">
                <div class="column ">
                    <div class="content">
                        <img src="img/Bitmap.png" class="card-img-top" alt="...">
                        <div class="card-body">
                <span class="date">
                  03.03.2020 / Bakı,Azǝrbaycan
                </span>
                            <a href="">
                                <h5 class="card-title">A.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdur</h5>
                            </a>

                            <p class="card-text">Saytımızda daxil olmuş tǝklif ǝsasında Akim Abbasov ünvanında piyada keçidindǝ
                                pandus olmadığı müǝyy…</p>
                            <div class="buttons">
                                <button>Daha ǝtraflı</button>
                                <button class=""><span><i class="fas fa-star"></i></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-4 d-flex">
                <div class="column ">
                    <div class="content">
                        <img src="img/Bitmap2.png" class="card-img-top" alt="...">
                        <div class="card-body">
                <span class="date">
                  03.03.2020 / Bakı,Azǝrbaycan
                </span>
                            <a href="">
                                <h5 class="card-title">A.Abbasov 13 ünvanında piyada keçidinǝ pandus yoxdur</h5>
                            </a>

                            <p class="card-text">Saytımızda daxil olmuş tǝklif ǝsasında Akim Abbasov ünvanında piyada keçidindǝ
                                pandus olmadığı müǝyy…</p>
                            <div class="buttons">
                                <button>Daha ǝtraflı</button>
                                <button class=""><span><i class="fas fa-star"></i></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
    </div>
</main>
@endsection
