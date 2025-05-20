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
                                            href="/departments"><i class="dripicons-arrow-thin-left"></i></a></h4><br>


                                            <form action="{{ route('garnish.update', $garnish->slug) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="document_id" value="{{ $garnish->document_id }}">

                                                <div class="mb-3">
                                                    <label for="comment" class="form-label">Comment</label>
                                                    <textarea name="comment" id="comment" class="form-control" rows="4" required>{{ old('comment', $garnish->comment) }}</textarea>
                                                    @error('comment')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Amount</label>
                                                    <input type="number" name="amount" id="amount" class="form-control" required value="{{ old('amount', $garnish->amount) }}">
                                                    @error('amount')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="signature" class="form-label">Upload Signature</label>
                                                    <input type="file" name="signature" id="signature" class="form-control">
                                                    @error('signature')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                    @if($garnish->signature)
                                                        <p>Current Signature: <a href="{{ asset('storage/' . $garnish->signature) }}" target="_blank">View</a></p>
                                                    @endif
                                                </div>



                                                <button type="submit" class="btn btn-primary">Update</button>
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
