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

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


</head>

<body style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%);" data-sidebar="dark">
    {{-- @include('loader.loader')
    @include('includes.validation') --}}
    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.mobile_header')

        {{-- @include('includes.mobile_sidebar') --}}

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

        <a href="/windows/off" class="menu-item">
            <i class="fa fa-power-off"></i>
            <span>App Logout</span>
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
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title"><a class="btn btn-info waves-effect waves-light"
                                            href="/attendance"><i class="dripicons-arrow-thin-left"></i></a></h4><br>

                                    <form class="row needs-validation" action="{{ route('attendance.store') }}"
                                        novalidate method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Search input for employees -->
                                        <div class="mb-3">
                                            <label for="search_employee" class="form-label"><span style="font-size: 12px">Search Employee</span></label>
                                            <input type="text" id="search_employee" class="form-control" style="font-size: 12px"
                                                placeholder="Enter NRC, Name, or Email..." onkeyup="filterEmployees()">
                                        </div>

                                        <!-- Employee Dropdown (Hidden) -->
                                        <div class="mb-3">
                                        <select   id="employee_id" class="form-control" name="employee_id"
                                            onchange="fillEmployeeDetails()" style="display: none; font-size: 12px;">
                                            <option value="" disabled selected>Select Employee</option>
                                            @foreach ($employees as $employee)
                                                <option  value="{{ $employee->id }}" data-nrc="{{ $employee->nrc }}"
                                                    data-name="{{ $employee->name }}"
                                                    data-email="{{ $employee->email }}">
                                                    {{ $employee->nrc }} - {{ $employee->name }}
                                                    {{-- {{ $employee->email }} --}}
                                                </option>
                                            @endforeach
                                        </select>
                                        </div>



                                        <!-- Hidden Date Field with Today's Date -->
                                        <input type="hidden" name="date" id="date" value="{{ date('Y-m-d') }}">

                                        <div class="mb-3">
                                            <label class="form-label"><span style="font-size: 12px">Status</span></label>
                                            <select style="font-size: 13px" name="status" class="form-select">
                                                <option  value="" disabled selected>Select Status</option>
                                                <option value="Present">Present</option>
                                                <option value="Absent">Absent</option>
                                                <option value="Late">Late</option>
                                            </select>
                                        </div>

                                        <div class="mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-info btn-sm waves-effect waves-light">
                                                    Register Attendance
                                                </button>
                                                <button type="reset" class="btn btn-secondary btn-sm  waves-effect ms-3">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <script>
                                        function filterEmployees() {
                                            let input = document.getElementById("search_employee").value.toLowerCase();
                                            let select = document.getElementById("employee_id");
                                            let options = select.getElementsByTagName("option");
                                            let employeeDetails = document.getElementById("employee_details");

                                            let foundEmployee = null;

                                            // Loop through all employees
                                            for (let i = 1; i < options.length; i++) { // Start from index 1 to skip "Select Employee"
                                                let nrc = options[i].getAttribute("data-nrc")?.toLowerCase() || "";
                                                let name = options[i].getAttribute("data-name")?.toLowerCase() || "";
                                                let email = options[i].getAttribute("data-email")?.toLowerCase() || "";

                                                if (nrc.includes(input) || name.includes(input) || email.includes(input)) {
                                                    foundEmployee = options[i];
                                                    break; // Stop at first match
                                                }
                                            }

                                            if (foundEmployee) {
                                                select.style.display = "block";
                                                select.value = foundEmployee.value; // Select the matched employee
                                                fillEmployeeDetails();
                                                employeeDetails.style.display = "block"; // Show NRC, Name, Email
                                            } else {
                                                select.style.display = "none";
                                                employeeDetails.style.display = "none"; // Hide NRC, Name, Email
                                                document.getElementById("nrc").value = "";
                                                document.getElementById("name").value = "";
                                                document.getElementById("email").value = "";
                                            }
                                        }

                                        function fillEmployeeDetails() {
                                            let select = document.getElementById("employee_id");
                                            let selectedOption = select.options[select.selectedIndex];

                                            if (!selectedOption) return;

                                            document.getElementById("nrc").value = selectedOption.getAttribute("data-nrc") || "";
                                            document.getElementById("name").value = selectedOption.getAttribute("data-name") || "";
                                            document.getElementById("email").value = selectedOption.getAttribute("data-email") || "";
                                        }
                                    </script>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <!-- end col -->
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            {{-- @include('includes.taskbar') --}}
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

</body>

</html>
