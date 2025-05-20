<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Tasks</title>
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

        @include('includes.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title"><a class="btn btn-info waves-effect waves-light"
                                            href="/windows/user_settings"><i class="dripicons-arrow-thin-left"></i></a></h4>
                                    <br>


                                    <form action="{{ route('email.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="mail_driver">Mail Driver</label>
                                            <input type="text" class="form-control" id="mail_driver"
                                                name="mail_driver" placeholder="e.g., smtp" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mail_host">Mail Host</label>
                                            <input type="text" class="form-control" id="mail_host" name="mail_host"
                                                placeholder="e.g., smtp.mailtrap.io" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mail_port">Mail Port</label>
                                            <input type="number" class="form-control" id="mail_port" name="mail_port"
                                                placeholder="e.g., 587" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mail_username">Mail Username</label>
                                            <input type="text" class="form-control" id="mail_username"
                                                name="mail_username" placeholder="Enter your mail username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mail_password">Mail Password</label>
                                            <input type="password" class="form-control" id="mail_password"
                                                name="mail_password" placeholder="Enter your mail password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mail_encryption">Mail Encryption</label>
                                            <input type="text" class="form-control" id="mail_encryption"
                                                name="mail_encryption" placeholder="e.g., tls" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mail_from_address">Mail From Address</label>
                                            <input type="email" class="form-control" id="mail_from_address"
                                                name="mail_from_address" placeholder="e.g., your-email@example.com"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mail_from_name">Mail From Name</label>
                                            <input type="text" class="form-control" id="mail_from_name"
                                                name="mail_from_name" placeholder="e.g., Your Company Name" required>
                                        </div><br>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>


                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <!-- end col -->
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
