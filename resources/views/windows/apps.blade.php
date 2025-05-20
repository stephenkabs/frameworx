<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Apps</title>
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

{{-- install button --}}

<style>
    /* Hover-expand styling for smooth transition */
    .hover-expand {
        transition: transform 0.3s ease-in-out;
    }

    .hover-expand:hover {
        transform: scale(1.05);
    }

    /* Hidden Install button styling */
    .install-btn {
        display: none; /* Hide by default */
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #ffffff;
        color: #04345e;
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        font-size: 14px;
        transition: opacity 0.3s;
    }

    /* Show Install button on hover */
    .card:hover .install-btn {
        display: block;
    }
</style>
</head>

@php
    $userWallpaper = auth()->user()->wallpaper; // Get the user's wallpaper from the database
@endphp

<body data-sidebar="dark" data-keep-enlarged="true" class="vertical-collapsed">
    <!-- Background image div with blur -->
    <div style="
        position: fixed;
        top: -2.5%; /* Expand slightly outward from the top */
        left: -2.5%; /* Expand slightly outward from the left */
        width: 105%; /* Slightly larger than 100% */
        height: 105%; /* Slightly larger than 100% */
        background: {{ $userWallpaper ? 'url(' . asset($userWallpaper) . ') no-repeat center center' : 'radial-gradient(circle, rgb(17, 92, 122) 30%, rgba(10,37,83,1) 100%)' }};
        background-size: cover;
        filter: blur(5px);
        z-index: -1;">
    </div>

    <!-- Overlay for darkening the wallpaper background -->
    <div style="
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;">
    </div>



<!-- Loader -->
<div style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%);"  id="preloader">
@include('loader.loader')
    @include('includes.taskbar')
</div>
@include('toast.success_toast')

<!-- Begin page -->
<div id="layout-wrapper">
    {{-- @include('includes.header') --}}

{{-- @include('includes.sidebar') --}}


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="status-icons" style="position: relative; display: inline-block; background-color: rgba(0, 0, 0, 0.7); border-radius: 10px; padding: 10px 20px; width: auto; max-width: 100%; white-space: nowrap;">
            <i style="font-size: 10px; color: white;" class="ion ion-ios-wifi" id="network-icon"></i> <!-- Network Icon -->
            <span style="font-size: 10px; color: white;" id="network-status">Connecting...</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <i style="font-size: 10px; color: white;" class="ion ion-ios-battery-charging" id="battery-icon"></i> <!-- Battery Icon -->
            <span style="font-size: 10px; color: white;" id="battery-percentage">--% <span></span></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


        </div>

        <div class="page-content">
            <div class="container-fluid">

                {{-- <h4 class="card-title">
                    <a class="btn btn-info waves-effect waves-light" href="/dashboard">
                        <i class="dripicons-arrow-thin-left"></i>
                    </a>
                    <a class="btn btn-info waves-effect waves-light" href="/stores/create">Install more Apps</a>
                </h4><br> --}}
                <p style="font-size: 14px;color:white"><strong>Aw Applications Store</strong></p> <span  style="color: #ffffff"><hr></span>
                {{-- <div class="row">

                    <div class="col-lg-6">
                        <div style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%);border-radius: 10px;" >
                            <div>
                                <img style="border-radius: 10px;" src="/assets/images/small/plus.webp" class="img-fluid" alt="Responsive image">
                            </div>
                        </div>
                    </div>
                    <div  class="col-lg-6">
                        <div style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%);border-radius: 10px;" >
                            <div>
                                <img style="border-radius: 10px;" src="/assets/images/small/support.webp" class="img-fluid" alt="Responsive image">
                            </div>
                        </div>
                    </div>

                </div><br> --}}
{{-- App Category start --}}

                <div class="row">
                    <p style="font-size: 14px;color:white"><strong>Computer Apps</strong></p>

                    @foreach ($stores as $item)
                    @php
                        $userStatus = $item->userStatuses->first();
                        $status = $userStatus ? $userStatus->status : 'Unstall';
                    @endphp

                    @if ($item->type == 'computer_apps')
                        @if ($status == 'Unstall')
                            <div class="col-lg-2">
                                <div class="card hover-expand" style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%); position: relative; border-radius: 7px;">
                                    <div style="position: relative;">
                                        <img style="width: 120%; border-radius: 7px;" src="/app_icons/{{ $item->file }}" class="img-fluid" alt="Responsive image">

                                        <!-- Install Button -->
                                        <button class="install-btn" onclick="openInstallModal({{ $item->id }})">Install</button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-2">
                                <div class="card hover-expand" style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%); border-radius: 7px;">
                                    <div>
                                        <a href="{{ $item->stream_link }}" target="blank">
                                            <img style="width: 120%; border-radius: 7px;" src="/app_icons/{{ $item->file }}" class="img-fluid" alt="Responsive image">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach


