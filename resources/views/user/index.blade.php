<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Users</title>
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

    <!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editUserName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editUserName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editUserEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUserCountry" class="form-label">Country</label>
                        <input type="text" class="form-control" id="editUserCountry" name="country_id">
                    </div>
                    <div class="mb-3">
                        <label for="editUserCity" class="form-label">City</label>
                        <input type="text" class="form-control" id="editUserCity" name="city">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editUserModal = document.getElementById('editUserModal');

        // Listen for when the modal is about to be shown
        editUserModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const userSlug = button.getAttribute('data-user-slug');
            const userName = button.getAttribute('data-user-name');
            const userEmail = button.getAttribute('data-user-email');
            const userCountry = button.getAttribute('data-user-country');
            const userCity = button.getAttribute('data-user-city');

            // Update the form's action URL
            const form = document.getElementById('editUserForm');
            form.action = `/user/${userSlug}/update-pricing-plan`;

            // Populate modal input fields with user data
            document.getElementById('editUserName').value = userName;
            document.getElementById('editUserEmail').value = userEmail;
            document.getElementById('editUserCountry').value = userCountry;
            document.getElementById('editUserCity').value = userCity;
        });
    });
</script>
    <!-- Edit Pricing Plan Modal -->
    <div class="modal fade" id="editPricingModal" tabindex="-1" aria-labelledby="editPricingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editPricingForm" method="POST" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-user-name" class="form-label">Name</label>
                            <input type="text" id="edit-user-name" class="form-control" disabled />
                        </div>
                        <div class="mb-3">
                            <label for="pricing-id" class="form-label">Pricing Plan</label>
                            <select name="pricing_id" id="pricing-id" class="form-select">
                                @foreach ($pricingPlans as $pricingPlan)
                                    <option value="{{ $pricingPlan->id }}">{{ $pricingPlan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editPricingModal = document.getElementById('editPricingModal');

            // When modal is shown, update the form action
            editPricingModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const userSlug = button.getAttribute('data-user-slug'); // Retrieve the slug
                const userName = button.getAttribute('data-user-name');
                const userPricingId = button.getAttribute('data-user-pricing-id');

                // Populate modal fields
                document.getElementById('edit-user-name').value = userName;
                document.getElementById('pricing-id').value = userPricingId;

                // Set the form action with the slug
                const form = document.getElementById('editPricingForm');
                form.action =
                `/user/${userSlug}/update-pricing-plan`; // Dynamically set the route with slug
            });
        });
    </script>

    <!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" method="POST" action="{{ route('user.update', ['user' => 'slug']) }}">

                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editUserName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editUserName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editUserEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUserCountry" class="form-label">Country</label>
                        <input type="text" class="form-control" id="editUserCountry" name="country_id">
                    </div>
                    <div class="mb-3">
                        <label for="editUserCity" class="form-label">City</label>
                        <input type="text" class="form-control" id="editUserCity" name="city">
                    </div>
                    <div class="mb-3">
                        <label for="editUserPricingPlan" class="form-label">Pricing Plan</label>
                        <select class="form-control" id="editUserPricingPlan" name="pricing_id" required>
                            @foreach($pricingPlans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->name }} - {{ formatCurrency($plan->price) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editUserModal = document.getElementById('editUserModal');

        // Listen for when the modal is about to be shown
        editUserModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const userSlug = button.getAttribute('data-user-slug');
            const userName = button.getAttribute('data-user-name');
            const userEmail = button.getAttribute('data-user-email');
            const userCountry = button.getAttribute('data-user-country');
            const userCity = button.getAttribute('data-user-city');
            const userPricingId = button.getAttribute('data-user-pricing-id');

            // Update the form's action URL
            const form = document.getElementById('editUserForm');
            form.action = `/users/${userSlug}`;

            // Populate modal input fields with user data
            document.getElementById('editUserName').value = userName;
            document.getElementById('editUserEmail').value = userEmail;
            document.getElementById('editUserCountry').value = userCountry;
            document.getElementById('editUserCity').value = userCity;
            document.getElementById('editUserPricingPlan').value = userPricingId;
        });
    });
