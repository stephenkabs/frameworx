<!DOCTYPE html>
<html lang="en">

<head>
    <title>Eventix Zambia</title>
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
                        <div class="col-lg-6">
                            <div class="subtitle s2 bg-color text-light wow fadeInUp mb-2">Search our Events</div><br><br>
                            {{-- <h1>Stay Up to Date</h1> --}}
                            <input
                            type="text"
                            id="searchInput"
                            class="form-control mb-4 search-input"
                            placeholder="Search events by name, location, or date"
                            onkeyup="filterEvents()">
                            <style>
                                .search-input {
                                    background-color: transparent;
                                    border: 1px solid rgba(255, 255, 255, 0.5); /* Semi-transparent border */
                                    color: white; /* Adjust text color to contrast with the background */
                                    font-size: 14px;
                                    padding: 10px 15px;
                                    border-radius: 20px; /* Rounded corners */
                                }

                                .search-input::placeholder {
                                    color: rgba(255, 255, 255, 0.7); /* Semi-transparent placeholder */
                                }

                                .search-input:focus {
                                    outline: none; /* Remove default outline */
                                    box-shadow: 0 0 5px rgba(255, 255, 255, 0.8); /* Glow effect on focus */
                                }
                            </style>
{{--
                            <ul class="crumb">
                                <li><a href="index.html">Home</a></li>
                                <li class="active">Blog</li>
                            </ul> --}}
                            <div class="fs-20 fw-600 no-bottom sm-hide">Zambian Events Guru..</div>
                        </div>
                        <div class="col-lg-6 text-lg-end">

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
                    @php
use Illuminate\Support\Str;
@endphp

<div class="container">
    <!-- Search Input -->
    <input type="text" id="searchInput" class="form-control mb-4" placeholder="Search events by name, location, or date" onkeyup="filterEvents()">

    <!-- Events List -->
    <div class="row g-4" id="eventsContainer">
        @foreach ($events as $item)
        <div class="col-lg-4 col-md-6 mb10 event-item"
             data-name="{{ $item->name }}"
             data-location="{{ $item->location }}"
             data-date="{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}">
            <div class="bloglist rounded-20px">
                <div class="post-content">
                    <div class="post-image">
                        <div class="d-tagline">
                            <span>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</span>
                        </div>
                        <img alt="" src="/events/{{ $item->image }}" class="lazy" style="width: 100%; height: 300px; object-fit: cover; object-position: top;">
                    </div>
                    <div class="post-text padding40 pt-2 h-100">
                        <h4 style="font-size: 13px">
                            <a href="{{ route('event.public_show', $item->slug) }}">{{ $item->name }} | {{ formatCurrency($item->ticket->price ) }}</a><br>
                            <span style="font-size: 11px; line-height: 1.9; margin: 0; color: rgb(110, 110, 110);">
                                Time: {{ $item->start_time }} - {{ $item->end_time }} | {{ $item->location }}
                            </span>
                        </h4>
                        <p style="font-size: 12px; line-height: 1.9; margin: 0;">
                            <b>About Event:</b> {{ Str::limit($item->description, 70) }}
                        </p><br>
                        {{-- <a class="btn-main btn-light-trans mt-3" href="{{ route('event.public_show', $item->slug) }}">
                            {{ formatCurrency($item->ticket->price ) }} <!-- Safeguard if ticket is null -->
                        </a> --}}
                        <a class="btn-main bg-color-2" href="{{ route('event.public_show', $item->slug) }}">Buy Ticket</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    </div>
</div>

<script>
    function filterEvents() {
        // Get the search input value
        const query = document.getElementById('searchInput').value.toLowerCase();

        // Get all event items
        const events = document.querySelectorAll('.event-item');

        events.forEach(event => {
            // Get data attributes
            const name = event.getAttribute('data-name').toLowerCase();
            const location = event.getAttribute('data-location').toLowerCase();
            const date = event.getAttribute('data-date').toLowerCase();

            // Check if the event matches the query
            if (name.includes(query) || location.includes(query) || date.includes(query)) {
                event.style.display = ''; // Show
            } else {
                event.style.display = 'none'; // Hide
            }
        });
    }
</script>

                    </div>
                </div>
            </section>
        </div>
        <!-- content close -->
{{-- @include('web_includes.footer') --}}
    </div>

    <!-- Javascript Files
    ================================================== -->
    <script src="/site_asset/js/plugins.js"></script>
    <script src="/site_asset/js/designesia.js"></script>
@include('web_includes.menu')


</body>

</html>
