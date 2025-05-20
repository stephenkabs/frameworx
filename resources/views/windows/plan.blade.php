<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Desktop</title>
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

    {{-- REFLESH CSS --}}

    <!-- CSS for the Modal -->
    <style>
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Semi-transparent black */
            backdrop-filter: blur(8px); /* Blurred background */
        }

        .modal-content {
            background-color: #ffffff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
                background: linear-gradient(135deg, #093ada 0%, #bd6506 100%);
                color: #e9e9e9; /* Black text for readability */
            }
            .aapp-btn {
                background: linear-gradient(135deg, #3F51B5 0%, #162158 100%);
            }

            .acontactus-btn {
                background: linear-gradient(135deg, #0ad9b3 0%, #03384a 100%);
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


        {{-- Time CSS --}}
<style>.top-bar {
    display: flex;
    justify-content: space-between; /* Adjusts space between icons and time */
    align-items: center; /* Centers items vertically */
    padding: 10px;
    /* background-color: #000; Background color of the top bar */
}

.status-icons {
    display: flex;
    align-items: center; /* Centers icons vertically */
}

.status-icons i {
    color: #fff; /* Icon color */
    margin-right: 10px; /* Space between icons */
}

#current-time {
    flex-grow: 1; /* Allow the time to take up available space */
    text-align: center; /* Center the time text */
    justify-content: left;
    font-family: "Helvetica Neue", Arial, sans-serif; /* iOS-like font */
    font-weight: bold; /* Bold text for better visibility */
    font-size: 12px; /* Adjusted font size */
}

#current-date {
    font-family: "Helvetica Neue", Arial, sans-serif; /* iOS-like font */
    font-weight: normal; /* Normal weight for date */
    font-size: 20px; /* Adjust font size */
    color: rgb(255, 255, 255); /* White color for date */
}

</style>


{{-- WELCOME STYLE  --}}

<style>
    /* Modal styling */
    .modal {
        display: none; /* Start hidden */
        align-items: center;
        justify-content: center;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        font-size: 20px;
        animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>



</head>
{{-- @foreach ($desk->sortByDesc('updated_at')->slice(0, 1) as $item) <!-- Assuming 'updated_at' is the field for the latest update -->
    @if ($item->status === 'Install')
        <body style="
            background: url('/desk_wallpapers/{{ $item->file }}') no-repeat center center;
            background-size: cover;" data-sidebar="dark" data-keep-enlarged="true" class="vertical-collpsed">

            <!-- Overlay div -->
            <div style="
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);  /* Black with 50% opacity */
                z-index: 1;"> <!-- Ensure overlay is above the background -->
            </div>
    @endif
@endforeach --}}



@php
    $userWallpaper = auth()->user()->wallpaper; // Get the user's wallpaper from the database
@endphp

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

    <!-- Your page content goes here -->



    <!-- Loader -->
    <div style="background: radial-gradient(circle, rgb(17, 92, 122) 30%, rgba(10,37,83,1) 100%);"  id="preloader">

        <div id="status">
            <div class="spinner"></div>
        </div>
        @include('includes.taskbar')
    </div>

    <!-- Begin page -->
    <div id="layout-wrapper">



{{-- @include('includes.sidebar_collapse') --}}

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
 <div class="main-content">

<div   class="page-content">

</div>
gh
</div>
</div>

</div>

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

    <!--Morris Chart-->
    <script src="/assets/libs/morris.js/morris.min.js"></script>
    <script src="/assets/libs/raphael/raphael.min.js"></script>

    <script src="/assets/js/pages/dashboard.init.js"></script>

    <script src="/assets/js/app.js"></script>


{{-- Time Display --}}
<script>
    function updateTime() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const formattedTime = `${hours}:${minutes}`; // Format as HH:MM

        // Get the formatted date (e.g., "October 24, 2024")
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const formattedDate = now.toLocaleDateString('en-US', options);

        // Update the current time and date display
        document.getElementById('current-time').innerText = formattedTime;
        document.getElementById('current-date').innerText = formattedDate;
    }

    // Update the time and date immediately and then every minute
    updateTime();
    setInterval(updateTime, 60000); // Update every minute


    </script>


{{-- Battery status and network --}}

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

{{-- REFLESH PAGE --}}

<!-- JavaScript for Modal and Click Events -->
<script>
    // Open the modal on any left-click event
    document.addEventListener('click', function (event) {
        if (event.button === 0) { // Left click only
            openModal();
        }
    });

    // Open modal function
    function openModal() {
        document.getElementById('refreshModal').style.display = 'block';
    }

    // Close modal function
    function closeModal() {
        document.getElementById('refreshModal').style.display = 'none';
    }

    // Refresh the page
    function refreshPage() {
        location.reload();
    }

    // Close modal if the user clicks outside of it
    window.onclick = function(event) {
        const modal = document.getElementById('refreshModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const welcomeSound = document.getElementById('welcome-sound');
        const hasPlayed = localStorage.getItem('welcomeSoundPlayed');

        if (!hasPlayed && welcomeSound) {
            welcomeSound.play().catch(error => {
                console.log("Autoplay was prevented by the browser:", error);
            });

            // Set the flag to prevent future plays
            localStorage.setItem('welcomeSoundPlayed', 'true');
        }
    });
</script>


<div id="welcomeModal" class="modal" style="display: none;"> <!-- Start hidden -->
    <div class="modal-content">
        <img src="/assets/images/logo-light.png" alt="Logo" class="modal-logo">
        <p class="modal-text"><strong>Welcome!</strong><br>Immerse Yourself in the Experience.</p>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Check if the welcome modal has been shown before
        if (!localStorage.getItem("welcomeModalShown")) {
            console.log("Displaying welcome modal");

            // Show the modal
            const welcomeModal = document.getElementById("welcomeModal");
            welcomeModal.style.display = "flex"; // Show modal as flex

            // Set the flag in local storage to prevent it from showing again
            localStorage.setItem("welcomeModalShown", "true");

            // Hide the modal after a few seconds
            setTimeout(() => {
                welcomeModal.style.display = "none"; // Hide the modal after a set time
            }, 5000); // Adjust time as needed
        } else {
            console.log("Welcome modal has already been shown");
        }
    });
