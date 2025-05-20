<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $payslip->employee->name }} - PDF Export</title>
    <!-- Add Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        hr {
            margin: 20px 0;
        }

        .btn-info {
            margin-right: 10px;
        }

        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>

<body style="font-size: 13px; font-family:sans-serif">
    <div class="container my-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <div>
                            <img src="{{ public_path('logos/' . $quotations->detail->image) }}" class="h-12" />
                        </div> --}}

                        <h4 class="card-title">{{ $payslip->salary->employee->name }}'s Payslip Information</h4>
                        <hr style="border-top: dashed 1px;" />

                        <!-- Payslip Details -->
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Employee Name:</strong> {{ $payslip->salary->employee->name }}</p>
                                <p><strong>Position:</strong> {{ $payslip->salary->employee->designation }}</p>
                                <p><strong>Department:</strong> {{ $payslip->salary->employee->department->name }}</p>
                                <p><strong>Payment Date:</strong> {{ \Carbon\Carbon::parse($payslip->date)->format('d M, Y') }}</p>
                            </div>

                            <div class="col-md-6 text-right-custom"> <!-- Applied custom class here -->
                                <p><strong>Prepared By:</strong> {{ $payslip->prepared_by }}</p>
                                <p><strong>Salary Amount:</strong> {{ formatCurrency($payslip->salary->net_pay) }}</p>
                            </div>
                        </div>



                        <hr style="border-top: dashed 1px;" />
                        <style>
                                .text-right-custom {
                                 text-align: right;
                                }
                            .table-responsive {
                                margin: 20px 0;
                                overflow-x: auto;
                            }

                            .table {
                                width: 100%;
                                margin-bottom: 1rem;
                                color: #212529;
                                border-collapse: collapse;
                            }

                            .table th,
                            .table td {
                                padding: 12px;
                                vertical-align: top;
                                border-top: 1px solid #ddd;
                                text-align: left;
                            }

                            .table thead {
                                background-color: #f8f9fa;
                                color: #495057;
                            }

                            .table th {
                                font-weight: bold;
                            }

                            .table tbody tr:nth-child(odd) {
                                background-color: #f2f2f2;
                            }

                            .table tbody tr:hover {
                                background-color: #e9ecef;
                            }

                            .table .table-bordered {
                                border: 1px solid #ddd;
                            }

                            .table-bordered th,
                            .table-bordered td {
                                border: 1px solid #ddd;
                            }

                            .table td {
                                font-size: 12px;
                                color: #495057;
                            }

                            .table th {
                                font-size: 12px;
                                color: #007bff;
                            }

                            .table .total-pay th,
                            .table .total-pay td {
                                font-weight: bold;
                                background-color: #e2e6ea;
                            }

                            .table .deductions th,
                            .table .deductions td {
                                background-color: #ffe6e6;
                            }

                            .table .amount {
                                text-align: right;
                                font-weight: bold;
                            }
                        </style>


                        <!-- Salary Breakdown Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Allowances</th>
                                        <th>Amount (ZMW)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Basic Salary</td>
                                        <td>{{ formatCurrency($payslip->salary->basic_salary) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Housing Allowance</td>
                                        <td>{{ formatCurrency($payslip->salary->housing_allowance) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Transport Allowance</td>
                                        <td>{{ formatCurrency($payslip->salary->transport_allowance) }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Deductions</b></td>
                                    </tr>
                                    <tr>
                                        <td>Health</td>
                                        <td>{{ formatCurrency($payslip->salary->nhima) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pension</td>
                                        <td>{{ formatCurrency($payslip->salary->napsa) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td>{{ formatCurrency($payslip->salary->payee) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Pay</th>
                                        <th>{{ formatCurrency($payslip->salary->monthly_gross + $payslip->salary->basic_salary + $payslip->salary->housing_allowance + $payslip->salary->transport_allowance - $payslip->salary->nhima - $payslip->salary->napsa - $payslip->salary->payee) }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr style="border-top: dashed 1px;" />

                        <!-- Footer with Action Buttons (optional, uncomment if needed) -->
                        {{-- <div class="text-center">
                            <a href="{{ route('payslip.print', $payslip->slug) }}" class="btn btn-primary">
                                <i class="dripicons-print"></i> Print Payslip
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
