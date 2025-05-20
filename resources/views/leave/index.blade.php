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


                                    </h4>

                                    <table id="tech-companies-1" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Leave Type</th>
                                                <th>Days</th>
                                                <th>Leave Monetary</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($leave->isEmpty())
                                                <tr>
                                                    <td colspan="8" class="text-center">
                                                        <div style="margin-top: 20px;">
                                                            <h5>No Leave Records Found</h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($workers as $worker)
                                                    @php
                                                        $totalAnnualLeave = 24; // Fixed annual leave days
                                                        $usedAnnualLeaveDays = $worker->leaves->where('type', 'Annual Leave')->sum(function ($leave) {
                                                            return \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1;
                                                        });
                                                        $remainingAnnualLeaveDays = max($totalAnnualLeave - $usedAnnualLeaveDays, 0);
                                                    @endphp

                                                    @foreach ($worker->leaves as $leave)
                                                        @php
                                                            $usedLeaveDays = \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1;
                                                            $leaveMonetaryValue = $usedLeaveDays * $worker->salary->daily_earnings;

                                                        @endphp

                                                        <tr>
                                                            <td>
                                                                <b>{{ $worker->name }}<br>
                                                                    <span style="font-size: 11px; color:#7a7a7a;">
                                                                        <b>Employee MAN ID: {{ $worker->tracking_code }}</b>
                                                                    </span></b>
                                                            </td>
                                                            <td><b>{{ $leave->type }}</b><br>
                                                                <span style="font-size: 11px; color:#7a7a7a;">
                                                                    <b>Dates: {{ \Carbon\Carbon::parse($leave->start_date)->format('d M ') }} - {{ \Carbon\Carbon::parse($leave->end_date)->format('d M ') }}</b>
                                                                </span></b>
                                                            </td>

                                                            <td>
                                                                <b>{{ $usedLeaveDays }} days</b><br>

                                                                <span style="font-size: 11px; color:#7a7a7a;">@if($leave->type === 'Annual Leave')
                                                                    <b>Remaining Days: {{ $remainingAnnualLeaveDays }} days</b>
                                                                @else
                                                                    <span style="color: gray;">None Annual Type</span>
                                                                @endif</span>
                                                            </td>
                                                            <td>
                                                                <b>{{ number_format($leaveMonetaryValue, 2) }}</b><br>

                                                                <span style="font-size: 11px; color:#7a7a7a;">
                                                                    <b>Monetary Leave Balance</b>
                                                                </span></b>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('leave.edit', $leave->slug) }}" class="btn btn-info">
                                                                    Edit
                                                                </a>
                                                                <button type="button" class="btn btn-danger delete-leave-btn"
                                                                    data-bs-toggle="modal" data-bs-target="#deleteMinistryModal"
                                                                    data-route="{{ route('leave.destroy', $leave->slug) }}">
                                                                    <i class="dripicons-trash"></i> Delete
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
