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
                                            href="/asset"><i class="dripicons-arrow-thin-left"></i></a> <a
                                            class="btn btn-info waves-effect waves-light"
                                            href="{{ route('asset.edit', $asset->slug) }}"><i
                                                class="dripicons-document-edit"></i></a></h4><br>
                                    <h4 class="card-title"> {{ $asset->name }} Information</h4>
                                    <p class="card-title-desc"><b>Bought Date:
                                        </b>{{ $asset->delivery_date }}<br><b>Amount:
                                        </b>{{ formatCurrency($asset->amount) }}<br>


                                        <b>Assets Description:</b> {{ $asset->asset_description }}<br>
                                    </p>



                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title"> <a class="btn btn-info waves-effect waves-light"
                                            href="/assets_files/{{ $asset->image }}" download>Download Attachment</a>
                                    </h4>
                                    <hr><br>
                                    <h4 class="card-title">{{ $asset->attachment_name }} </h4>
                                    <embed src="/assets_files/{{ $asset->image }}#toolbar=0" height="600cm"
                                        width="100%" />
                                    {{-- <img src="/images/documents{{ $file->image }}" alt="" class="img-fluid radius-image"> --}}


                                </div>
                            </div>
                        </div>
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