</script>



    {{-- <!-- Update Pricing Plan Modal -->
<div class="modal fade" id="updatePricingPlanModal" tabindex="-1" aria-labelledby="updatePricingPlanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('user.update', $user->slug) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePricingPlanModalLabel">Update Pricing Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="modal-user-id">
                    <div class="mb-3">
                        <label for="modal-pricing-plan-id" class="form-label">Pricing Plan</label>
                        <select name="pricing_id" id="modal-pricing-plan-id" class="form-select" required>
                            <option value="" selected>Select Plan</option>
                            @foreach ($pricingPlans as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                        @endforeach

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div> --}}


    <form method="POST" action="" id="updatePricingPlanForm">
        @csrf
        @method('PUT')
        <input type="hidden" name="pricing_id" id="modal-pricing-plan-id">
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updatePricingPlanModal = document.getElementById('updatePricingPlanModal');

            updatePricingPlanModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const userId = button.getAttribute('data-user-id');
                const pricingPlanId = button.getAttribute('data-pricing-plan-id');

                // Set the form action dynamically
                const form = document.getElementById('updatePricingPlanForm');
                form.action = `/users/${userId}/update-pricing-plan`;

                // Populate the modal dropdown
                const modalPricingPlanField = document.getElementById('modal-pricing-plan-id');
                modalPricingPlanField.value = pricingPlanId;
            });
        });
    </script>


    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="viewUserName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="viewUserName" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="viewUserEmail" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewUserCountry" class="form-label">Country</label>
                        <input type="text" class="form-control" id="viewUserCountry" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewUserCity" class="form-label">City</label>
                        <input type="text" class="form-control" id="viewUserCity" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewUserRoles" class="form-label">Roles</label>
                        <input type="text" class="form-control" id="viewUserRoles" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewUserStatus" class="form-label">Status</label>
                        <input type="text" class="form-control" id="viewUserStatus" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="userName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="userName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="userEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="userCountry" class="form-label">Country</label>
                            <input type="text" class="form-control" id="userCountry" name="country_id">
                        </div>
                        <div class="mb-3">
                            <label for="userCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="userCity" name="city">
                        </div>
                        <div class="mb-3">
                            <label for="userRoles" class="form-label">Roles</label>
                            <select class="form-select" id="userRoles" name="roles[]" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="userImage" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="userImage" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="userStatus" class="form-label">Status</label>
                            <select class="form-select" id="userStatus" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="statusForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Change User Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to <span id="statusAction"></span> the status of <strong
                                id="userName"></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes, <span
                                id="statusActionConfirm"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



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
                    {{-- <div class="row"> --}}

                        <!-- Copy and Paste this section for more items -->
                        {{-- <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/user/create" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="dripicons-plus" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Add User</h6>
                                        <p class="mb-0 text-muted">This is the Settings section for user</p>
                                    </div>
                                </div>
                            </a>
                        </div> --}}
                        <!-- Repeatable Icon Section -->
                        {{-- <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/windows/due_subscriptions" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px; cursor: pointer;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-funnel" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Due Mobile Transfers Users</h6>
                                        <p class="mb-0 text-muted">Navigate Due Subscribers Users</p>
                                    </div>
                                </div>
                            </a>
                        </div> --}}




                        <!-- Add more items as needed -->
                        {{-- <div class="col-lg-4 col-md-6 mb-4">
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
                        </div> --}}







