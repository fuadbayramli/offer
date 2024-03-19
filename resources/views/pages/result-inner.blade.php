@extends('layout')
@push('css')
    <meta property="og:description" content="{{ $result['description'] }}"/>
    <meta property="og:image" content="{{ asset('/storage/'.json_decode($result['result_images'], 1)[0]) }}"/>
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

                            @foreach(json_decode($result['result_images'], true) as $image)
                                <div class="item{{ $loop->iteration }}">
                                    <a href="{{ '/storage/'.$image }}"
                                       data-toggle="lightbox" data-gallery="example-gallery">
                                        <img
                                            src="{{ '/storage/'.$image }}"
                                            alt="">
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <span class="date">{{ $result['date_format'] }} / {{ $result['area'] }}</span>
                    <h4 class="name">
                        {{ $result['title'] }}
                    </h4>
                    <p>
                        {{ $result['description'] }}
                    </p>
                    @if(isset($result['admin_comment']))
                        <div class="row pt-5">
                            <div class="col-md-2"><b class="text-info">Təklifimvar komandası: </b></div>
                            <div class="col-md-10 bg-info rounded"><span class="text-white">{{ $result['admin_comment'] }} </span></div>
                        </div>
                    @endif
{{--                                    @auth('site-user')--}}
{{--                                        @if($result['user_id'] === auth('site-user')->user()->id)--}}
{{--                                         <div class="redak"><a style="color:#606060;" href="{{ route('result.edit', $result['id']) }}"><span>Tǝklifin redaktə et<i class="fas fa-pen"></i></span></a></div>--}}
{{--                                            <div class="sender"><span>Tǝklifin müǝllifi: {{ $result['user']['name'] }}</span></div>--}}
{{--                                        @else--}}
{{--                                            <div class="sender"><span>Tǝklifin müǝllifi: @if($result['anonymous'] == 0) {{ $result['user']['name'] }} @else Anonim @endif</span></div>--}}
{{--                                        @endif--}}
{{--                                    @else--}}
{{--                                        <div class="sender"><span>Tǝklifin müǝllifi: @if($result['anonymous'] == 0) {{ $result['user']['name'] }} @else Anonim @endif</span></div>--}}
{{--                                    @endauth--}}
                    @if(isset($result['offer']) && $result['offer'])
                        <div class="mb-5 mt-4">
                            <a href="{{ route('offer.info', ['id' => $result['offer']['id']]) }}">
                                <span class="thumbs" style="font-size: 20px">Təklif</span>
                            </a>
                        </div>
                    @endif
                    <div class="mt-4">
                        @auth('site-user')
                            <form style="float:left;margin-right:5px;" method="POST" action="/result/like">
                                @csrf
                                @if($result['liked'] === false)
                                    <span style="cursor:pointer;" class="thumbs" id="likeButton"
                                          onclick="resultLike(this)"><i class="far fa-thumbs-up"></i>Bǝyǝn</span>
                                @else
                                    <span class="thumbs"><i class="far fa-thumbs-up"></i>Bǝyǝnilib</span>
                                @endif
                                <input name="id" type="hidden" value="{{  $result['id'] }}">
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
