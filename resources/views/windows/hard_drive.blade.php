<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>This PC</title>
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

<!-- Loader -->
@include('loader.loader')
@include('toast.success_toast')
<!-- Begin page -->
<div id="layout-wrapper">

@include('includes.header')

@include('includes.sidebar')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid" style="padding: 20px; color: #000;">
                <div class="row">

                    <div class="col-md-6 mb-4">
                        <a href="/folder">
                            <div class="d-flex align-items-center p-3"
                                style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                <div class="icon-container me-3"
                                    style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                    <i class="fas fa-hdd" style="font-size: 24px; color: #555;"></i>
                                </div>
                                <div style="flex-grow: 1;">
                                    <h6 class="mb-0">Local Drive</h6>
                                    <p class="mb-0 text-muted">
                                        {{ number_format($totalUsedSpace / (1024 * 1024), 2) }} GB /
                                        {{ number_format($totalStorage / (1024 * 1024), 2) }} GB
                                    </p>
                                    <div style="background-color: #eee; border-radius: 5px; height: 10px; margin-top: 5px; width: 100%;">
                                        <div id="progress-bar"
                                            style="background-color: {{ $usedPercentage >= 80 ? 'red' : 'black' }};
                                                   width: {{ $usedPercentage }}%;
                                                   height: 100%;
                                                   border-radius: 5px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const progressBarContainer = document.getElementById('progress-bar-container');
        const progressBar = document.getElementById('progress-bar');

        if (progressBarContainer && progressBar) {
            const folderCount = parseInt(progressBarContainer.getAttribute('data-folder-count'), 10);
            const folderLimit = parseInt(progressBarContainer.getAttribute('data-folder-limit'), 10);

            // Calculate the percentage usage
            const usagePercentage = (folderCount / folderLimit) * 100;

            // Update progress bar width
            progressBar.style.width = usagePercentage + '%';

            // Change progress bar color based on folder usage
            if (folderCount >= 8) {
                progressBar.style.backgroundColor = 'red'; // Turn red when almost full
            } else if (folderCount === 0) {
                progressBar.style.width = '10px'; // Small width for no usage
            } else {
                progressBar.style.backgroundColor = 'black'; // Default color
            }
        }
    });
</script>


                    <!-- Local Drive 2 -->
                    <div class="col-md-6 mb-4">
                        <a href="https://drive.google.com/">
                        <div class="d-flex align-items-center p-3"
                            style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                            <div class="icon-container me-3"
                                style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                <i class="fab fa-google-drive" style="font-size: 24px; color: #555;"></i>
                            </div>
                            <div style="flex-grow: 1;">
                                <h6 class="mb-0">Google Drive</h6>
                                <p class="mb-0 text-muted">15 GB</p>
                                <div style="background-color: #eee; border-radius: 5px; height: 10px; margin-top: 5px; width: 100%;">
                                    <div style="background-color: black; width: 50%; height: 100%; border-radius: 5px;"></div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                </div>
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
@include('toast.error_success_js')


<script>
    document.getElementById('connectBluetooth').addEventListener('click', async () => {
        try {
            const options = {
                filters: [{ services: ['battery_service'] }] // Change to the desired service
            };

            // Request a Bluetooth device
            const device = await navigator.bluetooth.requestDevice(options);

            // Connect to the GATT server
            const server = await device.gatt.connect();
            document.getElementById('status').innerText = `Connected to ${device.name}`;

            // Optionally, get a specific service
            const service = await server.getPrimaryService('battery_service');

            // You can read characteristics, etc.
            const batteryLevelCharacteristic = await service.getCharacteristic('battery_level');
            const batteryLevel = await batteryLevelCharacteristic.readValue();
            const batteryPercentage = batteryLevel.getUint8(0);
            document.getElementById('status').innerText += `\nBattery Level: ${batteryPercentage}%`;

        } catch (error) {
            console.error('Error connecting to Bluetooth device:', error);
            document.getElementById('status').innerText = "Paired Unsuccessful";
        }
    });
</script>

</body>

</html>
