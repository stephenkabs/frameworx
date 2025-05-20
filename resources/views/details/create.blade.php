<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Invoice - Details</title>
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
    @include('toast.success_toast')
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

                                <h4 class="card-title"><a class="btn btn-info btn-sm waves-effect waves-light" href="/details"><i class="dripicons-arrow-thin-left"></i></a></h4><br>


                                <form class="row needs-validation" action="{{ route('details.store') }}" novalidate method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Company Name</label>
                                        <div>
                                            <input name="name" type="text" class="form-control" placeholder="Enter Company Name" required />
                                        </div>
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationCustom01">Logo</label>
                                        <input type="file" name="image" class="form-control" id="validationCustom01" placeholder="Upload Logo" required />
                                        <div class="valid-tooltip">Looks good!</div>
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Company Primary Color</label>
                                        <div>
                                            <input name="primary_color" type="color" class="form-control"  required />
                                        </div>
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Company Secondary Color</label>
                                        <div>
                                            <input name="secondary_color" type="color" class="form-control"  required />
                                        </div>
                                    </div>


                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Address</label>
                                        <div>
                                            <input name="address" type="text" class="form-control" placeholder="Enter Address" required />
                                        </div>
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Email</label>
                                        <div>
                                            <input name="email" type="email" class="form-control" placeholder="Enter Email" required />
                                        </div>
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Phone</label>
                                        <div>
                                            <input name="phone" type="text" class="form-control" placeholder="Enter Phone Number" required />
                                        </div>
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Website</label>
                                        <div>
                                            <input name="website" type="text" class="form-control" placeholder="Enter Website URL" required />
                                        </div>
                                    </div>

                                    <div class="mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                            <button type="reset" class="btn btn-secondary waves-effect ms-1">Cancel</button>
                                        </div>
                                    </div>
                                </form>




                            </div>
                        </div>
                    </div>

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



<!-- JAVASCRIPT -->
<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/libs/node-waves/waves.min.js"></script>

<script src="/assets/libs/parsleyjs/parsley.min.js"></script>

<script src="/assets/js/pages/form-validation.init.js"></script>

<script src="/assets/js/app.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addDutyBtn = document.getElementById('add-duty-btn');
        const dutiesContainer = document.getElementById('duties-container');

        // Add event listener to the 'Add Duty' button
        addDutyBtn.addEventListener('click', function() {
            // Create a new input element for the duty
            const newDutyInput = document.createElement('input');
            newDutyInput.type = 'text';
            newDutyInput.name = 'duties[]'; // Make sure the name is an array to handle multiple inputs
            newDutyInput.classList.add('form-control', 'mb-2');
            newDutyInput.placeholder = 'Enter Duty Name';
            newDutyInput.required = true;

            // Append the new duty input to the container
            dutiesContainer.appendChild(newDutyInput);
        });
    });


</script>
    @include('toast.error_success_js')
</body>

</html>
