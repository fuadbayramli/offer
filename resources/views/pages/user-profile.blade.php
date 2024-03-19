@extends('layout')
@section('content')
    <main id="cabinet">
        <div class="baner">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-5 head">
                        <div class="head-name">
                            <p><a style="color: #fff;" href="{{ url('/') }}">Ana sǝhifǝ</a> | Şǝxsi kabinet</p>
                            <h1>Şǝxsi kabinet</h1>
                        </div>

                    </div>
                    <div class=" col-12 col-lg-6 head">
                        <div>
                            <img src="/img/10.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="name">Şǝxsi kabinet</h4>
                </div>
                <div class="col-12">
                    <form  action="/user/{{ Auth::guard('site-user')->id() }}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">Ad</label>
                                    <input type="text" class="form-control" id="name" name="name"  value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="surname">Soyad</label>
                                    <input type="text" name="surname" class="form-control" id="surname" value="{{ $user->surname }}" placeholder="Safarli">
                                </div>
                                <div class="form-group">
                                    <label for="fatherName">Ata adı</label>
                                    <input type="text" class="form-control" id="fatherName"  name="fatherName" value="{{ $user->fatherName }}">
                                </div>

                                <div class="form-group">
                                    <label for="add">Ünvan</label>
                                    <input type="text" class="form-control" id="add" name="address" placeholder="Yasamal rayonu, Şǝrifzadǝ 160" value="{{ $user->address }}">
                                </div>

                                <span class="d-md-block d-none">Xahiş olunur xanaları Azǝrbaycan şriftlǝri ilǝ doldurasınız</span>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="aykhansafarli@gmail.com" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="number">Əlaqǝ nömrǝsi</label>
                                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="+994 55 123 45 67" value="{{ $user->phonenumber }}">
                                </div>

                                <span class="d-md-none ">Xahiş olunur xanaları Azǝrbaycan şriftlǝri ilǝ doldurasınız</span>

                                <div class="button">
                                    <button type="button" onclick="userProfileUpdate(this)">Yadda saxla</button>
                                    <button>İmtina et</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade " id="modal-profile-update" tabindex="-1" role="dialog" aria-labelledby="modal-login"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/img/x.svg" alt="">
                    </div>
                    <div class="m-header">
                        <h4 class="modal-title" id="userProfileUpdate"></h4>
                    </div>
                    <div>
                        <img src="/img/123456 (1).svg" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
