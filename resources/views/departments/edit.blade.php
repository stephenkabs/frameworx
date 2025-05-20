<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Departments</title>
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

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Department Form -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><a class="btn btn-info waves-effect waves-light"
                                            href="/departments"><i class="dripicons-arrow-thin-left"></i></a></h4><br>

                                    <form class="row needs-validation"
                                        action="{{ route('departments.update', $department->slug) }}" novalidate
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Department Name</label>
                                            <div>
                                                <input name="name" type="text" class="form-control"
                                                    value="{{ $department->name }}" required />
                                            </div>
                                        </div>

                                        <div class="mb-0">
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-info waves-effect waves-light">Update</button>
                                                <button type="reset"
                                                    class="btn btn-secondary waves-effect ms-1">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Demo</h6>
            <!-- Customization Options -->
        </div>
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
        window.setTimeout(function() {
            let alert = document.getElementById('success-alert');
            if (alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000); // 5000ms = 5s
    </script>

</body>

</html>
