<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Members</title>
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
                                            href="/branches"><i class="dripicons-arrow-thin-left"></i></a></h4><br>
                                    {{-- <h4 class="card-title"> {{ $profileData->last_name }} Here are your Projects</h4>
                                <p class="card-title-desc">Hey, enter your Projects here and Delivery dates.</p> --}}

                                    <form class="row needs-validation" action="{{ route('branches.store') }}" novalidate
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @include('toast.any_error')

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationCustom01">Countries</label>
                                            <select name="country_id" class="form-select" id="validationCustom01"
                                                required>
                                                <option value="" disabled selected>Select Country</option>
                                                @foreach ($country as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Branch Name</label>
                                            <div>
                                                <input name="name" data-parsley-type="number" type="text"
                                                    class="form-control" placeholder="Branch Name" required />
                                            </div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Address</label>
                                            <div>
                                                <input name="address" data-parsley-type="number" type="text"
                                                    class="form-control" placeholder="Address" required />
                                            </div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Email</label>
                                            <div>
                                                <input name="email" data-parsley-type="number" type="email"
                                                    class="form-control" placeholder="Email" required />
                                            </div>
                                        </div>


                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationCustom01">Branch Status</label>
                                            <select type="text" name="status" class="form-select"
                                                id="validationCustom01" placeholder="Enter Project name" required>
                                                <option value="" disabled selected>Select Branch Status</option>
                                                <option>active </option>
                                                <option>inactive </option>

                                            </select>

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
