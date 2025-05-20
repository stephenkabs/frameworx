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

    <!-- Responsive Table css -->
    <link href="/assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

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
    @include('toast.success_toast')
    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
{{-- @role('super_admin') --}}
                    <div class="row">

                        <!-- Copy and Paste this section for more items -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/pricingPlan/create" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="dripicons-plus" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Add Plan</h6>
                                        <p class="mb-0 text-muted">Add New Plan and Features</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Repeatable Icon Section -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/windows/due_subscriptions" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px; cursor: pointer;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-funnel" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Free Trial Users</h6>
                                        <p class="mb-0 text-muted">Navigate Due Subscribers Users</p>
                                    </div>
                                </div>
                            </a>
                        </div>




                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/windows/bank_payments" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-business" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Due User Paid on Stripe</h6>
                                        <p class="mb-0 text-muted">Manage Subscribers paid via Stripe</p>
                                    </div>
                                </div>
                            </a>
                        </div>








                    </div>
                    {{-- @endrole --}}

                    <div  class="row">

                        <div class="container py-5" >

                            <div class="row text-center">

                                @foreach ($plans as $plan)
                                <div class="col-md-4 mb-4">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-primary text-white py-3">
                                            <h5>{{ $plan->name }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title">{{ $plan->currency }} {{ number_format($plan->price, 2) }}<small>/ {{ $plan->billing_cycle }}</small></h3>
                                            <ul class="list-unstyled mt-4">
                                                @foreach ($plan->features as $feature)
                                                <li>{{ $feature->feature }}</li>
                                                @endforeach
                                            </ul>
                                            <a href="{{ $plan->button_link }}"class="btn btn-primary mt-3">{{ $plan->button_name }}</a>
                                            <a href="{{ route('pricingPlan.edit', $plan->id) }}" class="btn btn-primary mt-3">Edit</a>
                                            {{-- @role('super_admin') --}}
                                            <a class="btn btn-primary mt-3">Delete</a>
                                            {{-- @endrole --}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- Marketing Plan -->

                            </div>
                        </div>

                    </div>
                </div>

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



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <!-- Responsive Table js -->
    <script src="/assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

    <!-- Init js -->
    <script src="/assets/js/pages/table-responsive.init.js"></script>

    <script src="/assets/js/app.js"></script>

    @if (Session::has('message'))
        <script>
            swal("Hi!, {{ $profileData->first_name }}", "{{ Session::get('message') }}", 'success', {
                button: true,
                button: "Close",
            });
        </script>
    @endif

    <script>
        // Event listener for delete button click
        $('#deleteMinistryModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var route = button.data('route'); // Extract route from data-* attribute
            var modal = $(this);

            // Update the form action with the correct route
            modal.find('#deleteMinistryForm').attr('action', route);
        });
    </script>

    @include('toast.error_success_js')


</body>

</html>
