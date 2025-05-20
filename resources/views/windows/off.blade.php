<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Shutdown - PC</title>
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

<body style="
    background: {{ $userWallpaper ? 'url(' . asset($userWallpaper) . ') no-repeat center center' : 'radial-gradient(circle, rgb(17, 92, 122) 30%, rgba(10,37,83,1) 100%)' }};
    background-size: cover;"
    data-sidebar="dark"
    data-keep-enlarged="true"
    class="vertical-collapsed">

    <!-- Overlay for darkening the wallpaper background if needed -->
    <div style="
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.1);
        z-index: 1;">
    </div>
<!-- Loader -->
@include('loader.loader')

{{-- @include('toast.success_toast') --}}

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

    .folder-container {
    display: flex;
    flex-wrap: wrap;
    gap: 5px; /* Adjust the space between folders */
}

.folder {
    display: flex;
    flex-direction: column;
    align-items: left;
    text-align: center;
    margin-bottom: 5px; /* Reduce the bottom margin */
}

.folder a {
    font-size: 10px; /* Keeping the font size consistent */
    text-align: left;
}

.folder label {
    font-size: 10px;
    color: aliceblue;
    padding-top: 2px; /* Reduced padding for label */
}

</style>

<style>
    /* Modal styling */
.modal {
    display: none; /* Hide modal by default */
    position: fixed;
    z-index: 1050;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
}

.modal-dialog {
    margin: 100px auto;
    max-width: 500px;
}

.modal-content {
    padding: 20px;
    border-radius: 8px;
}

</style>

{{-- @include('includes.icons_inside') --}}
@include('includes.icons_inside')



<!-- Begin page -->
<div id="layout-wrapper">
        <!-- Sticky Navigation Bar -->

    <!-- Create Folder Modal -->
    <div class="modal" id="createFolderModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Folder</h5>
                    <button type="button" class="close" onclick="closeCreateFolderModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
      <!-- Logout Button -->
<form action="{{ route('dashboard.logout') }}" method="POST" onsubmit="handleLogout(event)">
    @csrf
    &nbsp;&nbsp;&nbsp;<button type="submit" class="dropdown-item" style="border: none; background: none;">
        <i class="dripicons-exit font-size-16 align-middle me-2"></i> Logout
    </button>
</form>

<!-- Audio for Logout Sound -->
<audio id="logout-sound" src="{{ asset('assets/welcome_audio/off.mp3') }}" preload="auto"></audio>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeCreateFolderModal()">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="submitCreateFolderForm()">Create</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Structure -->
<div class="modal fade" id="deleteFolderModal" tabindex="-1" role="dialog" aria-labelledby="deleteFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFolderModalLabel">Confirm Deletion</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this folder? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <a class="btn btn-info waves-effect waves-light" href="/folder">Cancel</a>
                <form id="deleteFolderForm" action="" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add the audio element -->
<audio id="modalSound" src="{{ asset('assets/welcome_audio/sure.mp3') }}"></audio> <!-- Replace with the path to your audio file -->

<!-- JavaScript to play sound on modal open -->
<script>
    // Wait for the DOM to load
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById('deleteFolderModal');
        const sound = document.getElementById('modalSound');

        // Bootstrap modal 'shown' event listener
        $('#deleteFolderModal').on('shown.bs.modal', function() {
            sound.play();
        });
    });
</script>




{{-- @include('includes.header') --}}
{{-- @include('includes.sidebar') --}}
{{--
@include('includes.sidebar') --}}


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

{{--
    <h4 class="card-title">
        <a class="btn btn-info waves-effect waves-light" href="/dashboard">
            <i class="dripicons-arrow-thin-left"></i>
        </a>
        <a class="btn btn-info waves-effect waves-light" href="javascript:void(0);" onclick="showCreateFolderModal();">Create Folder</a>
    </h4> --}}

