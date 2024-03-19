@extends('layout')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.css') }}?v=1.01">
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

        .image {
            opacity: 0.6!important;
            padding-bottom: 50px!important;
            padding-top: 14px!important;
            max-width: -webkit-fill-available;
        }

        #myDropZone .dz-image{
            width: 100px;
            height: 100px;
        }
        #myDropZone .dz-error-mark {
            background-color: red;
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
                            <p><a style="color: #fff;" href="{{ url('/') }}">Ana sǝhifǝ</a> | Tǝklif ver</p>
                            <h1>Tǝklif ver</h1>
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
                    <form id="offerMake" action="/offer" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="label" for="offer-name">Tǝklifin başlığı*</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="label" for="select">Kateqoriya*</label>
                                    <select name="category_id" id="category_id">
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="label" for="district_id">Rayonlar (şəhər)*</label>
                                        <select name="district_id" class="search-select">
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}">{{ $district->title }}</option>
                                            @endforeach
                                        </select>
                                        <h6 class="small mt-2">Təklifin aid olduğu rayonu qeyd edin</h6>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="label" for="doc">Ünvan*</label>
                                        <input type="text" name="area" id="area" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="label"><span>Şǝkil yüklǝyin*</span></div>
                                        <div>
{{--                                            <input type="file" name="images[]" id="images" class="inputfile inputfile-3"--}}
{{--                                                    data-multiple-caption="{count} file" multiple>--}}
{{--                                            <label class="file" for="images"><span><img src="/img/image_icon.png" class="image" alt=""></span></label></div>--}}
                                        <div id="myDropZone" class="dropzone dropzone-design" style=" padding: 0">
                                            <div class="dz-default dz-message">
                                            </div>
                                            <label class="file" for="images">
                                                <span><img src="/img/image_icon.png" class="image" alt=""></span>
                                            </label>
                                        </div>
                                        <div id="offerImages"></div>
                                        </div>
                                        <div class="d-block"><h6 class="small mt-2">Təklifinizə uyğun şəkil yükləməyiniz xahiş olunur.</h6></div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="label"><span>Video yüklǝyin</span></div>
                                        <div><input type="file" name="videos[]" id="videos" class="inputfile inputfile-3"
                                                    data-multiple-caption="{count} file" multiple>
                                            <label class="file" for="videos"><span><img src="/img/video.svg" style="max-width: -webkit-fill-available; width: 150px;" alt=""></span></label></div>

                                    </div>
                                </div>
                                <div class="check d-md-block d-none">
                                    <div>
                                        <!--<input type="checkbox" id="cb1" value="1" name="anonymous"/> <label class="check" for="cb1">Tǝklifini anonim olaraq ver</label>-->
                                        <input type="checkbox" id="cb1" value="1" style="width:18px;height:18px;position:static!important;left:auto!important" name="anonymous">
                                        <span class="check" for="cb1" style="position: relative;top: -4px;left: 10px;">Tǝklifini anonim olaraq ver</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group text">
                                    <label class="label" for="text">Tǝklif haqqında ǝtraflı mǝlumat*</label>
                                    <textarea class="form-control" name="description" id="description"></textarea>
                                </div>
                                <div class="check d-md-none">

                                    <div>
                                        <!--<input type="checkbox" id="cb1" value="1" name="anonymous"> <label class="check" for="cb1">Tǝklifini anonim olaraq ver</label>-->
                                        <input type="checkbox" id="cb1" value="1" style="width:18px;height:18px;position:static!important;left:auto!important" name="anonymous">
                                        <span class="check" for="cb1" style="position: relative;top: -4px;left: 10px;">Tǝklifini anonim olaraq ver</span>
                                    </div>
                                </div>
                                <div><span class="small">Xahiş olunur xanaları Azǝrbaycan şriftlǝri ilǝ doldurasınız</span></div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-lg-6 col-12 button-offer">
                                <button type="submit" id="makeOfferButton">Tǝklifi göndǝr</button>
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
@endsection
@push('js')
    <script src="{{ asset('/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/dropzone.js') }}?v=1.01"></script>
    <script>
        Dropzone.autoDiscover = false;
        Dropzone.options.myDropZone = {
            maxFiles: 5,
        }

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $("div#myDropZone").dropzone({
            url: "{{ url('/addImage') }}",
            sending: function (file, xhr, formData) {
                formData.append("_token", CSRF_TOKEN);
            },
            success: function (re) {
                var obj = $.parseJSON(re.xhr.response);
                $("#offerImages").append('<input type="hidden" value="' + obj.file_name + '" name="images[]"/>');
            }
        });

        // Search Select
        $(document).ready(function() {
            $('.search-select').select2();
        });

        $(document).on('focus', '.select2.select2-container', function (e) {
            if (e.originalEvent && $(this).find(".select2-selection--single").length > 0) {
                $(this).siblings('select').select2('open');
            }
        });
    </script>
@endpush
