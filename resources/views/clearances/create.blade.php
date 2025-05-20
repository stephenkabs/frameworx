

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

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title"><a class="btn btn-info waves-effect waves-light"
                                            href="/clearances"><i class="dripicons-arrow-thin-left"></i></a></h4><br>
                                            <form class="row needs-validation" action="{{ route('clearances.store') }}"
                                            novalidate method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">Select Garnished Invoice:</label>
                                                <select name="garnish_id" id="garnish_id" class="form-control" required>
                                                    <option value="">Select Invoice</option>
                                                    @foreach ($garnishes as $garnish)
                                                        <option value="{{ $garnish->id }}">{{ $garnish->document->supplier_name }} - Garnished Amount {{ $garnish->amount }}
                                                            </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3 position-relative">
                                                <label class="form-label">Bank Name</label>
                                                <div>
                                                    <input name="bank_name" data-parsley-type="number" type="text"
                                                        class="form-control" placeholder="Enter Bank Name" required />
                                                </div>
                                            </div>
                                            <div class="mb-3 position-relative">
                                                <label class="form-label">Bank Address</label>
                                                <div>
                                                    <input name="bank_address"  data-parsley-type="number" type="text"
                                                        class="form-control" placeholder="Enter Bank Address" required />
                                                </div>
                                            </div>
                                            <div class="mb-3 position-relative">
                                                <label class="form-label">Director</label>
                                                <div>
                                                    <input name="director" data-parsley-type="number" type="text"
                                                        class="form-control" placeholder="Enter Director Name" required />
                                                </div>
                                            </div>

                                            <div class="mb-3 position-relative">
                                                <label class="form-label">Position</label>
                                                <div>
                                                    <input name="position" data-parsley-type="number" type="text"
                                                        class="form-control" placeholder="Enter Position" required />
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

                                            {{-- <form action="{{ route('clearances.store') }}" method="POST">
                                                @csrf
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label">Department Name</label>
                                                <div>
                                                    <label for="bank_name">Bank Name</label>
                                                    <input type="text" name="bank_name" id="bank_name" required>
                                                </div>
                                                </div>
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label">Department Name</label>

                                                <div>
                                                    <label for="bank_address">Bank Address</label>
                                                    <input type="text" name="bank_address" id="bank_address">
                                                </div>
                                                </div>
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label">Department Name</label>
                                                <div>
                                                    <label for="director">Director</label>
                                                    <input type="text" name="director" id="director">
                                                </div>
                                                </div>
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label">Department Name</label>
                                                <div>
                                                    <label for="prepared_by">Prepared By</label>
                                                    <input type="text" name="prepared_by" id="prepared_by">
                                                </div>
                                                </div>
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label">Department Name</label>
                                                <div>
                                                    <label for="position">Position</label>
                                                    <input type="text" name="position" id="position">
                                                </div>
                                                </div>
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label">Department Name</label>
                                                <div>
                                                    <label for="garnish_id">Garnish</label>
                                                    <select name="garnish_id" id="garnish_id" required>
                                                        @foreach($garnishes as $garnish)
                                                            <option value="{{ $garnish->id }}">{{ $garnish->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                </div>

                                                <button type="submit">Create Clearance</button>
                                            </form> --}}


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
