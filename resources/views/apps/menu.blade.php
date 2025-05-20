<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Apps_Widget</title>
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


<body style="background: radial-gradient(circle, rgb(22, 95, 159) 30%, rgb(5, 51, 85) 100%);" data-sidebar="dark">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

{{-- @php
    $userWallpaper = auth()->user()->wallpaper; // Get the user's wallpaper from the database
@endphp

<body data-sidebar="dark" data-keep-enlarged="true" class="vertical-collapsed">

    <div style="
        position: fixed;
        top: -2.5%; /* Expand slightly outward from the top */
        left: -2.5%; /* Expand slightly outward from the left */
        width: 108%; /* Slightly larger than 100% */
        height: 108%; /* Slightly larger than 100% */
        background: {{ $userWallpaper ? 'url(' . asset($userWallpaper) . ') no-repeat center center' : 'radial-gradient(circle, rgb(17, 92, 122) 30%, rgba(10,37,83,1) 100%)' }};
        background-size: cover;
        filter: blur(25px);
        z-index: -1;">
    </div>


    <div style="
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.2);
        z-index: 1;">
    </div> --}}



    <!-- Your page content goes here -->


<!-- Loader -->


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

        {{-- Main apps style --}}

        <style>
            /* Container background */
            .section-with-bg {
                background-image: url('/path-to-your-image.jpg'); /* Replace with your image path */
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                padding: 50px 0;
            }

            /* App-like button styles */
            .app-buttons {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); /* Auto-sizing columns for responsiveness */
                gap: 20px; /* Spacing between buttons */
                justify-items: center;
                padding: 20px; /* Optional padding around buttons */
            }

            .button-app {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100px; /* App icon width */
                height: 100px; /* App icon height */
                color: white;
                text-align: center;
                font-size: 14px;
                border-radius: 20px; /* Rounded corners */
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* App icon shadow */
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                text-decoration: none; /* Remove underline */
                overflow: hidden;
                white-space: pre-wrap; /* Allow line breaks inside button text */
                position: relative; /* For animation effect */
            }

            /* Hover effect for buttons */
            .button-app:hover {
                transform: scale(1.05); /* Slightly enlarge the button on hover */
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4); /* Enhanced shadow on hover */
            }

            @keyframes pop-in {
                0% {
                    transform: scale(0.8);
                    opacity: 0;
                }
                50% {
                    transform: scale(1.2);
                    opacity: 0.8;
                }
                100% {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            /* Individual colors for each button */
            .aeChurch-btn {
                background: linear-gradient(135deg, #690606 0%, #a20606 50%, #e71717 100%);
            }

            .atestimonial-btn {
                background: linear-gradient(135deg, #572606 0%, #7c3a1d 50%, #572811 100%);
            }

            .agive-btn {
                background: linear-gradient(135deg, #36e7f4 0%, #075f7a 50%, #022235 100%);
            }

            .aministries-btn {
                background: linear-gradient(135deg, #2196F3 0%, #6EC6FF 100%);
            }

            .atv-btn {
                background: linear-gradient(135deg, #6a0707 0%, #f11212 100%);
            }

            .acontacts-btn {
                background: linear-gradient(135deg, #FFEB3B 0%, #887b07 100%);
                color: #000; /* Black text for readability */
            }

            .google-btn {
                background: linear-gradient(135deg, #e59809 0%, #7a5b07 100%);
                color: #000; /* Black text for readability */
            }


            .recorder-btn {
                background: linear-gradient(135deg, #292828 0%, #0d0a01 100%);
                color: #bb0505; /* Black text for readability */
            }
            .aapp-btn {
                background: linear-gradient(135deg, #3F51B5 0%, #162158 100%);
            }

            .acontactus-btn {
                background: linear-gradient(135deg, #08b410 0%, #114a03 100%);
            }

            .areminder-btn {
                background: linear-gradient(135deg, #2a5605 0%, #84ab06 100%);
            }

            .anotepad-btn {
                background: linear-gradient(135deg, #560529 0%, #d81874 100%);
            }
            .aministry-btn {
                background: linear-gradient(135deg, #760505 0%, #eb0606 100%);
            }

            .aprograms-btn {
                background: linear-gradient(135deg, #0664a3 0%, #3a96ff 100%);
            }

            .thispc-btn {
                background: linear-gradient(135deg, #c47e06 0%, #773505 100%);
            }

            .streaming-btn {
                background: linear-gradient(135deg, #04345e 0%, #3a96ff 100%);
            }

            .bluetooth-btn {
                background: linear-gradient(135deg, #032678 0%, #08428e 100%);
            }

            .insta-btn {
                background: linear-gradient(135deg, #f9ce34, #ee2a7b, #6228d7);
            }

            .link-btn {
                background: linear-gradient(135deg, #04345e 0%, #205fb8 100%);
            }


            .setting-btn {
                background: linear-gradient(135deg, #48045e 0%, #082fde 100%);
            }

            .photo-btn {
                background: linear-gradient(135deg, #045e5b 0%, #08dea1 100%);
            }


            .drive-btn {
                background: linear-gradient(135deg, #135e04 0%, #c1780b 100%);
            }
            /* Animation effect for buttons */
            .aanimated-btn {
                animation: pop-in 0.5s ease forwards; /* Animate on load */
            }




            /* Adjust animation delay for staggered effect */
            .aeChurch-btn { animation-delay: s; }
            .atestimonial-btn { animation-delay: 0.1s; }
            .agive-btn { animation-delay: 0.2s; }
            .aministries-btn { animation-delay: 0.3s; }
            .atv-btn { animation-delay: 0.4s; }
            .acontacts-btn { animation-delay: 0.5s; }
            .aapp-btn { animation-delay: 0.6s; }
            .acontactus-btn { animation-delay: 0.7s; }
            .areminder-btn { animation-delay: 0.9s; }
            .anotepad-btn { animation-delay: 0.9s; }
            .aministry-btn { animation-delay: 0s; }
            .aprograms-btn { animation-delay: 0.1s; }
            .agive-btn { animation-delay: 0.2s; }

        </style>

@include('includes.iconscss')



<!-- Begin page -->
<div id="layout-wrapper">
        <!-- Sticky Navigation Bar -->



{{-- @include('includes.header') --}}
{{-- @include('includes.sidebar') --}}

{{-- @include('includes.sidebar') --}}


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">


        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <!-- Search Bar -->
                    <div style="width: 100%; text-align: left; margin-bottom: 30px;">
                        <input
                            id="search-input"
                            type="text"
                            placeholder="Search Installed Apps..."
                            class="search-input">
                    </div>

                    <!-- Installed Apps Section -->

                    <div id="apps-container" class="row">
                        @foreach ($store as $item)
                        <div class="col-md-2 m-1 app-card" data-name="{{ strtolower($item->stream_name) }}">
                            <div class="card hover-expand" style="background-color: transparent; border-radius: 7px; box-shadow: none;">
                                <a href="{{ $item->stream_link }}">
                                    <img style="width: 100%; border-radius: 7px;" src="/app_icons/{{ $item->file }}" class="img-fluid" alt="Responsive image">
                                </a>
                                <p class="truncate-text" style="text-align: center; color: #fff; font-size: 10px; margin-top: 2px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);">
                                    <b>{{ $item->stream_name }}</b>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>


                    <div id="pagination-container" class="mt-4 text-left"></div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const itemsPerPage = 15;
                            const appContainer = document.getElementById("apps-container");
                            const paginationContainer = document.getElementById("pagination-container");
                            const appCards = Array.from(appContainer.getElementsByClassName("app-card"));

                            function renderPagination(currentPage) {
                                const totalPages = Math.ceil(appCards.length / itemsPerPage);
                                paginationContainer.innerHTML = "";

                                for (let i = 1; i <= totalPages; i++) {
                                    const pageButton = document.createElement("button");
                                    pageButton.innerText = i;
                                    pageButton.className = `btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-secondary'} m-1`;
                                    pageButton.addEventListener("click", () => updatePage(i));
                                    paginationContainer.appendChild(pageButton);
                                }
                            }

                            function updatePage(pageNumber) {
                                const start = (pageNumber - 1) * itemsPerPage;
                                const end = start + itemsPerPage;

                                appCards.forEach((card, index) => {
                                    if (index >= start && index < end) {
                                        card.style.display = "block";
                                    } else {
                                        card.style.display = "none";
                                    }
                                });

                                renderPagination(pageNumber);
                            }

                            // Initialize
                            updatePage(1);
                        });
                        </script>

                </div>


                <script>
                    // Real-Time Search Functionality
                    document.getElementById('search-input').addEventListener('input', function () {
                        const query = this.value.toLowerCase();
                        const appCards = document.querySelectorAll('.app-card');

                        appCards.forEach(card => {
                            const appName = card.getAttribute('data-name');
                            if (appName.includes(query)) {
                                card.style.display = 'block'; // Show matching cards
                            } else {
                                card.style.display = 'none'; // Hide non-matching cards
                            }
                        });
                    });
                </script>

                <style>
                    .hover-expand {
                        border-radius: 10px;
                        transition: transform 0.3s ease;
                        overflow: hidden;
                    }

                    .hover-expand:hover {
                        transform: scale(1.05);
                    }

                    /* Search Input Styling */
                    .search-input {
                        width: 30%;
                        background-color: transparent;
                        border: 1px solid rgba(255, 255, 255, 0.5); /* Semi-transparent border */
                        color: white; /* Adjust text color to contrast with the background */
                        font-size: 14px;
                        padding: 10px 15px;
                        border-radius: 20px; /* Rounded corners */
                    }

                    .search-input::placeholder {
                        color: rgba(255, 255, 255, 0.7); /* Semi-transparent placeholder */
                    }

                    .search-input:focus {
                        outline: none; /* Remove default outline */
                        box-shadow: 0 0 5px rgba(255, 255, 255, 0.8); /* Glow effect on focus */
                    }
                </style>

                <!-- end row -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

{{-- @include('includes.footer') --}}
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
    const WORD_LIMIT = 4;

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





<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>



</body>

</html>
