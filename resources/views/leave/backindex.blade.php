<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Leave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.png">

    <!-- Responsive Table css -->
    <link href="/assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

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

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteMinistryModal" tabindex="-1"
                        aria-labelledby="deleteMinistryModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteMinistryModalLabel">Delete Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this Leave?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <form id="deleteMinistryForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

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
                <div class="container-fluid">



                    <div class="row" >
                        <div class="col-12">
                            <div class="card" >
                                <div class="card-body">

                                    <h4 class="card-title">
                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="/leave">
                                            <i
                                                class="dripicons-arrow-thin-left"></i></a>
                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="/leave/create"><i
                                            class="dripicons-plus"></i></a>

                                            <a class="btn btn-info btn-sm waves-effect waves-light" href="/leave/create"><i
                                                class="dripicons-plus"></i></a>
                                    </h4>

                                    <div class="table-rep-plugin">
                                        <div class="table-responsive b-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Employee Name</th>
                                                        <th data-priority="1">Used Days</th>
                                                        <th data-priority="6">Leave in Monetary</th>
                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($workers->isEmpty())
                                                        <tr>
                                                            <td colspan="2" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5>No Leave Uploaded</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($workers as $worker)

                                                        @php
                                                        $totalAnnualLeave = 24; // Fixed annual leave
                                                        $usedLeaveDays = $worker->leaves->where('type', 'Annual Leave')->sum(function($leave) {
                                                            return \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1;
                                                        });
                                                        $remainingLeaveDays = max($totalAnnualLeave - $usedLeaveDays, 0);
                                                    @endphp
                                                            <tr>
                                                                <td>
                                                                    <b>{{ $worker->name }}</b>
                                                                    <br>
                                                                    <span style="font-size: 11px; color:#7a7a7a;">
                                                                        <b>Total Annual Days: {{ $totalAnnualLeave }} days</b>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <b>{{ $usedLeaveDays }} days</b>
                                                                    <br>
                                                                    <span style="font-size: 11px; color:#7a7a7a;">
                                                                        <b>Remaining Days: {{ $remainingLeaveDays }} days</b>
                                                                    </span>
                                                                </td>

                                                                <td>
                                                                    <b>{{ $totalAnnualLeave * $worker->salary->daily_earnings }}</b>
                                                                    <br>
                                                                    <span style="font-size: 11px; color:#7a7a7a;">
                                                                        <b>Annual Leave Balance: {{ $remainingLeaveDays * $worker->salary->daily_earnings }}</b>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('leave.edit', $worker->leaves->first()->slug ?? '#') }}" class="btn btn-info waves-effect waves-light">
                                                                        Add More Leave Days
                                                                    </a>
                                                                    @php
                                                                    $firstAnnualLeave = $worker->leaves->where('type', 'Annual Leave')->first();
                                                                @endphp

                                                                <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteMinistryModal"
                                                                    data-route="{{ $firstAnnualLeave ? route('leave.destroy', $firstAnnualLeave->slug) : '#' }}"
                                                                    {{ $firstAnnualLeave ? '' : 'disabled' }}>
                                                                    <i class="dripicons-trash"></i> Delete
                                                                </button>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            {{-- <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Employee Name</th>
                                                        <th data-priority="1">Used Days</th>
                                                        <th data-priority="6">Leave in Monetary</th>
                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($workers->isEmpty())
                                                        <tr>
                                                            <td colspan="2" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5>No Leave Uploaded</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($workers as $worker)

                                                        @php
                                                        $totalAnnualLeave = 24; // Fixed annual leave
                                                        $usedLeaveDays = $worker->leaves->where('type', 'Annual Leave')->sum(function($leave) {
                                                            return \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1;
                                                        });
                                                        $remainingLeaveDays = max($totalAnnualLeave - $usedLeaveDays, 0);
                                                    @endphp
                                                            <tr>
                                                                <td>
                                                                    <b>{{ $worker->name }}</b>
                                                                    <br>
                                                                    <span style="font-size: 11px; color:#7a7a7a;">
                                                                        <b>Total Annual Days: {{ $totalAnnualLeave }} days</b>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <b>{{ $usedLeaveDays }} days</b>
                                                                    <br>
                                                                    <span style="font-size: 11px; color:#7a7a7a;">
                                                                        <b>Remaining Days: {{ $remainingLeaveDays }} days</b>
                                                                    </span>
                                                                </td>

                                                                <td>
                                                                    <b>{{ $totalAnnualLeave * $worker->salary->daily_earnings }}</b>
                                                                    <br>
                                                                    <span style="font-size: 11px; color:#7a7a7a;">
                                                                        <b>Annual Leave Balance: {{ $remainingLeaveDays * $worker->salary->daily_earnings }}</b>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('leave.edit', $worker->leaves->first()->slug ?? '#') }}" class="btn btn-info waves-effect waves-light">
                                                                        Add More Leave Days
                                                                    </a>
                                                                    <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteMinistryModal" data-route="{{ route('leave.destroy', $worker->slug) }}">
                                                                        <i class="dripicons-trash"></i> Delete
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table> --}}
                                            <style>
                                                .pagination-container button.active {
                                                    background-color: #0a387d;
                                                    color: white;
                                                }

                                                .pagination-container {
                                                    display: flex;
                                                    justify-content: left;
                                                }
                                            </style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const rowsPerPage = 5; // Number of rows per page
        const table = document.querySelector("#tech-companies-1 tbody");
        const rows = Array.from(table.querySelectorAll("tr"));
        const totalRows = rows.length;
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        const paginationContainer = document.createElement("div");

        paginationContainer.className = "pagination-container mt-3";
        table.parentElement.appendChild(paginationContainer);

        function showPage(page) {
            // Hide all rows
            rows.forEach((row, index) => {
                row.style.display = "none";
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                if (index >= start && index < end) {
                    row.style.display = "table-row";
                }
            });

            // Highlight the active page number
            Array.from(paginationContainer.children).forEach((button, index) => {
                button.classList.toggle("active", index + 1 === page);
            });
        }

        function setupPagination() {
            for (let i = 1; i <= totalPages; i++) {
                const button = document.createElement("button");
                button.textContent = i;
                button.className = "btn btn-outline-primary btn-sm mx-1";
                button.addEventListener("click", () => showPage(i));
                paginationContainer.appendChild(button);
            }
        }

        setupPagination();
        if (totalPages > 0) showPage(1); // Show the first page initially
    });