<br><br><br><br>
<br><br><br><br><br><br>
                    <div class="folder-container" style="display: flex; flex-wrap: wrap; gap: 5px;"> <!-- Adjust gap as needed -->

                        <div class="d-flex justify-content-left align-items-center" style="min-height: 20vh; width: 100%;">
                            <div class="alert alert-info text-center p-5" role="alert" >
                                <h4> <i class="ion ion-md-power"></i><br><br>You're about to switch off your online PC.
                                    </h4>
                                <p class="mb-4">Please save and close any programs you're working on.</p>

                                <form action="{{ route('dashboard.logout') }}" method="POST" onsubmit="handleLogout(event)">
                                    @csrf
                                    &nbsp;&nbsp;&nbsp;<button type="submit" class="dropdown-item" style="border: none; background: none;">
                                        <i class="dripicons-exit font-size-16 align-middle me-2"></i> Switch Off
                                    </button>
                                </form>
                            </div>
                        </div>


                    </div>




                <!-- end row -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

{{-- @include('includes.taskbar') --}}
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

{{-- word limit --}}

<script>
    // Define the word limit
    const WORD_LIMIT = 2;

    // Function to truncate text to a specified word limit
    function applyWordLimit() {
        // Select all folder labels
        const folderLabels = document.querySelectorAll('.folder label b');

        // Loop through each label and apply the word limit
        folderLabels.forEach(label => {
            const text = label.innerText.trim();
            const words = text.split(' ');

            // Check if text exceeds word limit
            if (words.length > WORD_LIMIT) {
                // Truncate the text and add ellipsis
                label.innerText = words.slice(0, WORD_LIMIT).join(' ') + '...';
            }
        });
    }

    // Run the function after page loads
    window.onload = applyWordLimit;
</script>

<script>function showCreateFolderModal() {
    document.getElementById('createFolderModal').style.display = 'block';
}

function closeCreateFolderModal() {
    document.getElementById('createFolderModal').style.display = 'none';
}

function submitCreateFolderForm() {
    document.getElementById('createFolderForm').submit();
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('createFolderModal');
    if (event.target === modal) {
        closeCreateFolderModal();
    }
};
</script>
@include('toast.error_success_js')


{{-- Delete folder --}}
<script>
    function openDeleteModal(event, deleteUrl) {
        event.preventDefault(); // Prevent the default context menu
        $('#deleteFolderModal').modal('show'); // Show the modal
        // Set the form action to the delete URL
        $('#deleteFolderForm').attr('action', deleteUrl);
    }
</script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>








<!-- JavaScript for handling logout -->
<script>
    function handleLogout(event) {
        console.log("Logout function triggered"); // Debug line
        event.preventDefault(); // Prevent default form submission

        // Play the logout sound
        const logoutSound = document.getElementById('logout-sound');
        if (logoutSound) {
            logoutSound.play().catch(error => {
                console.log("Autoplay was prevented by the browser:", error);
            });
        }

        // Show goodbye modal
        const goodbyeModal = document.getElementById('goodbyeModal');
        goodbyeModal.style.display = 'flex'; // Show goodbye modal
        console.log("Goodbye modal displayed"); // Debug line

        // Hide the goodbye modal after 7 seconds
        setTimeout(() => {
            goodbyeModal.style.display = 'none'; // Hide goodbye modal
            console.log("Goodbye modal hidden"); // Debug line

            // Show loading modal
            const loadingModal = document.getElementById('loadingModal');
            loadingModal.style.display = 'flex'; // Show loading modal
            console.log("Loading modal displayed"); // Debug line

            // Submit the form after a brief delay
            setTimeout(() => {
                event.target.submit(); // Submit the form after a delay
                console.log("Form submitted"); // Debug line
            }, 2000); // Adjust time as needed
        }, 7000); // Goodbye modal display time
    }
</script>




<audio id="logout-sound" src="{{ asset('assets/welcome_audio/off.mp3') }}" preload="auto"></audio>

<!-- Loading Modal -->
<div id="loadingModal" class="modal" style="display: none; justify-content: center; align-items: center;
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%); z-index: 1000;">
    <p style="color: #ffffff; font-size: 24px; text-align: center;">Switching Off...</p>
</div>

<!-- Goodbye Modal -->
<div id="goodbyeModal" class="modal" style="display: none; justify-content: center; align-items: center;
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%); z-index: 1000;">
    <p style="color: #ffffff; font-size: 24px; text-align: center;">Goodbye! See you again</p>
</div>



</body>

</html>
