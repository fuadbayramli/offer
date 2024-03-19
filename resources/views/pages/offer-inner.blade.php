@extends('layout')
@push('css')
    <meta property="og:description" content="{{ $offer['description'] }}"/>
    @if($offer['images'])
        <meta property="og:image" content="{{ asset('/storage/'.$offer['images'][0]['path']) }}"/>
    @endif
    <style>
        .offer_share {
            float: left;
            margin-top: 15px;
        }
        .offer_share span {
            float: left;
            display: block;
            color: #357dc0;
        }
        .offer_share a {
            float: left;
            display: block;
            width: 30px;
            height: 30px;
            margin-left: 10px;
            background: #999;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }
        .offer_share i {
            display: block;
            width: 100%;
            height: 100%;
            padding-top: 8px;
            text-align: center;
            font-size: 15px!important;
            color: #fff;
        }
    </style>
@endpush
@section('content')
    <main id="offer">
        <div class="container">
            <div class="row">
                <div class="col-12 ">
                    <div class="img">
                        <div class="right grid-container ">

                            @foreach( $offer['images'] as $image)
                                <div class="item{{ $loop->iteration }}">
                                    <a href="{{'/storage/'.$image['path'] }}" data-toggle="lightbox"
                                       data-gallery="example-gallery">
                                        <img src="{{ '/storage/'.$image['path'] }}" alt="">
                                    </a>
                                </div>
                            @endforeach

                            @foreach( $offer['videos'] as $video)
                                <div class="item{{ $loop->iteration }}">
                                    <iframe src="{{ '/storage/'.$video['path'] }}"></iframe>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <span class="date">{{ $offer['date_format'] }} / {{ $offer['area'] }}</span>
                    <h4 class="name">
                        {{ $offer['title'] }}
                    </h4>
                    <p>
                        {{ $offer['description'] }}
                    </p>
                    @if(isset($offer['admin_comment']))
                        <div class="row pt-5">
                            <div class="col-md-2 d-flex align-items-end"><b class="text-info">Təklifimvar <br>komandası: </b></div>
                            <div class="col-md-10 rounded cloud-bg">
                                <span class="text-white" style="font-size: 22px;">{{ $offer['admin_comment'] }} </span>
                            </div>
                        </div>
                    @endif

                    @auth('site-user')
                        @if($offer['user_id'] === auth('site-user')->user()->id)
                            <div class="redak"><a style="color:#606060;" href="{{ route('offer.edit', $offer['id']) }}"><span>Tǝklifin redaktə et<i
                                            class="fas fa-pen"></i></span></a></div>
                            <div class="sender"><span>Tǝklifin müǝllifi: {{ $offer['user']['name'] }}</span></div>
                        @else
                            <div class="sender">
                                <span>Tǝklifin müǝllifi: @if($offer['anonymous'] == 0) {{ $offer['user']['name'] }} @else
                                        Anonim @endif</span></div>
                        @endif
                    @else
                        <div class="sender">
                            <span>Tǝklifin müǝllifi: @if($offer['anonymous'] == 0) {{ $offer['user']['name'] }} @else
                                    Anonim @endif</span></div>
                    @endauth

                    @if(isset($offer['result']) && $offer['result'])
                        <div class="mb-5">
                            <a href="{{ route('result.info', ['id' => $offer['result']['id']]) }}">
                                <span class="thumbs" style="font-size: 20px">Nəticə</span>
                            </a>
                        </div>
                    @endif
                    <div>
                        @auth('site-user')
                            <form style="float:left;margin-right:5px;" method="POST" action="/offer/like">
                                @csrf
                                @if($offer['liked'] === false)
                                    <span style="cursor:pointer;" class="thumbs" id="likeButton"
                                          onclick="offerLike(this)"><i class="far fa-thumbs-up"></i>Bǝyǝn</span>
                                @else
                                    <span class="thumbs"><i class="far fa-thumbs-up"></i>Bǝyǝnilib</span>
                                @endif
                                <input name="id" type="hidden" value="{{  $offer['id'] }}">
                            </form>
                        @endauth


                            <div class="offer_share">
                                <span><i class="fas fa-share-alt"></i></span>
                                <div class="share42init" style="float: left;"></div>
                            </div>
                    </div>

                </div>
            </div>

        </div>
    </main>
@endsection
@push('js')
    <script type="text/javascript" src="/js/share42.js"></script>
@endpush
