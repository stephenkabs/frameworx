<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>payslips</title>
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
    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="/payslip"><i class="dripicons-arrow-thin-left"></i> Back</a>
                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="{{ route('payslip.edit', $payslip->slug) }}"><i class="dripicons-document-edit"></i> Edit</a>
                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="{{ route('payslip.exportToPDF', $payslip->slug) }}"><i class="dripicons-download"></i> Download PDF</a>
                                    </h4><br><br>
                                    <h4 class="card-title">{{ $payslip->salary->employee->name }}'s Payslip Information</h4>
                                    <hr style="border-top: dashed 1px;" />

                                    <!-- Payslip Details -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Employee Name:</strong> {{ $payslip->salary->employee->name }}</p>
                                            <p><strong>Position:</strong> {{ $payslip->salary->employee->designation }}</p>
                                            <p><strong>Department:</strong> {{ $payslip->salary->employee->department->name }}</p>
                                            <p><strong>Payment Date:</strong> {{ \Carbon\Carbon::parse($payslip->date)->format('d M, Y') }}</p>
                                        </div>

                                        <div class="col-md-6">
                                            <p><strong>Prepared By:</strong> {{ $payslip->prepared_by }}</p>
                                            <p><strong>Salary Amount:</strong> {{formatCurrency($payslip->salary->net_pay ) }}</p>
                                            {{-- <p><strong>Slug:</strong> {{ $payslip->slug }}</p>
                                            <p><strong>User ID:</strong> {{ $payslip->user_id }}</p> --}}
                                        </div>
                                    </div>

                                    <hr style="border-top: dashed 1px;" />

                                    <!-- Salary Breakdown Table -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Allowances</th>
                                                    <th>Amount (ZMW)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Basic Salary</td>
                                                    <td>{{ formatCurrency($payslip->salary->basic_salary) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Housing Allowance</td>
                                                    <td>{{ formatCurrency($payslip->salary->housing_allowance) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Transport Allowance</td>
                                                    <td>{{ formatCurrency($payslip->salary->transport_allowance) }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Deductions</b></td>
                                                    {{-- <td>{{ formatCurrency($payslip->salary->other_deductions ) }}</td> --}}
                                                </tr>
                                                <tr>
                                                    <td>Health</td>
                                                    <td>{{ formatCurrency($payslip->salary->nhima) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pension</td>
                                                    <td>{{ formatCurrency($payslip->salary->napsa) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tax</td>
                                                    <td>{{ formatCurrency($payslip->salary->payee) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Pay</th>
                                                    <th>{{ formatCurrency($payslip->salary->monthly_gross + $payslip->salary->basic_salary + $payslip->salary->housing_allowance + $payslip->salary->transport_allowance - $payslip->salary->nhima - $payslip->salary->napsa - $payslip->salary->payee) }}</th>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <hr style="border-top: dashed 1px;" />

                                    <!-- Footer with Action Buttons -->
                                    {{-- <div class="text-center">
                                        <a href="{{ route('payslip.print', $payslip->slug) }}" class="btn btn-primary"><i class="dripicons-print"></i> Print Payslip</a>
                                    </div> --}}
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

    <script src="/assets/libs/parsleyjs/parsley.min.js"></script>

    <script src="/assets/js/pages/form-validation.init.js"></script>

    <script src="/assets/js/app.js"></script>
    @include('toast.error_success_js')

</body>

</html>
