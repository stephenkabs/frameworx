<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Branches</title>
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

                                    <form class="row needs-validation"
                                        action="{{ route('branches.update', $branch->slug) }}" novalidate method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationCustom01">Countries</label>
                                            <select name="country_id" class="form-select" id="validationCustom01"
                                                required>
                                                <option value="" disabled>Select Country</option>
                                                <!-- Placeholder option -->

                                                @foreach ($countries as $item)
                                                    <!-- Assuming $countries contains the list of all countries -->
                                                    <option value="{{ $item->id }}"
                                                        {{ $branch->country_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Branch Name</label>
                                            <div>
                                                <input name="name" type="text" class="form-control"
                                                    value="{{ $branch->name }}" required />
                                            </div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Address</label>
                                            <div>
                                                <input name="address" type="text" class="form-control"
                                                    value="{{ $branch->address }}" required />
                                            </div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Email</label>
                                            <div>
                                                <input name="email" type="email" class="form-control"
                                                    value="{{ $branch->email }}" required />
                                            </div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="validationCustom01">Branch Status</label>
                                            <select name="status" class="form-select" id="validationCustom01">
                                                <option value="" disabled selected>{{ $branch->status }}</option>
                                                <option value="Active"
                                                    {{ $branch->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Partial Active"
                                                    {{ $branch->status == 'Partial Active' ? 'selected' : '' }}>Partial
                                                    Active</option>
                                                <option value="Transfered"
                                                    {{ $branch->status == 'Transfered' ? 'selected' : '' }}>Transfered
                                                </option>
                                                <option value="Closed"
                                                    {{ $branch->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>

                                        <div class="mb-0">
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-info waves-effect waves-light">Update
                                                    Changes</button>
                                                <button type="reset"
                                                    class="btn btn-secondary waves-effect ms-1">Cancel</button>
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