</script>

                                        </div>
                                    </div>

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

 @include('includes.footer')
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
                    <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch"
                        data-bsStyle="/assets/css/bootstrap-dark.min.css"
                        data-appStyle="/assets/css/app-dark.min.css" />
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

                <div class="mb-2">
                    <img src="/assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch"
                        data-appStyle="/assets/css/app-rtl.min.css" />
                    <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                </div>

                <h6 class="mt-4">Select Custom Colors</h6>
                <div class="d-flex">

                    <ul class="list-unstyled mb-0">
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-default" value="default"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'default')" checked>
                            <label class="form-check-label" for="theme-default">Default</label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-orange" value="orange"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'orange')">
                            <label class="form-check-label" for="theme-orange">Orange</label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-teal" value="teal"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'teal')">
                            <label class="form-check-label" for="theme-teal">Teal</label>
                        </li>
                    </ul>

                    <ul class="list-unstyled mb-0 ms-4">
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-purple" value="purple"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'purple')">
                            <label class="form-check-label" for="theme-purple">Purple</label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-green" value="green"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'green')">
                            <label class="form-check-label" for="theme-green">Green</label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-red" value="red"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'red')">
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

    <!-- Responsive Table js -->
    <script src="/assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

    <!-- Init js -->
    <script src="/assets/js/pages/table-responsive.init.js"></script>

    <script src="/assets/js/app.js"></script>

    @if (Session::has('message'))
        <script>
            swal("Hi!, {{ $profileData->first_name }}", "{{ Session::get('message') }}", 'success', {
                button: true,
                button: "Close",
            });
        </script>
    @endif

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

    @include('toast.error_success_js')


</body>

</html>
