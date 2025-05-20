<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $profileData->last_name }} - Dashboard</title>
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
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="d-sm-flex align-items-start">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xl me-3">
                                                    <img src="{{ (!empty($profileData->image)) ? url('images/users/'.$profileData->image) : url('images/mock1.jpg') }}" alt="" class="img-fluid rounded-4 d-block">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 mt-3 mt-sm-0">
                                                <div>
                                                    <div>
                                                        <h5 class="font-size-16 mb-1">{{ $profileData->first_name }} {{ $profileData->last_name }}</h5>
                                                        <p class="text-muted font-size-13">Full Stack Developer</p>
                                                    </div>

                                                    <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted">
                                                        <ul class="list-unstyled mb-0">
                                                            <li><i class="mdi mdi-map-marker-outline text-primary font-size-20 me-2"></i>San Francisco, USA</li>
                                                            <li><i class="mdi mdi-cellphone-android text-primary font-size-20 me-2"></i>+1 416 935 52 42</li>
                                                        </ul>
                                                        <ul class="list-unstyled mb-0">
                                                            <li><i class="mdi mdi-factory text-primary font-size-20 me-2"></i>Development</li>
                                                            <li><i class="mdi mdi-email-outline text-primary font-size-20 me-2"></i>{{ $profileData->email }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex align-items-start justify-content-sm-end gap-sm-2 mt-3 mt-sm-0">
                                            <div>
                                                <form action="{{ route('info.destroy',$profileData->id) }}" method="POST">

                                                    <a class="btn btn-info" href="/home"><i class="dripicons-arrow-thin-left"></i></a>
                                                    <a class="btn btn-info" href="{{ route('info.edit',$profileData->id) }}"><i class="dripicons-document-edit"></i></a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-info"><i class="dripicons-preview"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                        <div class="row">

                            <div class="col-md-6 col-xl-3">
                                <div class="card text-center">
                                    <a href="/family"> <div class="mb-2 card-body text-muted">
                                        <i class="dripicons-user-group"></i><br> My Family
                                    </div></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card text-center">
                                    <a href="/gallery"> <div class="mb-2 card-body text-muted">
                                        <i class="dripicons-photo-group"></i><br> My Photo Album
                                    </div></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card text-center">
                                    <a href="/educations"> <div class="mb-2 card-body text-muted">
                                        <i class="dripicons-graduation"></i><br> My Education
                                    </div></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card text-center">
                                    <a href="/bill"> <div class="mb-2 card-body text-muted">
                                        <i class="dripicons-card"></i><br> My Bills
                                    </div></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6 col-xl-3">
                                <div class="card text-center">
                                    <a href="/goals"> <div class="mb-2 card-body text-muted">
                                        <i class="dripicons-pin"></i><br> My Goals
                                    </div></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card text-center">
                                    <a href="/plans"> <div class="mb-2 card-body text-muted">
                                        <i class="dripicons-network-3"></i><br> My Plans
                                    </div></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card text-center">
                                    <a href="/book"> <div class="mb-2 card-body text-muted">
                                        <i class="dripicons-suitcase"></i><br> My Books
                                    </div></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card text-center">
                                    <a href="/treasure"> <div class="mb-2 card-body text-muted">
                                        <i class="dripicons-store"></i><br> My Treasures
                                    </div></a>
                                </div>
                            </div>
                        </div>

                <div class="row">

                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <a href="/insurances"> <div class="mb-2 card-body text-muted">
                                <i class="dripicons-web"></i><br> My Social Media
                            </div></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <a href="/file"> <div class="mb-2 card-body text-muted">
                                <i class="dripicons-folder-open"></i><br> My Files
                            </div></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <a href="/passcodes"> <div class="mb-2 card-body text-muted">
                                <i class="dripicons-lock"></i><br> Passcodes
                            </div></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card text-center">
                            <a href="/info/edit"> <div class="mb-2 card-body text-muted">
                                <i class="dripicons-gear"></i><br> Account Settings
                            </div></a>
                        </div>
                    </div>
                </div>

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
