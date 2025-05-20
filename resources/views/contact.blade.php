<!DOCTYPE html>
<html lang="en">

<head>
    <title>AwCloud</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="CoolAir — Air Conditioner & HVAC Repair Website Template" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <!-- CSS Files
    ================================================== -->
    <link href="/website_style/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="/website_style/css/plugins.css" rel="stylesheet" type="text/css">
    <link href="/website_style/css/swiper.css" rel="stylesheet" type="text/css">
    <link href="/website_style/css/style.css" rel="stylesheet" type="text/css">
    <link href="/website_style/css/coloring.css" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="/website_style/css/colors/scheme-01.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">



</head>

<body>
    <div id="wrapper">
        <div class="float-text show-on-scroll">
            <span><a href="#">Scroll to top</a></span>
        </div>
        <div class="scrollbar-v show-on-scroll"></div>

        <!-- page preloader begin -->
        <div id="de-loader"></div>
        <!-- page preloader close -->

        @include('web_includes.header')
        <!-- content begin -->
        <div class="no-bottom no-top" id="content">

            <div id="top"></div>

            <section class="pt70 jarallax section-dark text-light" style="position: relative;">
                <!-- Image Slider -->
                <div class="swiper-container jarallax-img"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                    <div class="swiper-wrapper">
                        @foreach ($background as $item)
                            @if ($item->type == 'contact')
                                <div class="swiper-slide">
                                    <img src="/background_images/{{ $item->image }}" alt="Background 1"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>

                <!-- Gradient Shade -->
                <div
                    style="
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        /* background: linear-gradient(38deg, rgb(29, 71, 149) 0%, rgb(4, 92, 101) 0%, rgba(207, 117, 6, 0.613) 52%, rgba(185,252,69,0.48365283613445376) 100%); */
                                                background: linear-gradient(248deg, rgba(190, 203, 8, 0) 0%, rgb(0, 0, 0) 70%);
                        z-index: 1;">
                </div>





                <!-- Content -->
                <div class="container relative z-index-1000" style="position: relative;">
                    <div class="spacer-double sm-hide"></div>
                    <div class="row g-4 gx-5 align-items-center">
                        @foreach ($heroes as $item)
                            @if ($item->status == 'contact')
                                <div class="col-lg-6 relative">
                                    <div class="relative z-index-1000">
                                        <h3
                                            style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
                                            {{ $item->title }}
                                        </h3>
                                        <p class="wow fadeInUp" data-wow-delay=".4s"
                                            style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size:13px;">
                                            {{ $item->about }}
                                        </p>
                                        <a class="btn-main wow fadeInUp" data-wow-delay=".6s"
                                            href="{{ $item->button_link }}">{{ $item->button_name }}</a>

                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Swiper JS Initialization -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    new Swiper('.swiper-container', {
                        loop: true,
                        autoplay: {
                            delay: 20000,
                            disableOnInteraction: false,
                        },
                        effect: 'fade', // Adds a smooth fade effect
                        speed: 1000,
                    });
                });
            </script>





            <section>
                <div class="container">
                    <div class="row g-4 gx-5">

                        <div class="col-lg-6">
                            @foreach ($background as $item)
                                @if ($item->type == 'about_image_contact')
                                    <img src="/background_images/{{ $item->image }}"
                                        class=" img-fluid rounded-20px  wow scaleIn" alt="">
                                @endif
                            @endforeach
                        </div>
                        @foreach ($generalSettings as $item)
                            <div class="col-lg-4">
                                <!--                             <h4>Our Office</h4>
                            <div class="img-with-cap mb20">
                                <div class="d-title">Mon - Fri 08.00 - 18.00</div>
                                <div class="d-overlay"></div>
                                <img src="images/misc/5.webp" class="img-fullwidth rounded-1" alt="">
                            </div> -->
                                <br><br>



                                <div class="spacer-single"></div>

                                <div class="fw-bold text-dark"><i
                                        class="icofont-location-pin me-2 id-color-2"></i>Office Location</div>
                                {{ $item->address }}

                                <div class="spacer-single"></div>

                                <div class="fw-bold text-dark"><i class="icofont-envelope me-2 id-color-2"></i>Send a
                                    Message</div>
                                {{ $item->email }}

                                <div class="spacer-single"></div>

                                <div class="fw-bold text-dark"><i class="icofont-phone me-2 id-color-2"></i>Call Us
                                    Directly</div>
                                {{ $item->phone }}

                                <div class="spacer-single"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

        </div>
        <!-- content close -->

        <!-- footer begin -->
        @include('web_includes.footer')
    </div>

    <!-- Javascript Files
    ================================================== -->
    <script src="/website_style/js/plugins.js"></script>
    <script src="/website_style/js/designesia.js"></script>
    <script src="/website_style/js/swiper.js"></script>
    <script src="/website_style/js/custom-marquee.js"></script>
    <script src="/website_style/js/custom-swiper-1.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- JavaScript for Cookie Pop-up -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cookieConsent = document.getElementById("cookieConsent");
            const acceptCookies = document.getElementById("acceptCookies");

            // Check if the user already accepted cookies
            if (!localStorage.getItem("cookiesAccepted")) {
                cookieConsent.style.display = "block";
            }

            // Handle the accept button
            acceptCookies.addEventListener("click", function() {
                localStorage.setItem("cookiesAccepted", "true");
                cookieConsent.style.display = "none";
            });
        });
    </script>
</body>

</html>
