<!-- ========== Left Sidebar Start ========== -->

<style>    .vertical-menu {
    width: 240px;  /* Sidebar width */
    height: 1800px; /* Set the height to 70px */

    overflow: hidden;  /* Hide overflow content */
    background-color: #fff; /* You can set the background color to your preference */
}</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div  id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title"><hr></li>
                <li>
                    <a href="/attendance" class="waves-effect" target="blank">
                        <i class="fas fa-check-circle"></i>
                        <span style="font-size: 14px"><b>Attendance</b></span>
                    </a>
                </li>

                <li>
                    <a href="/dashboard" class="waves-effect">
                        <i class="dripicons-device-desktop"></i>
                        <span style="font-size: 14px"><b>Home</b></span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-arrow-circle-down"></i>
                        <span style="font-size: 14px"> <b>Excel Statements</b> </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('payslip_normal.exportToExcel') }}"><span style="font-size: 14px">Monthly Report</a></span></li>
                        <li><a href="{{ route('payslip_bank.exportToExcel') }}"><span style="font-size: 14px">Bank Statement</a></span></li>
                        <li><a href="{{ route('payslip_mobile.exportToExcel') }}"><span style="font-size: 14px">Mobile Money Statement</a></span></li>
                        <li><a href="{{ route('payslip.exportToExcel') }}"><span style="font-size: 14px">Advances Report</a></span></li>
                        <li><a href="{{ route('reports.days.exportToExcel') }}"><span style="font-size: 14px">Attendance Report</a></span></li>


                        {{-- <li><a href="/branches"><span style="font-size: 14px">Branches</a></span></li>
                        <li><a href="/worker"><span style="font-size: 14px">Employees</a></span></li>
                        <li><a href="/payslip"><span style="font-size: 14px">Payslips</a></span></li> --}}
                    </ul>

                    <style>
                        .sub-menu {
                            font-size: 12px;
                            line-height: 17px; /* Improved readability */
                        }
                    </style>

                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ion ion-md-people"></i>
                        <span style="font-size: 14px"> <b>Human Resource</b> </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/worker"><span style="font-size: 14px">Employees</a></span></li>
                        <li><a href="/branches"><span style="font-size: 14px">Branches</a></span></li>
                        <li><a href="/departments"><span style="font-size: 14px">Departments</a></span></li>
                        <li><a href="/tasks"><span style="font-size: 14px">Tasks</a></span></li>
                        <li><a href="/leave"><span style="font-size: 14px">Leave</a></span></li>
                        <li><a href="/payslip"><span style="font-size: 14px">Payrolls</a></span></li>

                    </ul>

                    <style>
                        .sub-menu {
                            font-size: 12px;
                            line-height: 17px; /* Improved readability */
                        }
                    </style>

                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ion ion-ios-paper"></i>
                        <span style="font-size: 14px"> <b>Finance</b> </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/advance"><span style="font-size: 14px">Advance Loan</a></span></li>
                        <li><a href="/client"><span style="font-size: 14px">Customers</a></span></li>
                        <li><a href="/quotations"><span style="font-size: 14px">Quotations</a></span></li>
                        <li><a href="/profit"><span style="font-size: 14px">Sales</a></span></li>
                        <li><a href="/asset"><span style="font-size: 14px">Assets</a></span></li>
                        <li><a href="/expenses"><span style="font-size: 14px">Expenses</a></span></li>
                        <li><a href="/details"><span style="font-size: 14px">Business Settings</a></span></li>
                        {{-- <li><a href="/job"><span style="font-size: 14px">Job Cards</a></span></li>
                        <li><a href="/cash"><span style="font-size: 14px">Cash Book</a></span></li> --}}

                    </ul>

                    <style>
                        .sub-menu {
                            font-size: 12px;
                            line-height: 18px; /* Improved readability */
                        }
                    </style>

                </li>

                <li>
                    <a href="/apps/menu" class="waves-effect">
                        <i class="fab fa-react"></i>
                        <span style="font-size: 14px"><b>Ai Automates Apps</b></span>
                    </a>
                </li>
@role('admin')
                <li>
                    <a href="/restricted/developer_dashboard" class="waves-effect">
                        <i class="dripicons-gear"></i>
                        <span style="font-size: 14px"><b>General Settings</b></span>
                    </a>
                </li>
                @endrole

<br>
<li style="background-color: rgb(66, 103, 153); border-radius: 40px;">
    <a href="" class="waves-effect">
        {{-- <i class="dripicons-lock"></i> --}}
        <span style="font-size: 13px">
            @if(auth()->user()->image) <!-- Check if image is uploaded -->
                <img class="rounded-circle header-profile-user" src="{{ asset('users/images/' . auth()->user()->image) }}" alt="Header Avatar">
            @else
                <img class="rounded-circle header-profile-user" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7F9CF5&background=EBF4FF" alt="Header Avatar">
            @endif
            &nbsp;&nbsp;&nbsp;<b>
                <span id="user-name">{{ auth()->user()->name }}</span>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const userNameElement = document.getElementById("user-name");
                        if (userNameElement) {
                            const fullName = userNameElement.textContent.trim();
                            const limitedName = fullName.split(" ").slice(0, 1).join(" ");
                            userNameElement.textContent = limitedName;
                        }
                    });
                </script>


            </b>
            <span style="display:inline-block; width: 8px; height: 8px; background-color: rgb(14, 196, 14); border-radius: 50%; margin-left: 5px;"></span>
        </span>

    </a>
</li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
