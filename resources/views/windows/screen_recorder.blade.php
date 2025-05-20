<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Screen Recorder</title>
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
    <style>
        #videoElement {
            width: 100%;
            height: auto;
            border: 1px solid black;
            margin-top: 10px;
        }
    </style>


                <h4 class="card-title">
                    <a class="btn btn-info waves-effect waves-light" href="/dashboard"><i class="dripicons-arrow-thin-left"></i></a>
                    <a class="btn btn-danger waves-effect waves-light" id="startRecording">Start Recording</a>
                    <a class="btn btn-danger waves-effect waves-light"  id="stopRecording">Stop Recording</a>
                    <a class="btn btn-primary waves-effect waves-light" id="download" style="display:none;">Download Video</a>

                </h4><br>
                <div class="row">
                    <div  class="col-lg-12">
                        <div class="card">
                            <div style="background-color: #041d37" class="card-body">

                                <video id="videoElement" controls></video>


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
    let mediaRecorder;
    let recordedChunks = [];

    document.getElementById('startRecording').addEventListener('click', async () => {
        try {
            const stream = await navigator.mediaDevices.getDisplayMedia({
                video: true,
                audio: true
            });

            mediaRecorder = new MediaRecorder(stream);

            mediaRecorder.ondataavailable = (event) => {
                if (event.data.size > 0) {
                    recordedChunks.push(event.data);
                }
            };

            mediaRecorder.onstop = () => {
                const blob = new Blob(recordedChunks, {
                    type: 'video/webm'
                });
                const url = URL.createObjectURL(blob);
                const videoElement = document.getElementById('videoElement');
                videoElement.src = url;
                recordedChunks = []; // Clear the recorded chunks

                // Prepare the download link
                const downloadLink = document.getElementById('download');
                downloadLink.href = url;
                downloadLink.download = 'recording.webm'; // Set the default filename
                downloadLink.style.display = 'block'; // Show the download link
                downloadLink.innerText = 'Download Video'; // Change text of download link
            };

            mediaRecorder.start();
            document.getElementById('stopRecording').disabled = false;
            document.getElementById('startRecording').disabled = true;

        } catch (error) {
            console.error('Error accessing media devices.', error);
        }
    });

    document.getElementById('stopRecording').addEventListener('click', () => {
        mediaRecorder.stop();
        document.getElementById('stopRecording').disabled = true;
        document.getElementById('startRecording').disabled = false;
    });
</script>













</body>

</html>
