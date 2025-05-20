<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Profit</title>
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
    <!-- Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Client
                        Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Client Name:</strong> <span id="clientName"></span></p>
                    <p><strong>Grand Total:</strong> <span id="grandTotal"></span></p>
                    <p><strong>Amount Paid:</strong> <span id="amountPaid"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteMinistryModal" tabindex="-1" aria-labelledby="deleteMinistryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMinistryModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Sale?
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
    @include('toast.success_toast')
    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">

                        <div class="col-md-6 col-xl-3">
                            <div class="card text-center">
                                <div class="mb-2 card-body text-muted">
                                    <h3 style="font-size: 15px" class="text-info mt-2">
                                        @php
                                            // Calculate the total grand total using a foreach loop
                                            $totalGrandTotal = $profit->sum(function ($item) {
                                                return $item->quotation->grand_total ?? 0;
                                            });
                                        @endphp

                                        {{ formatCurrency($totalGrandTotal) }}
                                    </h3>

                                    Total Amount of Quotations
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card text-center">
                                <div class="mb-2 card-body text-muted">
                                    <h3 style="font-size: 15px" class="text-info mt-2">

                                        @php
                                            // Sum the 'amount_spent' for all profits
                                            $totalAmountSpent = $profit->sum('amount_spent');
                                        @endphp

                                        <div>
                                            {{ formatCurrency($totalAmountSpent) }}
                                        </div>


                                    </h3>
                                    Total Amount Spent:
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card text-center">
                                <div class="mb-2 card-body text-muted">
                                    @php
                                    // Assuming you have a collection of profits or items
                                    $totalRemainingBalance = $profit->sum(function ($profit) {
                                        return $profit->quotation->grand_total - $profit->amount_spent;
                                    });
                                @endphp
                                    <h3 style="font-size: 15px" class="text-info mt-2">
                                        {{ formatCurrency($totalRemainingBalance) }}
                                    </h3>

                                    Total Profit Amount
                                </div>
                            </div>
                        </div>

                        @php
                        $totalBalance = $profit->reduce(function ($carry, $item) {
                            return $carry + ($item->quotation->grand_total - $item->amount_paid);
                        }, 0);
                    @endphp

                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <div class="mb-2 card-body text-muted">
                                <h3 style="font-size: 15px" class="text-info mt-2">
                                    {{ formatCurrency($totalBalance) }}
                                </h3>
                                Total Balance
                            </div>
                        </div>
                    </div>


                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">


                                    <h4 class="card-title"><a class="btn btn-sm btn-info waves-effect waves-light"
                                            href="/windows/business_manager"><i class="dripicons-arrow-thin-left"></i></a> <a
                                            class="btn btn-info btn-sm waves-effect waves-light"
                                            href="/profit/create"><i class="dripicons-plus"></i></a></h4>
                                    {{-- <p class="card-title-desc"><b>{{$profileData->last_name}}</b>, this is the total Amount you have spent on all your projects</b></p> --}}

                                    <div class="table-rep-plugin">
                                        <div class="table-responsive b-0" data-pattern="priority-columns">
                                            <!-- Table -->
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Client Name</th>
                                                        <th data-priority="3">Invested Amount</th>
                                                        <th data-priority="6">Balance</th>
                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($profit->isEmpty())
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5>No Profits Uploaded</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($profit as $item)
                                                            @php
                                                                $balance =
                                                                    (int) ($item->quotation->grand_total -
                                                                        $item->amount_paid);
                                                            @endphp
                                                            <tr>
                                                                <td>
                                                                    <b>{{ $item->quotation->client->client_name }} -
                                                                        {{ formatCurrency($item->quotation->grand_total) }}</b><br>
                                                                    <span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                        Amount Paid:
                                                                        {{ formatCurrency($item->amount_paid) }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <b>{{ formatCurrency($item->amount_spent) }}</b><br>
                                                                    <span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                        Profit:
                                                                        {{ formatCurrency($item->quotation->grand_total - $item->amount_spent) }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <b>{{ formatCurrency($balance) }}</b><br>
                                                                    <span
                                                                        style="font-size: 11px; color: {{ \Carbon\Carbon::parse($item->date)->isToday() ? 'red' : 'rgb(112, 112, 112)' }};">
                                                                        Payment Date:
                                                                        {{ \Carbon\Carbon::parse($item->date)->format('F j, Y') }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    @if ($balance === 0)
                                                                        <a
                                                                            class="btn btn-success waves-effect waves-light">
                                                                            Completed Sale
                                                                        </a>
                                                                    @endif
                                                                    <button
                                                                        class="btn btn-info waves-effect waves-light preview-button"
                                                                        data-client-name="{{ $item->quotation->client->client_name }}"
                                                                        data-grand-total="{{ formatCurrency($item->quotation->grand_total) }}"
                                                                        data-amount-paid="{{ formatCurrency($item->amount_paid) }}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#previewModal">
                                                                        Preview
                                                                    </button>
                                                                    <a class="btn btn-info waves-effect waves-light
                           {{ $balance === 0 ? 'disabled' : '' }}"
                                                                        href="{{ route('profit.edit', $item->slug) }}">
                                                                        Update Payments
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn  btn-danger waves-effect waves-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteMinistryModal"
                                                                        data-route="{{ route('profit.destroy', $item->slug) }}">
                                                                        <i class="dripicons-trash"></i> Delete
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>


                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const previewButtons = document.querySelectorAll('.preview-button');
                                                    previewButtons.forEach(button => {
                                                        button.addEventListener('click', function() {
                                                            const clientName = this.dataset.clientName;
                                                            const grandTotal = this.dataset.grandTotal;
                                                            const amountPaid = this.dataset.amountPaid;

                                                            // Populate modal with data
                                                            document.getElementById('clientName').innerText = clientName;
                                                            document.getElementById('grandTotal').innerText = grandTotal;
                                                            document.getElementById('amountPaid').innerText = amountPaid;
                                                        });
                                                    });
                                                });
                                            </script>

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
                    <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch"
                        data-bsStyle="/assets/css/bootstrap-dark.min.css"
                        data-appStyle="/assets/css/app-dark.min.css" />
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

                <div class="mb-2">
                    <img src="/assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch"
                        data-appStyle="/assets/css/app-rtl.min.css" />
                    <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                </div>

                <h6 class="mt-4">Select Custom Colors</h6>
                <div class="d-flex">

                    <ul class="list-unstyled mb-0">
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-default" value="default"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'default')" checked>
                            <label class="form-check-label" for="theme-default">Default</label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-orange" value="orange"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'orange')">
                            <label class="form-check-label" for="theme-orange">Orange</label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-teal" value="teal"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'teal')">
                            <label class="form-check-label" for="theme-teal">Teal</label>
                        </li>
                    </ul>

                    <ul class="list-unstyled mb-0 ms-4">
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-purple" value="purple"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'purple')">
                            <label class="form-check-label" for="theme-purple">Purple</label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-green" value="green"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'green')">
                            <label class="form-check-label" for="theme-green">Green</label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-red" value="red"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'red')">
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

    <script>
        // Event listener for delete button click
        $('#deleteMinistryModal').on('show.bs.modal', function(event) {
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
