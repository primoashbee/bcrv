<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BCRV Tech-Voc, Inc.</title>

    <!-- ==== STYLE.CSS ==== -->
    <link rel="stylesheet" href="{{ asset('new_welcome_assets/css/style.css') }}" />
    <link rel="icon" href="{{ asset('admin_assets/dist/img/icon.ico') }}">

    <!-- ====  REMIXICON CDN ==== -->
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />

    <!-- ==== FONTAWESOME  ==== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- ==== ANIMATE ON SCROLL CSS CDN  ==== -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  </head>
  <body>
    <!-- ==== HEADER ==== -->
    <header class="container header">
      <!-- ==== NAVBAR ==== -->
      <nav class="nav">
        <div class="logo">
          <h2> <img src="{{ asset('admin_assets/dist/img/bcrv.png') }}" class="img" style="max-height:100px; max-width:50px; margin-bottom: -5px"> BCRV.</h2>
        </div>

        <div class="nav_menu" id="nav_menu">
          <button class="close_btn" id="close_btn">
            <i class="ri-close-fill"></i>
          </button>
          @if (Sentinel::check())
                <form action="{{ url('/logout') }}" method="POST" id="logout-form">
                    {{ csrf_field() }}
                    <ul class="nav_menu_list">
                        <li class="nav_menu_item">
                            <a href="{{ url('/') }}" class="nav_menu_link">{{ Sentinel::getUser()->name }}</a>
                        </li>
                        <li class="nav_menu_item">
                            <a href="#" onclick="document.getElementById('logout-form').submit()" class="nav_menu_link">Logout</a>
                    </li>
                    </ul>
                </form>
            @else
            <ul class="nav_menu_list">
                <li class="nav_menu_item">
                <a href="{{ url('login') }}" class="nav_menu_link">Account</a>
                </li>
                {{-- <li class="nav_menu_item">
                <a href="https://www.facebook.com/bcrvtvi.edu.ph/" class="nav_menu_link">Help<span style="font-size: 13px; align: top;"> (?)</span></a>
                </li> --}}
            </ul>
            @endif
        </div>

        <button class="toggle_btn" id="toggle_btn">
          <i class="ri-menu-line"></i>
        </button>
      </nav>
    </header>

    <section class="wrapper">
      <div class="container">
        <div class="grid-cols-2">
          <div class="grid-item-1">
            <h1 class="main-heading">
              Welcome to <span>BCRV</span>
              <br />
              Tech-Voc, Inc.
            </h1>
            <p class="info-text">
                TESDA-Accredited Technical Vocational Institute located in the City of Calapan, Province of Oriental Mindoro.
            </p>

            <div class="btn_wrapper">
            @if (Sentinel::check())
                {{-- <button onclick="location.href='{{ url('/show_dashboard') }}'" class="btn view_more_btn">
                    Proceed to Admin <i class="ri-arrow-right-line"></i>
                </button> --}}

                <button onclick="location.href='{{ url('/show_dashboard') }}'" class="btn documentation_btn">Join us</button>
            @else
              {{-- <button onclick="location.href='{{ url('login') }}'" class="btn view_more_btn">
                Proceed to Admin <i class="ri-arrow-right-line"></i>
              </button> --}}

              <button onclick="location.href='{{ url('login') }}'" class="btn documentation_btn">Join us</button>
            @endif

              
            </div>
          </div>
          <div class="grid-item-2">
            <div class="team_img_wrapper">
              <img src="{{ asset('new_welcome_assets/img/records.svg') }}" alt="team-img" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="wrapper">
      <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <div class="grid-cols-3">
          <div class="grid-col-item">
            <div class="featured_info">
              <span>Who we are</span>
              <p>
                TESDA-Accredited Technical Vocational Institute located in the City of Calapan, Province of Oriental Mindoro.
              </p>
            </div>
          </div>

          <div class="grid-col-item">
            <div class="icon">
            </div>
            <div class="featured_info">
              <span>Our Mission </span>
              <p>
                <li>To enhance our clients’ life/corporate skills especially in the aspect of Information and
                    Communications Technology (ICT).</li>
                <li>To achieve and maintain our position as the top training and assessment/testing
                  center in the Southern Region, particularly in the Province of Oriental Mindoro.</li>
                <li>To be recognized as No. 1 in the country by adopting transparent and honest business
                  practices thereby generating immense goodwill with our clients, employees and
                  society we operate in.</li>
                <li>To enrich our experience and know-how in the ICT field.</li>
                <li>To be a top partner of government and private institutions in providing quality service 
                  and thereby, contributing to economic development.</li>
              </p>
            </div>
          </div>
          
          <div class="grid-col-item">
            <div class="featured_info">
              <span>Our Vision</span>
              <p>
                To be the training and assessment/testing center of choice in the Southern Tagalog Region, particularly in the Province of Oriental Mindoro, with the goal of serving the technicalvocational needs of our clients especially in the area of Information and Communications Technology and other allied short courses.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer style="
        position: fixed;
        left: 0;
        bottom: 0;
        padding-top:5px;
        padding-bottom:10px;
        height: 30px;
        width: 100%;
        color: white;
        text-align: center;"
      >
      <p> Footer Here </p>
    </footer>

    <!-- ==== ANIMATE ON SCROLL JS CDN -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- ==== GSAP CDN ==== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js"></script>
    <!-- ==== SCRIPT.JS ==== -->
    <script src="{{ asset('new_welcome_assets/script.js') }}" defer></script>
  </body>
</html>
