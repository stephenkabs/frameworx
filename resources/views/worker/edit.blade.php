<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit - worker</title>
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
    <!-- Loader -->


    {{-- @include('toast.success_toast') --}}

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <h4 class="card-title"><a class="btn btn-sm btn-info waves-effect waves-light"
                        href="/worker"><i
                            class="dripicons-arrow-thin-left"></i></a>
                </h4>

                    {{-- <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a class="btn btn-info waves-effect waves-light" href="/member">
                                    <i class="dripicons-arrow-thin-left"></i>
                                </a>
                            </h4><br> --}}

                            <!-- Start Form -->
                            <form class="needs-validation" action="{{ route('worker.update', $worker->slug) }}" novalidate method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- For updating resources -->
                                <div class="row">
                                    <!-- worker Information Card -->
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Employee Information</h5><br>
                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input name="name" type="text" class="form-control" placeholder="Enter Name" value="{{ old('name', $worker->name) }}" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Department</label>
                                                    <select name="department_id" class="form-select" required>
                                                        <option value="" disabled>Select a Department</option>
                                                        @foreach ($departments as $item)
                                                            <option value="{{ $item->id }}" {{ $worker->department_id == $item->id ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Branch</label>
                                                    <select name="branch_id" class="form-select" required>
                                                        <option value="" disabled>Select a Branch</option>
                                                        @foreach ($branches as $item)
                                                            <option value="{{ $item->id }}" {{ $worker->branch_id == $item->id ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Designation</label>
                                                    <input name="designation" type="text" class="form-control" placeholder="Enter Designation" value="{{ old('designation', $worker->designation) }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Join Date</label>
                                                    <input name="join_date" type="date" class="form-control" value="{{ old('join_date', $worker->join_date) }}" />
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Nhima No</label>
                                                    <input name="nhima_no" type="text" class="form-control" value="{{ old('nhima_no', $worker->nhima_no) }}"/>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Napsa No</label>
                                                    <input name="napsa_no" type="text" class="form-control" value="{{ old('napsa_no', $worker->napsa_no) }}"/>
                                                </div>

                                                {{-- <div class="mb-3">
                                                    <label class="form-label">Documents</label>
                                                    <input name="file" type="file" class="form-control" accept=".pdf,.doc,.docx" />
                                                    <small>Existing File: {{ $worker->file }}</small>
                                                </div> --}}

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bank Details Card -->
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Bank Details & Profile</h5><br>
                                                <div class="mb-3">
                                                    <label class="form-label">Account Holder Name</label>
                                                    <input name="account_name" type="text" class="form-control" placeholder="Enter Account Holder Name" value="{{ old('account_name', $worker->account_name) }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Account Number</label>
                                                    <input name="account_number" type="text" class="form-control" placeholder="Enter Account Number" value="{{ old('account_number', $worker->account_number) }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Bank Name</label>
                                                    <input name="bank_name" type="text" class="form-control" placeholder="Enter Bank Name" value="{{ old('bank_name', $worker->bank_name) }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Bank Code</label>
                                                    <input name="bank_code" type="text" class="form-control" placeholder="Enter Bank Code" value="{{ old('bank_code', $worker->bank_code) }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Branch Location</label>
                                                    <input name="branch_location" type="text" class="form-control" placeholder="Enter Branch Location" value="{{ old('branch_location', $worker->branch_location) }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Mobile Money Number</label>
                                                    <input name="mm_number" type="text" class="form-control" value="{{ old('mm_number', $worker->mm_number) }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Mobile Money Name</label>
                                                    <input name="mm_name" type="text" class="form-control" value="{{ old('mm_name', $worker->mm_name) }}" />
                                                </div>
                                                {{-- <div class="mb-3">
                                                    <label class="form-label">Profile Image (Optional)</label>
                                                    <input name="image" type="file" class="form-control" accept="image/*" /><br>
                                                    <small><img src="{{ asset('employee_profile/'.$worker->image) }}" alt="Profile Image" height="100"></small>
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
                                                                                    <input name="email" type="email" class="form-control" placeholder="Enter Email" value="{{ old('email', $worker->email) }}" required />
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Birthday</label>
                                                                                    <input name="birthday" type="date" class="form-control" value="{{ old('birthday', $worker->birthday) }}" />
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Address</label>
                                                                                    <input name="address" type="text" class="form-control" placeholder="Enter Address" value="{{ old('address', $worker->address) }}" />
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Phone</label>
                                                                                    <input name="phone" type="text" class="form-control" placeholder="Enter Phone Number" value="{{ old('phone', $worker->phone) }}" />
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label class="form-label">NRC No</label>
                                                                                    <input name="nrc" type="text" class="form-control" placeholder="Enter NRC" value="{{ old('nrc', $worker->nrc) }}" required />
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Gender</label>
                                                                                    <select name="gender" class="form-select">
                                                                                        <option value="" disabled>Select Gender</option>
                                                                                        <option value="male" {{ $worker->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                                                        <option value="female" {{ $worker->gender == 'female' ? 'selected' : '' }}>Female</option>
                                                                                        <option value="other" {{ $worker->gender == 'other' ? 'selected' : '' }}>Other</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                </div>

                                <!-- Save and Cancel Buttons -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                    <a href="{{ route('worker.index') }}" class="btn btn-secondary waves-effect ms-1">Cancel</a>
                                </div>
                            </form>


                            <!-- End Form -->
                        </div>
                    </div>

                    <!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


        </div>
        <!-- end main content-->
        @include('includes.footer')
    </div>
    <!-- END layout-wrapper -->


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
