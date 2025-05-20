<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $user->name }}</title>
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

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">

                                    <h4 class="card-title">
                                        <a class="btn btn-info waves-effect waves-light" href="#">
                                            <i class="dripicons-arrow-thin-left"></i>
                                        </a>
                                        <a class="btn btn-info waves-effect waves-light" href="{{ route('user.edit', $user->id) }}">
                                            Edit {{ $user->name }}'s Profile
                                        </a>
                                    </h4><br>

                                    <h4 class="card-title"> {{ $user->name }}</h4>
                                    <p class="card-title-desc">
                                        <b>City: </b>{{ $user->city }}<br>
                                        <b>Storage Used:</b> {{ number_format($profileData->storage_used / 1073741824, 2) }} GB / 1 GB</p>

                                        @if ($profileData->storage_used >= 0.9 * 1073741824)
                                            <p style="color: red; font-weight: bold;">Warning: You have used over 90% of your storage capacity!
                                        @endif

                                        {{-- <h4 class="card-title">
                                            @if($user->status == 'Published')
                                                <a class="btn btn-success btn-sm waves-effect waves-light" href="#">
                                                    Status: {{ $user->status}}
                                                </a>
                                            @else
                                                <a class="btn btn-danger btn-sm waves-effect waves-light" href="#">
                                                    Status: {{ $user->status}}
                                                </a>
                                            @endif

                                            <a class="btn btn-info btn-sm waves-effect waves-light" href="#">
                                                {{ $user->button_name}}
                                            </a>

                                        </h4><br> --}}
                                    </p>
                            </div>
                        </div>
                    </div>

                    <!-- end col -->
                    <div class="col-lg-2">
                        <div class="card">
                            <div class="card-body">

                                @if($user->image)
                                <embed src="/users/images/{{ $user->image }}#toolbar=0" width="100%" />
                            @else
                                <embed src="/images/profile.webp#toolbar=0" width="100%" /> <!-- Default image path -->
                            @endif

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>

                <!-- end row -->


                <div class="row">
                    <p style="font-size: 14px;color:rgb(207, 207, 207)"><strong>{{ $profileData->name }}'s Installed Apps</strong></p>

 @foreach ($media as $item)

    @if ($item->status == 'Install')

        <div class="col-lg-2">
            <div class="card hover-expand" style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%); border-radius: 7px;">
                <div>
                    <a href="{{ $item->stream_link }}" target="blank">
                        <img style="width: 120%; border-radius: 7px;" src="/stream_icons/{{ $item->file }}" class="img-fluid" alt="Responsive image">
                    </a>
                </div>
            </div>
        </div>

    @endif
@endforeach

<!-- Install Modal -->
<div id="installModal" class="modal" style="display: none;">
    <div class="modal-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center;">
        <div class="modal-content" style="background-color: rgb(6, 77, 125); padding: 20px; border-radius: 10px; width: 400px; max-width: 100%; text-align: center; border: none; box-shadow: none;">
            <h4 style="color: white;font-size: 15px" >Install Application</h4> <!-- Optional: Change text color for visibility -->
            <form action="{{ route('media.install') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="mediaId">
                <input type="hidden" name="status" value="Install">

                <button type="submit" class="btn btn-info btn-sm waves-effect waves-light">Install</button>
                <button type="button" class="btn btn-info btn-sm waves-effect waves-light" onclick="closeInstallModal()">Cancel</button>
            </form>
        </div>
    </div>
</div>

                    <style>
                        .hover-expand {
                            border-radius: 10px;
                            transition: transform 0.3s ease; /* Smooth transition for the transform property */
                            overflow: hidden; /* Prevents overflow during the animation */
                        }

                        .hover-expand:hover {
                            transform: scale(1.05); /* Slightly increase size on hover */
                        }
                    </style>


                </div>


            </div>
            {{-- @endforeach --}}
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
            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-default" value="default" onchange="document.documentElement.setAttribute('data-theme-mode', 'default')" checked>
                <label class="form-check-label" for="theme-default">Default</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-teal" value="teal" onchange="document.documentElement.setAttribute('data-theme-mode', 'teal')">
                <label class="form-check-label" for="theme-teal">Teal</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-orange" value="orange" onchange="document.documentElement.setAttribute('data-theme-mode', 'orange')">
                <label class="form-check-label" for="theme-orange">Orange</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-purple" value="purple" onchange="document.documentElement.setAttribute('data-theme-mode', 'purple')">
                <label class="form-check-label" for="theme-purple">Purple</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-green" value="green" onchange="document.documentElement.setAttribute('data-theme-mode', 'green')">
                <label class="form-check-label" for="theme-green">Green</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-red" value="red" onchange="document.documentElement.setAttribute('data-theme-mode', 'red')">
                <label class="form-check-label" for="theme-red">Red</label>
            </div> -->
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

<script src="/assets/libs/parsleyjs/parsley.min.js"></script>

<script src="/assets/js/pages/form-validation.init.js"></script>

<script src="/assets/js/app.js"></script>

</body>

</html>