{{--
                    </div> --}}


                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card text-center">
                                <div class="mb-2 card-body text-muted">
                                    <h3 style="font-size: 17px" class="text-info mt-2">{{ $myuser->count() }}</h3>
                                    <span style="font-size: 12px">Total Users</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card text-center">
                                <div class="mb-2 card-body text-muted">
                                    <h3 style="font-size: 17px" class="text-info mt-2">
                                        @if ($totalPrice > 1000)
                                            {{ number_format($totalPrice / 1000, 2) }}K
                                        @else
                                            {{ $totalPrice }}
                                        @endif
                                    </h3>

                                    <span style="font-size: 12px">Total Monthly Revenue</span>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card text-center">
                                <div class="mb-2 card-body text-muted">
                                    <h3 style="font-size: 17px" class="text-info mt-2">
                                        {{ $todayUserCount }}
                                    </h3>
                                    <span style="font-size: 12px">Today's Registered Users</span>


                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card text-center">
                                <div class="mb-2 card-body text-muted">
                                    <h3 style="font-size: 17px" class="text-info mt-2">
                                        <h3 style="font-size: 17px" class="text-info mt-2">
                                            {{ $freePlans->count() }}
                                        </h3>
                                    </h3>
                                    <span style="font-size: 12px">5 Days Free trial User's</span>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div>
                                        <div>
                                            <!-- Search input field -->
                                            <div class="mb-3">
                                                <input type="text" id="search-input" class="form-control"
                                                    placeholder="Search by Name, Country, or Role" />
                                            </div>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Names</th>
                                                        {{-- <th data-priority="1">Country/City</th> --}}
                                                        <th data-priority="1">Package Plan</th>
                                                        <th data-priority="1">Roles</th>
                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-body">
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td>
                                                                {{ $user->name }}<br>
                                                                <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                    Email: {{ $user->email }}
                                                                </span>
                                                            </td>
                                                            {{-- <td>
                                                                {{ $user->country_id ?? 'No Country' }}<br>
                                                                <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                    City: {{ $user->city }}
                                                                </span>
                                                            </td> --}}
                                                            <td>
                                                                <b style="font-size: 12px">
                                                                    {{ $user->pricingPlan->name ?? 'N/A' }}
                                                                </b><br>
                                                                <span style="font-size: 9px; color: rgb(112, 112, 112);">
                                                                    Price: {{ optional($user->pricingPlan)->currency ?? 'none' }} {{ optional($user->pricingPlan)->price ?? 'N/A' }} |
                                                                    @php
                                                                        if ($user->pricingPlan) {
                                                                            $createdAt = \Carbon\Carbon::parse($user->pricingPlan->created_at);
                                                                            $dueDate = $user->pricingPlan->price == 0
                                                                                ? $createdAt->clone()->addWeek()  // Add one week for free plans
                                                                                : $createdAt->clone()->addMonth(); // Add one month for paid plans
                                                                        } else {
                                                                            $dueDate = null; // No plan assigned
                                                                        }
                                                                    @endphp

                                                                    @if ($dueDate)
                                                                        <span style="font-size: 9px; color: {{ $dueDate->isToday() ? 'red' : 'rgb(112, 112, 112)' }};">
                                                                            Due On: {{ $dueDate->format('F j, Y') }}
                                                                        </span>
                                                                    @else
                                                                        <span style="font-size: 9px; color: red;">No Plan Assigned</span>
                                                                    @endif
                                                                </span>
                                                            </td>



                                                            <td>
                                                                @if (!empty($user->getRoleNames()))
                                                                    @foreach ($user->getRoleNames() as $rolename)
                                                                        <a class="btn btn-info btn-sm waves-effect">{{ $rolename }}</a>
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                            <td>

                                                                <a class="btn btn-info waves-effect waves-light" id="sa-warning" href="{{ route('user.edit',$user->slug) }}"><i class="dripicons-document-edit"></i></a>

