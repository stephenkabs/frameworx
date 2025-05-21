<!DOCTYPE html>
<html lang="en">

<head>
    <title>Plus- Official</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="CoolAir — Air Conditioner & HVAC Repair Website Template" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <!-- CSS Files
    ================================================== -->
    <link href="/web_nice/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="/web_nice/css/plugins.css" rel="stylesheet" type="text/css">
    <link href="/web_nice/css/swiper.css" rel="stylesheet" type="text/css">
    <link href="/web_nice/css/style.css" rel="stylesheet" type="text/css">
    <link href="/web_nice/css/coloring.css" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="/web_nice/css/colors/scheme-01.css" rel="stylesheet" type="text/css">
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
                <div class="swiper-container jarallax-img" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                    <div class="swiper-wrapper">
                        @foreach ($background as $item)
                        @if ($item->type == 'hero')
                        <div class="swiper-slide">
                            <img src="/background_images/{{ $item->image }}" alt="Background 1" style="width: 100%; height: 100%; object-fit: cover;">
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
                        background: linear-gradient(248deg, rgba(200, 74, 6, 0) 0%, rgb(34, 34, 34) 70%);
                        z-index: 1;">
                </div>

                <!-- Content -->
                <div class="container relative z-index-1000" style="position: relative;">
                    <div class="spacer-double sm-hide"></div>
                    <div class="row g-4 gx-5 align-items-center">
                        @foreach ($heroes as $item)
                        @if ($item->status == 'Published')
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
                            <a class="btn-main wow fadeInUp" style="background-color: #ff8c00; color: #000;" data-wow-delay=".6s" href="{{ $item->button_link }}">{{ $item->button_name }}</a>


                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Swiper JS Initialization -->
            <script>
                document.addEventListener("DOMContentLoaded", function () {
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


            <br><br>

            <section class="no-top">
                <div class="container">

                    <div class="row g-4">
                        {{-- <div class="col-lg-6" style="position: relative;">
                            <img src="/web_nice/images/projects/1.jpg"
                                class="img-fluid rounded-20px wow scaleOut" data-wow-delay=".0s" alt="">
                        </div> --}}
                        @foreach ($background as $item)
                        @if ($item->type == 'about_image')
                        <div class="col-lg-6">
                            <img src="/background_images/{{ $item->image }}"
                                class="img-fluid rounded-20px wow scaleOut" data-wow-delay=".2s" alt="">
                        </div>
                        @endif
                        @endforeach

                        <div class="spacer-single"></div>

                        <div class="row g-4">
                            @foreach ($solution->where('type', 'Feature')->take(4) as $item)
                                <div class="col-lg-3 col-sm-6 text-center">
                                    <div class="fw-bold text-dark">{{ $item->name }}</div>
                                    {{ $item->content }}
                                </div>
                            @endforeach
                        </div>


                        <div class="spacer-single"></div>
                        @foreach ($overview as $item)
                        <div class="col-lg-3">
                            <h3
                                style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
                               {{ $item->title }}
                            </h3>
                        </div>

                        <div class="col-lg-9">
                            <p
                                style="font-size: 14px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
                            {{ $item->content }}
                            </p>
                        </div>
                        @endforeach


                        <div class="spacer-single"></div>
                    </div>

                    {{-- <div class="row g-5">
                        <div class="col-lg-6 wow fadeInLeft">
                            <div class="padding40 bg-grey rounded-30 h-100">
                                <h3 class="mb-4">Challenges</h3>
                                <ol class="ol-style-1">
                                    @foreach ($solution as $item)
                                    @if ($item->type == 'Challenges')
                                    <li style="font-size: 14px">{{ $item->content }}
                                    </li>
                                    @endif
                                    @endforeach

                                </ol>
                            </div>
                        </div>

                        <div class="col-lg-6 wow fadeInRight">
                            <div style="background: rgb(6, 87, 119);
background: linear-gradient(248deg, rgba(171, 93, 3, 0.418) 0%, rgba(254, 185, 101, 0.161) 82%);"
                                class="padding40 rounded-30 h-100">
                                <h3 class="mb-4">Solutions</h3>
                                <ol class="ol-style-1">
                                    @foreach ($solution as $item)
                                    @if ($item->type == 'Solution')
                                    <li style="font-size: 14px" >{{ $item->content }}
                                    </li>
                                    @endif
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </section>

            <div class="spacer-single"></div>

            <section class="no-top">
                <div class="container">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6">
                            <div class="mb-2 text-center">
                                @foreach ($background as $item)
                                @if ($item->type == 'brands')
                                <div class="bg-color-3 inline-block w-25 p-3 py-4 rounded-10px m-2 wow fadeInUp" data-wow-delay=".2s">
                                    <img src="/background_images/{{ $item->image }}" width="100px">
                                </div>
                                @endif
                                @endforeach

                            </div>
                        </div>
                        @foreach ($heroes as $item)
                        @if ($item->status == 'Section')
                        <div class="col-lg-5">
                            {{-- <div class="subtitle wow fadeInUp mb-3">Services Process</div> --}}
                            <h2 style="font-size: 32px">{{ $item->title }}</h2>
                            <div class="spacer-10"></div>
                            <p>{{ $item->about }}</p>
                            <a style="background-color: #ff8c00; color: #000;" class="btn-main" href="{{ $item->button_link }}">{{ $item->button_name }}</a>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </section>

        <!-- Cookie Pop-up -->
        <div id="cookieConsent" style="display: none; position: fixed; bottom: 0; width: 100%; background-color: #000000; color: white; padding: 20px; z-index: 9999; text-align: center;">
            <span>We use cookies to enhance your experience. By continuing to visit this site, you agree to our use of cookies.</span>
            <button id="acceptCookies" style="margin-left: 15px; padding: 10px 20px; background-color: #b1580a; color: white; border: none; border-radius: 5px; cursor: pointer;">Accept</button>
        </div>

        </div>
        <!-- content close -->

        <!-- footer begin -->
        @include('web_includes.footer')
    </div>

    <!-- Javascript Files
    ================================================== -->
    <script src="/web_nice/js/plugins.js"></script>
    <script src="/web_nice/js/designesia.js"></script>
    <script src="/web_nice/js/swiper.js"></script>
    <script src="/web_nice/js/custom-marquee.js"></script>
    <script src="/web_nice/js/custom-swiper-1.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- JavaScript for Cookie Pop-up -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cookieConsent = document.getElementById("cookieConsent");
            const acceptCookies = document.getElementById("acceptCookies");

            // Check if the user already accepted cookies
            if (!localStorage.getItem("cookiesAccepted")) {
                cookieConsent.style.display = "block";
            }

            // Handle the accept button
            acceptCookies.addEventListener("click", function () {
                localStorage.setItem("cookiesAccepted", "true");
                cookieConsent.style.display = "none";
            });
        });
    </script>
</body>

</html>
