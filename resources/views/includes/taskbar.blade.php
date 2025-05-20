<style>/* Sticky taskbar centered at the bottom */
    /* Sticky taskbar centered at the bottom */

    .sticky-taskbar {
        position: fixed;
        bottom: 0; /* Adjust based on your design */
        left: 0;
        right: 0;
        background: #fff; /* Change as per your design */
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    }

    .taskbar-buttons {
        display: flex;
        justify-content: center;
        padding: 10px;
    }

    .taskbar-icon {
        position: relative; /* Needed for absolute positioning of tooltip */
        margin: 0 5px; /* Spacing between icons */
        text-align: center;
        color: #000; /* Change color as needed */
        text-decoration: none;
    }

    .tooltip {
        visibility: hidden; /* Initially hidden */
        width: 120px; /* Adjust as needed */
        background-color: #555; /* Tooltip background */
        color: #fff; /* Tooltip text color */
        text-align: center;
        border-radius: 5px;
        padding: 5px 0;

        /* Positioning */
        position: absolute;
        bottom: 100%; /* Position above the icon */
        left: 50%;
        margin-left: -60px; /* Center the tooltip */
        opacity: 0; /* Make it transparent */
        transition: opacity 0.3s; /* Smooth transition */
    }

    .taskbar-icon:hover .tooltip {
        visibility: visible; /* Show tooltip on hover */
        opacity: 1; /* Fully opaque */
    }


    .main-content {
        /* background-image: url('/assets/images/backs.png'); */
        background-size: cover; /* Ensures the image covers the entire div */
        background-position: center; /* Centers the image */
        background-repeat: no-repeat; /* Prevents the image from repeating */
        min-height: 100vh; /* Ensures the div takes up at least the full height of the viewport */
        position: relative; /* Allows positioning of elements within */
        padding: 20px;

    }
    .main-content {
        position: sticky;
        top: -50;
        z-index: 100; /* Ensures it stays above other elements */
        background-color: #yourColor; /* Optionally set a background color */
    }

    .sticky-taskbar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 80px; /* Increased height for icon and text */
        background: rgba(0, 0, 0, 0.8); /* Semi-transparent background */
        display: flex;
        justify-content: center; /* Center the icons horizontally */
        align-items: center;
        z-index: 1000;
        padding: 10px 0;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.5);
    }

    /* Taskbar buttons */
    .taskbar-buttons {
        display: flex;
        gap: 05px; /* Space between icons */
    }

    /* Each app icon in the taskbar */
    .taskbar-icon {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 70px;
        color: white; /* Default icon color */
        font-size: 40px; /* Icon size */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none; /* Remove underline from links */
    }

    .taskbar-icon i {
        font-size: 30px; /* Icon size */
        margin-bottom: 3px; /* Space between icon and text */
    }

    /* Text under the icon */
    .taskbar-icon span {
        font-size: 12px; /* Font size of the text */
        color: white; /* Default text color */
    }

    /* Icon hover effect */
    .taskbar-icon:hover {
        transform: scale(1.3); /* Scale the icon slightly */
        /* box-shadow: 0 4px 4px rgba(255, 255, 255, 0.6); Add shadow */
    }

    /* Different colors for each icon */
    .eChurch-btn i {

        color: #e9e9e9; /* Lime Green */
        background: linear-gradient(135deg, #066523 0%, #1d8f43 50%, #156b32 100%);
        padding: 10px;
        border-radius: 5px;
    }
    .testimonial-btn i {

        color: #e9e9e9; /* Lime Green */
        background: linear-gradient(135deg, #572606 0%, #7c3a1d 50%, #572811 100%);
        padding: 10px;
        border-radius: 5px;
    }
    .give-btn i {

        color: #e9e9e9; /* Lime Green */
        background: linear-gradient(135deg, #36e7f4 0%, #075f7a 50%, #022235 100%);
        padding: 10px;
        border-radius: 5px;
    }
    .ministries-btn i {

        color: #e9e9e9; /* Lime Green */
        background: linear-gradient(135deg, #2196F3 0%, #6EC6FF 100%);
        padding: 10px;
        border-radius: 5px;
    }
    .tv-btn i {
        color: #e9e9e9; /* Lime Green */
        background: linear-gradient(135deg, #9C27B0 0%, #D5006D 100%);
        padding: 10px;
        border-radius: 5px;
    }
    .contacts-btn i {
        color: #e9e9e9; /* Lime Green */
        background: linear-gradient(135deg, #04d1ff 0%, #073688 100%);
        padding: 10px;
        border-radius: 5px;
    }
    .app-btn i {
        color: #e9e9e9; /* Lime Green */
        background: linear-gradient(135deg, #3F51B5 0%, #162158 100%);
        padding: 10px;
        border-radius: 5px;

    }
    .contactus-btn i {
        color: #e9e9e9; /* Lime Green */
        background: linear-gradient(135deg, #ea3939 0%, #97031e 100%);
        padding: 10px;
        border-radius: 5px;
    }
    .contact-btn i {
        color: #e9e9e9; /* Lime Green */
        background: linear-gradient(135deg, #9C27B0 0%, #D5006D 100%);
        padding: 10px;
        border-radius: 5px;
    }

    /* Adjust icon size and layout for mobile */
    /* @media (max-width: 768px) {
        .taskbar-icon {
            width: 50px;
            font-size: 25px;
        }

        .taskbar-icon i {
            font-size: 25px;
        }

        .taskbar-icon span {
            font-size: 10px;
        }
    } */

            </style>

               <!-- Sticky Taskbar with App Links -->
   <div class="sticky-taskbar">
    <div class="container text-center taskbar-buttons">
        <a class="taskbar-icon eChurch-btn" href="/dashboard">
            <i class="ion ion-ios-home"></i>
            <span class="tooltip">Home</span>
        </a>
        <a class="taskbar-icon testimonial-btn" href="/windows/apps_widget">
            <i class="ion ion-md-apps"></i>
            <span class="tooltip">App Widget</span>
        </a>
        <a class="taskbar-icon give-btn" href="/apps">
            <i class="ion ion-md-appstore"></i>
            <span class="tooltip">Plus App Store</span>
        </a>

        <a class="taskbar-icon tv-btn" href="/windows/live_channels">
            <i class="ion ion-ios-videocam"></i>
            <span class="tooltip">Live Channels</span>
        </a>
        <a class="taskbar-icon contactus-btn" href="https://music.apple.com/" target="blank">
            <i class="fab fa-itunes-note"></i>
            <span class="tooltip">Apple Music</span>
        </a>


        <a class="taskbar-icon contacts-btn" href="/word/create">
            <i class="fas fa-file-word"></i>
            <span class="tooltip">Plus Word</span>
        </a>

        <a class="taskbar-icon ministries-btn" href="/windows/settings">
            <i class="ion ion-md-cog"></i>
            <span class="tooltip">Settings</span>
        </a>

        {{-- <a class="taskbar-icon app-btn" href="/windows/user_profile">
            <i class="ion ion-md-person"></i>
            <span class="tooltip">{{ $user->name }}'s Profile</span>
        </a> --}}
        <a class="taskbar-icon contact-btn" href="/windows/off">
            <i class="ion ion-md-power"></i>
            <span class="tooltip">Power Off</span>
        </a>
    </div>
</div>
