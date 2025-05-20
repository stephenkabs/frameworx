<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Camera</title>
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

{{-- Small nav css --}}
<style>
    .sticky-nav {
        position: sticky;
        top: 0;
        background-color: #041d37; /* Dark background */
        display: flex;
        justify-content: flex-end;
        padding: 10px;
        z-index: 1000; /* Ensure it stays above other content */
        border-bottom: 1px solid #444; /* Optional: border for separation */
    }

    .nav-controls {
        display: flex;
        gap: 10px;
    }

    .nav-controls button {
        background-color: transparent;
        border: none;
        font-size: 16px;
        color: white; /* Icon color */
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .nav-controls button:hover {
        background-color: rgba(255, 255, 255, 0.1); /* Light hover effect */
    }

    .top-nav {
        background-color: #444; /* Darker background for top nav */
        padding: 10px;
    }

    .status-icons {
        display: flex;
        align-items: center;
        color: white; /* White text for icons */
    }
</style>

<style>
    #capture {
        background-color: #007bff; /* Bootstrap primary color */
        color: white; /* White text */
        border: none; /* Remove default border */
        border-radius: 5px; /* Rounded corners */
        padding: 10px 20px; /* Padding for the button */
        cursor: pointer; /* Pointer cursor on hover */
        font-size: 16px; /* Font size */
    }

    #capture:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }
</style>


{{-- Error detector --}}
<style>
    /* Error Notice Styling */
    #error-notice {
        display: none;
        position: fixed;
        bottom: 100px;
        right: 10px;
        background-color: #f44336;
        color: white;
        padding: 16px;
        border-radius: 4px;
        z-index: 1000;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Close Button */
    #error-notice button {
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
        float: right;
    }
</style>



<!-- Begin page -->
<div id="layout-wrapper">
        <!-- Sticky Navigation Bar -->



@include('includes.header')
{{-- @include('includes.sidebar') --}}

@include('includes.sidebar')


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">


        <div class="page-content">
            <div class="container-fluid">
                    <!-- Error Notice -->
    {{-- <div id="error-notice">
        <span id="error-message"></span>
        <button onclick="closeErrorNotice()">✖</button>
    </div> --}}


                <h4 class="card-title">
                    <a class="btn btn-info waves-effect waves-light" href="/photos"><i class="dripicons-arrow-thin-left"></i></a>
                    {{-- <a class="btn btn-success waves-effect waves-light" href="/note/create">Add New</a> --}}
                </h4>
                <div class="row">
                    <div  class="col-lg-6">
                        <div class="card">
                            <div style="background-color: #041d37" class="card-body">

                                <div class="table-rep-plugin">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <div class="camera-container" style="display: flex; flex-direction: column; align-items: center;">
                                            <button id="recordButton">Start Recording</button>
                                            <button id="stopButton" disabled>Stop Recording</button>

                                            <audio style="width: 630px; color: #0056b3;" id="audioPlayer" controls></audio>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div style="background-color: #041d37" class="card-body">
{{--
                                <canvas id="canvas"></canvas>
                                <form id="photo-form" action="{{ route('photos.store') }}" method="POST" style="margin-top: 20px;">
                                    @csrf
                                    <input type="hidden" name="image" id="image-data">
                                    <button type="submit" class="btn btn-info">Save Photo</button>
                                </form> --}}

                            </div>
                        </div>
                    </div><br><br>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // Event listener for delete button click
    $('#deleteMinistryModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var route = button.data('route'); // Extract route from data-* attribute
        var modal = $(this);

        // Update the form action with the correct route
        modal.find('#deleteMinistryForm').attr('action', route);
    });
</script>


<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const imageInput = document.getElementById('image-data');
    const capturedImage = document.getElementById('captured-image');

    // Request camera access
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(err => {
            console.error("Error accessing camera: ", err);
        });

    // Capture photo when button is clicked
    function capturePhoto() {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Convert the captured image to base64
        const imageData = canvas.toDataURL('image/png');
        imageInput.value = imageData;

        // Show the captured image as a preview
        capturedImage.src = imageData;
        capturedImage.style.display = 'block'; // Show the preview
    }
</script>

<script>
    document.getElementById('minimize').addEventListener('click', function() {
        // Code to minimize the window or hide the content
        alert("Minimize action triggered");
    });

    document.getElementById('maximize').addEventListener('click', function() {
        // Code to maximize the window or bring it to focus
        alert("Maximize action triggered");
    });

    document.getElementById('close').addEventListener('click', function() {
        // Code to close the window or exit
        alert("Close action triggered");
    });
</script>

{{-- Error Detector js --}}

<script>
    // JavaScript Error Handler
    window.onerror = function (message, source, lineno, colno, error) {
        const errorMessage = `Error: ${message} at ${source}:${lineno}:${colno}`;
        document.getElementById('error-message').innerText = errorMessage;
        document.getElementById('error-notice').style.display = 'block';
    };

    // Function to close the error notice
    function closeErrorNotice() {
        document.getElementById('error-notice').style.display = 'none';
    }
</script>

<script>
    // Set the limit for the number of photos that can be uploaded
    const PHOTO_LIMIT = 5;
    let uploadedPhotosCount = 0;  // This will track the number of uploaded photos

    // Function to handle photo upload
    function handlePhotoUpload() {
        // Check if the user has reached the limit
        if (uploadedPhotosCount >= PHOTO_LIMIT) {
            showPhotoLimitNotice();
            return false;  // Prevent the upload
        }

        // If limit is not reached, increment the count and proceed with the upload
        uploadedPhotosCount++;
        console.log(`Photo uploaded successfully. Total uploaded: ${uploadedPhotosCount}`);
    }

    // Function to show a notification when the user hits the limit
    function showPhotoLimitNotice() {
        const notification = document.createElement('div');
        notification.innerText = `Photo limit reached! You can only upload ${PHOTO_LIMIT} photos.`;
        notification.style.backgroundColor = '#ff4d4f';
        notification.style.color = 'white';
        notification.style.padding = '10px';
        notification.style.borderRadius = '5px';
        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.zIndex = '1000';
        notification.style.fontSize = '16px';

        document.body.appendChild(notification);

        // Remove the notification after 3 seconds
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 3000);
    }
</script>

<script>
    function capturePhoto() {
        if (uploadedPhotosCount >= PHOTO_LIMIT) {
            showPhotoLimitNotice();
            return;
        }

        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        // Draw the photo from the video stream to the canvas
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Convert the canvas image to base64 and send to the server
        const dataUrl = canvas.toDataURL('image/png');
        document.getElementById('image-data').value = dataUrl;

        console.log('Photo captured');
    }
</script>



<script>const recordButton = document.getElementById('recordButton');
    const stopButton = document.getElementById('stopButton');
    const audioPlayer = document.getElementById('audioPlayer');
    let mediaRecorder = null;

    recordButton.addEventListener('click', () => {
        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(stream => {
                mediaRecorder = new MediaRecorder(stream);
                mediaRecorder.ondataavailable = event => {
                    const blob = new Blob([event.data], { type: 'audio/mp3' });
                    const url = URL.createObjectURL(blob);
                    audioPlayer.src = url;

                    // To save the file:
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'recorded_audio.mp3';
                    a.click();
                };
                mediaRecorder.start();
                recordButton.disabled = true;
                stopButton.disabled = false;
            })
            .catch(error => {
                console.error('Error accessing microphone:', error);
            });
    });

    stopButton.addEventListener('click', () => {
        mediaRecorder.stop();
        recordButton.disabled = false;
        stopButton.disabled = true;
    });</script>



</body>

</html>
