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
                                            href="/advance"><i class="dripicons-arrow-thin-left"></i></a></h4><br>


                                            <form class="row needs-validation" action="{{ route('advance.store') }}" novalidate method="POST">
                                                @csrf

                                                <!-- Worker Selection -->
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label">Select Worker</label>
                                                    <select name="worker_id" class="form-control" required>
                                                        <option value="">Choose Worker</option>
                                                        @foreach ($workers as $worker)
                                                            <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Amount -->
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label">Advance Amount</label>
                                                    <input name="amount" type="number" step="0.01" class="form-control" placeholder="Enter Amount" required />
                                                </div>

                                                <!-- Date -->
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label">Advance Date</label>
                                                    <input name="date" type="date" class="form-control" required />
                                                </div>

                                                <!-- Comment (Optional) -->
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label">Comment</label>
                                                    <textarea name="comment" class="form-control" placeholder="Enter Comment (Optional)"></textarea>
                                                </div>

                                                <!-- Submit & Reset Buttons -->
                                                <div class="mb-0">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                                    <button type="reset" class="btn btn-secondary waves-effect ms-1">Cancel</button>
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
