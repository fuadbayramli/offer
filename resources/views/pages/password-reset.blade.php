@extends('layout')
@section('content')
    <main id="cabinet">
        <div class="baner">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-5 head">
                        <div class="head-name">
                            <p><a style="color: #fff;" href="{{ url('/') }}">Ana sǝhifǝ</a> | Şifrə Yeniləmə</p>
                            <h1>Şifrə yeniləmə</h1>
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
                    <h4 class="name">Şifrə yeniləmə</h4>
                </div>
                <div class="col-12">
                    <form  action="/password/reset">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"  value="{{request()->get('email')}}" placeholder="aykhansafarli@gmail.com">
                                </div>

                                <div class="form-group">
                                    <label for="passwordConfirmation">Təkrar şifrə</label>
                                    <input type="password" class="form-control" id="passwordConfirmation"  name="passwordConfirmation" value="" placeholder="******">
                                </div>
                            </div>

                             <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="password">Şifrə</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="******" value="">
                                </div>

                                <div class="button">
                                    <button type="button"  onclick="forgotPasswordReset(this)">Yadda saxla</button>
                                    <button>İmtina et</button>
                                </div>
                            </div>
                            <input hidden name="token" id="token" placeholder="token" value="{{request()->get('token')}}">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade " id="modal-password-reset" tabindex="-1" role="dialog" aria-labelledby="modal-login"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="/img/x.svg" alt="">
                    </div>
                    <div class="m-header">
                        <h4 class="modal-title" id="passwordReset"> Şifrə uğurla dəyişdirildi.</h4>

                    </div>
                    <div>
                        <img src="/img/123456 (1).svg" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