</script>





<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log("DOM fully loaded and parsed");

        // Check if the modal has been shown before
        if (!localStorage.getItem("welcomeModalShown")) {
            console.log("Modal has not been shown before; displaying now.");

            // Show the modal
            const welcomeModal = document.getElementById("welcomeModal");
            welcomeModal.style.display = "flex";  // Ensures flex display is used

            // Set the flag in local storage to prevent it from showing again
            localStorage.setItem("welcomeModalShown", "true");

            // Hide the modal after a few seconds
            setTimeout(() => {
                welcomeModal.style.display = "none";
                console.log("Hiding modal after delay.");
            }, 5000); // Adjust duration if needed
        } else {
            console.log("Modal has already been shown, skipping display.");
        }
    });
</script>

<style>
/* Modal Styles */
.modal {
    display: none; /* Initially hidden */
    position: fixed;
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); /* Transparent black background */
    padding-top: 50px;
}

.modal-content {
    background-color: rgba(0, 0, 0, 0.9); /* Darker transparent background for content */
    margin: 5% auto;
    padding: 20px;
    border-radius: 10px;
    width: 80%;
    max-width: 400px;
    text-align: center;
}

.settings-list {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.setting-item {
    margin: 10px 0;
    display: flex;
    align-items: center;
    color: white;
    font-size: 18px;
}

.setting-item i {
    margin-right: 10px;
}

.close {
    color: white;
    font-size: 40px;
    position: absolute;
    top: 10px;
    right: 20px;
    cursor: pointer;
}

.close:hover {
    color: #ff4d4d;
}

</style>


{{-- Weather API --}}

<script>
    const apiKey = 'fbe75c4bb4610aead2d38cff92bf0581';

    async function fetchWeather(lat, lon) {
        try {
            const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`);

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();

            if (data && data.weather && data.weather.length > 0) {
                const weatherDescription = data.weather[0].description;
                const temperature = data.main.temp;
                document.getElementById('weatherStatus').innerHTML = `${weatherDescription}, ${temperature}°C`;
            } else {
                document.getElementById('weatherStatus').innerHTML = 'Weather data not available';
            }
        } catch (error) {
            console.error('Error fetching weather data:', error);
            document.getElementById('weatherStatus').innerHTML = 'Unable to load weather data';
        }
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => fetchWeather(position.coords.latitude, position.coords.longitude),
                (error) => {
                    console.warn('Geolocation failed, using default location');
                    fetchWeather(-15.4167, 28.2833); // Default to Lusaka, Zambia
                }
            );
        } else {
            document.getElementById('weatherStatus').innerHTML = 'Geolocation not supported';
        }
    }

    getLocation();
</script>

<script>// Get the modal
// Get the modal
var modal = document.getElementById("settingsModal");

// Get the button that opens the modal
var settingsMenuIcon = document.getElementById("settings-menu-icon");

// Get the <span> element that closes the modal
var closeModal = document.getElementById("closeModal");

// When the user clicks on the icon, open the modal
settingsMenuIcon.addEventListener("click", function() {
    modal.style.display = "block";
});

// When the user clicks on <span> (x), close the modal
closeModal.addEventListener("click", function() {
    modal.style.display = "none";
});

// When the user clicks anywhere outside of the modal, close it
window.addEventListener("click", function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
});

    </script>


</body>

</html>
