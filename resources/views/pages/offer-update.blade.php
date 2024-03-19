@extends('layout')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}" />
    <style>
        .select2-selection__rendered {
            padding: 10px!important;
            padding-left: 14px!important;
        }
        .select2-selection--single {
            border: none!important;
            height: calc(2.1em + 0.75rem + 2px)!important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            margin: 10px;
        }
        .video-area {
            position: relative;
            float: left;
            margin-right: 20px;
        }
        .remove-video {
            display: none;
            position: absolute;
            top: -15px;
            right: 2px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
            text-shadow: 0 1px 2px rgba(0,0,0,0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }
        .remove-video:hover {
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -15px;
            right: 2px;
        }
        .remove-video:active {
            background: #E54E4E;
            top: -15px;
            right: 2px;
        }
    </style>
@endpush
@section('content')
    <main id="makeAnOffer">
        <div class="baner">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-5 head">
                        <div class="head-name">
                            <p><a style="color: #fff;" href="{{ url('/') }}">Ana sǝhifǝ</a> | Tǝklifi yenilə</p>
                            <h1>Tǝklifi yenilə</h1>
                        </div>

                    </div>
                    <div class=" col-12 col-lg-6 head">
                        <div>
                            <img src="/img/11.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="name">
                        Xanaları doldurun
                    </h4>
                </div>
                <div class="col-12">
                    <form id="offerUpdate" action="/offer/update/{{ $id }}" method="PUT" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="label" for="offer-name">Tǝklifin başlığı*</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                           placeholder="Zibil qutularının qoyulması" value="{{ $offer['title'] }}">
                                </div>
                                <div class="form-group">
                                    <label class="label" for="select">Kateqoriya*</label>
                                    <select name="category_id" id="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if( $category->id == $offer['category_id']) selected @endif>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="label" for="district_id">Rayonlar*</label>
                                        <select name="district_id" class="search-select">
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}" @if( $district->id == $offer['district_id']) selected @endif>{{ $district->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="label" for="doc">Ünvan*</label>
                                        <input type="text" name="area" id="area" class="form-control"
                                                value="{{ $offer['area'] }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="label"><span>Şǝkil yüklǝyin*</span></div>
                                        <div><input type="file" name="images[]" id="images" class="inputfile inputfile-3"
                                                    data-multiple-caption="{count} file" multiple>
                                            <label class="file" for="images"><span><img src="/img/img.svg" style="max-width: -webkit-fill-available;" alt=""></span></label>
                                            <h6 class="small mt-2">Təklifinizə uyğun şəkil yükləməyiniz xahiş olunur.</h6>
                                        </div>
                                        <div class="d-flex" style="margin-top:20px;">
                                            @foreach($offer['images'] as $images)
                                                <div class="image-area">
                                                    <a href="{{'/storage/'.$images['path'] }}" data-toggle="lightbox" data-gallery="example-gallery">

                                                        <img  src="{{ ImageManager::getImagePath(public_path() .'/storage/'.$images['path'], 83, 50, 'crop') }}" />
                                                        <a class="remove-image" href="#" data-id="{{ $images['id'] }}" style="display: inline;">&#215;</a>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="label"><span>Video yüklǝyin</span></div>
                                        <div><input type="file" name="" id="" class="inputfile inputfile-3"
                                                    data-multiple-caption="{count} file" multiple>
                                            <label class="file" for=""><span><img src="/img/video.svg" style="max-width: -webkit-fill-available; width: 150px;" alt=""></span></label>
                                        </div>
                                        <div class="d-flex" style="margin-top:20px;">
                                            @foreach($offer['videos'] as $video)
                                                <div class="video-area">
                                                    <a href="{{'/storage/'.$video['path'] }}" data-toggle="lightbox" data-gallery="example-gallery">
                                                        <video controls width="83" height="50">
                                                            <source src="{{ '/storage/'.$video['path'] }}" type="video/mp4">
                                                        </video>
                                                        <a class="remove-video" href="#" data-id="{{ $video['id'] }}" style="display: inline;">&#215;</a>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="check d-md-block d-none">
                                    <div>
                                        <!-- <input type="checkbox" id="cb1" value="1" name="anonymous"/> <label class="check" for="cb1">Tǝklifini anonim olaraq ver</label>-->
                                        <input type="checkbox" id="cb1" value="1" style="width:18px;height:18px;position:static!important;left:auto!important" name="anonymous" @if($offer['anonymous']==1) checked @endif>
                                        <span class="check" for="cb1" style="position: relative;top: -4px;left: 10px;">Tǝklifini anonim olaraq ver</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group text">
                                    <label class="label" for="text">Tǝklif haqqında ǝtraflı mǝlumat*</label>
                                    <textarea class="form-control" name="description" id="description">
                                        {{ $offer['description'] }}
                                    </textarea>
                                </div>
                                <div class="check d-md-none">

                                    <div>
                                        <!--<input type="checkbox" id="cb1" value="1" name="anonymous"> <label class="check" for="cb1">Tǝklifini anonim olaraq ver</label>-->
                                        <input type="checkbox" id="cb1" value="1" style="width:18px;height:18px;position:static!important;left:auto!important" name="anonymous" @if($offer['anonymous']==1) checked @endif>
                                        <span class="check" for="cb1" style="position: relative;top: -4px;left: 10px;">Tǝklifini anonim olaraq ver</span>
                                    </div>
                                </div>
                                <div><span class="small">Xahiş olunur xanaları Azǝrbaycan şriftlǝri ilǝ doldurasınız</span></div>
                            </div>

                            <div class="col-6"></div>
                            <div class="col-lg-6 col-12 button-offer">

                                <button type="submit" id="makeOfferButton">Tǝklifi yenilə</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade " id="modal-offer-yes" tabindex="-1" role="dialog" aria-labelledby="modal-offer-yes" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="/img/x.svg" alt="">
                        </div>
                        <div class="m-header">
                            <h4 class="modal-title" id="createOffer"></h4>
                        </div>
                        <div>
                            <img src="/img/123456 (1).svg" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 4px!important;">
                <div class="modal-header" style="display: unset!important; padding: 0.5rem 1rem!important;">
                    <button type="button" style="position:static!important;outline: none;" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 style="font-size: 1.3rem!important;" class="modal-title"><i class="voyager-trash"></i> Faylı silməyə əminsinizmi?</h4>
                </div>
                <div class="modal-footer" style="display: unset!important;">
                    <form action="#" id="delete_form" method="POST" style="margin: 0!important;;">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Bəli">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Xeyr</button>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
@push('js')
    <script src="{{ asset('/js/select2.js') }}"></script>
    <script>
        // Search Select
        $(document).ready(function() {
            $('.search-select').select2();
        });
    </script>
@endpush
