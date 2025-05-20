<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.png">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


</head>

<body data-sidebar="dark">

<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<!-- Begin page -->
<div id="layout-wrapper">

    @include('includes.header')

    @include('includes.side_bar')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title"><a class="btn btn-info waves-effect waves-light" href="/event"><i class="dripicons-arrow-thin-left"></i></a></h4><br>
                                {{-- <h4 class="card-title"> {{ $profileData->last_name }} Here are your Projects</h4>
                                <p class="card-title-desc">Hey, enter your Projects here and Delivery dates.</p> --}}

                                <form class="row needs-validation" action="{{ route('event.update', $event->slug) }}" method="POST" enctype="multipart/form-data" id="event-form" novalidate>
                                    @csrf
                                    @method('PUT') <!-- For Edit/Update form -->

                                    <!-- Event Title -->
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="event-title">Event Title</label>
                                        <input type="text" name="name" id="event-title" class="form-control" placeholder="Enter Event Title" value="{{ $event->name }}" required>
                                    </div>

                                    <!-- Organizer Name -->
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="organizer-name">Organizer Name</label>
                                        <input type="text" name="organizer_name" id="organizer-name" class="form-control" placeholder="Enter Organizer Name" value="{{ $event->organizer_name }}" required>
                                    </div>

                                    <!-- Organizer Email -->
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="organizer-email">Organizer Email</label>
                                        <input type="email" name="email" id="organizer-email" class="form-control" placeholder="Organizer Email" value="{{ $event->email }}" required>
                                    </div>

                                    <!-- Organizer Number -->
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="organizer-number">Organizer Number</label>
                                        <input type="text" name="number" id="organizer-number" class="form-control" placeholder="Organizer Number" value="{{ $event->number }}" required>
                                    </div>

                                    <!-- Event Date & Time -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="start-time">Start Time</label>
                                            <input type="time" name="start_time" id="start-time" class="form-control" value="{{ $event->start_time }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="end-time">End Time</label>
                                            <input type="time" name="end_time" id="end-time" class="form-control" value="{{ $event->end_time }}" required>
                                        </div>
                                    </div>

                                    <!-- Event Date -->
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="event-date">Event Date</label>
                                        <input type="date" name="date" id="event-date" class="form-control" value="{{ $event->date }}" required>
                                    </div>

                                    <!-- Event Location -->
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="event-location">Location</label>
                                        <input type="text" name="location" id="event-location" class="form-control" placeholder="Enter Event Location" value="{{ $event->location }}" required>
                                    </div>

                                    <!-- Event Poster -->
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="event-poster">Event Poster</label>
                                        <input type="file" name="image" id="event-poster" class="form-control">
                                        @if($event->image)
                                            <p>Current Poster: <img src="{{ asset('events/'.$event->image) }}" alt="Event Poster" width="100"></p>
                                        @endif
                                    </div>

                                    <!-- Event Description -->
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="event-description">Event Description</label>
                                        <textarea name="description" id="event-description" class="form-control" rows="4" placeholder="Enter Event Description" required>{{ $event->description }}</textarea>
                                    </div>

                                    <!-- Ticket Details -->
                                    <h4>Ticket Details</h4>
                                    <div id="ticket-container">
                                        @foreach($event->tickets as $index => $ticket)
                                            <div class="row mb-2 ticket-row">
                                                <input type="hidden" name="tickets[{{ $index }}][id]" value="{{ $ticket->id }}">
                                                <div class="col-md-4">
                                                    <input type="text" name="tickets[{{ $index }}][type]" class="form-control" placeholder="Ticket Type" value="{{ $ticket->type }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" name="tickets[{{ $index }}][price]" class="form-control" placeholder="Price" value="{{ $ticket->price }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" name="tickets[{{ $index }}][quantity]" class="form-control" placeholder="Quantity" value="{{ $ticket->quantity }}" required>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" id="add-ticket" class="btn btn-secondary btn-sm mt-2">Add Another Ticket</button>

                                    <!-- Submit and Reset Buttons -->
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Update Event</button>
                                        <button type="reset" class="btn btn-secondary waves-effect ms-1">Reset</button>
                                    </div>
                                </form>



                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <!-- end col -->
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

