<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Assets</title>
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
                                            href="/asset"><i class="dripicons-arrow-thin-left"></i></a></h4><br>


                                    <form class="row needs-validation" action="{{ route('asset.store') }}" novalidate
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationCustom01">Asset Name</label>
                                            <input type="text" name="name" class="form-control"
                                                id="validationCustom01" placeholder="Enter Asset Name" required />
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationCustom01">Asset Amount</label>
                                            <input type="number" name="amount" class="form-control"
                                                id="validationCustom01" placeholder="Enter Amount" required />
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                        {{-- <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationCustom01">Supplier Name</label>
                                        <input type="text" name="supplier_name" class="form-control" id="validationCustom01"
                                            placeholder="Enter Supplier" required />
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationCustom01">Supplier Number</label>
                                        <input type="text" name="supplier_contact" class="form-control" id="validationCustom01"
                                            placeholder="Enter Supplier Number" required />
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div> --}}
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Delivered Date</label>
                                            <div>
                                                <input name="delivery_date" data-parsley-type="number" type="date"
                                                    class="form-control" placeholder="Delivery Date" required />
                                            </div>
                                        </div>
                                        {{-- <div class="mb-3 position-relative">
                                        <label class="form-label">Warrant Start Date</label>
                                        <div>
                                            <input name="warrant_start_date" data-parsley-type="number" type="date" class="form-control"
                                                placeholder="Warrant Start Date" required />
                                        </div>
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Delivery Date</label>
                                        <div>
                                            <input name="end_date" data-parsley-type="number" type="date" class="form-control"
                                                placeholder="Enter Date" required />
                                        </div>
                                    </div> --}}
                                        {{-- <div class="mb-3 position-relative">
                                        <label class="form-label">Warrant Duration</label>
                                        <div>
                                            <input name="warrant_duration" data-parsley-type="number" type="text" class="form-control"
                                                placeholder="Warrant Duration" required />
                                        </div>
                                    </div> --}}
                                        {{-- <div class="mb-3 position-relative">
                                            <label class="form-label">Attachment</label>
                                            <div>
                                                <input name="image" data-parsley-type="number" type="file"
                                                    class="form-control" placeholder="Enter Date"  />
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Attachment Name</label>
                                            <div>
                                                <input name="attachment_name" data-parsley-type="number" type="text"
                                                    class="form-control" placeholder="Enter File Name"  />
                                            </div>
                                        </div> --}}
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Asserts Note</label>
                                            <div>
                                                <textarea name="asset_description" class="form-control" rows="5" ></textarea>
                                            </div>
                                        </div>
                                        <div class="mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-info waves-effect waves-light">
                                                    Save
                                                </button>
                                                <button type="reset" class="btn btn-secondary waves-effect ms-1">
                                                    Cancel
                                                </button>
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

</body>

</html>
