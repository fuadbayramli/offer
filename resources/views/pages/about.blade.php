@extends('layout')
@push('css')
    <meta property="og:image" content="{{ asset('/img/logo.svg') }}" />
@endpush
@section('content')
    <main id="aboutUs">
        <div class="baner">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-5 head">
                        <div class="head-name">
                            <p><a style="color: #fff;" href="{{ url('/') }}">Ana sǝhifǝ</a> | Haqqımızda</p>
                            <h1>Haqqımızda</h4>
                        </div>

                    </div>
                    <div class=" col-12 col-lg-6 head">
                        <div>
                            <img src="/img/1.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="info">
            <div class="container">
                <div class="row">
                    <div class="col-12 cards">
                        <div class="left">
                            <img src="img/ab.svg" alt="">
                        </div>
                        <div class="text">
                            <h5>Haqqımızda</h5>
                            <p class="text-right"><b>“Regional İnkişaf” İctimai Birliyi (RİİB) müxtəlif sahələr üzrə təkliflər təqdim etmək imkanı yaradan
                                www.teklifimvar.az portalını istifadəyə verib. Portal əhalini ölkənin sosial-iqtisadi, ictimai və mədəni
                                həyatında, vətəndaş cəmiyyəti quruculuğu sahəsində fəal iştiraka təşviq etməklə yanaşı, ictimai
                                    nəzarətin gücləndirilməsinə töhfə məqsədi daşıyır.İnternet resursunda qeydiyyatdan keçən
                                istifadəçilərin təklifləri araşdırıldıqdan və seçildikdən sonra onların reallaşdırılması istiqamətində
                                aidiyyəti qurumlarla birgə müvafiq tədbirlər həyata keçiriləcək. Nəticələrə dair məlumatlar portalda
                                yerləşdiriləcək və bununla da ictimaiyyətin prosesi izləməsi mümkün olacaq.Xatırladaq ki, “Regional
                                İnkişaf” İctimai Birliyi ictimai nəzarətin həyata keçirilməsi, əhalinin müxtəlif müraciətlərinin
                                araşdırılması, onların aidiyyəti qurumlarla əməkdaşlıq şəratində həlli, eləcə də elm, təhsil, səhiyyə,
                                sosial, ekologiya, turizm, idman və digər sahələrdə layihələrin icrası istiqamətində fəaliyyət göstərir.</b>
                            </p>
                        </div>
                    </div>

                    <div class="col-12 cards">
                        <div class="right">
                            <img src="img/3.svg" alt="">
                        </div>
                        <div class="text">
                            <h5>Necǝ tǝklif

                                verilmǝli? </h5>
                            <p><b>Təqdim etdiyiniz təklifi daha dəqiq və ətraflı hazırlamaq üçün ana səhifədəki
                                    videonu izləyə və ya aşağıdakı linkdən nümunəvi təkliflə tanış ola bilərsiniz.</b>
                            </p>
                        </div>
                        <div><span onclick="downloadURI('/img/Numunevi-teklif.jpg', 'Numunevi-teklif.jpg')"><b>Nümunǝ tǝklifi yüklǝ </b><i class="fas fa-download"></i></span></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')
    <script>
        function downloadURI(uri, name) {
            var link = document.createElement("a");
            link.download = name;
            link.href = uri;
            link.click();
        }
    </script>
@endpush