@include('includes.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title px-3 py-4">
            <a href="javascript:void(0);" class="right-bar-toggle float-end">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Choose Demo</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="/assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                <label class="form-check-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="/assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" data-bsStyle="/assets/css/bootstrap-dark.min.css" data-appStyle="/assets/css/app-dark.min.css" />
                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <div class="mb-2">
                <img src="/assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" data-appStyle="/assets/css/app-rtl.min.css" />
                <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
            </div>

            <h6 class="mt-4">Select Custom Colors</h6>
            <div class="d-flex">

            <ul class="list-unstyled mb-0">
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-default" value="default" onchange="document.documentElement.setAttribute('data-theme-mode', 'default')" checked>
                    <label class="form-check-label" for="theme-default">Default</label>
                </li>
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-orange" value="orange" onchange="document.documentElement.setAttribute('data-theme-mode', 'orange')">
                    <label class="form-check-label" for="theme-orange">Orange</label>
                </li>
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-teal" value="teal" onchange="document.documentElement.setAttribute('data-theme-mode', 'teal')">
                    <label class="form-check-label" for="theme-teal">Teal</label>
                </li>
            </ul>

            <ul class="list-unstyled mb-0 ms-4">
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-purple" value="purple" onchange="document.documentElement.setAttribute('data-theme-mode', 'purple')">
                    <label class="form-check-label" for="theme-purple">Purple</label>
                </li>
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-green" value="green" onchange="document.documentElement.setAttribute('data-theme-mode', 'green')">
                    <label class="form-check-label" for="theme-green">Green</label>
                </li>
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-red" value="red" onchange="document.documentElement.setAttribute('data-theme-mode', 'red')">
                    <label class="form-check-label" for="theme-red">Red</label>
                </li>
            </ul>

            </div>
            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-default" value="default" onchange="document.documentElement.setAttribute('data-theme-mode', 'default')" checked>
                <label class="form-check-label" for="theme-default">Default</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-teal" value="teal" onchange="document.documentElement.setAttribute('data-theme-mode', 'teal')">
                <label class="form-check-label" for="theme-teal">Teal</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-orange" value="orange" onchange="document.documentElement.setAttribute('data-theme-mode', 'orange')">
                <label class="form-check-label" for="theme-orange">Orange</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-purple" value="purple" onchange="document.documentElement.setAttribute('data-theme-mode', 'purple')">
                <label class="form-check-label" for="theme-purple">Purple</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-green" value="green" onchange="document.documentElement.setAttribute('data-theme-mode', 'green')">
                <label class="form-check-label" for="theme-green">Green</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-red" value="red" onchange="document.documentElement.setAttribute('data-theme-mode', 'red')">
                <label class="form-check-label" for="theme-red">Red</label>
            </div> -->
        </div>

    </div>
    <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/libs/node-waves/waves.min.js"></script>

<script src="/assets/libs/parsleyjs/parsley.min.js"></script>

<script src="/assets/js/pages/form-validation.init.js"></script>

<script src="/assets/js/app.js"></script>

<script>
    document.getElementById('add-ticket').addEventListener('click', function () {
    const container = document.getElementById('ticket-container');
    const index = container.getElementsByClassName('ticket-row').length;

    const newRow = document.createElement('div');
    newRow.className = 'row mb-2 ticket-row';
    newRow.innerHTML = `
        <div class="col-md-4">
            <input type="text" name="tickets[${index}][type]" class="form-control" placeholder="Ticket Type" required>
        </div>
        <div class="col-md-4">
            <input type="number" name="tickets[${index}][price]" class="form-control" placeholder="Price" required>
        </div>
        <div class="col-md-4">
            <input type="number" name="tickets[${index}][quantity]" class="form-control" placeholder="Quantity" required>
        </div>
    `;
    container.appendChild(newRow);
});

    </script>

</body>

</html>
