<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Categories</title>
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
    <!-- Loader -->

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
                                            href="/categories"><i class="dripicons-arrow-thin-left"></i></a></h4><br>


                                    <form class="row needs-validation" action="{{ route('categories.store') }}"
                                        novalidate method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Child Category Name</label>
                                            <div>
                                                <input name="name" id="category-name" type="text"
                                                    class="form-control" placeholder="Enter Category Name" required />
                                                <small id="name-taken" class="text-danger" style="display: none;">This
                                                    category name is already taken.</small>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Category Parent</label>
                                            <select name="type" class="form-select">
                                                <option value="" disabled selected>Select Category Parent</option>
                                                <option value="Task">Task</option>
                                                <option value="News">News</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>

                                        <div class="mb-0">
                                            <div>
                                                <button type="submit" id="submit-btn"
                                                    class="btn btn-info waves-effect waves-light">
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



    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <script src="/assets/libs/parsleyjs/parsley.min.js"></script>

    <script src="/assets/js/pages/form-validation.init.js"></script>

    <script src="/assets/js/app.js"></script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryNameInput = document.getElementById('category-name');
            const nameTakenWarning = document.getElementById('name-taken');
            const submitButton = document.getElementById('submit-btn');

            categoryNameInput.addEventListener('input', function() {
                const categoryName = categoryNameInput.value;

                if (categoryName.length > 0) {
                    // Make AJAX request to check if the name exists
                    fetch(`/check-category-name?name=${categoryName}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.exists) {
                                nameTakenWarning.style.display = 'block';
                                submitButton.disabled = true; // Disable submit button
                            } else {
                                nameTakenWarning.style.display = 'none';
                                submitButton.disabled = false; // Enable submit button
                            }
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    nameTakenWarning.style.display = 'none';
                    submitButton.disabled = true; // Disable submit button when input is empty
                }
            });
        });
    </script> --}}
</body>

</html>
