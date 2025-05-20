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
    @include('includes.validation')
    <!-- Loader -->


    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title"><a class="btn btn-info waves-effect waves-light"
                                            href="/accounts"><i class="dripicons-arrow-thin-left"></i></a></h4><br>


                                            <form class="row needs-validation" action="{{ route('accounts.update', $account->slug) }}" novalidate method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')  <!-- Add this line to indicate that the form is for updating an existing resource -->

                                                <div class="row">
                                                    <!-- Account Name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Account Name</label>
                                                        <div>
                                                            <input name="name" type="text" class="form-control" value="{{ old('name', $account->name) }}" placeholder="Enter Account Name" required />
                                                        </div>
                                                    </div>

                                                    <!-- Bank Name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Bank Name</label>
                                                        <div>
                                                            <input name="account_name" type="text" class="form-control" value="{{ old('account_name', $account->account_name) }}" placeholder="Enter Bank Name" required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- Swift Code -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Swift Code</label>
                                                        <div>
                                                            <input name="swift_code" type="text" class="form-control" value="{{ old('swift_code', $account->swift_code) }}" placeholder="Enter Swift Code" required />
                                                        </div>
                                                    </div>

                                                    <!-- Sort Code -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Sort Code</label>
                                                        <div>
                                                            <input name="sort_code" type="text" class="form-control" value="{{ old('sort_code', $account->sort_code) }}" placeholder="Enter Sort Code" required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- Currency -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="validationCustom01">Account Currency</label>
                                                        <select name="currency" class="form-select" id="validationCustom01" required>
                                                            <option value="" disabled>Select Currency</option>
                                                            <option value="Kwacha Account" {{ old('currency', $account->currency) == 'Kwacha Account' ? 'selected' : '' }}>Kwacha Account</option>
                                                            <option value="US Dollar Account" {{ old('currency', $account->currency) == 'US Dollar Account' ? 'selected' : '' }}>US Dollar Account</option>
                                                        </select>
                                                    </div>

                                                    <!-- Account Number -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Account Number</label>
                                                        <div>
                                                            <input name="account_number" type="text" class="form-control" value="{{ old('account_number', $account->account_number) }}" placeholder="Enter Account Number" required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Hidden Field for Account Type -->
                                                <input name="type" type="hidden" value="Online Payment" />

                                                <div class="row">
                                                    <!-- Branch -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Branch</label>
                                                        <div>
                                                            <input name="branch" type="text" class="form-control" value="{{ old('branch', $account->branch) }}" placeholder="Enter Branch" required />
                                                        </div>
                                                    </div>

                                                    <!-- Hidden Input for Branch -->
                                                    {{-- <input name="branch" type="hidden" value="Online Banking" /> --}}

                                                    <!-- Accounts For -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="validationCustom01">Accounts For</label>
                                                        <select name="target" class="form-select" id="validationCustom01" required>
                                                            <option value="" disabled>Select Description</option>
                                                            <option value="Main" {{ old('target', $account->target) == 'Main' ? 'selected' : '' }}>Main</option>
                                                            <option value="business_account" {{ old('target', $account->target) == 'business_account' ? 'selected' : '' }}>Business Account</option>
                                                            <option value="yearly_savings" {{ old('target', $account->target) == 'yearly_savings' ? 'selected' : '' }}>Yearly</option>
                                                            <option value="monthly_savings" {{ old('target', $account->target) == 'monthly_savings' ? 'selected' : '' }}>Monthly Savings</option>
                                                            <option value="daily_savings" {{ old('target', $account->target) == 'daily_savings' ? 'selected' : '' }}>Daily Savings</option>
                                                            <option value="other" {{ old('target', $account->target) == 'other' ? 'selected' : '' }}>Other</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Submit and Reset buttons -->
                                                <div class="mb-0">
                                                    <div>
                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                                        <button type="reset" class="btn btn-secondary waves-effect ms-1">Cancel</button>
                                                    </div>
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

    <script src="/assets/libs/parsleyjs/parsley.min.js"></script>

    <script src="/assets/js/pages/form-validation.init.js"></script>

    <script src="/assets/js/app.js"></script>

</body>

</html>
