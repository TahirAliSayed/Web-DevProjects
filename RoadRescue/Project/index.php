<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>RoadRescue</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">
        <!-- AOS CSS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- Favicon -->
        <link href="Assets/Templates/Main/Assets/Templates/Main/img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="Assets/Templates/Main/lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="Assets/Templates/Main/lib/animate/animate.min.css" rel="stylesheet">
        <link href="Assets/Templates/Main/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="Assets/Templates/Main/css/style.css" rel="stylesheet">
        
        <style>
        /* Social Media Buttons */
        .social-btn {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background-color: transparent;
            position: relative;
            border-radius: 7px;
            cursor: pointer;
            transition: all .3s;
            margin-left: 10px;
            text-decoration: none;
            overflow: hidden;
        }

        .social-svg-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
            backdrop-filter: blur(4px);
            letter-spacing: 0.8px;
            border-radius: 10px;
            transition: all .3s;
            border: 1px solid rgba(156, 156, 156, 0.466);
        }

        .social-bg {
            position: absolute;
            content: "";
            width: 100%;
            height: 100%;
            z-index: -1;
            border-radius: 9px;
            pointer-events: none;
            transition: all .3s;
        }

        /* Instagram */
        .instagram-btn .social-bg {
            background: #f09433;
            background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
            background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );
        }

        /* Facebook */
        .facebook-btn .social-bg {
            background: #1877F2;
        }

        /* Email */
        .email-btn .social-bg {
            background: #D44638; /* Gmail red */
        }

        .social-btn:hover .social-bg {
            transform: rotate(35deg);
            transform-origin: bottom;
        }

        .social-btn:hover .social-svg-container {
            background-color: rgba(156, 156, 156, 0.466);
        }

        .social-btn:active .social-bg {
            transform: scale(0.95) rotate(35deg);
        }

        .social-icons-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
    </style>
    </head>

    <body>
        <!-- Top Bar Start -->
        <div class="top-bar" style="color: red;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="logo">
                            <img src="Assets/Templates/Main/img/download.png" alt="Logo" width=50% height=1000%> 
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 d-none d-lg-block">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="top-bar-item">
                <div class="top-bar-icon">
                    <i class="far fa-clock"></i>
                </div>
                <div class="top-bar-text">
                    <h3>Opening Hour</h3>
                    <p style="color: white;">Mon - Fri, 8:00AM - 9:00PM</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        <!-- Your existing top bar code, replace the social icons container with: -->
    <div class="social-icons-container">
        <!-- Instagram Button -->
        <a href="https://www.instagram.com/yourroadrescuepage" target="_blank" class="social-btn instagram-btn">
            <span class="social-svg-container">
                <svg fill="white" viewBox="0 0 448 512" height="1.5em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                </svg>
            </span>
            <span class="social-bg"></span>
        </a>

        <!-- Facebook Button -->
        <a href="https://www.facebook.com/yourroadrescuepage" target="_blank" class="social-btn facebook-btn">
            <span class="social-svg-container">
                <svg fill="white" viewBox="0 0 320 512" height="1.5em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
                </svg>
            </span>
            <span class="social-bg"></span>
        </a>

        <!-- Email Button -->
        <a href="mailto:RoadRescueWork@gmail.com" class="social-btn email-btn">
            <span class="social-svg-container">
                <svg fill="white" viewBox="0 0 512 512" height="1.5em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                </svg>
            </span>
            <span class="social-bg"></span>
        </a>
    </div>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="nav-bar">
            <div class="container" style="color: red;">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                           
                            <div class="nav-item dropdown" style="float:right">
                                <a href="../Assets/Templates/Main/#" class="nav-link dropdown-toggle" data-toggle="dropdown">Sign Up</a>
                                <div class="dropdown-menu">
                                    <a href="Guest/UserRegistration.php" class="dropdown-item">User</a>
                                    <a href="Guest/WorkshopRegistration.php" class="dropdown-item">Workshop</a>
                                </div>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <a class="btn btn-custom" href="Guest/Login.php">Login</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->

        <!-- Carousel Start -->
        <div class="carousel">
            <div class="container-fluid">
                <div class="owl-carousel">
                    <div class="carousel-item">
                        <div class="carousel-img">
                            <img src="Assets/Templates/Main/img/1234.jpg" alt="Image">
                        </div>
                        <div class="carousel-text">
                            <h3 data-aos="fade-up" data-aos-delay="100">Repairing & Detailing</h3>
                            <h1 data-aos="fade-up" data-aos-delay="200">Road Side Assistance</h1>
                            <p data-aos="fade-up" data-aos-delay="300">
                                Ride Anywhere Hassle Free Without The Fear Of Breakdown - Our Roadside Assistance Has Got You Covered!
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-img">
                            <img src="Assets/Templates/Main/img/oil-change.jpg" alt="Image">
                        </div>
                        <div class="carousel-text">
                            <h3>Repairing & Detailing</h3>
                            <h1>Oil Services</h1>
                            <p>
                            Choose Nothing But The Best...Engine Oil
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-img">
                            <img src="Assets/Templates/Main/img/general-car-repair-CA-Motor-Works.jpg" alt="Image">
                        </div>
                        <div class="carousel-text">
                            <h3>Repairing & Detailing</h3>
                            <h1>Quality service for you</h1>
                            <p>
                               Take Care Of Your Vehicle In The Garage,And The Vehicle Will Take Care Of You On The Road
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-img">
                            <img src="Assets/Templates/Main/img/carousel-3.jpg" alt="Image">
                        </div>
                        <div class="carousel-text">
                            <h3>Repairing & Detailing</h3>
                            <h1>Exterior & Interior Washing</h1>
                            <p>
                               
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->
        
        <!-- About Start -->
        <div class="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-img">
                            <img src="Assets/Templates/Main/img/istockphoto-1148037363-612x612.jpg" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="section-header text-left" data-aos="fade-up">
                        <p>About Us</p>
                        <h2>Auto Repairing and detailing</h2>
                        </div>
                        <div class="about-content" data-aos="fade-up" data-aos-delay="100">
                        <p>
                            We have experienced mechanics and know how to fix anything wrong with your vehicle. We have the equipment to troubleshoot the problem whatever it may be.
                        </p>
                        <ul>
                            <li data-aos="fade-up" data-aos-delay="200"><i class="far fa-check-circle"></i>Auto Inspection</li>
                            <li data-aos="fade-up" data-aos-delay="300"><i class="far fa-check-circle"></i>Engine Upgrade</li>
                            <li data-aos="fade-up" data-aos-delay="400"><i class="far fa-check-circle"></i>Auto Servicing</li>
                            <li data-aos="fade-up" data-aos-delay="500"><i class="far fa-check-circle"></i>On Road Assistance</li>
                            <li data-aos="fade-up" data-aos-delay="600"><i class="far fa-check-circle"></i>Washing & Painting</li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Service Start -->
        <div class="service">
            <div class="container">
                <div class="section-header text-center">
                    <p data-aos="fade-up">What We Do?</p>
                    <h2 data-aos="fade-up" data-aos-delay="100">Premium Vehicle Services</h2>
                </div>
                <div class="row">
                    <!-- On Road Assistance -->
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item" data-aos="fade-up" data-aos-delay="200">
                            <i class="flaticon-car-wash-1"></i>
                            <h3>On Road Assistance</h3>
                            <p>It provides emergency services to drivers such as towing, jump-starts, tire changes, fuel delivery, and lockout assistance.</p>
                        </div>
                    </div>

                    <!-- Engine Repairing -->
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item" data-aos="fade-up" data-aos-delay="300">
                            <i class="flaticon-car-wash"></i>
                            <h3>Engine Repairing</h3>
                            <p>Engine repair involves diagnosing, fixing, and testing damaged or malfunctioning vehicle engines.</p>
                        </div>
                    </div>

                    <!-- Oil Changing -->
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item" data-aos="fade-up" data-aos-delay="400">
                            <i class="flaticon-vacuum-cleaner"></i>
                            <h3>Oil Changing</h3>
                            <p>Regular oil changes reduce friction, provide lubrication, minimise wear & tear, and keep engine parts cool.</p>
                        </div>
                    </div>

                    <!-- Auto Services -->
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item" data-aos="fade-up" data-aos-delay="500">
                            <i class="flaticon-seat"></i>
                            <h3>Auto Services</h3>
                            <p>It is the maintenance and repair of vehicles by professionals, including oil changes, brake repairs, and engine tune-ups.</p>
                        </div>
                    </div>

                    <!-- Brake Repairing -->
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item" data-aos="fade-up" data-aos-delay="600">
                            <i class="flaticon-car-service"></i>
                            <h3>Brake Repairing</h3>
                            <p>Brake repair is the process of fixing or replacing faulty components of a vehicle's braking system to ensure safety while driving.</p>
                        </div>
                    </div>

                    <!-- Transmission Repairing -->
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item" data-aos="fade-up" data-aos-delay="700">
                            <i class="flaticon-car-service-2"></i>
                            <h3>Transmission Repairing</h3>
                            <p>Much like the oil in your engine, transmission fluid is a lubricant that helps keep all of the moving parts inside of your transmission functioning properly.</p>
                        </div>
                    </div>

                    <!-- Water Service -->
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item" data-aos="fade-up" data-aos-delay="800">
                            <i class="flaticon-car-wash"></i>
                            <h3>Water Service</h3>
                            <p>Get your Car Cleaned Up and Washed in the most convenient and time-saving manner. Set your eyes ready to see the most treasured thing of your car in a completely shiny and showroom-like look.</p>
                        </div>
                    </div>

                    <!-- Painting & Detailing -->
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item" data-aos="fade-up" data-aos-delay="900">
                            <i class="flaticon-brush-1"></i>
                            <h3>Painting & Detailing</h3>
                            <p>It involves cleaning, polishing, and restoring a vehicle's exterior and interior appearance to maintain its value and aesthetics.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->
        
        <!-- Footer Start -->
        <div class="footer">
            <div class="container copyright">
                <p>&copy; <a href="http://localhost/RoadRescue/RoadRescue/Project"> 2024 RoadRescue </a>, All Right Reserved. Designed By <a href="http://localhost/RoadRescue/RoadRescue/Project/">RoadRescue</a></p>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Back to top button -->
        <a href="Assets/Templates/Main/#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- Pre Loader -->
        <div id="loader" class="show">
            <div class="loader"></div>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="Assets/Templates/Main/lib/easing/easing.min.js"></script>
        <script src="Assets/Templates/Main/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="Assets/Templates/Main/lib/waypoints/waypoints.min.js"></script>
        <script src="Assets/Templates/Main/lib/counterup/counterup.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="Assets/Templates/Main/mail/jqBootstrapValidation.min.js"></script>
        <script src="Assets/Templates/Main/mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="Assets/Templates/Main/js/main.js"></script>
        <!-- Initialize AOS -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
        AOS.init({
            duration: 1000, // Animation duration in milliseconds
            once: true, // Animations will only happen once
        });
        </script>
    </body>
</html>

