<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $event->title }}</title>
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
<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #28a745; color: white;">
                <h5 class="modal-title" id="successModalLabel">🎉 Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button>
            </div>
            <div class="modal-body text-center">
                <p style="font-size: 1.2rem; font-weight: bold; color: #28a745;">
                    {{ session('success') }}
                </p>
                <i class="bi bi-check-circle-fill" style="font-size: 2.5rem; color: #28a745;"></i>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


                <!-- Modal for Buying Tickets -->
                <div class="modal fade" id="buyTicketModal" tabindex="-1" aria-labelledby="buyTicketModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="buyTicketModalLabel">Buy Tickets for {{ $event->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('tickets.purchase', $event->slug) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="ticket_type" class="form-label">Select Ticket Type:</label>
                                        <select name="ticket_type" id="ticket_type" class="form-select" required>
                                            @foreach($event->tickets as $ticket)
                                                <option value="{{ $ticket->type }}">{{ $ticket->type }} ({{ $ticket->quantity }} available)</option>
                                            @endforeach
                                        </select>
                                    </div>

                                        <input type="hidden" name="quantity" id="quantity" class="form-control" min="1" value="1" required>


                                    <div class="mb-3">
                                        <label for="transaction" class="form-label">Transaction ID</label>
                                        <input type="text" name="transaction_number"  class="form-control" required>
                                    </div>
                                    <input type="hidden" name="status"  class="form-control" value="transaction_unapproved">
                                    <button type="submit" class="btn btn-primary">Buy Tickets</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a class="btn btn-info btn-sm waves-effect waves-light" href="/event">
                                        <i class="dripicons-arrow-thin-left"></i>
                                    </a>
                                    @role('admin')
                                    <a class="btn btn-info btn-sm waves-effect waves-light" href="{{ route('event.edit', $event->slug) }}">
                                        <i class="dripicons-document-edit"></i>
                                    </a>
                                    @endrole

                                    <!-- Buy Ticket Button -->
                                    <button type="button" class="btn btn-info btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#buyTicketModal">
                                        Buy Ticket
                                    </button>
                                </h4><br>
                                <h4 class="card-title"> {{ $event->name }}'s Event Information</h4>
                                <p class="card-title-desc">
                                    <b>Date: </b>{{ $event->date ?? 'None' }}<br>
                                    <b>Venue: </b>{{ $event->location ?? 'None' }}<br>
                                    <b>Time: </b>{{ $event->start_time ?? 'None' }} - {{ $event->end_time ?? 'None' }}<br>
                                    <b>Organizer Name: </b>{{ $event->organizer_name ?? 'None' }}<br>
                                    <b>Organizer Email: </b>{{ $event->email?? 'None' }}<br>
                                    <b>Organizer Number: </b>{{ $event->number?? 'None' }} <br><br>
                                    <b>PAY VIA MOBILE MONEY</b><br>
                                    <b>Airtel Money Name: </b>{{ $event->mobile_money_name ?? 'None' }}<br>
                                    <b>Airtel Money Number: </b>{{ $event->mobile_money_number  ?? 'None' }}<br>
                                    <b>MTN Money Name: </b>{{ $event->mobile_money_name_two ?? 'None' }}<br>
                                    <b>MTN Money Number: </b>{{ $event->mobile_money_number_two  ?? 'None' }}<br><br>

                                    <b>Ticket Prices:</b>
                                    <ul>
                                        @foreach ($event->tickets as $ticket)
                                            <li>{{ $ticket->type }}: {{ formatCurrency($ticket->price) }} </li>
                                        @endforeach
                                    </ul>
                                    <b>Tickets:</b>
                                    <ul>
                                        @forelse ($event->tickets as $ticket)
                                            <li>{{ $ticket->type }}: {{ $ticket->quantity }} available</li>
                                        @empty
                                            <li>No tickets available</li>
                                        @endforelse
                                    </ul>

                                    <hr><br>
                                    <b>About Event: </b>{{ $event->description }}<br>
                                </p>
                                <br>
                            </div>
                        </div>
                    </div>





                    <!-- end row -->
                    <!-- end col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <embed src="/events/{{ $event->image }}#toolbar=0"  width="100%"/>



                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-8">
                        <div class="card">

                        </div>
                    </div>
                    <!-- end col -->
                </div>

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
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    });
</script>
@endif

</body>

</html>