<!-- Install Modal -->
<div id="installModal" class="modal" style="display: none;">


    <div class="modal-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center;">
        <div class="modal-content" style="background-color: rgb(6, 77, 125); padding: 20px; border-radius: 10px; width: 400px; max-width: 100%; text-align: center; border: none; box-shadow: none;">
            <h4 style="color: white;font-size: 15px" >Install Application</h4> <!-- Optional: Change text color for visibility -->
            <form action="{{ route('stores.install') }}" method="POST">
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

                    <!-- JavaScript for Handling Modal and AJAX -->
<script>
    function openInstallModal(id) {
        document.getElementById('installModal').style.display = 'block';
        document.getElementById('mediaId').value = id;
    }

    function closeInstallModal() {
        document.getElementById('installModal').style.display = 'none';
    }

    // Optional: Close modal when clicking outside it
    window.onclick = function(event) {
        const modal = document.getElementById('installModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>


                </div>


{{-- App Category end --}}


            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

@include('includes.taskbar')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


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

<!-- JavaScript for Handling Modal and AJAX -->
<script>
    function openInstallModal(id) {
        document.getElementById('installModal').style.display = 'block';
        document.getElementById('mediaId').value = id;
    }

    function closeInstallModal() {
        document.getElementById('installModal').style.display = 'none';
    }

    // Optional: Close modal when clicking outside it
    window.onclick = function(event) {
        const modal = document.getElementById('installModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

<script>
    // Update time and date
    function updateTime() {
        const currentTime = new Date();
        const timeString = currentTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const dateString = currentTime.toLocaleDateString([], { weekday: 'long', month: 'long', day: 'numeric' });

        document.getElementById('current-time').textContent = timeString;
        document.getElementById('current-date').textContent = dateString;
    }

    setInterval(updateTime, 1000);

    // Check network connection status
    function updateNetworkStatus() {
        const networkIcon = document.getElementById('network-icon');
        const networkStatus = document.getElementById('network-status');

        if (navigator.onLine) {
            networkIcon.classList.replace('ion-ios-cloud-outline', 'ion-ios-wifi');
            networkStatus.textContent = 'Online';
        } else {
            networkIcon.classList.replace('ion-ios-wifi', 'ion-ios-cloud-outline');
            networkStatus.textContent = 'Offline';
        }
    }

    window.addEventListener('online', updateNetworkStatus);
    window.addEventListener('offline', updateNetworkStatus);
    updateNetworkStatus(); // Initial check

    // Battery status
    navigator.getBattery().then(function(battery) {
        function updateBatteryStatus() {
            const batteryPercentage = Math.round(battery.level * 100);
            document.getElementById('battery-percentage').textContent = batteryPercentage + '%';

            if (battery.charging) {
                document.getElementById('battery-icon').classList.add('ion-ios-battery-charging');
            } else {
                document.getElementById('battery-icon').classList.remove('ion-ios-battery-charging');
            }
        }

        updateBatteryStatus();
        battery.addEventListener('chargingchange', updateBatteryStatus);
        battery.addEventListener('levelchange', updateBatteryStatus);
    });
</script>
@include('toast.error_success_js')



</body>

</html>
