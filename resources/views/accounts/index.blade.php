<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Accounts</title>
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
    @include('toast.success_toast')
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteMinistryModal" tabindex="-1"
                        aria-labelledby="deleteMinistryModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteMinistryModalLabel">Delete Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this Account?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <form id="deleteMinistryForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                                <!-- Modal -->
                                <div class="modal fade" id="saveNowModal" tabindex="-1" aria-labelledby="saveNowModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="saveNowModalLabel">Save Money</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/money" method="POST">
                                                @csrf <!-- CSRF token for Laravel forms -->
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" required>
                                                    </div>

                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="validationCustom01">Accounts For</label>
                                                        <select type="text" name="type" class="form-select"
                                                            id="validationCustom01" placeholder="Enter Project name" required>
                                                            <option value="" disabled selected>Select Description</option>
                                                            <option value="main">Main</option>
                                                            <option value="business_account">Business Account </option>
                                                            <option value="yearly_savings">Yearly </option>
                                                            <option value="monthly_savings">Monthly Savings </option>
                                                            <option value="daily_savings">Daily Savings </option>

                                                            <option value="other">Other </option>

                                                        </select>

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="amount" class="form-label">Amount</label>
                                                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="transaction_id" class="form-label">Transaction ID</label>
                                                        <input type="text" class="form-control" id="transaction_id" name="transaction_id" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Description</label>
                                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Now</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteMinistryModal" tabindex="-1"
                        aria-labelledby="deleteMinistryModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteMinistryModalLabel">Delete Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this Account?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
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
                        <div class="col-lg-12">

                            <div class="card">
                                <div style="background: linear-gradient(338deg, rgb(15, 139, 148) 0%, rgb(20, 7, 84) 100%); border-radius: 0px;"
                                    class="card-body text-center">
                                    <h4 style="color: white" class="card-title"><b>BANK ACCOUNTS</b></h4>
                                    <p style="color: white" class="card-text">Create your accounts Here</p>

                                    <div class="row justify-content-center gap-3">
                                        <h4 class="card-title">
                                            <a class="btn btn-info waves-effect waves-light" href="/accounts/create">Add New Account</a>
                                            <!-- Button to open the modal -->
                                            <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#saveNowModal">
                                               Record More Deposits
                                            </button>
                                        </h4>
                                        <h4 class="card-title">
                                            <a class="btn btn-primary btn-sm waves-effect waves-light" href="#"><b>Expenses Total:
                                                    {{ formatCurrency($expense->sum('amount')) }}</b></a>
                                            <a class="btn btn-primary btn-sm waves-effect waves-light" href="#"><b>Assets Total:
                                                    {{ formatCurrency($asset->sum('amount')) }}</b></a>
                                            <a class="btn btn-primary btn-sm waves-effect waves-light" href="#"><b>Employee Monthly Payments Total:
                                                    {{ formatCurrency($salary->sum('net_pay')) }}</b></a>
                                        </h4>
                                    </div>
                                </div>
                            </div>



                        </div>
                        @foreach ($account as $item)
                            <div class="col-lg-4">
                                <div class="card">
                                    <div style="background: linear-gradient(338deg, rgba(34,185,195,1) 0%, rgba(32,14,124,1) 100%);"
                                        class="card-body"><br>

                                        <h4 style="color: white; text-transform: uppercase;" class="card-title">
                                            {{ $item->account_name }}</h4>

                                        <p style="color: white;font-size: 12px" class="card-title-desc"><b>Account
                                                Number:</b> {{ $item->account_number }}<br>
                                            <b>Branch:</b> {{ $item->branch }}<br>
                                            <b>Payment Way:</b> {{ $item->type }}<br>
                                            <b>Swift Code:</b> {{ $item->swift_code }}<br>
                                            <b>Sort Code:</b> {{ $item->sort_code }}<br>
                                            <b>Currency:</b> {{ $item->currency }}<br>
                                            <b>Payment Way:</b> {{ $item->type }}<br>
                                            <b>Account Type:</b> {{ $item->target }}<br>
                                            <br>
                                            @if ($item->target == 'monthly_savings')
                                                <h4 style="color: white; text-transform: uppercase;font-size: 13px"
                                                    class="card-title">ACCOUNT BALANCE:
                                                    {{ formatCurrency($main->filter(fn($item) => $item->type === 'monthly_savings')->sum('amount')) }}
                                                </h4>
                                            @elseif($item->target == 'yearly_savings')
                                                <h4 style="color: white; text-transform: uppercase;font-size: 13px"
                                                    class="card-title">ACCOUNT BALANCE:
                                                    {{ formatCurrency($main->filter(fn($item) => $item->type === 'yearly_savings')->sum('amount')) }}
                                                </h4>
                                            @elseif($item->target == 'daily_savings')
                                                <h4 style="color: white; text-transform: uppercase;font-size: 13px"
                                                    class="card-title">ACCOUNT BALANCE:

                                                    {{ formatCurrency($main->filter(fn($item) => $item->type === 'daily_savings')->sum('amount')) }}
                                                </h4>
                                            @elseif($item->target == 'Other')
                                                <h4 style="color: white; text-transform: uppercase;font-size: 13px"
                                                    class="card-title">ACCOUNT BALANCE: {{ $totalOtherDonations }}</h4>
                                            @elseif($item->target == 'Main')
                                            <h4 style="color: white; text-transform: uppercase;font-size: 13px"
                                            class="card-title">
                                            ACCOUNT BALANCE:
                                            {{ formatCurrency($main->filter(fn($item) => $item->type === 'main')->sum('amount') + $quotations->sum('grand_total')) }}
                                        </h4>


                                            @else
                                                <h4 style="color: white; text-transform: uppercase;font-size: 13px"
                                                    class="card-title">ACCOUNT BALANCE: 00.000.00</h4>
                                            @endif

                                        </p>

                                        <h4 class="card-title">
                                            <a class="btn btn-info btn-sm waves-effect waves-light"
                                                href="{{ route('accounts.edit', $item->slug) }}"><i
                                                    class="dripicons-document-edit"></i></a>
                                            <!-- Delete button to open modal -->
                                            <button type="button"
                                                class="btn btn-danger btn-sm waves-effect waves-light"
                                                data-bs-toggle="modal" data-bs-target="#deleteMinistryModal"
                                                data-route="{{ route('accounts.destroy', $item->slug) }}">
                                                <i class="dripicons-trash"></i> Delete Account
                                            </button>
                                        </h4>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- end col -->

                    </div>


                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('includes.taskbar')
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

    <script src="/assets/js/app.js"></script>
    @include('toast.error_success_js')

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

</body>

</html>
