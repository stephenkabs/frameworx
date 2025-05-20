<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Create - Employee</title>
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

    {{-- @include('includes.mobile_buttom_css') --}}
</head>

<body data-sidebar="dark">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
@include('includes.validation')


    {{-- @include('toast.success_toast') --}}

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    {{-- <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a class="btn btn-info waves-effect waves-light" href="/member">
                                    <i class="dripicons-arrow-thin-left"></i>
                                </a>
                            </h4><br> --}}

                            <!-- Start Form -->
                            <form class="needs-validation" action="{{ route('worker.store') }}" novalidate method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Employee Information Card -->
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Employee Information</h5><br>
                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input name="name" type="text" class="form-control" placeholder="Enter Name" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Department</label>
                                                    <select name="department_id" class="form-select" required>
                                                        <option value="" disabled selected>Select a Department</option>
                                                        @foreach ($department as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Branch</label>
                                                    <select name="branch_id" class="form-select" required>
                                                        <option value="" disabled selected>Select a Branch</option>
                                                        @foreach ($branch as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Designation</label>
                                                    <input name="designation" type="text" class="form-control" placeholder="Enter Designation" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Join Date</label>
                                                    <input name="join_date" type="date" class="form-control" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nhima No</label>
                                                    <input name="nhima_no" type="text" class="form-control" placeholder="Enter Nhima"/>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Napsa No</label>
                                                    <input name="napsa_no" type="text" class="form-control" placeholder="Enter Napsa" />
                                                </div>
                                                {{-- <div class="mb-3">
                                                    <label class="form-label">Documents</label>
                                                    <input name="file" type="file" class="form-control" accept=".pdf,.doc,.docx" />
                                                </div> --}}

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bank Details Card -->
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Bank Details</h5><br>
                                                <div class="mb-3">
                                                    <label class="form-label">Account Holder Name</label>
                                                    <input name="account_name" type="text" class="form-control" placeholder="Enter Account Holder Name" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Account Number</label>
                                                    <input name="account_number" type="text" class="form-control" placeholder="Enter Account Number" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Bank Name</label>
                                                    <input name="bank_name" type="text" class="form-control" placeholder="Enter Bank Name" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Bank Code</label>
                                                    <input name="bank_code" type="text" class="form-control" placeholder="Enter Bank Code" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Branch Location</label>
                                                    <input name="branch_location" type="text" class="form-control" placeholder="Enter Branch Location" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Mobile Money Number</label>
                                                    <input name="mm_number" type="text" class="form-control" placeholder="Enter MM Number" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Mobile Money Name</label>
                                                    <input name="mm_name" type="text" class="form-control" placeholder="Enter MM Name" />
                                                </div>

                                                {{-- <div class="mb-3">
                                                    <label class="form-label">Profile Image (Optional)</label>
                                                    <input name="image" type="file" class="form-control" accept="image/*" />
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>

                                                                        <!-- Personal Information Card -->
                                                                        <div class="col-lg-4">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title">Personal Information</h5><br>
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Email</label>
                                                                                        <input name="email" type="email" class="form-control" placeholder="Enter Email" required />
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Address</label>
                                                                                        <input name="address" type="text" class="form-control" placeholder="Enter Address" />
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Phone</label>
                                                                                        <input name="phone" type="text" class="form-control" placeholder="Enter Phone Number" />
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">NRC No</label>
                                                                                        <input name="nrc" type="text" class="form-control" placeholder="Enter NRC" required />
                                                                                    </div>
                                                                                    <input name="password_confirmation" type="hidden" value="password" />
                                                                                    <input name="password" type="hidden" value="password" />
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Birthday</label>
                                                                                        <input name="birthday" type="date" class="form-control" />
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Gender</label>
                                                                                        <select name="gender" class="form-select">
                                                                                            <option value="" disabled selected>Select Gender</option>
                                                                                            <option value="Male">Male</option>
                                                                                            <option value="Female">Female</option>
                                                                                            <option value="other">Other</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                </div>

                                {{-- <div class="row mt-3">


                                    <!-- Document Uploads Card -->
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Document Uploads</h5><br>
                                                <div class="mb-3">
                                                    <label class="form-label">Documents</label>
                                                    <input name="file" type="file" class="form-control" accept=".pdf,.doc,.docx" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Profile Image (Optional)</label>
                                                    <input name="image" type="file" class="form-control" accept="image/*" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Save and Cancel Buttons -->

                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save Employee</button>
                                    <button type="reset" class="btn btn-secondary waves-effect ms-1">Cancel</button>

                            </form>

                            <!-- End Form -->
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
    {{-- @include('includes.image_js') --}}

</body>

</html>