<!-- Trigger Button -->

    {{-- <button type="button"
            class="btn btn-primary waves-effect"
            data-bs-toggle="modal"
            data-bs-target="#editUserModal"
            data-user-slug="{{ $user->slug }}"
            data-user-name="{{ $user->name }}"
            data-user-email="{{ $user->email }}"
            data-user-country="{{ $user->country_id }}"
            data-user-city="{{ $user->city }}">
        Edit User
    </button> --}}
                                                   {{-- <button type="button"
                                                                    class="btn btn-primary waves-effect"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editUserModal"
                                                                    data-user-slug="{{ $user->slug }}"
                                                                    data-user-name="{{ $user->name }}"
                                                                    data-user-email="{{ $user->email }}"
                                                                    data-user-country="{{ $user->country_id }}"
                                                                    data-user-city="{{ $user->city }}"
                                                                    data-user-pricing-id="{{ $user->pricing_id }}">
                                                                    Edit User
                                                                </button> --}}

                                                                <button type="button"
                                                                    class="btn btn-primary waves-effect"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editPricingModal"
                                                                    data-user-slug="{{ $user->slug }}"
                                                                    data-user-name="{{ $user->name }}"
                                                                    data-user-pricing-id="{{ $user->pricing_id }}">
                                                                    Upgrade Account Plan
                                                                </button>

                                                                <button type="button"
                                                                    class="btn btn-{{ $user->active ? 'danger' : 'success' }} waves-effect waves-light"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#statusModal"
                                                                    data-user-name="{{ $user->name }}"
                                                                    data-user-slug="{{ $user->slug }}"
                                                                    data-active="{{ $user->active }}">
                                                                    <i class="dripicons-{{ $user->active ? 'ban' : 'checkmark' }}"></i>
                                                                    {{ $user->active ? 'Deactivate' : 'Activate' }}
                                                                </button>

                                                                <button type="button"
                                                                    class="btn btn-danger waves-effect"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal"
                                                                    data-route="{{ route('user.destroy', $user->slug) }}">
                                                                    <i class="dripicons-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>


                                                <script>
                                                    document.addEventListener('DOMContentLoaded', () => {
                                                        const editModal = document.getElementById('editModal');
                                                        editModal.addEventListener('show.bs.modal', function(event) {
                                                            const button = event.relatedTarget; // Button that triggered the modal
                                                            const userName = button.getAttribute('data-user-name');
                                                            const userEmail = button.getAttribute('data-user-email');
                                                            const userCountry = button.getAttribute('data-user-country');
                                                            const userCity = button.getAttribute('data-user-city');
                                                            const userSlug = button.getAttribute('data-user-slug');
                                                            const userRoles = button.getAttribute('data-user-roles'); // For roles
                                                            const userStatus = button.getAttribute('data-user-status'); // For status

                                                            // Update modal form fields
                                                            this.querySelector('#userName').value = userName;
                                                            this.querySelector('#userEmail').value = userEmail;
                                                            this.querySelector('#userCountry').value = userCountry;
                                                            this.querySelector('#userCity').value = userCity;
                                                            this.querySelector('#userStatus').value = userStatus; // Set status

                                                            // Update roles in multi-select
                                                            const rolesSelect = this.querySelector('#userRoles');
                                                            Array.from(rolesSelect.options).forEach(option => {
                                                                option.selected = userRoles.includes(option.value);
                                                            });

                                                            // Update form action
                                                            this.querySelector('#editForm').action = `/user/${userSlug}`;
                                                        });
                                                    });
                                                </script>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', () => {
                                                        const viewModal = document.getElementById('viewModal');
                                                        viewModal.addEventListener('show.bs.modal', function(event) {
                                                            const button = event.relatedTarget; // Button that triggered the modal
                                                            const userName = button.getAttribute('data-user-name');
                                                            const userEmail = button.getAttribute('data-user-email');
                                                            const userCountry = button.getAttribute('data-user-country');
                                                            const userCity = button.getAttribute('data-user-city');
                                                            const userRoles = button.getAttribute('data-user-roles');
                                                            const userStatus = button.getAttribute('data-user-status');

                                                            // Update modal form fields
                                                            this.querySelector('#viewUserName').value = userName;
                                                            this.querySelector('#viewUserEmail').value = userEmail;
                                                            this.querySelector('#viewUserCountry').value = userCountry;
                                                            this.querySelector('#viewUserCity').value = userCity;
                                                            this.querySelector('#viewUserRoles').value = userRoles;
                                                            this.querySelector('#viewUserStatus').value = userStatus;
                                                        });
                                                    });
                                                </script>

                                        </div>
                                    </div>




                                    <!-- Pagination Controls -->
                                    <div id="pagination" class="text-left" style="margin-top: 20px;"></div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            const rowsPerPage = 5; // Number of rows per page
                                            const searchInput = document.getElementById("search-input"); // Search input field
                                            const tableBody = document.getElementById("table-body");
                                            const pagination = document.getElementById("pagination");

                                            const rows = Array.from(tableBody.getElementsByTagName("tr"));
                                            let filteredRows = rows;
                                            const totalRows = filteredRows.length;
                                            const totalPages = Math.ceil(totalRows / rowsPerPage);

                                            // Function to render the table rows for the selected page
                                            function renderTable(page) {
                                                tableBody.innerHTML = ""; // Clear the table body
                                                const start = (page - 1) * rowsPerPage;
                                                const end = start + rowsPerPage;

                                                // Append the relevant rows for the page
                                                filteredRows.slice(start, end).forEach(row => tableBody.appendChild(row));
                                            }

                                            // Function to render pagination controls
                                            function renderPagination() {
                                                pagination.innerHTML = ""; // Clear the pagination container

                                                const totalFilteredPages = Math.ceil(filteredRows.length / rowsPerPage);

                                                for (let i = 1; i <= totalFilteredPages; i++) {
                                                    const button = document.createElement("button");
                                                    button.textContent = i;
                                                    button.className = "btn btn-sm btn-info mx-1";
                                                    button.addEventListener("click", () => {
                                                        renderTable(i); // Render the selected page
                                                        setActiveButton(i); // Set the active page button
                                                    });

                                                    if (i === 1) button.classList.add("active");
                                                    pagination.appendChild(button);
                                                }
                                            }

                                            // Function to set the active page button
                                            function setActiveButton(page) {
                                                Array.from(pagination.getElementsByTagName("button")).forEach(btn => {
                                                    btn.classList.remove("active");
                                                });
                                                pagination.getElementsByTagName("button")[page - 1].classList.add("active");
                                            }

                                            // Real-time search function
                                            function filterTable() {
                                                const query = searchInput.value.toLowerCase();
                                                filteredRows = rows.filter(row => {
                                                    const name = row.querySelector("td:nth-child(1)").textContent.toLowerCase();
                                                    const country = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                                                    const roles = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
                                                    return name.includes(query) || country.includes(query) || roles.includes(query);
                                                });

                                                // Re-render the table with filtered rows and update pagination
                                                renderTable(1);
                                                renderPagination();
                                            }

                                            // Event listener for the search input field
                                            searchInput.addEventListener("input", filterTable);

                                            // Initialize the table and pagination controls
                                            renderTable(1); // Render the first page
                                            renderPagination(); // Generate pagination buttons
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



    <script>
        // Handle status modal population (Activate/Deactivate user)
        const statusModal = document.getElementById('statusModal');
        statusModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const userName = button.getAttribute('data-user-name');
            const userSlug = button.getAttribute('data-user-slug');
            const isActive = button.getAttribute('data-active') == '1'; // Checking if active is true (1)

            // Determine action text for status change
            const actionText = isActive ? 'deactivate' : 'activate';

            // Set modal content dynamically
            document.getElementById('userName').textContent = userName;
            document.getElementById('statusAction').textContent = actionText;
            document.getElementById('statusActionConfirm').textContent = actionText;

            // Update the form's action URL with the user slug
            const form = document.getElementById('statusForm');
            form.action = `/user/${userSlug}/status`; // Form action URL for updating status
        });

        // Handle delete modal population
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const route = button.getAttribute('data-route'); // Route to delete the user

            // Set the delete form's action URL dynamically
            const form = document.getElementById('deleteForm');
            form.action = route; // Use the provided route for deletion
        });
    </script>
    @include('toast.error_success_js')



    <script src="/assets/js/app.js"></script>

</body>

</html>
