<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Reminders</title>
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
