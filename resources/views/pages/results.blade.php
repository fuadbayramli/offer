@extends('layout')
@section('content')
    <main id="offers">
        <div class="baner">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-5 head">
                        <div class="head-name">
                            <p><a style="color: #fff;" href="{{ url('/') }}">Ana sǝhifǝ</a> | Nǝticǝlǝr</p>
                            <h1>Nǝticǝlǝr</h1>
                        </div>

                    </div>
                    <div class=" col-12 col-lg-6 head">
                        <div>
                            <img src="/img/t.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h4 class="name">Nǝticǝlǝr</h4>
                </div>
                <div class="col-12 col-md-6 group-select">
                    <form action="{{ route('results.search') }}">
                        <label for="category_id">Ünvan:</label>
                        <select name="district_id" id="district_id">
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}"
                                        @if($district->id == (request('district_id') ?? '')) selected @endif>{{ $district->title }}</option>
                            @endforeach
                        </select>
                        <label for="district_id">Kateqoriya:</label>
                        <select name="category_id" id="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if($category->id == (request('category_id') ?? '')) selected @endif>{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                @if (is_array($results) || is_object($results))
                    @foreach($results as $result)
                        <div class="col-12 col-lg-4 col-md-4 d-flex">
                            <div class="column ">
                                <div class="content">
                                    <a href="{{ route('result.info', $result['id']) }}">
                                        @if($result['result_images'])
                                            <img src="{{ ImageManager::getImagePath(public_path() .'/storage/'.json_decode($result['result_images'], 1)[0] ?? '', 350, 197, 'crop') }}" class="card-img-top" alt="...">
                                        @endif
                                    </a>
                                    <div class="card-body">
                    <span class="date">
                      {{ $result['date_format'] }} / {{ $result['area'] }}
                    </span>
                                        <a href="{{ route('result.info', $result['id']) }}">
                                            <h5 class="card-title">{{ $result['title'] }}</h5>
                                        </a>

                                        <p class="card-text">{{ \Illuminate\Support\Str::words($result['description'], 11, '...')  }}</p>
                                        @if($result['likes_count'] >= 0)
                                            <div><span class="like">{{ $result['likes_count'] }} nəfər təklifi bəyənib</span></div>
                                        @endif
                                        <div class="buttons">
                                            <button><a style="color: #fff;" href="{{ route('result.info', $result['id']) }}">Daha ǝtraflı</a></button>
                                            <button class=""><span><i class="fas fa-star"></i></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="col-12">
                    <div class="previous-next">
                        <div class="circle"></div>
                        <div class="circle"></div>
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>
@endsection
@push('js')
    <script>
        $("#category_id, #district_id").change(function () {
            $(this).parents('form:first').submit();
        })
    </script>
@endpush
