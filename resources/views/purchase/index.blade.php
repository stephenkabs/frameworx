<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Events</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.png">

    <!-- Responsive Table css -->
    <link href="/assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

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
@include('toast.success_toast')
<!-- Begin page -->
<div id="layout-wrapper">

@include('includes.header')

@include('includes.side_bar')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteMinistryModal" tabindex="-1" aria-labelledby="deleteMinistryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteMinistryModalLabel">Delete Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this Event Information?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form id="deleteMinistryForm" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card" >
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a class="btn btn-info btn-sm waves-effect waves-light" href="#"><i class="dripicons-arrow-thin-left"></i></a>
                                    <a class="btn btn-info btn-sm waves-effect waves-light" href="/event/create"><i class="dripicons-plus"></i></a>
                                </h4>


                                <div class="table-rep-plugin">

                                    <div class="table-responsive b-0" data-pattern="priority-columns">

                                        @if ($purchases->isEmpty())
                                        <div class="alert alert-info text-center p-5" role="alert">
                                            <h4><i class="dripicons-feed"></i><br><br>No Tickets Purchased at the moment</h4>
                                            <p class="mb-4">Please Purchase Tickets Now</p>
                                            <a href="/event" class="btn btn-primary"><b>Check our Events</b></a>
                                        </div>
                                    @else
                                        <table id="tech-companies-1" class="table table-striped" style="color: white;">
                                            <thead>
                                                <tr>
                                                    <th data-priority="1">Event</th>
                                                    <th data-priority="1">Transaction ID</th>
                                                    <th data-priority="6">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($purchases as $purchase)
                                                    <tr>
                                                        <td>
                                                            <b>{{ $purchase->event->name ?? 'N/A' }}</b><br>
                                                            <span style="font-size: 11px; color:#6e6e6e;">Quantity: {{ $purchase->quantity }}</span>
                                                        </td>
                                                        <td>
                                                            <b>{{ $purchase->transaction_number }}</b><br>
                                                            <span style="font-size: 11px; color:#6e6e6e;">Status: {{ ucfirst($purchase->status) }}</span>
                                                        </td>
                                                        <td>
                                                            @if ($purchase->status === 'approved')
                                                                <a href="{{ route('purchase.show', $purchase->slug) }}" class="btn btn-info waves-effect waves-light">Print Ticket</a>
                                                            @else
                                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#pendingApprovalModal">Print Ticket</button>
                                                            @endif
                                                            @role('admin')
                                                            <a href="{{ route('purchase.edit', $purchase->slug) }}" class="btn btn-info waves-effect waves-light">
                                                                <i class="dripicons-document-edit"></i>
                                                            </a>


                                                            <!-- Delete button to open modal -->
                                                            <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal"
                                                                data-bs-target="#deleteMinistryModal" data-route="{{ route('purchase.destroy', $purchase->slug) }}">
                                                                <i class="dripicons-trash"></i> Delete
                                                            </button>
                                                            @endrole
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                    <!-- Pending Approval Modal -->
                                    <div class="modal fade" id="pendingApprovalModal" tabindex="-1" aria-labelledby="pendingApprovalModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #ffc107; color: black;">
                                                    <h5 class="modal-title" id="pendingApprovalModalLabel">Approval Pending</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p style="font-size: 1.2rem; font-weight: bold;">
                                                        Waiting for an admin to approve the payment.
                                                    </p>
                                                    <i class="bi bi-hourglass-split" style="font-size: 2.5rem; color: #ffc107;"></i>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
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

<!-- Responsive Table js -->
<script src="/assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

<!-- Init js -->
<script src="/assets/js/pages/table-responsive.init.js"></script>

<script src="/assets/js/app.js"></script>

@if(Session::has('message'))

<script>
    swal("Hi!, {{$profileData->first_name}}", "{{ Session::get('message') }}",'success',{
        button:true,
        button:"Close",
    });


</script>

@endif

<script>
    // Event listener for delete button click
    $('#deleteMinistryModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var route = button.data('route'); // Extract route from data-* attribute
        var modal = $(this);

        // Update the form action with the correct route
        modal.find('#deleteMinistryForm').attr('action', route);
    });
</script>
@include('toast.error_success_js')


</body>

</html>
