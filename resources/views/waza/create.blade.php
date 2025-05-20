<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Waza</title>
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
                                            href="/waza"><i class="dripicons-arrow-thin-left"></i></a></h4><br>


                                    <form class="row needs-validation" action="{{ route('waza.store') }}"
                                        novalidate method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Employee Name</label>
                                            <div>
                                                <input name="name" data-parsley-type="number" type="text"
                                                    class="form-control" placeholder="Enter Employee Name" required />
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Position</label>
                                            <div>
                                                <input name="position" data-parsley-type="number" type="text"
                                                    class="form-control" placeholder="Enter Position" required />
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Enter Net Pay</label>
                                            <div>
                                                <input name="net_pay" data-parsley-type="number" type="text"
                                                    class="form-control" placeholder="Enter Net Pay" required />
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Accuedle Days</label>
                                            <div>
                                                <input name="accuedle_days" data-parsley-type="number" type="text"
                                                    class="form-control" placeholder="Enter Accuedle Days" required />
                                            </div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Leave Days Taken</label>
                                            <div>
                                                <input name="leave_days_taken" data-parsley-type="number" type="text"
                                                    class="form-control" placeholder="Enter Leave Days Taken" required />
                                            </div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Worked Days</label>
                                            <div>
                                                <input name="worked_days" data-parsley-type="number" type="text"
                                                    class="form-control" placeholder="Enter Worked Days" required />
                                            </div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Term Date</label>
                                            <div>
                                                <input name="term_date" data-parsley-type="number" type="date"
                                                    class="form-control" placeholder="Enter Worked Days" required />
                                            </div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Comments</label>
                                            <textarea name="comment" class="form-control" rows="2" required></textarea>
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
