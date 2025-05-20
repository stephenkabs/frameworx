<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Developer - Manager</title>
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

<body data-sidebar="dark" style="background: linear-gradient(135deg, #eaeff9, #ffffff);">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    {{-- Small nav css --}}
    <style>
        .sticky-nav {
            position: sticky;
            top: 0;
            background-color: #041d37;
            /* Dark background */
            display: flex;
            justify-content: flex-end;
            padding: 10px;
            z-index: 1000;
            /* Ensure it stays above other content */
            border-bottom: 1px solid #444;
            /* Optional: border for separation */
        }

        .nav-controls {
            display: flex;
            gap: 10px;
        }

        .nav-controls button {
            background-color: transparent;
            border: none;
            font-size: 16px;
            color: white;
            /* Icon color */
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-controls button:hover {
            background-color: rgba(255, 255, 255, 0.1);
            /* Light hover effect */
        }

        .top-nav {
            background-color: #444;
            /* Darker background for top nav */
            padding: 10px;
        }

        .status-icons {
            display: flex;
            align-items: center;
            color: white;
            /* White text for icons */
        }
    </style>

    <style>
        #capture {
            background-color: #007bff;
            /* Bootstrap primary color */
            color: white;
            /* White text */
            border: none;
            /* Remove default border */
            border-radius: 5px;
            /* Rounded corners */
            padding: 10px 20px;
            /* Padding for the button */
            cursor: pointer;
            /* Pointer cursor on hover */
            font-size: 16px;
            /* Font size */
        }

        #capture:hover {
            background-color: #0056b3;
            /* Darker blue on hover */
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
            background-image: url('/path-to-your-image.jpg');
            /* Replace with your image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 50px 0;
        }

        /* App-like button styles */
        .app-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            /* Auto-sizing columns for responsiveness */
            gap: 20px;
            /* Spacing between buttons */
            justify-items: center;
            padding: 20px;
            /* Optional padding around buttons */
        }

        .button-app {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            /* App icon width */
            height: 100px;
            /* App icon height */
            color: white;
            text-align: center;
            font-size: 14px;
            border-radius: 20px;
            /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* App icon shadow */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            /* Remove underline */
            overflow: hidden;
            white-space: pre-wrap;
            /* Allow line breaks inside button text */
            position: relative;
            /* For animation effect */
        }

        /* Hover effect for buttons */
        .button-app:hover {
            transform: scale(1.05);
            /* Slightly enlarge the button on hover */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
            /* Enhanced shadow on hover */
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
            color: #000;
            /* Black text for readability */
        }

        .google-btn {
            background: linear-gradient(135deg, #e59809 0%, #7a5b07 100%);
            color: #000;
            /* Black text for readability */
        }


        .recorder-btn {
            background: linear-gradient(135deg, #292828 0%, #0d0a01 100%);
            color: #bb0505;
            /* Black text for readability */
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


        .drive-btn {
            background: linear-gradient(135deg, #135e04 0%, #c1780b 100%);
        }

        /* Animation effect for buttons */
        .aanimated-btn {
            animation: pop-in 0.5s ease forwards;
            /* Animate on load */
        }




        /* Adjust animation delay for staggered effect */
        .aeChurch-btn {
            animation-delay: s;
        }

        .atestimonial-btn {
            animation-delay: 0.1s;
        }

        .agive-btn {
            animation-delay: 0.2s;
        }

        .aministries-btn {
            animation-delay: 0.3s;
        }

        .atv-btn {
            animation-delay: 0.4s;
        }

        .acontacts-btn {
            animation-delay: 0.5s;
        }

        .aapp-btn {
            animation-delay: 0.6s;
        }

        .acontactus-btn {
            animation-delay: 0.7s;
        }

        .areminder-btn {
            animation-delay: 0.9s;
        }

        .anotepad-btn {
            animation-delay: 0.9s;
        }

        .aministry-btn {
            animation-delay: 0s;
        }

        .aprograms-btn {
            animation-delay: 0.1s;
        }

        .agive-btn {
            animation-delay: 0.2s;
        }
    </style>

    @include('includes.iconscss')



    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- Sticky Navigation Bar -->



        @include('includes.header')
        @include('includes.sidebar')



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">


            <div class="page-content">
                <div class="container-fluid">


                    <div class="row">
                        {{-- <p style="font-size: 14px;color:white"><strong>{{ $profileData->name }}'s Installed Apps</strong></p> --}}



                        {{-- <div class="col-lg-12">
                            <div style="position: relative; width: fit-content;">
                                <!-- The card with gradient background -->
                                <div
                                    style="position: relative; top: 70px; left: 300px; display: flex; align-items: center; background: linear-gradient(135deg, #1e3c72, #2a5298); padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    <div
                                        style="display: flex; flex-direction: column; align-items: center; margin-right: 10px;">
                                        <div style="height: 50px; width: 2px; background-color: white;"></div>
                                    </div>
                                    <span style="color: white; font-size: 12px; font-weight: 100; line-height: 1.5;">
                                        ⚠️ <strong>Warning:</strong> You are accessing the Developer Dashboard. Please proceed with caution!
                                        Modifying settings here can impact the entire system, <br>especially if the application is in <strong>Production Mode</strong>.
                                        Ensure you have a backup and understand the <br>consequences of your actions before making any changes.
                                    </span>
                                </div>
                            </div>
                        </div --}}








                                <!-- Add more items as needed -->
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <a href="/role" style="text-decoration: none;">
                                        <div class="d-flex align-items-center p-3"
                                            style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                            <div class="icon-container me-3"
                                                style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                                <i class="ion ion-md-construct" style="font-size: 24px; color: #555;"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Roles</h6>
                                                <p style="font-size: 10px" class="mb-0 text-muted">Access Guides and Resources</p>
                                            </div>

                                        </div>
                                    </a>
                                </div>

                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/permission" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-checkbox-outline" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Permissions</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Access Guides and Resources</p>
                                    </div>

                                </div>
                            </a>
                        </div>

                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/terminal/form" style="text-decoration: none;" target="blank" >
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-code-working" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Terminal</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Access Terminal for your Simple Commands</p>
                                    </div>

                                </div>
                            </a>
                        </div>

                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/setting" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="fas fa-globe" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Web Settings</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Manage Your Web Settings Preferences</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/heros" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-information-circle"
                                            style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Web Information</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Manage Your Linked Accounts</p>
                                    </div>

                                </div>
                            </a>
                        </div>


                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/background" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-aperture" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Web Images</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Customize Your images Settings</p>
                                    </div>

                                </div>
                            </a>
                        </div>



                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/stores" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="far fa-paper-plane" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Computer Apps & Links</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Manage Your Links & Icons Preferences</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Add more items as needed -->
                        {{-- <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/windows/traffic" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-analytics" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Live Online Traffic</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Monitor Real-Time Traffic Updates</p>
                                    </div>

                                </div>
                            </a>
                        </div> --}}


                          <!-- Add more items as needed -->
                          {{-- <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/pricingPlan" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-logo-usd" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">VM Pricing and Features</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Manage your VM's Pricing and Features</p>
                                    </div>

                                </div>
                            </a>
                        </div> --}}

                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/categories" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="far fa-object-group" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">General Categories</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Manage Your Category Preferences</p>
                                    </div>

                                </div>
                            </a>
                        </div>

                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/email-config" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="far fa-envelope" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Email Settings</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Manage Your Email Preferences</p>
                                    </div>

                                </div>
                            </a>
                        </div>


                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/user" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="dripicons-lock" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Users Permissions & Roles</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Manage Your Users/permissions and roles Preferences
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                      <!-- Copy and Paste this section for more items -->
                      {{-- <div class="col-lg-4 col-md-6 mb-4">
                        <a href="/broadcast" style="text-decoration: none;">
                            <div class="d-flex align-items-center p-3"
                                style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                <div class="icon-container me-3"
                                    style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                    <i class="ion ion-md-film" style="font-size: 24px; color: #555;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Live Broadcasting</h6>
                                    <p style="font-size: 10px" class="mb-0 text-muted">Broadcast Live YouTube Channels to VM</p>
                                </div>

                            </div>
                        </a>
                    </div> --}}

                        <!-- Add more items as needed -->
                        {{-- <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/admin/index" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-close-circle" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Trace System Errors</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Identify, Analyze, and Resolve Issues Effectively</p>
                                    </div>

                                </div>
                            </a>
                        </div> --}}

                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/doc" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-apps" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">System Documentation</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">Manage System Documentation.
                                        </p>
                                    </div>

                                </div>
                            </a>
                        </div>



                    </div>



                    <style>
                        .hover-expand {
                            border-radius: 10px;
                            transition: transform 0.3s ease;
                            /* Smooth transition for the transform property */
                            overflow: hidden;
                            /* Prevents overflow during the animation */
                        }

                        .hover-expand:hover {
                            transform: scale(1.05);
                            /* Slightly increase size on hover */
                        }
                    </style>


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
        $('#deleteMinistryModal').on('show.bs.modal', function(event) {
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
        navigator.mediaDevices.getUserMedia({
                video: true
            })
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
        window.onerror = function(message, source, lineno, colno, error) {
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
        let uploadedPhotosCount = 0; // This will track the number of uploaded photos

        // Function to handle photo upload
        function handlePhotoUpload() {
            // Check if the user has reached the limit
            if (uploadedPhotosCount >= PHOTO_LIMIT) {
                showPhotoLimitNotice();
                return false; // Prevent the upload
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

s






</body>

</html>
