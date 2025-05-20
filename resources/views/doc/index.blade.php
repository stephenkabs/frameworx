<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Documentation</title>
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

@include('toast.success_toast')

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
        <a class="btn btn-sm btn-info waves-effect waves-light" href="/dashboard">
            <i class="dripicons-arrow-thin-left"></i>
        </a>
        <a class="btn btn-sm btn-info waves-effect waves-light" href="/doc/create"><i class="dripicons-plus"></i></a>
    </h4>

                <div class="app-buttons">

                    <div class="folder-container" style="display: flex; flex-wrap: wrap; gap: 5px;"> <!-- Adjust gap as needed -->
                        @foreach ($doc as $item)
                        <div class="folder" style="display: flex; flex-direction: column; align-items: left; text-align: center; margin-bottom: 5px;" oncontextmenu="openDeleteModal(event, '{{ route('doc.destroy', $item->slug) }}')">
                            <a style="font-size: 10px; text-align: left;" class="button button-app animated-btn thispc-btn" href="{{ route('doc.edit', $item->slug) }}">
                                <b><i style="font-size: 40px;" class="fas fa-file-word"></i></b>
                            </a>
                            <label style="font-size: 10px; color: rgb(72, 72, 72); padding-top: 5px;" for="folder">
                                <a style="color: rgb(56, 56, 56)" href="{{ route('doc.edit', $item->slug) }}"><b>{{ $item->title }}</b></a>
                            </label>
                        </div>

                        @endforeach
                    </div>


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






</body>

</html>
