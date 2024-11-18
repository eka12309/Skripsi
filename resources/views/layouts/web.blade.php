@php
    $konf = DB::table('settings')->first();
@endphp

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <link rel="icon" href="{{ asset('logo/'.$konf->favicon_setting) }}">
      <title>{{$konf->instansi_setting}}</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="{{asset('web/css/bootstrap.min.css')}}">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="{{asset('web/css/style.css')}}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{asset('web/css/responsive.css')}}">
      <!-- fevicon -->
      <link rel="icon" href="{{asset('web/images/fevicon.png')}}" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{asset('web/css/jquery.mCustomScrollbar.min.css')}}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="{{asset('web/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{asset('web/css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- Leaflet CSS -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
      <style>
         .swal2-input, .swal2-select {
            width: 80%;
            box-sizing: border-box;
            margin-bottom: 10px;
         }
      </style>
   </head>
   <body>
      <!--header section start -->
      <div class="header_section header-bg">
         <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <div class="logo"><a href="index.html"><h1>{{$konf->instansi_setting}}</h1></a></div>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                     <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{url('/')}}">Home</a>
                     </li>
                     <li class="nav-item {{ request()->is('daftar_qurban') ? 'active' : '' }}">
                        <a class="nav-link" href="{{url('daftar_qurban')}}">Daftar Qurban</a>
                     </li>
                     @if(Auth::check())
                        @if(Auth::user()->role == "user")
                        <li class="nav-item {{ request()->is('pendaftaran_saya') ? 'active' : '' }}">
                           <a class="nav-link" href="{{url('pendaftaran_saya')}}">Qurban Saya</a>
                        </li>
                        <li class="nav-item {{ request()->is('transaksi_saya') ? 'active' : '' }}">
                           <a class="nav-link" href="{{url('transaksi_saya')}}">Transaksi</a>
                        </li>
                        @endif
                        @if(Auth::user()->role !== "user")
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('dashboard')}}">Dashboard</a>
                        </li>
                        @endif
                        <li class="nav-item">
                           <h6 class="nav-link" href="#">Hi {{ Auth::user()->name }}</h6>
                        </li>
                     @endif
                  </ul>
                  @if(Auth::check())
                  <div class="login_text">
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="login_text btn btn-xs btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit();">
                        Logout
                        </a>
                     </form>
                  </div>
                  @else
                  <div class="login_text btn btn-xs btn-outline-success ml-3"><a href="{{ route('login') }}">Login</a></div>
                  <div class="login_text btn btn-xs btn-outline-warning ml-1"><a href="{{ route('register') }}">Daftar</a></div>
                  @endif
               </div>
            </nav>
         </div>
        
         <section>
            @yield('content')
         </section>

      <!--footer section start -->
      <div class="footer_section">
         <div class="container">
            <h1 class="touch_text">{{$konf->instansi_setting}}</h1>
            <div class="row call_main">
               <div class="col-lg-6 col-md-12 col-sm-12 call_text"><img src="{{asset('web/images/call-icon.png')}}"><span class="padding_left_15">Kontak {{$konf->no_hp_setting}}</span></div>
               <div class="col-lg-6 col-md-12 col-sm-12 call_text"><img src="{{asset('web/images/mail-icon.png')}}"><span class="padding_left_15">{{$konf->email_setting}}</span></div>
            </div>
         </div>
      </div>
      <!--footer section end -->
      <!--copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text"> <?php $cpy = date('Y'); echo $cpy; ?> All Rights Reserved. Design by <a href="#">ADev</a></p>
         </div>
      </div>
      <!--copyright section end -->
      <!-- Javascript files-->
      <script src="{{asset('web/js/jquery.min.js')}}"></script>
      <script src="{{asset('web/js/popper.min.js')}}"></script>
      <script src="{{asset('web/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('web/js/jquery-3.0.0.min.js')}}"></script>
      <script src="{{asset('web/js/plugin.js')}}"></script>
      <!-- sidebar -->
      <script src="{{asset('web/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
      <script src="{{asset('web/js/custom.js')}}"></script>
      <!-- javascript --> 
      <script src="{{asset('web/js/owl.carousel.js')}}"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <!-- Leaflet JS -->
      <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
      <!-- Leaflet Control Geocoder -->
      <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

      @yield('script')
   </body>
</html>