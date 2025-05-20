<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit Pricing Plan</title>
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
                                    <h4 class="card-title">
                                        <a class="btn btn-info waves-effect waves-light" href="/departments">
                                            <i class="dripicons-arrow-thin-left"></i>
                                        </a>
                                    </h4>
                                    <br>

                                    <div class="container">
                                        <h2>Edit Pricing Plan</h2>
                                        <form action="{{ route('pricingPlan.update', $pricingPlan->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="name" class="form-label">Plan Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Plan Name" value="{{ $pricingPlan->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Button Name</label>
                                                <input type="text" class="form-control" id="name" name="button_name" placeholder="Plan Name" value="{{ $pricingPlan->button_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Button Link</label>
                                                <input type="text" class="form-control" id="name" name="button_link" placeholder="Button Link" value="{{ $pricingPlan->button_link }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="number" class="form-control" id="price" name="price" placeholder="Price" step="0.01" value="{{ $pricingPlan->price }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="billing_cycle" class="form-label">Billing Cycle</label>
                                                <select class="form-select" id="billing_cycle" name="billing_cycle" required>
                                                    <option value="One Day" {{ $pricingPlan->billing_cycle == 'One Day' ? 'selected' : '' }}>Free Trial</option>
                                                    <option value="Monthly" {{ $pricingPlan->billing_cycle == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                                    <option value="Yearly" {{ $pricingPlan->billing_cycle == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                                                </select>
                                            </div>

                                            <div class="mb-3 position-relative">
                                                <label for="currency" class="form-label">Currency</label>
                                                <select name="currency" id="currency" class="form-select" required>
                                                    <option value="USD" {{ $pricingPlan->currency == 'USD' ? 'selected' : '' }}>USD - United States Dollar</option>
                                                    <option value="ZMW" {{ $pricingPlan->currency == 'ZMW' ? 'selected' : '' }}>ZMW - Zambian Kwacha</option>
                                                    <option value="EUR" {{ $pricingPlan->currency == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                                                    <option value="GBP" {{ $pricingPlan->currency == 'GBP' ? 'selected' : '' }}>GBP - British Pound Sterling</option>
                                                    <option value="KES" {{ $pricingPlan->currency == 'KES' ? 'selected' : '' }}>KES - Kenyan Shilling</option>
                                                    <option value="NGN" {{ $pricingPlan->currency == 'NGN' ? 'selected' : '' }}>NGN - Nigerian Naira</option>
                                                    <option value="ZAR" {{ $pricingPlan->currency == 'ZAR' ? 'selected' : '' }}>ZAR - South African Rand</option>
                                                    <option value="JPY" {{ $pricingPlan->currency == 'JPY' ? 'selected' : '' }}>JPY - Japanese Yen</option>
                                                    <option value="CAD" {{ $pricingPlan->currency == 'CAD' ? 'selected' : '' }}>CAD - Canadian Dollar</option>
                                                    <option value="AUD" {{ $pricingPlan->currency == 'AUD' ? 'selected' : '' }}>AUD - Australian Dollar</option>
                                                    <option value="CNY" {{ $pricingPlan->currency == 'CNY' ? 'selected' : '' }}>CNY - Chinese Yuan</option>
                                                    <option value="INR" {{ $pricingPlan->currency == 'INR' ? 'selected' : '' }}>INR - Indian Rupee</option>
                                                    <option value="CHF" {{ $pricingPlan->currency == 'CHF' ? 'selected' : '' }}>CHF - Swiss Franc</option>
                                                    <option value="SEK" {{ $pricingPlan->currency == 'SEK' ? 'selected' : '' }}>SEK - Swedish Krona</option>
                                                    <option value="NZD" {{ $pricingPlan->currency == 'NZD' ? 'selected' : '' }}>NZD - New Zealand Dollar</option>
                                                    <option value="SGD" {{ $pricingPlan->currency == 'SGD' ? 'selected' : '' }}>SGD - Singapore Dollar</option>
                                                    <option value="HKD" {{ $pricingPlan->currency == 'HKD' ? 'selected' : '' }}>HKD - Hong Kong Dollar</option>
                                                    <option value="MXN" {{ $pricingPlan->currency == 'MXN' ? 'selected' : '' }}>MXN - Mexican Peso</option>
                                                    <option value="BRL" {{ $pricingPlan->currency == 'BRL' ? 'selected' : '' }}>BRL - Brazilian Real</option>
                                                    <option value="PHP" {{ $pricingPlan->currency == 'PHP' ? 'selected' : '' }}>PHP - Philippine Peso</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="features" class="form-label">Features</label>
                                                <div id="feature-list">
                                                    @foreach($pricingPlan->features as $index => $feature)
                                                        <input type="text" class="form-control mb-2" name="features[]" placeholder="Feature {{ $index + 1 }}" value="{{ $feature->feature }}" required>
                                                    @endforeach
                                                </div>
                                                <button type="button" id="add-feature" class="btn btn-secondary">Add Feature</button>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update Plan</button>
                                        </form>
                                    </div>

                                    <script>
                                        document.getElementById('add-feature').addEventListener('click', function() {
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
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('includes.taskbar')
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
