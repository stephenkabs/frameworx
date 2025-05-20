


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Attendance</title>
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
                                    Are you sure you want to delete this Department?
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
                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="/employee/index">
                                            <i
                                                class="dripicons-arrow-thin-left"></i></a>
                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="/departments/create"><i
                                            class="dripicons-plus"></i></a>
                                    </h4>

                                    <div class="table-rep-plugin">
                                        <div class="table-responsive b-0" data-pattern="priority-columns">
                                            <form action="{{ route('attendance.store') }}" method="POST">
                                                @csrf

                                                <div class="mb-3">
                                                    <label class="form-label">Date</label>
                                                    <input name="date" type="date" class="form-control" value="{{ now()->toDateString() }}" required readonly />
                                                </div>

                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Worker</th>
                                                            <th>Days Attended</th>
                                                            <th>Clock In</th>
                                                            <th>Clock Out</th>
                                                            <th>Hours Worked</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($workers as $worker)
                                                            @php
                                                                $attendanceDays = $worker->attendanceDaysCount(); // Call method to count attendance days
                                                                $attendance = $worker->attendances->where('date', now()->toDateString())->first();
                                                                $hoursWorked = null;
                                                                if ($attendance && $attendance->clock_in && $attendance->clock_out) {
                                                                    $clockIn = \Carbon\Carbon::parse($attendance->clock_in);
                                                                    $clockOut = \Carbon\Carbon::parse($attendance->clock_out);
                                                                    $hoursWorked = $clockOut->diff($clockIn)->format('%H:%I');
                                                                }
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $worker->name }}</td>
                                                                <td><span class="badge bg-primary">{{ $attendanceDays }} Days</span></td>
                                                                <td>
                                                                    @if(!$attendance || !$attendance->clock_in)
                                                                        <button type="submit" name="clock_in[{{ $worker->id }}]" class="btn btn-success">
                                                                            Clock In
                                                                        </button>
                                                                    @else
                                                                        <span class="badge bg-success">{{ $attendance->clock_in }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($attendance && $attendance->clock_in && !$attendance->clock_out)
                                                                        <button type="submit" name="clock_out[{{ $worker->id }}]" class="btn btn-danger">
                                                                            Clock Out
                                                                        </button>
                                                                    @elseif($attendance && $attendance->clock_out)
                                                                        <span class="badge bg-danger">{{ $attendance->clock_out }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($hoursWorked)
                                                                        <span class="badge bg-info">{{ $hoursWorked }} hrs</span>
                                                                    @else
                                                                        <span class="badge bg-warning">Pending</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                                <button type="submit" class="btn btn-primary">Submit Attendance</button>
                                            </form>

                                            <style>
                                                .pagination-container button.active {
                                                    background-color: #0d6efd;
                                                    color: white;
                                                }

                                                .pagination-container {
                                                    display: flex;
                                                    justify-content: center;
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


