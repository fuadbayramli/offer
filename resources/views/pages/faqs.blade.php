@extends('layout')
@section('content')
    <main id="questions">
        <div class="baner">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-5 head">
                        <div class="head-name">
                            <p><a style="color: #fff;" href="{{ url('/') }}">Ana sǝhifǝ</a> | Tez-tez verilən suallar</p>
                            <h1>Tez-tez verilən suallar</h1>
                        </div>

                    </div>
                    <div class=" col-12 col-lg-6 head">
                        <div>
                            <img src="/img/133-layers.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="name">Tez-tez verilən suallar</h4>
                </div>
                <div class="col-md-6 col-12">
                  @foreach($faqs as $faq)
                    <div class="question">
                          <span class="title">
                              {{ $faq->title }}
                              <i class="fas fa-angle-down"></i>
                          </span>
                          <p class="answer">
                           {!! $faq->description !!}
                         </p>
                    </div>
                  @endforeach
                </div>
            </div>
        </div>

    </main>
@endsection
