<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Attendances</title>
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

<body style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%);"  data-sidebar="dark">
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
                                    Are you sure you want to delete this Attendance?
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
    {{-- @include('loader.loader')
    @include('toast.success_toast') --}}
    <!-- Begin page -->
    <div id="layout-wrapper">


        @include('includes.mobile_header')

        {{-- @include('includes.mobile_sidebar') --}}

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row" >
                        <div class="col-12">
                            <div class="card rounded">
                                <div>
                                    <img src="/assets/images/small/pic.webp" class="img-fluid rounded" alt="Responsive image">
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- end row -->

                    <div class="row" >
                        <div class="col-12">
                            <div class="card" >
                                <div class="card-body">

                                    <h4 class="card-title">
                                        {{-- <a class="btn btn-info btn-sm waves-effect waves-light" href="/employee/index">
                                            <i
                                                class="dripicons-arrow-thin-left"></i></a> --}}
                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="/attendance/create">Log Attendance
                                            </a>
                                    </h4>

                                    <div class="table-rep-plugin">
                                        <div data-pattern="priority-columns">
        <!-- Search input -->
<div class="mb-3">
    <label for="search_attendance" class="form-label"><span style="font-size: 10px">Search by Name, NRC, or Email</span></label>
    <input type="text" id="search_attendance" class="form-control" placeholder="Enter Employee Name, NRC, or Email..." onkeyup="filterAttendance()" style="font-size: 10px">
</div>

<!-- Attendance Table (Hidden by default) -->
<table class="table table-striped" id="attendance_table" style="display: none;">
    <thead>
        <tr>
            <th style="font-size: 12px">Employee</th>
            <th style="font-size: 12px">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($attendances as $attendance)
            <tr class="attendance-row"
                data-employee-name="{{ strtolower($attendance->employee->name) }}"
                data-employee-nrc="{{ strtolower($attendance->employee->nrc) }}"
                data-employee-email="{{ strtolower($attendance->employee->email) }}">
                {{-- <td>{{ $loop->iteration }}</td> --}}
                <td style="font-size: 10px">{{ $attendance->employee->name }}<br> <span style="font-size: 9px; color: #7b7b7b;">
                    {{ $attendance->employee->nrc }}
                    </span>
                </td>
                <td style="font-size: 10px">{{ \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') }} -
                    {{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') : 'N/A' }}<br>
                     <span style="font-size: 9px; color: #7b7b7b;">
                        Hours Worked: {{ $attendance->hours_worked ?? 'N/A' }}
                    </span>
                </td>
                {{-- <td>{{ $attendance->employee->email }}</td>
                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y, H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($attendance->clock_in)->format('d M Y, H:i') }}</td>
                <td>{{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('d M Y, H:i') : 'N/A' }}</td>
                <td>{{ $attendance->hours_worked ?? 'N/A' }}</td>
                <td>{{ $attendance->status }}</td> --}}
                <td>
                    <div class="d-flex gap-2">
                        @if(is_null($attendance->clock_out))
                            <form action="{{ route('attendance.clockOut', $attendance->employee_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-info btn-sm waves-effect waves-light"><i class="fa fa-power-off"></i></button>
                            </form>
                        @else
                            <button type="submit" class="btn btn-success btn-sm waves-effect waves-light"> <i class="ion ion-md-checkmark-circle"></i></button>
                        @endif
                        @role('admin')
                        <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#deleteMinistryModal" data-route="{{ route('attendance.destroy', $attendance->id) }}">
                            <i class="dripicons-trash"></i>
                        </button>
                        @endrole
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    function filterAttendance() {
        let input = document.getElementById("search_attendance").value.toLowerCase().trim();
        let table = document.getElementById("attendance_table");
        let rows = document.querySelectorAll(".attendance-row");

        let found = false;
        rows.forEach(row => {
            let employeeName = row.getAttribute("data-employee-name") || "";
            let employeeNrc = row.getAttribute("data-employee-nrc") || "";
            let employeeEmail = row.getAttribute("data-employee-email") || "";

            if (employeeName.includes(input) || employeeNrc.includes(input) || employeeEmail.includes(input)) {
                row.style.display = "";
                found = true;
            } else {
                row.style.display = "none";
            }
        });

        // Show the table if at least one match is found, otherwise hide it
        table.style.display = found ? "table" : "none";
    }
</script>

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

        <!-- Bottom Navigation Menu -->
        <div class="bottom-menu d-md-none">
            <div class="menu-items">
                <a href="#" class="menu-item">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="/attendance" class="menu-item active">
                    <i class="fas fa-user-check"></i>
                    <span>Attendance</span>
                </a>

                {{-- <a href="#" class="menu-item">
                    <i class="fas fa-user"></i>
                    <span>Employee Login</span>
                </a> --}}

                <a href="{{ route('dashboard.logout') }}" class="menu-item">
                    <i class="fa fa-power-off"></i>
                    <span>Sign Off</span>
                </a>
            </div>
        </div>



        <style>
            .bottom-menu {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                background: #0d4054;
                box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
                padding: 10px 0;
                display: flex;
                justify-content: space-around;
                align-items: center;
                z-index: 1000;
            }

            .menu-items {
                display: flex;
                width: 100%;
                justify-content: space-around;
            }

            .menu-item {
                text-align: center;
                color: white;
                font-size: 10px;
                text-decoration: none;
                flex: 1;
                padding: 10px;
            }

            .menu-item i {
                display: block;
                font-size: 20px;
            }

            .menu-item.active {
                color: #00aaff;
            }
        </style>


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
