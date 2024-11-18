@extends('layouts.web')
@section('content')
 <!-- banner section start -->
 <div class="banner_section layout_padding">
    <div class="container">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="margin-top: 180px;">
                <!-- <div class="read_bt" style="margin-top: 100px;"><a href="#about">Jelajahi</a></div> -->
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--banner section end -->
</div>
<div class="container">
    <div class="play_icon"><a href="#about"><img src="{{asset('web/images/play-icon.png')}}"></a></div>
</div>
<!--header section end -->
<!--about section start -->
<div class="about_section layout_padding" id="about">
    <div class="container">
    <h1 class="about_taital">Tentang Website {{$konf->instansi_setting}}</h1>
    <div class="about_section_2">
        <div class="row">
            <div class="col-md-6">
                <div class="image_6">
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="about_taital_1">Tentang Website Kami </h1>
                <p class="about_text">website {{$konf->instansi_setting}} adalah platform online yang mempermudah proses pendaftaran dan pengelolaan qurban. Kami menyediakan solusi yang efisien dan terintegrasi untuk membantu Anda melakukan ibadah qurban dengan cara yang lebih sederhana dan terorganisir. Melalui website ini, Anda dapat dengan mudah mendaftar, melakukan pembayaran, dan mengelola semua aspek terkait qurban secara online.</p>
            </div>
        </div>
    </div>
    </div>
</div>
<!--about section end -->

<div class="events_section layout_padding">
    <div class="container">
    <h1 class="events_taital">Daftar Qurban Sekarang </h1>
    <p class="events_text">Beberapa Paket Untuk Berqurban </p>
    <div class="events_section_2">
        <div class="row">
            @foreach($qurban as $row)
            <div class="col-md-6">
                <div class="images_main mt-4">
                    @if($row->tipe_hewan == "Sapi")
                    <img src="{{asset('web/images/sapi.jpg')}}" class="image_7">
                    @else
                    <img src="{{asset('web/images/kambing.jpg')}}" class="image_7">
                    @endif
                </div>
                <p class="lorem_text">Qurban {{$row->tipe_hewan}}</p><br>
                <div class="time_section">
                <div class="live_text">Harga :Rp {{number_format($row->harga_per_orang)}}</div>
                <div class="date_text">Terdaftar : {{$row->registered}}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="read_bt"><a href="{{url('daftar_qurban')}}">Selengkapnya...</a></div>
    </div>
    </div>
</div>
@endsection