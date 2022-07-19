<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontend</title>
    <!-- swiper css -->
    <link rel="stylesheet" href="asset/css/swiper-bundle.min.css">
    <!-- box icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset ('../guest_assets/css/style.css') }}">
</head>
<body>
<!-- scroll top -->
<a href="#" class="scrolltop" id="scroll-top">
    <i class='bx bx-chevron-up scrolltop_icon'></i>
</a>

<!-- header -->
    <header class="l-header" id="header">
        <nav class="nav bd-container">
            <a href="#" class="nav_logo">ERES</a>

            <div class="nav_menu" id="nav-menu">
                <ul class="nav_list">
                    <li class="nav_item"><a href="#home" class="nav_link active-link">Home</a></li>
                    <li class="nav_item"><a href="#about" class="nav_link">About</a></li>
                    <li class="nav_item"><a href="#contact" class="nav_link">Contact Us</a></li>
                    <li class="nav_item"><a href="{{ url('login') }}" class="nav_link">Login</a></li>
                    <li class="nav_item"><a href="{{ url('login') }}" class="nav_link">Register</a></li>
                    <li class="nav_item"><a href="{{ url('/') }}" class="nav_link">Return</a></li>
                </ul>
            </div>

            <div class="nav_toggle" id="nav-toggle">
                <i class='bx bx-menu-alt-right'></i>
            </div>
        </nav>
    </header>

<!-- main -->
<main class="l-main">
    <!-- home -->
        <section class="home" id="home">
            <div class="home_container bd-container bd-grid">
                <div class="home_data">
                    <span class="home_greeting">Welcome, to</span>
                    <h1 class="home_name">Eulogio Rodriguez</h1>
                    <span class="home_profession">Elementary School</span>
                    <a href="#" class="button button-light home_button">Learn more</a>
                </div>

                <div class="home_social">
                    <a href="#" class="home_social-icon"><i class='bx bxl-facebook-square'></i></a>
                    <a href="#" class="home_social-icon"><i class='bx bxl-instagram'></i></a>
                    <a href="#" class="home_social-icon"><i class='bx bxl-twitter'></i></a>
                </div>

                <div class="home_img">
                    <img src="{{ asset ('../guest_assets/img/elemkids.png')}}" alt="home">
                </div>
            </div>
        </section>

    <!-- about -->
        <section class="about section bd-container" id="about">
            <span class="section-subtitle">Who we are</span>
            <h2 class="section-title">About Us</h2>
            
            <div class="about_container bd-grid">
                <div class="about_data bd-grid">
                    <p class="about_description">
                        <span>We are <br> </span>
                        Lorem ipsum, dolor sit amet consectetur 
                        adipisicing elit. Nulla, odio numquam.
                    </p>

                    <div>
                        <span class="about_number">20</span>
                        <span class="about_achievement">Years of Experience</span>
                    </div>

                    <div>
                        <span class="about_number">29+</span>
                        <span class="about_achievement">Professional Teachers</span>
                    </div>

                    <div>
                        <span class="about_number">07</span>
                        <span class="about_achievement">Awards</span>
                    </div>
                </div>
                <img src="{{ asset('../guest_assets/img/about-img.jfif')}}" alt="about" class="about_img">
            </div>
        </section>

    <!-- Projects in mind -->
        <section class="project section bd-container">
            <div class="project_container bd-grid">
                <div class="project_data">
                    <i class='bx bx-pencil project_icon'></i>

                    <div>
                        <h2 class="project_title">Enroll now!</h2>
                        <p class="project_description">
                            Lorem ipsum dolor sit amet consectetur esse?
                        </p>
                    </div>

                    <a href="#" class="button button-white">Enroll</a>
                </div>
            </div>
        </section>

    
    <div class="portfolio_container bd-grid" style="display: none;">
    </div>
      

    <!-- contact me -->
        <section class="contact section bd-container" id="contact">
            <span class="section-subtitle">For Inquiries</span>
            <h2 class="section-title">Contact us</h2>

            <div class="contact_container bd-grid">
                <div class="contact_content bd-grid">
                    <div class="contact_box">
                        <i class='bx bx-home contact_icon'></i>
                        <h3 class="contact_title">Location</h3>
                        <span class="contact_description">#123 Manila - Philippines </span>
                    </div>

                    <div class="contact_box">
                        <i class='bx bx-phone contact_icon'></i>
                        <h3 class="contact_title">Phone</h3>
                        <span class="contact_description">999-888-777 </span>
                    </div>

                    <div class="contact_box">
                        <i class='bx bx-envelope contact_icon'></i>
                        <h3 class="contact_title">Gmail</h3>
                        <span class="contact_description">school.email@gmail.com </span>
                    </div>

                    <div class="contact_box">
                        <i class='bx bx-chat contact_icon'></i>
                        <h3 class="contact_title">Chat</h3>
                        <div>
                            <a href="#" class="contact_social"><i class='bx bxl-whatsapp-square'></i></a>
                            <a href="#" class="contact_social"><i class='bx bxl-telegram'></i></a>
                            <a href="#" class="contact_social"><i class='bx bxl-messenger'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- footer -->
        <footer class="footer">
            <div class="footer_container bd-container">
                <h1 class="footer_title">Eulogio Rodriguez Elementary School</h1>
                <p class="footer_description">Lorem ipsum dolor sit amet consectetur 
                    adipisicing elit. Maiores, obcaecati.</p>

                <div class="footer_social">
                    <a href="#" class="footer_link"><i class="bx bxl-facebook-square"></i></a>
                    <a href="#" class="footer_link"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="footer_link"><i class="bx bxl-twitter"></i></a>
                </div>

                <p class="footer_copy">&#169; 2021 ERES. All rights reserved</p>
            </div>
        </footer>
</main>

<!-- scripts -->
    <!-- mixitup filter -->
    <script src="{{ asset ('../guest_assets/js/mixitup.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset ('../guest_assets/js/swiper-bundle.min.js') }}"></script>
    <!-- gsap -->
    <script src="{{ asset ('../guest_assets/js/gsap.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset ('../guest_assets/js/main.js') }}"></script>
</body>
</html>