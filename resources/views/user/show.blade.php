<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>User Show</title>
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


<body style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%);"  data-sidebar="dark">

    @include('loader.loader')

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
                <div class="row">
                    <div class="col-xl-9 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Profile Header -->
                                <div class="row align-items-center">
                                    <!-- Profile Image -->
                                    <div class="col-md-auto text-center">
                                        <div
                                        style="width: 100px; height: 100px; border: 2px solid #ccc; overflow: hidden; display: flex; align-items: center; justify-content: center; border-radius: 10px;">
                                        <!-- Image -->
                                        <img src="{{ $user->image ? '/users/images/' . $user->image : '/assets/user.webp' }}"
                                             alt="{{ $user->name }}"
                                             style="width: 100%; height: 100%; object-fit: cover; object-position: top;">
                                    </div>


                                    </div>
                                    <!-- User Info -->
                                    <div class="col">
                                        <h4 class="font-size-18 mb-1">{{ $user->name }}</h4>
                                        <p class="text-muted mb-2"><i class="mdi mdi-email-outline text-primary"></i> {{ $user->email }}</p>
                                        {{-- <p class="text-muted"><i class="mdi mdi-map-marker-outline text-primary"></i> {{ $user->address }}</p> --}}
                                    </div>
                                    <!-- Actions -->
                                    <div class="col-md-auto text-md-end mt-3 mt-md-0">
                                        <div class="d-flex flex-wrap gap-2">
                                            <a class="btn btn-outline-secondary" href="/dashboard">
                                                <i class="dripicons-arrow-thin-left"></i> Back
                                            </a>
                                            <a class="btn btn-outline-info" href="{{ route('user.edit', $user->slug) }}">
                                                <i class="dripicons-document-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('user.destroy', $user->slug) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="dripicons-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Divider -->
                                <hr class="my-4">
                                <!-- Additional Info -->
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-3">
                                                <i class="mdi mdi-cellphone-android text-primary font-size-20 me-2"></i>
                                                <strong>Phone:</strong> {{ $user->phone }}
                                            </li>
                                            <li>
                                                <i class="mdi mdi-card-account-details-outline text-primary font-size-20 me-2"></i>
                                                <strong>TPIN:</strong> {{ $user->tpin }}
                                            </li>
                                        </ul>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-3">
                                                <i class="mdi mdi-clock-outline text-primary font-size-20 me-2"></i>
                                                <strong>Member Since:</strong> {{ $user->created_at->format('M d, Y') }}
                                            </li>
                                            <li>
                                                <i class="mdi mdi-briefcase-outline text-primary font-size-20 me-2"></i>
                                                <strong>Roles:</strong> {{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<style>.avatar-xl {
    width: 100px;
    height: 100px;
    border: 3px solid #d1e9ff;
    overflow: hidden;
}

.avatar-xl img {
    width: 100%;
    height: auto;
}

.card-body {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    border-radius: 0.75rem;
}

.btn-outline-info {
    border-color: #0dcaf0;
    color: #0dcaf0;
}

.btn-outline-info:hover {
    background-color: #0dcaf0;
    color: #fff;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    color: #fff;
}
</style>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

@include('includes.taskbar')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title px-3 py-4">
            <a href="javascript:void(0);" class="right-bar-toggle float-end">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Choose Demo</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="/assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                <label class="form-check-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="/assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" data-bsStyle="/assets/css/bootstrap-dark.min.css" data-appStyle="/assets/css/app-dark.min.css" />
                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <div class="mb-2">
                <img src="/assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" data-appStyle="/assets/css/app-rtl.min.css" />
                <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
            </div>

            <h6 class="mt-4">Select Custom Colors</h6>
            <div class="d-flex">

            <ul class="list-unstyled mb-0">
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-default" value="default" onchange="document.documentElement.setAttribute('data-theme-mode', 'default')" checked>
                    <label class="form-check-label" for="theme-default">Default</label>
                </li>
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-orange" value="orange" onchange="document.documentElement.setAttribute('data-theme-mode', 'orange')">
                    <label class="form-check-label" for="theme-orange">Orange</label>
                </li>
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-teal" value="teal" onchange="document.documentElement.setAttribute('data-theme-mode', 'teal')">
                    <label class="form-check-label" for="theme-teal">Teal</label>
                </li>
            </ul>

            <ul class="list-unstyled mb-0 ms-4">
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-purple" value="purple" onchange="document.documentElement.setAttribute('data-theme-mode', 'purple')">
                    <label class="form-check-label" for="theme-purple">Purple</label>
                </li>
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-green" value="green" onchange="document.documentElement.setAttribute('data-theme-mode', 'green')">
                    <label class="form-check-label" for="theme-green">Green</label>
                </li>
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-red" value="red" onchange="document.documentElement.setAttribute('data-theme-mode', 'red')">
                    <label class="form-check-label" for="theme-red">Red</label>
                </li>
            </ul>

            </div>
        </div>

    </div>
    <!-- end slimscroll-menu-->
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

<script src="/assets/js/app.js"></script>

</body>

</html>
