<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Event</title>
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

                                <h4 class="card-title"><a class="btn btn-info waves-effect waves-light" href="/sermon"><i class="dripicons-arrow-thin-left"></i></a></h4><br>
                                {{-- <h4 class="card-title"> {{ $profileData->last_name }} Here are your Projects</h4>
                                <p class="card-title-desc">Hey, enter your Projects here and Delivery dates.</p> --}}

                                <form
                                class="row needs-validation"
                                action="{{ route('event.store') }}"
                                novalidate
                                method="POST"
                                enctype="multipart/form-data"
                                id="event-form">
                                @csrf

                                <!-- Event Title -->
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="event-title">Event Title</label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="event-title"
                                        class="form-control"
                                        placeholder="Enter Event Title"
                                        required
                                        aria-label="Event Title">
                                </div>

                                <!-- Start Time -->
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="start-time">Start Time</label>
                                    <input
                                        type="time"
                                        name="start_time"
                                        id="start-time"
                                        class="form-control"
                                        required
                                        aria-label="Start Time">
                                </div>

                                <!-- End Time -->
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="end-time">End Time</label>
                                    <input
                                        type="time"
                                        name="end_time"
                                        id="end-time"
                                        class="form-control"
                                        required
                                        aria-label="End Time">
                                </div>

                                <!-- Event Date -->
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="event-date">Event Date</label>
                                    <input
                                        type="date"
                                        name="date"
                                        id="event-date"
                                        class="form-control"
                                        required
                                        aria-label="Event Date">
                                </div>

                                <!-- Location -->
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="event-location">Location</label>
                                    <input
                                        type="text"
                                        name="location"
                                        id="event-location"
                                        class="form-control"
                                        placeholder="Enter Event Location"
                                        required
                                        aria-label="Event Location">
                                </div>

                                <!-- Available Tickets -->
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="available-tickets">Available Tickets</label>
                                    <input
                                        type="number"
                                        name="available_tickets"
                                        id="available-tickets"
                                        class="form-control"
                                        placeholder="Enter Available Tickets"
                                        required
                                        aria-label="Available Tickets"
                                        min="1">
                                </div>

                                <!-- Price -->
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="event-price">Ticket Price</label>
                                    <input
                                        type="number"
                                        name="price"
                                        id="event-price"
                                        class="form-control"
                                        placeholder="Enter Ticket Price"
                                        required
                                        aria-label="Event Price"
                                        step="0.01"
                                        min="0">
                                </div>

                                <!-- Event Poster -->
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="event-poster">Event Poster</label>
                                    <input
                                        type="file"
                                        name="image"
                                        id="event-poster"
                                        class="form-control"
                                        aria-label="Event Poster"
                                        required>
                                </div>

                                <!-- Event Description -->
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="event-description">Event Description</label>
                                    <textarea
                                        name="description"
                                        id="event-description"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Enter Event Description"
                                        required
                                        aria-label="Event Description"></textarea>
                                </div>

                                <!-- Ticket Fields -->
                                <div class="mb-3">
                                    <label class="form-label">Ticket Details</label>
                                    <div id="ticket-container">
                                        <div class="row mb-2 ticket-row">
                                            <div class="col-md-4">
                                                <input
                                                    type="text"
                                                    name="tickets[0][type]"
                                                    class="form-control"
                                                    placeholder="Ticket Type (e.g., VIP)"
                                                    required>
                                            </div>
                                            <div class="col-md-4">
                                                <input
                                                    type="number"
                                                    name="tickets[0][price]"
                                                    class="form-control"
                                                    placeholder="Price"
                                                    required>
                                            </div>
                                            <div class="col-md-4">
                                                <input
                                                    type="number"
                                                    name="tickets[0][quantity]"
                                                    class="form-control"
                                                    placeholder="Quantity"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="add-ticket" class="btn btn-secondary btn-sm mt-2">Add Another Ticket</button>
                                </div>

                                <!-- Submit and Reset Buttons -->
                                <div class="mb-0">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">
                                        Save
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect ms-1">
                                        Cancel
                                    </button>
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

{{-- <script>
    document.getElementById('add-ticket').addEventListener('click', function () {
        const container = document.getElementById('ticket-container');
        const index = container.children.length;
        const ticketRow = document.createElement('div');
        ticketRow.className = 'ticket-row';
        ticketRow.innerHTML = `
            <input type="text" name="tickets[${index}][type]" placeholder="Ticket Type (e.g., VIP)" required>
            <input type="number" name="tickets[${index}][price]" placeholder="Price" required>
            <input type="number" name="tickets[${index}][quantity]" placeholder="Quantity" required>
        `;
        container.appendChild(ticketRow);
    });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ticketContainer = document.getElementById('ticket-container');
        const addTicketButton = document.getElementById('add-ticket');
        let ticketCount = 1;

        addTicketButton.addEventListener('click', function () {
            const newTicketRow = document.createElement('div');
            newTicketRow.className = 'row mb-2 ticket-row';

            newTicketRow.innerHTML = `
                <div class="col-md-4">
                    <input
                        type="text"
                        name="tickets[${ticketCount}][type]"
                        class="form-control"
                        placeholder="Ticket Type (e.g., VIP)"
                        required>
                </div>
                <div class="col-md-4">
                    <input
                        type="number"
                        name="tickets[${ticketCount}][price]"
                        class="form-control"
                        placeholder="Price"
                        required>
                </div>
                <div class="col-md-4">
                    <input
                        type="number"
                        name="tickets[${ticketCount}][quantity]"
                        class="form-control"
                        placeholder="Quantity"
                        required>
                </div>
            `;
            ticketContainer.appendChild(newTicketRow);
            ticketCount++;
        });
    });
</script>


</body>

</html>
