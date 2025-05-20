<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Payments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


</head>

<body style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%);"  data-sidebar="dark">

    @include('loader.loader')
<!-- Begin page -->
<div id="layout-wrapper">

    @include('includes.header')

    @include('includes.sidebar')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">


                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card text-center">
                                            <div class="mb-2 card-body text-muted">
                                                <h3 style="font-size: 15px" class="text-info mt-2">

                                                    {{ $payments->count() }}
                                                </h3>

                                                Paid Users
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card text-center">
                                            <div class="mb-2 card-body text-muted">
                                                <h3 style="font-size: 15px" class="text-info mt-2">

                                                    {{ $payments->sum('amount')  }}
                                                </h3>

                                        Total Amount of Payments
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card text-center">
                                            <div class="mb-2 card-body text-muted">
                                                <h3 style="font-size: 15px" class="text-info mt-2">

                                                    {{ $payments->sum('amount')  }}
                                                </h3>

                                        Today's Subscriptions
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-xl-3">
                                        <div class="card text-center">
                                            <div class="mb-2 card-body text-muted">
                                                <h3 style="font-size: 15px" class="text-info mt-2">
                                                    {{ formatCurrency($todayPayments->sum('amount')) }}
                                                </h3>
                                                Total Amount of Payments Today
                                            </div>
                                        </div>
                                    </div> --}}




                                </div>
                                <!-- end row -->

                                <table
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                    <tr>
                                        <th>Amount</th>
                                        <th>Names & Package Type</th>
                                        <th>Subscription Date</th>
                                    </tr>
                                </thead>

                                <tbody id="table-body">
                                    @if ($payments->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <div class="text-center" style="margin-top: 20px;">
                                                    <h5>No Donations Available</h5>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($payments as $donation)
                                            <tr>
                                                <td>
                                                    <b>{{ strtoupper($donation->currency) }}
                                                        {{ number_format($donation->amount, 0) }}</b><br>
                                                    <span style="font-size: 11px; color:#7a7a7a;">Transaction ID: {{ $donation->transaction_id }}</span>
                                                </td>
                                                <td>
                                                    <b>{{ $donation->user->name }}</b><br>
                                                    <span style="font-size: 11px; color:#7a7a7a;">
                                                        Package Type: {{ $donation->description }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @php
                                                    $dueDate = \Carbon\Carbon::parse($donation->first()->created_at)->addMonths(1);
                                                    $dueDateFormatted = $dueDate->format('F j, Y');
                                                    $createdAtFormatted = \Carbon\Carbon::parse($donation->first()->created_at)->format('F j, Y');
                                                    $isToday = $dueDate->isToday();
                                                @endphp

                                                <b style="font-size: 12px">
                                                    {{ $createdAtFormatted }}
                                                </b><br>
                                                <span style="font-size: 9px; color: rgb(125, 125, 125);">
                                                    Due On:
                                                    <span style="color: {{ $isToday ? 'red' : 'inherit' }}">
                                                        {{ $dueDateFormatted }}
                                                    </span>
                                                </span>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                            <div id="pagination" class="text-center" style="margin-top: 20px;"></div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 5;
    const tableBody = document.getElementById("table-body");
    const pagination = document.getElementById("pagination");

    const rows = Array.from(tableBody.getElementsByTagName("tr"));
    const totalRows = rows.length;
    const totalPages = Math.ceil(totalRows / rowsPerPage);

    function renderTable(page) {
        tableBody.innerHTML = "";
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.slice(start, end).forEach(row => tableBody.appendChild(row));
    }

    function renderPagination() {
        pagination.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement("button");
            button.textContent = i;
            button.className = "btn btn-sm btn-info mx-1";
            button.addEventListener("click", () => {
                renderTable(i);
                setActiveButton(i);
            });

            if (i === 1) button.classList.add("active");
            pagination.appendChild(button);
        }
    }

    function setActiveButton(page) {
        Array.from(pagination.getElementsByTagName("button")).forEach(btn => {
            btn.classList.remove("active");
        });
        pagination.getElementsByTagName("button")[page - 1].classList.add("active");
    }

    // Initialize table and pagination
    renderTable(1);
    renderPagination();
});

</script>




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

<!-- Required datatable js -->
<script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/libs/jszip/jszip.min.js"></script>
<script src="/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="/assets/js/pages/datatables.init.js"></script>

<script src="/assets/js/app.js"></script>

</body>

</html>
