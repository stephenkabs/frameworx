<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $event->name }}</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <meta content="CoolAir — Air Conditioner & HVAC Repair Website Template" name="description" >
    <meta content="" name="keywords" >
    <meta content="" name="author" >
    <!-- CSS Files
    ================================================== -->
    <link href="/site_asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="/site_asset/css/plugins.css" rel="stylesheet" type="text/css" >
    <link href="/site_asset/css/swiper.css" rel="stylesheet" type="text/css" >
    <link href="/site_asset/css/style.css" rel="stylesheet" type="text/css" >
    <link href="/site_asset/css/coloring.css" rel="stylesheet" type="text/css" >
    <!-- color scheme -->
    <link id="colors" href="/site_asset/css/colors/scheme-01.css" rel="stylesheet" type="text/css" >

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

        <!-- header begin -->
@include('web_includes.header')
        <!-- header close -->
        <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            <!-- section begin -->
            <section id="subheader" class="jarallax text-light">
                <img src="/site_asset/images/background/bg.webp" class="jarallax-img" alt="">
                <div class="container relative z-index-1000">
                    <div class="row align-items-center">
                        <div class="col-lg-6 offset-lg-3 text-center">
                            <div class="subtitle s2 bg-color text-light wow fadeInUp mb-2">Date: {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</div>
                            <h1 style="font-size: 25px" >{{ $event->name }}</h1>
                            <ul class="crumb">
                                <li><a href="#">Time: {{ $event->start_time }} - {{ $event->end_time }}</a></li>
                                <li class="active">{{ $event->location }}</li>

                            </ul><br><br>
                            <a class="btn-main bg-color-2" href="{{ route('event.show', $event->slug) }}">Buy Ticket</a>
                        </div>
                    </div>
                </div>
                <div class="de-overlay"></div>
            </section>
            <!-- section close -->

            <div class="bg-color relative z-index-1000 mt-40 mb40">
                <div class="border-white-6 text-center bg-color text-white w-84px h-80px p-3 circle absolute abs-center sm-hide" alt="">
                    <i class="icofont-newspaper fs-36"></i>
                </div>
            </div>

            <section>
                <div class="container">
                    <div class="row gx-5">
                        <div class="col-lg-8">
                            <div class="blog-read">

                                    <img src="/events/{{ $event->image }}" class="img-fluid rounded-20px" alt="">

                                <div class="post-text">
                                    <p style="font-size: 12px; line-Height:17px" ><b>About {{ $event->name }}'s Event</b><br>
                                        Organizer's Name: {{ $event->organizer_name }}<br>
                                        Organizer's Email: {{ $event->email }}<br>
                                        Organizer's Phone Number: {{ $event->number }}<br><br>

                                        {{ $event->description }}</p>
                                </div>

                            </div>

                            <div class="spacer-single"></div>


                        </div>

                        <div class="col-lg-4">
                            <div class="widget widget-post">
                                <h4>Other Events</h4>
                                <ul class="de-bloglist-type-1">
                                    @foreach ($similarEvent as $event)
                                    <li>
                                        <div class="d-image">
                                            <img src="/events/{{ $event->image }}" alt="" style="width: 100%; height: 80px; object-fit: cover; object-position: top;">
                                        </div>
                                        <div class="d-content">
                                            <a href="{{ route('event.public_show', $event->slug) }}"><h4>{{ $event->name }}</h4></a>
                                            <div class="d-date">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</div>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>

    <!-- Javascript Files
    ================================================== -->
    <script src="/site_asset/js/plugins.js"></script>
    <script src="/site_asset/js/designesia.js"></script>
@include('web_includes.menu')
</body>

</html>
