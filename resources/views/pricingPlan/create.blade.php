<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pricing Plans</title>
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

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a class="btn btn-info waves-effect waves-light" href="/pricingPlan">
                                        <i class="dripicons-arrow-thin-left"></i>
                                    </a>
                                </h4>
                                <br>

                                <div class="container">
                                    <h2>Create Pricing Plan</h2>
                                    <form action="{{ route('pricingPlan.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <!-- Left Column -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Plan Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Plan Name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="button_name" class="form-label">Button Name</label>
                                                    <input type="text" class="form-control" id="button_name" name="button_name" placeholder="Button Name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="button_link" class="form-label">Button Link</label>
                                                    <input type="text" class="form-control" id="button_link" name="button_link" placeholder="Button Link" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price" class="form-label">Price</label>
                                                    <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
                                                </div>
                                                <div class="mb-3 position-relative">
                                                    <label for="currency" class="form-label">Currency</label>
                                                    <select name="currency" id="currency" class="form-select" required>
                                                        <option value="USD">USD - United States Dollar</option>
                                                        <option value="ZMW">ZMW - Zambian Kwacha</option>
                                                        <option value="EUR">EUR - Euro</option>
                                                        <option value="GBP">GBP - British Pound Sterling</option>
                                                        <option value="KES">KES - Kenyan Shilling</option>
                                                        <option value="NGN">NGN - Nigerian Naira</option>
                                                        <option value="ZAR">ZAR - South African Rand</option>
                                                        <option value="JPY">JPY - Japanese Yen</option>
                                                        <option value="CAD">CAD - Canadian Dollar</option>
                                                        <option value="AUD">AUD - Australian Dollar</option>
                                                        <option value="CNY">CNY - Chinese Yuan</option>
                                                        <option value="INR">INR - Indian Rupee</option>
                                                        <option value="CHF">CHF - Swiss Franc</option>
                                                        <option value="SEK">SEK - Swedish Krona</option>
                                                        <option value="NZD">NZD - New Zealand Dollar</option>
                                                        <option value="SGD">SGD - Singapore Dollar</option>
                                                        <option value="HKD">HKD - Hong Kong Dollar</option>
                                                        <option value="MXN">MXN - Mexican Peso</option>
                                                        <option value="BRL">BRL - Brazilian Real</option>
                                                        <option value="PHP">PHP - Philippine Peso</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Right Column -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="billing_cycle" class="form-label">Billing Cycle</label>
                                                    <select class="form-select" id="billing_cycle" name="billing_cycle" required>
                                                        <option value="One Day">Free Trial</option>
                                                        <option value="Monthly">Monthly</option>
                                                        <option value="Yearly">Yearly</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="features" class="form-label">Features</label>
                                                    <div id="feature-list">
                                                        <input type="text" class="form-control mb-2" name="features[]" placeholder="Feature 1" required>
                                                    </div>
                                                    <button type="button" id="add-feature" class="btn btn-secondary mt-2">Add Feature</button>
                                                </div>

                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary mt-4">Create Plan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <script>
                                    document.getElementById('add-feature').addEventListener('click', function () {
                                        const featureList = document.getElementById('feature-list');
                                        const input = document.createElement('input');
                                        input.type = 'text';
                                        input.name = 'features[]';
                                        input.className = 'form-control mb-2';
                                        input.placeholder = `Feature ${featureList.children.length + 1}`;
                                        input.required = true;
                                        featureList.appendChild(input);
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

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
