<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title>vor || Home</title>

    <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('public/vor/images/vor_amber.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('public/vor/images/vor_amber.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('public/vor/images/vor_amber.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/vor/images/vor_amber.png') }}">
    <link rel="manifest" href="{{ url('public/vor/assets_new/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ url('public/vor/images/vor_amber.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Icons Css -->
    <link href="{{ url('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- ===============================================-->
    <!--    Stylesheets--><!-- ===============================================-->
    <link rel="stylesheet" href="{{ url('public/vor/vendors/swiper/swiper-bundle.min.css') }}">
    <link rel="preconnect" href="{{ url('https://fonts.googleapis.com') }}">
    <link rel="preconnect" href="{{ url('https://fonts.gstatic.com') }}" crossorigin>
    <link href="{{ url('https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&amp;family=Rubik:ital,wght@0,300..900;1,300..900family=Rubik:ital,wght@0,300..900;1,300..900&amp;display=swap') }}" rel="stylesheet">
    <link href="{{ url('public/vor/assets_new/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ url('public/vor/assets_new/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ url('public/vor/assets_new/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <link rel="stylesheet" href="{{ url('https://unicons.iconscout.com/release/v4.0.8/css/line.css') }}">


        
    <link rel="stylesheet" type="text/css"href="{{ url('public/vor/assets/css/styles.css') }}">

    <!-- DataTables -->
    <link href="{{ url('public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    
    <style>

      textarea {
          font-size: 1rem;
          line-height: 1.5em;
          font-family: 'Roboto';
          resize: none;
          outline: none;
          overflow: hidden;
          
      }

      table{
          font-size: 1rem;
          line-height: 1.5em;
          font-family: 'Roboto';
          resize: none;
          outline: none;
          overflow: hidden;
          
      }

      table:hover {
        font-size: 1rem;
          line-height: 1.5em;
          font-family: 'Roboto';
          resize: none;
          outline: none;
          scrollbar-width: thin;
          scrollbar-color: #249de4 #f5f5f5;
          overflow: auto;
      }

      textarea:hover {
        font-size: 1rem;
          line-height: 1.5em;
          font-family: 'Roboto';
          resize: none;
          outline: none;
          scrollbar-width: thin;
          scrollbar-color: #249de4 #f5f5f5;
          overflow: auto;
      }

      textarea:focus {
          outline: none;
      }


      textarea::-webkit-scrollbar {
          width: 15px;
          background-color: #f5f5f5;
          box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.1);
          -moz-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.1);
          -webkit-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.1);
      }

      textarea::-webkit-scrollbar-thumb {
          border-radius: 10px;
          background-color: #249de4;
          box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
          -moz-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
          -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
          -webkit-border-radius: 10px;
          -moz-border-radius: 10px;
          -ms-border-radius: 10px;
          -o-border-radius: 10px;
      }


      /* Modern Browsers */
      textarea::placeholder {
          font-size: 1rem;
          color: #9c9c9c;
          font-family: 'Roboto', sans-serif;
      }

      /* WebKit, Edge */
      textarea::-webkit-input-placeholder {
          font-size: 1rem;
          color: #9c9c9c;
          font-family: 'Roboto', sans-serif;
      }

      /* Firefox 4-18 */
      textarea:-moz-placeholder {
          font-size: 1rem;
          color: #9c9c9c;
          font-family: 'Roboto', sans-serif;
      }

      /* Firefox 19+ */
      textarea::-moz-placeholder {
          font-size: 1rem;
          color: #9c9c9c;
          font-family: 'Roboto', sans-serif;
      }

      /* IE 10-11 */
      textarea:-ms-input-placeholder {
          font-size: 1rem;
          color: #9c9c9c;
          font-family: 'Roboto', sans-serif;
      }

      /* Edge */
      textarea::-ms-input-placeholder {
          font-size: 1rem;
          color: #9c9c9c;
          font-family: 'Roboto', sans-serif;
      }


      .schedule_list {
          font-size: 1rem;
          line-height: 1.5em;
          font-family: 'Roboto';
          outline: none;
          scrollbar-width: thin;
          scrollbar-color: #249de4 #f5f5f5;
          overflow-y: scroll;
          max-height: 600px
          
      }

      
      .schedule_list:hover {
        font-size: 1rem;
          line-height: 1.5em;
          font-family: 'Roboto';
          resize: none;
          outline: none;
          scrollbar-width: thick;
          scrollbar-color: #4b13e6 #f5f5f5;
          overflow-y: scroll;
      }

      .schedule_list:focus {
          outline: none;
      }


      .schedule_list::-webkit-scrollbar {
          width: 15px;
          background-color: #f5f5f5;
          box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.1);
          -moz-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.1);
          -webkit-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.1);
      }

      .schedule_list::-webkit-scrollbar-thumb {
          border-radius: 10px;
          background-color: #249de4;
          box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
          -moz-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
          -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
          -webkit-border-radius: 10px;
          -moz-border-radius: 10px;
          -ms-border-radius: 10px;
          -o-border-radius: 10px;
      }


      /* Modern Browsers */
      .schedule_list::placeholder {
          font-size: 1rem;
          color: #9c9c9c;
          font-family: 'Roboto', sans-serif;
      }

      /* WebKit, Edge */
      .schedule_list::-webkit-input-placeholder {
          font-size: 1rem;
          color: #9c9c9c;
          font-family: 'Roboto', sans-serif;
      }

      /* Firefox 4-18 */
      .schedule_list:-moz-placeholder {
          font-size: 1rem;
          color: #9c9c9c;
          font-family: 'Roboto', sans-serif;
      }

      /* Firefox 19+ */
      .schedule_list::-moz-placeholder {
          font-size: 1rem;
          color: #9c9c9c;
          font-family: 'Roboto', sans-serif;
      }




      .schedule_song{
          font-size: 0.8rem;
          /* line-height: 1.5em; */
          font-family: 'Roboto';
          outline: none;
          min-height: 130px;
          border: 0;
          width: 100%;
          overflow: none;
      }

      .schedule_song:hover{
          font-size: 0.8rem;
          /* line-height: 1.5em; */
          font-family: 'Roboto';
          outline: none;
          min-height: 130px;
          border: 0;
          width: 100%;
          overflow: none;
      }



      /* Songs List Table */
      
      .songs_list_table {
          font-size: 1rem;
          line-height: 1.5em;
          font-family: 'Roboto';
          outline: none;
          scrollbar-width: thin;
          scrollbar-color: #249de4 #f5f5f5;
          overflow-y: scroll;
          max-height: 600px
          
      }

      
      .songs_list_table:hover {
        font-size: 1rem;
          line-height: 1.5em;
          font-family: 'Roboto';
          resize: none;
          outline: none;
          scrollbar-width: thick;
          scrollbar-color: #4b13e6 #f5f5f5;
          overflow-y: scroll;
      }

      .songs_list_table:focus {
          outline: none;
      }


      .songs_list_table::-webkit-scrollbar {
          width: 15px;
          background-color: #f5f5f5;
          box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.1);
          -moz-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.1);
          -webkit-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.1);
      }

      .songs_list_table::-webkit-scrollbar-thumb {
          border-radius: 10px;
          background-color: #249de4;
          box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
          -moz-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
          -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
          -webkit-border-radius: 10px;
          -moz-border-radius: 10px;
          -ms-border-radius: 10px;
          -o-border-radius: 10px;
      }

  </style>



  </head>

  <body>
    <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
    <main class="main" id="top">
      <div class="content">
        <nav class="navbar navbar-expand-md fixed-top" id="navbar" data-navbar-soft-on-scroll="data-navbar-soft-on-scroll">
          <div class="container-fluid px-0">
            <a href="{{ url('/')}}"><img class="navbar-brand w-75 d-md-none" style="width: 50px; height: 50px;" src="{{ url('public/vor/images/vor_gray.png') }}" alt="logo" /></a><a class="navbar-brand fw-bold d-none d-md-block" href="{{ url('/')}}">ERM <img class="navbar-brand w-30" style="width: 30px; height: 30px;" src="{{ url('public/vor/images/vor_gray.png') }}" alt="logo" /></a>
            <a class="btn btn-primary btn-sm ms-md-x1 mt-lg-0 order-md-1 ms-auto" href="admin">ADMIN LOGIN </a>
            <button class="navbar-toggler border-0 pe-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-md-end" id="navbar-content" data-navbar-collapse="data-navbar-collapse">
              <ul class="navbar-nav gap-md-2 gap-lg-3 pt-x1 pb-1 pt-md-0 pb-md-0" data-navbar-nav="data-navbar-nav">
                <li class="nav-item"> <a class="nav-link lh-xl" href="#home">Home</a></li>
                {{-- <li class="nav-item"> <a class="nav-link lh-xl" href="#about">About us</a></li> --}}
                <li class="nav-item"> <a class="nav-link lh-xl" href="#vor_player">Songs</a></li>
                {{-- <li class="nav-item"> <a class="nav-link lh-xl" href="#service">Support</a></li> --}}
                <li class="nav-item"> <a class="nav-link lh-xl" href="#vor_schedule">Schedules</a></li>
                <li class="nav-item"> <a class="nav-link lh-xl" href="#contact">Contact</a></li>
              </ul>
            </div>
          </div>
        </nav>
        <div data-bs-target="#navbar" data-bs-spy="scroll" tabindex="0">
          <section class="hero-section overflow-hidden position-relative z-0 mb-4 mb-lg-0" id="home">
            <div class="hero-background">
              <div class="container">
                <div class="row gy-4 gy-md-8 pt-9 pt-lg-0">
                  <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="fs-2 fs-lg-1 text-white fw-bold mb-2 mb-lg-x1 lh-base mt-3 mt-lg-0"> Welcome to <span class="text-nowrap">Voices Of Rhema</span></h1>
                    <p class="fs-8 text-white mb-3 mb-lg-4 lh-lg">With lots of uniqueness, you can easily download the songs for the choir, view lyrics and listen to the songs. Get to know the schedules of songs for all services.</p>
                    <div class="d-flex justify-content-center justify-content-lg-start"><a class="btn btn-primary btn-lg lh-xl mb-4 mb-md-5 mb-lg-7" href="#!">Explore more</a></div>
                    <p class="mb-x1 fs-10 button-text text-uppercase fw-bold lh-base text-300">Download our app  [...Coming Soon...]</p>
                    <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-2 position-relative z-2"><a class="border-0 p-0 bg-transparent cursor-pointer rounded-1" href="#!"> <img class="img-fluid" src="{{ url('public/vor/assets_new/img/logos/App_Store.webp') }}" alt="{{ url('public/vor/assets_new/img/logos/App_Store.webp') }}" /></a><a class="border-0 p-0 bg-transparent cursor-pointer rounded-1" href="#!"> <img class="img-fluid" src="{{ url('public/vor/assets_new/img/logos/Play_Store.webp') }}" alt="{{ url('public/vor/assets_new/img/logos/Play_Store.webp') }}" /></a></div>
                  </div>
                  <div class="col-lg-6 position-lg-relative">
                    <div class="position-lg-absolute z-1 text-center"><img class="img-fluid chat-image" src="{{ url('public/vor/assets_new/img/Hero/vor_app2.png') }}" alt="" />
                      <div class="position-absolute dots d-none d-md-block"> <img class="img-fluid w-50 w-lg-75" src="{{ url('public/vor/assets_new/img/illustrations/Dots.webp') }}" alt="" /></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-absolute bottom-0 start-0 end-0 z-1"><img class="wave mb-md-n2" src="{{ url('public/vor/assets_new/img/illustrations/Wave.svg') }}" alt="" />
              <div class="bg-white py-2 py-md-5"></div>
            </div>
          </section>
          <section class="container border-bottom mb-8 mb-lg-10">
            <div class="row pb-6 pb-lg-8 g-3 g-lg-8 px-3">
              <div class="col-12 col-md-4">
                <h2 class="fs-3 fw-bold lh-sm mb-2 text-center" data-countup='{"endValue":{{ $getTotalDown }},"prefix":"0"}'>0</h2>
                <h6 class="fs-8 fw-normal lh-lg mb-0 opacity-70 text-center">Total Songs Downloaded</h6>
              </div>
              <div class="col-12 col-md-4">
                <h2 class="fs-3 fw-bold lh-sm mb-2 text-center" data-countup='{"endValue":{{ $maxDownloads }}}'>0</h2>
                <h6 class="opacity-70 fs-12 fw-normal lh-lg mb-0 text-center">{{ $mostDownloadedSong->songTitle }} By {{ $mostDownloadedSong->artiste }}</h6>
                <h6 class="opacity-70 fs-8 fw-normal lh-lg mb-0 text-center">Most Downloaded Song</h6>
              </div>
              <div class="col-12 col-md-4">
                <h2 class="fs-3 fw-bold lh-sm mb-2 text-center" data-countup='{"endValue":{{ $totalPlayed }},"autoIncreasing":false}'>0</h2>
                <h6 class="opacity-70 fs-12 fw-normal lh-lg mb-0 text-center">Most played: {{ $mostPlayedSong->songTitle }} By {{ $mostPlayedSong->artiste }}</h6>
                <h5 class="opacity-70 fs-8 fw-normal lh-lg mb-0 text-center">Total played Songs</h5>
              </div>
            </div>
          </section>
          
          <section class="container mb-8 mb-lg-13" id="vor_player">
            <div class="row align-items-center">
              
              <div class="col-md-4">
                <div class="mhn-player">
                  <div class="album-art"></div>
                  <div class="play-list" id="play_list">
                   
                  </div>
                  <div class="audio"></div>
                  <div class="current-info">
                    <div class="song-artist"></div>
                    <div class="song-album"></div>
                    <div class="song-title"></div>
                  </div>
                  <div class="controls">
                    <a href="javascript:void(0)" class="toggle-play-list"><i class="fa fa-list-ul"></i></a>
                    <div class="duration clearfix">
                      <span class="pull-left play-position"></span>
                      <span class="pull-right"><span class="play-current-time">00:00</span> / <span class="play-total-time">00:00</span></span>
                    </div>
                    <div class="progress">
                      <div class="bar"></div>
                    </div>
                    <div class="action-button">
                      <a href="javascript:void(0)" class="prev"><i class="fa fa-step-backward"></i></a>
                      <a href="javascript:void(0)" class="play-pause"><i class="fa fa-pp"></i></a>
                      <a href="javascript:void(0)" class="stop"><i class="fa fa-stop"></i></a>
                      <a href="javascript:void(0)" class="next"><i class="fa fa-step-forward"></i></a>
                      <input type="range" class="volume" min="0" max="1" step="0.1" value="0.5" data-css="0.5">
                    </div>
                
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="row">
                 <div class="songs_list_table">
                  <div id="play_list_table"></div>
                 </div>
                </div>
                
              </div>
            
            </div>
          </section>
          
          <section class="bg-1100 mt-n1" id="vor_schedule">
            <div class="mx-auto text-center">
              <hr class="horizontal-rule m-0 d-inline-block" />
            </div>
            <div class="container pb-8 pb-lg-10">
              <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                  <h2 class="fs-6 fs-lg-5 fw-bold text-white text-center pt-7 pb-4 pt-lg-9 pb-lg-6 lh-lg">V O R - Schedules</h2>
                </div>
                <div class="col-12 mb-4 mb-lg-6">
                  <div class="row g-2">
                    <div class="card">
                      <div class="card-body">
    
                        <div class="row schedule_list" id="schedule_list">
                          
                        
                        </div>
    
                      </div>
                      
                    </div>
                  </div>
                </div>
                <div class="text-center"><a class="py-1 link-success" href="#!"><span>Read more reviews </span><span class="uil uil-arrow-right icon"></span></a></div>
              </div>
            </div>
          </section>
          <section class="bg-300 position-relative z-0" id="contact">
            <div class="container py-8 py-lg-9">
              <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8">
                  <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                      <h2 class="fs-4 fs-lg-3 fw-bold text-center mb-2 lh-sm">Contact Us</h2>
                      <p class="fs-8 mb-5 mb-lg-6 text-center lh-lg fw-normal"> Send enquiries to our team for support!</p>
                    </div>
                    <div class="col-10 col-lg-7">
                      <form method="POST" onsubmit="return false;">
                        <div class="mb-2 w-100"><input class="form-control email-input" id="email" type="email" placeholder="Enter your email" required="required" /></div>
                        <div class="d-grid"><button class="btn btn-lg btn-primary lh-xl mb-x1" type="submit"> Send </button></div>
                      </form>
                    </div>
                    <div class="col-10 col-lg-7">
                      <p class="text-center lh-lg mb-0">We’ll never share your details with third parties. View our Privacy Policy for more info.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-absolute bottom-0 end-0 z-n1 d-none d-lg-block"><img src="{{ url('public/vor/assets_new/img/illustrations/Green_dots.svg') }}" alt="" /></div>
            <div class="position-relative bottom-0 start-0 z-1"><img class="img-fluid w-100" src="{{ url('public/vor/assets_new/img/illustrations/Wave_3.svg') }}" alt="" /></div>
          </section> 
          
          <section class="bg-1100">
            <div class="container">
              <div class="row py-8 py-md-10 py-lg-11">
                <div class="col-lg-6">
                  <div class="row justify-content-center justify-content-lg-start">
                    <div class="col-md-4 col-lg-12 col-xl-11">
                      <h2 class="text-white fs-4 fs-lg-4 lh-sm mb-2 text-center text-lg-start fw-bold">Most Played Songs.</h2>
                      <p class="fs-8 text-white text-opacity-65 mb-4 mb-md-6 mb-lg-7 lh-lg mb-6 mb-lg-7 text-center text-lg-start"> We share with you the most played songs. Many love to here these songs play.</p>
                    </div>
                    <div class="col-md-4 col-lg-12 col-xl-11">
                      <div class="accordion mt-lg-4 ps-3 pe-x1 bg-white" id="accordion">

                        @php
                            $index = 0;
                        @endphp
                 
                        @foreach ($mostPlayed as $mostPlayedSong)

                        @php
                            $index++;
                        @endphp

                          <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $mostPlayedSong->id }}"><button class="accordion-button fs-8 lh-lg fw-bold pt-x1 pb-2 {{ $index == 1 ? "" : "collapsed" }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $mostPlayedSong->id }}" aria-expand={{ $index == 1 ? "true" : "false" }} aria-controls="collapse{{ $mostPlayedSong->id }}" data-accordion-button="data-accordion-button">{{ $mostPlayedSong->songTitle }}</button></h2>
                            <div class="accordion-collapse collapse {{ $index == 1 ? "show" : "" }}" id="collapse{{ $mostPlayedSong->id }}" data-bs-parent="#accordion">
                              <div class="accordion-body lh-xl pt-0 pb-x1">Sang By {{ $mostPlayedSong->artiste }}  || <span class="text-dark text-sm">Played {{ $mostPlayedSong->played }} times</span></div>
                            </div>
                          </div>
                        @endforeach
                        
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-lg-6">
                  <div class="row justify-content-center justify-content-lg-start">
                    <div class="col-md-4 col-lg-12 col-xl-11">
                      <h2 class="text-white fs-4 fs-lg-4 lh-sm mb-2 text-center text-lg-start fw-bold">Most Downloaded Songs.</h2>
                      <p class="fs-8 text-white text-opacity-65 mb-4 mb-md-6 mb-lg-7 lh-lg mb-6 mb-lg-7 text-center text-lg-start">These are the list of the most downloaded songs, which could be a favourite song.</p>
                    </div>

                    <div class="col-md-4 col-lg-12 col-xl-11">
                      <div class="accordion mt-lg-4 ps-3 pe-x1 bg-white" id="accordion">
                        @php
                            $index2 = 0;
                        @endphp
             
                        @foreach ($getFavSong as $favSong)
                        @php
                            $index2++;
                        @endphp

                          <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $favSong->id }}"><button class="accordion-button fs-8 lh-lg fw-bold pt-x1 pb-2  {{ $index2 == 1 ? "" : "collapsed" }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $favSong->id }}" aria-expand={{ $index2 == 1 ? "true" : "false" }} aria-controls="collapse{{ $favSong->id }}" data-accordion-button="data-accordion-button">{{ $favSong->songTitle }}</button></h2>
                            <div class="accordion-collapse collapse {{ $index2 == 1 ? "show" : "" }}" id="collapse{{ $favSong->id }}" data-bs-parent="#accordion">
                              <div class="accordion-body lh-xl pt-0 pb-x1">Sang By {{ $favSong->artiste }}  ||  <span class="text-dark text-sm">Downloads #: {{ $favSong->downloads }}</span></div>
                            </div>
                          </div>
                        @endforeach
                        
                      </div>
                    </div>
                    
                  </div>
                  
                </div>
              </div>
            </div>
          </section>
          
        </div><button class="btn scroll-to-top text-white rounded-circle d-flex justify-content-center align-items-center bg-primary" data-scroll-top="data-scroll-top"><span class="uil uil-angle-up"></span></button>
        <footer class="pt-7 pt-lg-8">
          <div class="container">
            <div class="row gy-4 g-md-3 border-bottom pb-8 pb-lg-9 justify-content-center">
              <div class="col-6 col-md-3">
                <p class="mb-2 lh-lg ls-1">Company</p>
                <ul class="list-unstyled text-1100">
                  <li class="mb-1"> <a class="ls-1 lh-xl" href="#vor_player">Songs</a></li>
                  <li class="mb-1"> <a class="ls-1 lh-xl" href="#vor_schedule"> Schedules</a></li>
                  <li class="mb-1"> <a class="ls-1 lh-xl" href="#contact">Careers</a></li>
                </ul>
              </div>
              {{-- <div class="col-6 col-md-3">
                <p class="mb-2 lh-lg">Product</p>
                <ul class="list-unstyled text-1100">
                  <li class="mb-1"> <a class="ls-1 lh-xl" href="#!">Features</a></li>
                  <li class="mb-1"> <a class="ls-1 lh-xl" href="#!"> Pricing</a></li>
                  <li class="mb-1"> <a class="ls-1 lh-xl" href="#!"> News</a></li>
                  <li class="mb-1"> <a class="ls-1 lh-xl" href="#!"> Help desk</a></li>
                  <li class="mb-1"><a class="ls-1 lh-xl" href="#!"> Support</a></li>
                </ul>
              </div>
              <div class="col-6 col-md-3">
                <p class="mb-2 lh-lg"> Legal</p>
                <ul class="list-unstyled text-1100">
                  <li class="mb-1"> <a class="ls-1 lh-xl" href="#!">Privacy</a></li>
                  <li class="mb-1"> <a class="ls-1 lh-xl" href="#!"> Terms & Conditions</a></li>
                  <li class="mb-1"> <a class="ls-1 lh-xl" href="#!"> Return Policy</a></li>
                </ul>
              </div> --}}
              <div class="col-6 col-md-3 d-md-flex flex-column align-items-md-end pe-md-0">
                <div>
                  <p class="mb-2 lh-lg"> Download Our App [...Coming Soon...]</p>
                  <div class="mb-1 mb-lg-2"> <a class="border-0 p-0 bg-transparent cursor-pointer rounded-1" href="#!"> <img class="img-fluid" src="{{ url('public/vor/assets_new/img/logos/App_Store.webp') }}" alt="{{ url('public/vor/assets_new/img/logos/App_Store.webp') }}" /></a></div><a class="border-0 p-0 bg-transparent cursor-pointer rounded-1" href="#!"> <img class="img-fluid" src="{{ url('public/vor/assets_new/img/logos/Play_Store.webp') }}" alt="{{ url('public/vor/assets_new/img/logos/Play_Store.webp') }}" /></a>
                </div>
              </div>
            </div>
            <div class="row gy-2 py-3 justify-content-center justify-content-md-between">
              <div class="col-auto ps-0">
                <p class="text-center text-md-start lh-xl text-1100"> © 2024 Copyright, All Right Reserved, Made by <a class="fw-semi-bold" href="https://segitech.com/">Segitech </a>❤️</p>
              </div>
              <div class="col-auto pe-0"><a class="icons fs-8 me-3 me-md-0 ms-md-3 cursor-pointer" href="#!"><span class="uil uil-twitter"> </span></a><a class="icons fs-8 me-3 me-md-0 ms-md-3 cursor-pointer" href="#!"><span class="uil uil-instagram"></span></a><a class="icons fs-8 me-3 me-md-0 ms-md-3 cursor-pointer" href="#!"><span class="uil uil-linkedin"> </span></a></div>
            </div>
          </div>
        </footer>
      </div>
    </main><!-- ===============================================--><!--    End of Main Content--><!-- ===============================================-->

    @include('vor.layouts._modals')

    <!-- ===============================================--><!--    JavaScripts--><!-- ===============================================-->
    
    <script src="{{ url('public/assets/libs/jquery/jquery.min.js') }}"></script>

    <script src="{{ url('public/vor/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ url('public/vor/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ url('public/vor/vendors/is/is.min.js') }}"></script>
    <script src="{{ url('public/vor/vendors/countup/countUp.umd.js') }}"></script>
    <script src="{{ url('public/vor/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('public/vor/vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ url('https://polyfill.io/v3/polyfill.min.js?features=window.scroll') }}"></script>
    <script src="{{ url('public/vor/assets_new/js/theme.js') }}"></script>


        <!-- Required datatable js -->
        <script src="{{ url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        {{-- <script src="{{ url('public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}


    
    <script src="{{ url('public/vor/assets/js/vor_main.js') }}"></script>

  </body>

</html>