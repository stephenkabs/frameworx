<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Clients</title>
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
        @include('includes.validation')

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
                                            href="/client"><i class="dripicons-arrow-thin-left"></i></a></h4><br>


                                            <form action="{{ route('client.update', $client->slug) }}" method="POST" class="needs-validation" novalidate>
                                                @csrf
                                                @method('PUT') <!-- Use PUT method for updates -->
                                                <div class="mb-3">
                                                    <label for="client-name" class="form-label">Client Name</label>
                                                    <input
                                                        type="text"
                                                        name="client_name"
                                                        id="client-name"
                                                        class="form-control"
                                                        placeholder="Enter Client Name"
                                                        value="{{ old('client_name', $client->client_name) }}"
                                                        >
                                                </div>
                                                <div class="mb-3">
                                                    <label for="client-email" class="form-label">Client Email</label>
                                                    <input
                                                        type="email"
                                                        name="email"
                                                        id="client-email"
                                                        class="form-control"
                                                        placeholder="Enter Client Email"
                                                        value="{{ old('email', $client->email) }}"
                                                        >
                                                </div>
                                                <div class="mb-3">
                                                    <label for="client-phone" class="form-label">Client Phone</label>
                                                    <input
                                                        type="text"
                                                        name="phone"
                                                        id="client-phone"
                                                        class="form-control"
                                                        placeholder="Enter Client Phone"
                                                        value="{{ old('phone', $client->phone) }}"
                                                        >
                                                </div>
                                                <div class="mb-3">
                                                    <label for="client-tpin" class="form-label">Client No</label>
                                                    <input
                                                        type="text"
                                                        name="client_tpin"
                                                        id="client-tpin"
                                                        class="form-control"
                                                        placeholder="Enter TPIN"
                                                        value="{{ old('client_tpin', $client->client_tpin) }}"
                                                        >
                                                </div>
                                                <div class="mb-3">
                                                    <label for="client-address" class="form-label">Client Address</label>
                                                    <textarea
                                                        name="client_address"
                                                        id="client-address"
                                                        class="form-control"
                                                        rows="3"
                                                        placeholder="Enter Client Address"
                                                        >{{ old('client_address', $client->client_address) }}</textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Update Client</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
    @include('toast.error_success_js')

</body>

</html>
