<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $worker->name }} - Profile</title>
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

<body data-sidebar="dark">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Apply for Leave Modal -->
    <div class="modal fade" id="applyLeaveModal" tabindex="-1" aria-labelledby="applyLeaveModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyLeaveModalLabel">Apply for Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="leaveForm" action="{{ route('leave.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Leave Type</label>
                            <select name="type" class="form-select" id="leaveType" required>
                                <option value="" disabled selected>Select Leave Type</option>
                                <option value="Annual Leave">Annual Leave</option>
                                <option value="Sick Leave">Sick Leave</option>
                                <option value="Maternity Leave">Maternity Leave</option>
                                <option value="Paternity Leave">Paternity Leave</option>
                                <option value="Compassionate Leave">Compassionate Leave</option>
                                <option value="Study Leave">Study Leave</option>
                                <option value="Leave Without Pay">Leave Without Pay</option>
                                <option value="Special Leave">Special Leave</option>
                                <option value="Casual Leave">Casual Leave</option>
                                <option value="Public Holiday Leave">Public Holiday Leave</option>
                            </select>
                        </div>

                        <!-- Show Annual Leave Balance Only for Annual Leave -->
                        <div id="annualLeaveSection" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">Remaining Leave Days:</label>
                                <input type="text" class="form-control" id="remainingLeaveDays"
                                    value="{{ $worker->annual_leave_balance ?? 24 }} days" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>

                        <!-- Hidden Worker ID -->
                        <input type="hidden" name="worker_id" value="{{ $worker->id ?? '' }}">

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Leave Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const leaveTypeSelect = document.getElementById("leaveType");
            const annualLeaveSection = document.getElementById("annualLeaveSection");
            const remainingLeaveDaysInput = document.getElementById("remainingLeaveDays");
            const startDateInput = document.getElementById("start_date");
            const endDateInput = document.getElementById("end_date");
            const leaveForm = document.getElementById("leaveForm");

            let leaveBalance = parseInt("{{ $worker->annual_leave_balance ?? 24 }}") || 0;

            leaveTypeSelect.addEventListener("change", function() {
                if (leaveTypeSelect.value === "Annual Leave") {
                    annualLeaveSection.style.display = "block";
                } else {
                    annualLeaveSection.style.display = "none";
                }
            });

            leaveForm.addEventListener("submit", function(event) {
                const leaveType = leaveTypeSelect.value;
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);
                const leaveDays = (endDate - startDate) / (1000 * 60 * 60 * 24) + 1;

                if (leaveType === "Annual Leave" && leaveDays > leaveBalance) {
                    event.preventDefault();
                    alert("You don't have enough leave balance! You only have " + leaveBalance +
                        " days left.");
                }
            });
        });
    </script>



    <!-- Add Salary Modal -->
    <div class="modal fade" id="addSalaryModal" tabindex="-1" aria-labelledby="addSalaryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form method="POST" action="{{ route('salaries.store') }}" style="width: 75%">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSalaryModalLabel">Add Salary</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="worker_id" value="{{ $worker->id }}">

                            <!-- First Column -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="basic_pay" class="form-label">Basic Pay</label>
                                    <input type="number" class="form-control" id="basic_pay" name="basic_salary"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="housing_allowance" class="form-label">Housing Allowance</label>
                                    <input type="number" class="form-control" id="housing_allowance"
                                        name="housing_allowance" placeholder="Enter 30% of Basic Pay. (By Law)">
                                </div>
                                <div class="mb-3">
                                    <label for="transport_allowance" class="form-label">Transport Allowance</label>
                                    <input type="number" class="form-control" id="transport_allowance"
                                        name="transport_allowance">
                                </div>
                                <div class="mb-3">
                                    <label for="food_allowance" class="form-label">Food Allowance</label>
                                    <input type="number" class="form-control" id="food_allowance"
                                        name="food_allowance">
                                </div>
                                <div class="mb-3">
                                    <label for="other_allowance" class="form-label">Other Allowance</label>
                                    <input type="number" class="form-control" id="other_allowance"
                                        name="other_allowance">
                                </div>
                            </div>

                            <!-- Second Column -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="monthly_working_days" class="form-label">Monthly Working Days</label>
                                    <input type="number" class="form-control" id="monthly_working_days"
                                        name="monthly_working_days" value="24">
                                </div>
                                <div class="mb-3">
                                    <label for="hours_per_day" class="form-label">Hours Per Day</label>
                                    <input type="number" class="form-control" id="hours_per_day"
                                        name="hours_per_day" value="8">
                                </div>
                                <div class="mb-3">
                                    <label for="daily_hourly" class="form-label">Hourly Rate</label>
                                    <input type="number" class="form-control" id="daily_hourly" name="daily_hourly"
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="daily_earnings" class="form-label">Daily Earnings</label>
                                    <input type="number" class="form-control" id="daily_earnings"
                                        name="daily_earnings" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="monthly_gross" class="form-label">Total Gross Salary</label>
                                    <input type="number" class="form-control" id="monthly_gross"
                                        name="monthly_gross" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Deductions -->
                        <div class="row">
                            <!-- Payee (Tax) -->
                            {{-- <div class="col-md-6">
                                <label for="payee_percent" class="form-label">PAYEE Tax (%)</label> --}}
                                <input type="hidden" class="form-control" id="payee_percent" >
                            {{-- </div> --}}
                            <div class="col-md-6">
                                <label for="payee" class="form-label">PAYEE Tax</label>
                                <input type="number" class="form-control" id="payee" name="payee" readonly>
                            </div>

                            <!-- NAPSA (Pension Contribution) -->
                            <div class="col-md-6">
                                <label for="napsa_percent" class="form-label">NAPSA (%)</label>
                                <input type="number" class="form-control" id="napsa_percent" value="5">
                            </div>
                            <div class="col-md-6">
                                <label for="napsa" class="form-label">NAPSA Amount</label>
                                <input type="number" class="form-control" id="napsa" name="napsa" readonly>
                            </div>

                            <!-- NHIMA (Health Contribution) -->
                            <div class="col-md-6">
                                <label for="nhima_percent" class="form-label">NHIMA (%)</label>
                                <input type="number" class="form-control" id="nhima_percent" value="1">
                            </div>
                            <div class="col-md-6">
                                <label for="nhima" class="form-label">NHIMA Amount</label>
                                <input type="number" class="form-control" id="nhima" name="nhima" readonly>
                            </div>
                        </div>

                        <!-- Net Pay -->
                        <div class="mb-3">
                            <label for="net_pay" class="form-label">Net Pay</label>
                            <input type="number" class="form-control" id="net_pay" name="net_pay" readonly>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Salary</button>
                    </div>
                </div>
            </form>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const basicPayInput = document.getElementById("basic_pay");
                    const housingAllowance = document.getElementById("housing_allowance");
                    const transportAllowance = document.getElementById("transport_allowance");
                    const foodAllowance = document.getElementById("food_allowance");
                    const otherAllowance = document.getElementById("other_allowance");
                    const monthlyWorkingDays = document.getElementById("monthly_working_days");
                    const hoursPerDay = document.getElementById("hours_per_day");
                    const hourlyRate = document.getElementById("daily_hourly");
                    const dailyEarnings = document.getElementById("daily_earnings");
                    const totalGrossSalary = document.getElementById("monthly_gross");
                    const payeePercent = document.getElementById("payee_percent");
                    const payeeAmount = document.getElementById("payee");
                    const napsaPercent = document.getElementById("napsa_percent");
                    const napsaAmount = document.getElementById("napsa");
                    const nhimaPercent = document.getElementById("nhima_percent");
                    const nhimaAmount = document.getElementById("nhima");
                    const netPay = document.getElementById("net_pay");

                    function calculateFields() {
                        const basicPay = parseFloat(basicPayInput.value) || 0;
                        const housing = parseFloat(housingAllowance.value) || 0;
                        const transport = parseFloat(transportAllowance.value) || 0;
                        const food = parseFloat(foodAllowance.value) || 0;
                        const other = parseFloat(otherAllowance.value) || 0;
                        const workingDays = parseFloat(monthlyWorkingDays.value) || 24;
                        const hours = parseFloat(hoursPerDay.value) || 8;

                        // Hourly rate
                        const hourly = workingDays * hours > 0 ? (basicPay / (workingDays * hours)) : 0;
                        hourlyRate.value = hourly.toFixed(2);

                        // Daily earnings
                        const daily = workingDays > 0 ? (basicPay / workingDays) : 0;
                        dailyEarnings.value = daily.toFixed(2);

                        // Gross Salary
                        const grossSalary = basicPay + housing + transport + food + other;
                        totalGrossSalary.value = grossSalary.toFixed(2);

                        // --- PAYEE Tax Brackets ---
                        let payee = 0;
                        if (grossSalary > 9200) {
                            payee += (grossSalary - 9200) * 0.37;
                            payee += (9200 - 7100) * 0.30;
                            payee += (7100 - 5100) * 0.20;
                        } else if (grossSalary > 7100) {
                            payee += (grossSalary - 7100) * 0.30;
                            payee += (7100 - 5100) * 0.20;
                        } else if (grossSalary > 5100) {
                            payee += (grossSalary - 5100) * 0.20;
                        }
                        payeeAmount.value = payee.toFixed(2);

                        // Effective PAYEE Rate
                        const effectiveRate = grossSalary > 0 ? (payee / grossSalary) * 100 : 0;
                        payeePercent.value = effectiveRate.toFixed(2);

                        // --- NAPSA ---
                        const pensionRate = parseFloat(napsaPercent.value) || 0;
                        const pension = Math.min((grossSalary * pensionRate) / 100, 1708.20);
                        napsaAmount.value = pension.toFixed(2);

                        // --- NHIMA ---
                        const healthRate = parseFloat(nhimaPercent.value) || 0;
                        const health = (grossSalary * healthRate) / 100;
                        nhimaAmount.value = health.toFixed(2);

                        // --- Net Pay ---
                        const net = grossSalary - (payee + pension + health);
                        netPay.value = net.toFixed(2);
                    }

                    // Event Listeners
                    basicPayInput.addEventListener("input", calculateFields);
                    housingAllowance.addEventListener("input", calculateFields);
                    transportAllowance.addEventListener("input", calculateFields);
                    foodAllowance.addEventListener("input", calculateFields);
                    otherAllowance.addEventListener("input", calculateFields);
                    napsaPercent.addEventListener("input", calculateFields);
                    nhimaPercent.addEventListener("input", calculateFields);
                    monthlyWorkingDays.addEventListener("input", calculateFields);
                    hoursPerDay.addEventListener("input", calculateFields);
                });
            </script>

            {{-- <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const basicPayInput = document.getElementById("basic_pay");
                    const housingAllowance = document.getElementById("housing_allowance");
                    const transportAllowance = document.getElementById("transport_allowance");
                    const foodAllowance = document.getElementById("food_allowance");
                    const otherAllowance = document.getElementById("other_allowance");
                    const monthlyWorkingDays = document.getElementById("monthly_working_days");
                    const hoursPerDay = document.getElementById("hours_per_day");
                    const hourlyRate = document.getElementById("daily_hourly");
                    const dailyEarnings = document.getElementById("daily_earnings");
                    const totalGrossSalary = document.getElementById("monthly_gross");
                    const payeePercent = document.getElementById("payee_percent");
                    const payeeAmount = document.getElementById("payee");
                    const napsaPercent = document.getElementById("napsa_percent");
                    const napsaAmount = document.getElementById("napsa");
                    const nhimaPercent = document.getElementById("nhima_percent");
                    const nhimaAmount = document.getElementById("nhima");
                    const netPay = document.getElementById("net_pay");

                    function calculateFields() {
                        const basicPay = parseFloat(basicPayInput.value) || 0;
                        const housing = parseFloat(housingAllowance.value) || 0;
                        const transport = parseFloat(transportAllowance.value) || 0;
                        const food = parseFloat(foodAllowance.value) || 0;
                        const other = parseFloat(otherAllowance.value) || 0;
                        const workingDays = parseFloat(monthlyWorkingDays.value) || 24;
                        const hours = parseFloat(hoursPerDay.value) || 8;

                        // Hourly rate
                        const hourly = workingDays * hours > 0 ? (basicPay / (workingDays * hours)) : 0;
                        hourlyRate.value = hourly.toFixed(2);

                        // Daily earnings
                        const daily = workingDays > 0 ? (basicPay / workingDays) : 0;
                        dailyEarnings.value = daily.toFixed(2);

                        // Gross Salary
                        const grossSalary = basicPay + housing + transport + food + other;
                        totalGrossSalary.value = grossSalary.toFixed(2);

                        // --- PAYEE Tax Brackets ---
                        let payee = 0;
                        if (grossSalary > 9200) {
                            payee += (grossSalary - 9200) * 0.37;
                            payee += (9200 - 7100) * 0.30;
                            payee += (7100 - 5100) * 0.20;
                        } else if (grossSalary > 7100) {
                            payee += (grossSalary - 7100) * 0.30;
                            payee += (7100 - 5100) * 0.20;
                        } else if (grossSalary > 5100) {
                            payee += (grossSalary - 5100) * 0.20;
                        }
                        payeeAmount.value = payee.toFixed(2);

                        // Effective PAYEE Rate
                        const effectiveRate = grossSalary > 0 ? (payee / grossSalary) * 100 : 0;
                        payeePercent.value = effectiveRate.toFixed(2);

                        // --- NAPSA ---
                        const pensionRate = parseFloat(napsaPercent.value) || 0;
                        const pension = Math.min((grossSalary * pensionRate) / 100, 1708.20);
                        napsaAmount.value = pension.toFixed(2);

                        // --- NHIMA (1% of Basic Pay) ---
                        const healthRate = parseFloat(nhimaPercent.value) || 0;
                        const health = (basicPay * healthRate) / 100;
                        nhimaAmount.value = health.toFixed(2);

                        // --- Net Pay ---
                        const net = grossSalary - (payee + pension + health);
                        netPay.value = net.toFixed(2);
                    }

                    // Event Listeners
                    basicPayInput.addEventListener("input", calculateFields);
                    housingAllowance.addEventListener("input", calculateFields);
                    transportAllowance.addEventListener("input", calculateFields);
                    foodAllowance.addEventListener("input", calculateFields);
                    otherAllowance.addEventListener("input", calculateFields);
                    napsaPercent.addEventListener("input", calculateFields);
                    nhimaPercent.addEventListener("input", calculateFields);
                    monthlyWorkingDays.addEventListener("input", calculateFields);
                    hoursPerDay.addEventListener("input", calculateFields);
                });
            </script> --}}


        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteMinistryModal" tabindex="-1" aria-labelledby="deleteMinistryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMinistryModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Information ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteMinistryForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Show Modal -->
    <div class="modal fade" id="showSalaryModal" tabindex="-1" aria-labelledby="showSalaryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showSalaryModalLabel">Show Salary
                        Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>worker Name:</strong> <span id="showName"></span></p>
                    <p><strong>Net Earnings:</strong> <span id="showNet"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    @if ($salary)
        <div class="modal fade" id="editSalaryModal" tabindex="-1" aria-labelledby="editSalaryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="{{ route('salaries.update', $salary->slug) }}" style="width: 75%">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editSalaryModalLabel">Edit Salary</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="worker_id" value="{{ $salary->worker_id }}">

                                <!-- First Column -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="edit_basic_pay" class="form-label">Basic Pay</label>
                                        <input type="number" class="form-control" id="edit_basic_pay"
                                            name="basic_salary" value="{{ $salary->basic_salary }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_housing_allowance" class="form-label">Housing
                                            Allowance</label>
                                        <input type="number" class="form-control" id="edit_housing_allowance"
                                            name="housing_allowance" value="{{ $salary->housing_allowance }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_transport_allowance" class="form-label">Transport
                                            Allowance</label>
                                        <input type="number" class="form-control" id="edit_transport_allowance"
                                            name="transport_allowance" value="{{ $salary->transport_allowance }}"
                                            required>
                                    </div>
                                </div>

                                <!-- Second Column -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="edit_other_allowance" class="form-label">Other Allowance
                                            (Optional)</label>
                                        <input type="number" class="form-control" id="edit_other_allowance"
                                            name="other_allowance" value="{{ $salary->other_allowance }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_more_allowance" class="form-label">More Allowance
                                            (Optional)</label>
                                        <input type="number" class="form-control" id="edit_more_allowance"
                                            name="other_allowance_two" value="{{ $salary->other_allowance_two }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_monthly_gross" class="form-label">Monthly Gross
                                            Earnings</label>
                                        <input type="number" class="form-control" id="edit_monthly_gross"
                                            name="monthly_gross" value="{{ $salary->monthly_gross }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="edit_hours_per_day" class="form-label">Hours per Day</label>
                                <input type="number" class="form-control" id="edit_hours_per_day"
                                    name="hours_per_day" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_days_per_month" class="form-label">Days Worked per Month</label>
                                <input type="number" class="form-control" id="edit_days_per_month"
                                    name="days_per_month" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_hourly_rate" class="form-label">Hourly Rate</label>
                                <input type="number" class="form-control" id="edit_hourly_rate" name="hourly_rate"
                                    readonly>
                            </div>


                            <!-- Contributions -->
                            <div class="mb-3">
                                <label for="edit_payee" class="form-label">Tax</label>
                                <input type="number" class="form-control" id="edit_payee" name="payee"
                                    value="{{ $salary->payee }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_napsa" class="form-label">NAPSA Contribution</label>
                                <input type="number" class="form-control" id="edit_napsa" name="napsa"
                                    value="{{ $salary->napsa }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_nhima" class="form-label">NHIMA Contribution</label>
                                <input type="number" class="form-control" id="edit_nhima" name="nhima"
                                    value="{{ $salary->nhima }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_net_pay" class="form-label">Monthly Net Earnings</label>
                                <input type="number" class="form-control" id="edit_net_pay" name="net_pay"
                                    value="{{ $salary->net_pay }}" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Salary</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    @else
    @endif

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('toast.success_toast')

        @include('includes.header')

        @include('includes.sidebar')

        <div class="main-content">

            @php
                use Carbon\Carbon;
            @endphp
            <div class="page-content">
                <div class="container-fluid">




                    {{-- <div class="row">
                            <!-- Total Hours Worked -->
                            <div class="col-md-6 col-xl-2">
                                <div class="card text-center">
                                    <div class="mb-2 card-body text-muted">
                                        <h3 style="font-size: 20px" class="text-info mt-2">
                                            {{ $worker->attendance->sum('hours_worked') }}
                                        </h3>
                                        <span style="font-size: 12px">Total Hours Worked</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Reported Days -->
                            <div class="col-md-6 col-xl-2">
                                <div class="card text-center">
                                    <div class="mb-2 card-body text-muted">
                                        <h3 style="font-size: 20px" class="text-info mt-2">
                                            {{ $worker->attendance->count() }}
                                        </h3>
                                        <span style="font-size: 12px">Reported Days</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Working Days -->
                            <div class="col-md-6 col-xl-2">
                                <div class="card text-center">
                                    <div class="mb-2 card-body text-muted">
                                        <h3 style="font-size: 20px" class="text-info mt-2">
                                            {{ $totalWorkingDays }}
                                        </h3>
                                        <span style="font-size: 12px"> Total Working Days</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Absent Days -->
                            <div class="col-md-6 col-xl-2">
                                <div class="card text-center">
                                    <div class="mb-2 card-body text-muted">
                                        <h3 style="font-size: 20px" class="text-danger mt-2">
                                            {{ $absentDays }}
                                        </h3>
                                        <span style="font-size: 12px">Absent Days</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Absent Days -->
                            <div class="col-md-6 col-xl-2">
                                <div class="card text-center">
                                    <div class="mb-2 card-body text-muted">
                                        <h3 style="font-size: 20px" class="text-info mt-2">
                                            {{ $punctuality }}
                                        </h3>
                                        <span style="font-size: 12px">Punctuality</span>
                                    </div>
                                </div>
                            </div>
                                <!-- Overtime Days -->
    <div class="col-md-6 col-xl-2">
        <div class="card text-center">
            <div class="mb-2 card-body text-muted">
                <h3 style="font-size: 20px" class="text-warning mt-2">
                    {{ $overtimeDays }}
                </h3>
                <span style="font-size: 12px">Overtime Days</span>
            </div>
        </div>
    </div>


                        </div> --}}

                </div>
                <!-- end row -->
                <!-- Add Salary Modal -->
                {{--
                    @php
                    use Carbon\Carbon;
                @endphp --}}


                <div class="row">
                    <div class="col-lg-8">

                        <div class="card">
                            <div class="card-body">


                                <h4 class="card-title"><a class="btn btn-sm btn-info waves-effect waves-light"
                                        href="/worker"><i class="dripicons-arrow-thin-left"></i></a>
                                    <a class="btn btn-info btn-sm waves-effect waves-light"
                                        href="{{ route('worker.edit', $worker->slug) }}"><i
                                            class="dripicons-document-edit"></i></a>


                                    <a class="btn btn-info btn-sm waves-effect waves-light" href="#"
                                        data-bs-toggle="modal" data-bs-target="#applyLeaveModal">
                                        Apply for Leave
                                    </a>


                                    <a class="btn btn-info btn-sm waves-effect waves-light"
                                        href="{{ route('worker.edit', $worker->slug) }}">Napsa Credentials</a>


                                    <a class="btn btn-info btn-sm waves-effect waves-light"
                                        href="{{ route('worker.edit', $worker->slug) }}">Nhima Credentials</a><br>
                                    <br>
                                </h4>
                                {{-- <a class="btn btn-info waves-effect waves-light" href="/departments/create">Fasted Days: 30 Days</a> <a class="btn btn-info waves-effect waves-light" href="/departments/create">Yearly Tithing Report: K5,000</a>
                                    <a class="btn btn-info waves-effect waves-light" href="/departments/create">Church Attended Days: 245 Days</a> <a class="btn btn-info waves-effect waves-light" href="/departments/create">Souls Won: 100</a></h4><br> --}}

                                <h4 class="card-title"> {{ $worker->name }}'s Information</h4>
                                <p class="card-title-desc" style="font-size: 12px">

                                <b>Employee MAN Id: </b>{{ $worker->tracking_code ?? 'None' }}<br>
                                <b>Date of Birth:</b>
                                {{ $worker->birthday ? Carbon::parse($worker->birthday)->format('F j, Y') : 'None' }}<br>

                                <b>Age:</b>
                                {{ $worker->birthday ? Carbon::parse($worker->birthday)->age : 'Unknown' }}

                                <br>
                                <b>Gender:</b>
                                {{ $worker->gender ?? 'Unknown' }}

                                <br>
                                <b>Department: </b>{{ $worker->department->name ?? 'None' }}<br>
                                <b>Branch: </b>{{ $worker->branch->name ?? 'none' }}<br>
                                <b>NRC No: </b>{{ $worker->nrc ?? 'none' }}<br>
                                <b>NAPSA No: </b>{{ $worker->napsa_no ?? 'none' }}<br>
                                <b>NHIMA No: </b>{{ $worker->nhima_no ?? 'none' }}<br>
                                <b>Occupation: </b>{{ $worker->designation }}<br>
                                </p>


                                <h4 class="card-title">Contact Information</h4>
                                <p class="card-title-desc" style="font-size: 12px">
                                    <b>Email: </b>{{ $worker->email }}<br>
                                    <b>Phone Number: </b>{{ $worker->phone }}<br>
                                    <b>Address: </b>{{ $worker->address }}<br>
                                    {{-- <b>Country: </b>{{ $worker->country_id }}<br> --}}
                                </p>

                                <h4 class="card-title">Bank Details</h4>
                                <p class="card-title-desc" style="font-size: 12px">
                                    <b>Bank Name: </b>{{ $worker->bank_name }}<br>
                                    <b>Bank Account: </b>{{ $worker->account_number }}<br>
                                    <b>Branch Code: </b>{{ $worker->bank_code }}<br>
                                    <b>Account Name: </b>{{ $worker->account_name }}<br>
                                    <b>Mobile: </b>{{ $worker->account_name }}<br>
                                </p>

                                <h4 class="card-title">Mobile Money Details</h4>
                                <p class="card-title-desc" style="font-size: 12px">
                                    <b>Mobile Money Name: </b>{{ $worker->mm_name }}<br>
                                    <b>Mobile Money Number: </b>{{ $worker->mm_number }}<br>
                                </p>

                            </div>
                        </div>
                    </div>

                    <!-- end row -->
                    <!-- end col -->
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ $worker->name }}'s Photo</h4>
                                <!-- Frame Container -->
                                <div
                                    style="width: 300px; height: 300px; border: 2px solid #ccc; overflow: hidden; display: flex; align-items: center; justify-content: center; border-radius: 10px;">
                                    <!-- Image -->

                                    @if ($worker->image)
                                        <img src="/employee_profile/{{ $worker->image }}" alt="{{ $worker->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover; object-position: top;">
                                    @else
                                        <img src="/images/user.webp" alt="Default Profile Image"
                                            style="width: 100%; height: 100%; object-fit: cover; object-position: top;">
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end col -->
                    <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                @if (!$salary)
                                    <h4 class="card-title">
                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="#"
                                            data-bs-toggle="modal" data-bs-target="#addSalaryModal">
                                            Add Salary
                                        </a>
                                    </h4>
                                @endif

                                <div class="table-rep-plugin">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Worker Name</th>
                                                    <th>Monthly Gross Earnings</th>
                                                    <th>Monthly Net Earnings</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!$salary)
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            <div class="text-center" style="margin-top: 20px;">
                                                                <h5>No Salaries Uploaded</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>
                                                            <b>{{ $salary->worker->name ?? $salary->name }}</b>
                                                            <br>
                                                            <span style="font-size: 11px; color:#7a7a7a;">
                                                                <b>Employee MAN ID:
                                                                    {{ $salary->worker->tracking_code ?? 'N/A' }}</b>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <b>Monthly Gross Earnings:
                                                                {{-- {{ formatCurrency ($salary->basic_salary + $salary->housing_allowance + $salary->transport_allowance + $salary->other_allowance + $salary->other_allowance_two) }} --}}
                                                                {{ $salary->basic_salary + $salary->housing_allowance + $salary->transport_allowance + $salary->other_allowance + $salary->other_allowance_two }}<br>
                                                                <span style="font-size: 11px; color:#7a7a7a;">
                                                                    Daily Earnings:
                                                                    {{ $salary->daily_earnings ?? 'N/A' }}/Day
                                                                </span>
                                                            </b>
                                                        </td>
                                                        <td>
                                                            {{-- <b>Monthly Net Earnings: {{ formatCurrency($salary->net_pay ) }}</b> --}}
                                                            <b>Monthly Net Earnings: {{ $salary->net_pay }}</b><br>
                                                            <span style="font-size: 11px; color:#7a7a7a;">
                                                                <b>Monthly Total
                                                                    Deductions:{{ $salary->napsa + $salary->nhima + $salary->payee }}</b><br>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-info"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#showSalaryModal"
                                                                data-id="{{ $salary->id }}"
                                                                data-name="{{ $salary->worker->name ?? $salary->name }}"
                                                                data-net="{{ number_format($salary->net_pay, 0) }}">
                                                                <i class="dripicons-preview"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-warning"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editSalaryModal"
                                                                data-id="{{ $salary->id }}"
                                                                data-name="{{ $salary->worker->name ?? $salary->name }}"
                                                                data-net="{{ $salary->net_pay }}">
                                                                <i class="dripicons-document-edit"></i>
                                                            </button>

                                                            <!-- Delete button to open modal -->
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger waves-effect waves-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteMinistryModal"
                                                                data-route="{{ route('salaries.destroy', $salary->slug) }}">
                                                                <i class="dripicons-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>

                                        </table>
                                    </div>
                                </div>



                                <!-- Edit Modal -->




                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>

                <!-- Add Salary Modal -->




            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        @include('includes.footer')
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <script src="/assets/libs/parsleyjs/parsley.min.js"></script>

    <script src="/assets/js/pages/form-validation.init.js"></script>

    <script src="/assets/js/app.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Input fields
            const basicPay = document.getElementById("basic_pay");
            const housingAllowance = document.getElementById("housing_allowance");
            const transportAllowance = document.getElementById("transport_allowance");
            const otherAllowance = document.getElementById("other_allowance");
            const moreAllowance = document.getElementById("more_allowance");
            const monthlyGross = document.getElementById("monthly_gross");

            const payee = document.getElementById("payee");
            const napsa = document.getElementById("napsa");
            const nhima = document.getElementById("nhima");
            const netPay = document.getElementById("net_pay");

            // Function to calculate monthly gross earnings
            function calculateGrossEarnings() {
                const gross =
                    (parseFloat(basicPay.value) || 0) +
                    (parseFloat(housingAllowance.value) || 0) +
                    (parseFloat(transportAllowance.value) || 0) +
                    (parseFloat(otherAllowance.value) || 0) +
                    (parseFloat(moreAllowance.value) || 0);

                monthlyGross.value = gross.toFixed(2);
                calculateNetEarnings(); // Update net pay whenever gross changes
            }

            // Function to calculate net earnings
            function calculateNetEarnings() {
                const gross = parseFloat(monthlyGross.value) || 0;
                const totalDeductions =
                    (parseFloat(payee.value) || 0) +
                    (parseFloat(napsa.value) || 0) +
                    (parseFloat(nhima.value) || 0);

                const net = gross - totalDeductions;
                netPay.value = net.toFixed(2);
            }

            // Event listeners for inputs
            [basicPay, housingAllowance, transportAllowance, otherAllowance, moreAllowance].forEach((input) =>
                input.addEventListener("input", calculateGrossEarnings)
            );

            [payee, napsa, nhima].forEach((input) =>
                input.addEventListener("input", calculateNetEarnings)
            );
        });

        document.addEventListener('DOMContentLoaded', function() {
            const showSalaryModal = document.getElementById('showSalaryModal');
            const editSalaryModal = document.getElementById('editSalaryModal');

            showSalaryModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const name = button.getAttribute('data-name');
                const net = button.getAttribute('data-net');

                document.getElementById('showName').textContent = name;
                document.getElementById('showNet').textContent = net;
            });

            editSalaryModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const net = button.getAttribute('data-net');

                document.getElementById('editName').value = name;
                document.getElementById('editNet').value = net;

                const form = document.getElementById('editSalaryForm');
                form.action = `/salaries/${id}`;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all edit buttons
            const editButtons = document.querySelectorAll('.edit-salary-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const salaryId = this.getAttribute('data-id');
                    const route = this.getAttribute('data-route');

                    // Fetch salary data using AJAX (you can use Axios or Fetch API)
                    fetch(route)
                        .then(response => response.json())
                        .then(data => {
                            // Populate the form fields
                            document.getElementById('editSalaryForm').action = route;
                            document.getElementById('worker_id').value = data.worker_id;
                            document.getElementById('edit_basic_pay').value = data.basic_salary;
                            document.getElementById('edit_housing_allowance').value = data
                                .housing_allowance;
                            document.getElementById('edit_transport_allowance').value = data
                                .transport_allowance;
                            document.getElementById('edit_other_allowance').value = data
                                .other_allowance;
                            document.getElementById('edit_more_allowance').value = data
                                .other_allowance_two;
                            document.getElementById('edit_monthly_gross').value = data
                                .monthly_gross;
                            document.getElementById('edit_payee').value = data.payee;
                            document.getElementById('edit_napsa').value = data.napsa;
                            document.getElementById('edit_nhima').value = data.nhima;
                            document.getElementById('edit_net_pay').value = data.net_pay;

                            // Show the modal
                            const editModal = new bootstrap.Modal(document.getElementById(
                                'editSalaryModal'));
                            editModal.show();
                        });
                });
            });
        });
    </script>
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
        document.addEventListener("DOMContentLoaded", function() {
            // Input elements for the edit form
            const basicPayInput = document.getElementById("edit_basic_pay");
            const housingAllowanceInput = document.getElementById("edit_housing_allowance");
            const transportAllowanceInput = document.getElementById("edit_transport_allowance");
            const otherAllowanceInput = document.getElementById("edit_other_allowance");
            const moreAllowanceInput = document.getElementById("edit_more_allowance");
            const monthlyGrossInput = document.getElementById("edit_monthly_gross");
            const payeeInput = document.getElementById("edit_payee");
            const napsaInput = document.getElementById("edit_napsa");
            const nhimaInput = document.getElementById("edit_nhima");
            const netPayInput = document.getElementById("edit_net_pay");

            // Function to calculate gross earnings
            function calculateGrossEarnings() {
                const basicPay = parseFloat(basicPayInput.value) || 0;
                const housingAllowance = parseFloat(housingAllowanceInput.value) || 0;
                const transportAllowance = parseFloat(transportAllowanceInput.value) || 0;
                const otherAllowance = parseFloat(otherAllowanceInput.value) || 0;
                const moreAllowance = parseFloat(moreAllowanceInput.value) || 0;

                const grossEarnings = basicPay + housingAllowance + transportAllowance + otherAllowance +
                    moreAllowance;
                monthlyGrossInput.value = grossEarnings.toFixed(2);

                calculateNetEarnings(grossEarnings);
            }

            // Function to calculate net earnings
            function calculateNetEarnings(grossEarnings) {
                const payee = parseFloat(payeeInput.value) || 0;
                const napsa = parseFloat(napsaInput.value) || 0;
                const nhima = parseFloat(nhimaInput.value) || 0;

                const netEarnings = grossEarnings - (payee + napsa + nhima);
                netPayInput.value = netEarnings.toFixed(2);
            }

            // Event listeners for gross earnings calculation
            [basicPayInput, housingAllowanceInput, transportAllowanceInput, otherAllowanceInput, moreAllowanceInput]
            .forEach(input => {
                input.addEventListener("input", calculateGrossEarnings);
            });

            // Event listeners for net earnings calculation
            [payeeInput, napsaInput, nhimaInput].forEach(input => {
                input.addEventListener("input", () => calculateNetEarnings(parseFloat(monthlyGrossInput
                    .value) || 0));
            });
        });
    </script>


    @include('toast.error_success_js')
</body>

</html>
