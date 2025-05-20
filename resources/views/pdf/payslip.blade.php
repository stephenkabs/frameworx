<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip - {{ $payslip->worker->name }}</title>
    <style>
        body {
            font-family: 'Courier Regular', Courier, monospace;
        }
.container {
    /* width: 210mm;
    height: 297mm;  */
    margin: auto;
    /* border: 1px solid #ddd; */
    padding: 20px;
        padding-top: 2%;
    box-sizing: border-box;
}

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h2 {
            margin: 0;
        }
        .details {
            background: #f5f5f5;
            padding: 10px;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background: {{ optional($payslip->detail)->primary_color ?? '#ffffff' }};
            color: white;
                        border: 1px solid #ddd;
        }
        .payment-table th {
            background: {{ optional($payslip->detail)->secondary_color ?? '#ffffff' }};
        }
        .footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

          .bank-details-box {
            background-color: #f8f9fa; /* Very light grey */
            padding: 10px;
            border-radius: 8px;
/*            border: 1px solid #ddd; /* Light border */*/
            width: fit-content;
            max-width: 100%;
            font-family: Arial, sans-serif;
        }
        .bank-details-box p {
            margin: 5px 0;
        }
                .header {
            text-align: center;
            font-family: Arial, sans-serif;
                        font-size: 12px;
        }
        .header-line {
            width: 100%;
            height: 20px; /* Adjust thickness */
            display: flex;
        }
        .header-line .left {
/*            background-color: green;*/
           background: linear-gradient(90deg, rgba(13,145,6,1) 0%, rgba(244,167,16,1) 98%);
            width: 20%;
        }
        .header-line .right {
            background-color: yellow;
            width: 20%;
        }
    </style>
</head>

<body>
    <div class="container">
  <div class="header">
        <div class="header-line">
            <div class="left"></div>
            <div class="right"></div>
        </div>
        <h2 style="text-align: right;">
            <img src="{{ public_path('logos/' . $payslip->detail->image) }}" width="180px" />


        </h2>
        <!-- <h3>EIA/EIS INVOICE</h3> -->
    </div>
        <p style="font-size:12px; color: #878787;"><strong style="font-size:25px">Payslip</strong><br><br>
        <strong>{{ $payslip->detail->name }}</strong><br>
        {{ $payslip->detail->email }}<br>
        {{ $payslip->detail->address }}<br>
        @if ($payslip->detail->website > 0)
        {{ $payslip->detail->website }}
        @endif
        </p>
        {{-- @php
        $usedLeaveDays = \Carbon\Carbon::parse($payslip->worker->leaves->start_date)->diffInDays(\Carbon\Carbon::parse($payslip->worker->leave->leave->end_date)) + 1;
        $leaveMonetaryValue = $usedLeaveDays * $payslip->worker->salary->daily_earnings;

    @endphp --}}

    @php
    // Get the worker's leave entitlement (Assuming 20 days per year, adjust as needed)
    $totalAnnualLeaveEntitlement = 24;

    // Get the worker's leaves (ensure it's a single record)
    $leave = $payslip->worker->leaves->first();

    if ($leave) {
        $usedLeaveDays = \Carbon\Carbon::parse($leave->start_date)
                        ->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1;
    } else {
        $usedLeaveDays = 0;
    }

    // Calculate remaining leave days
    $remainingAnnualLeaveDays = max($totalAnnualLeaveEntitlement - $usedLeaveDays, 0);
@endphp



        <div class="details">
            <p style="font-size:12px; line-height: 20px;">

                <strong>Employee Name:</strong> {{ $payslip->worker->name }}<br>
                <strong>Employee MAN ID:</strong> {{ $payslip->worker->tracking_code }}<br>
                <strong>NRC No:</strong> {{ $payslip->worker->nrc }}<br>
                <strong>NAPSA No:</strong> {{ $payslip->worker->napsa_no }}<br>
                <strong>NHIMA No:</strong> {{ $payslip->worker->nhima_no }}<br>
                <strong>Designation :</strong> {{ $payslip->worker->designation }}<br>
                <strong>Employment Start Date :</strong> {{ $payslip->worker->join_date }}<br>
                <strong>Department: :</strong> {{ $payslip->worker->department->name }}<br>
                <strong>Month/Year :</strong> {{ $payslip->created_at->format(' M Y ') }}<br>
                <strong>Date:</strong> {{ $payslip->created_at->format('d M Y, H:i') }}<br>
                {{-- <strong>Annual Leave Entitlement(Days):</strong> {{ $usedLeaveDays ?? 'None' }} <br>
                <strong>Leave Days Due (Year To Date) :</strong> {{ $remainingAnnualLeaveDays }} days<br> --}}
                <strong>Annual Leave Entitlement (Days):</strong> {{ $usedLeaveDays ?? 'None' }} <br>
<strong>Leave Days Due (Year To Date):</strong> {{ $remainingAnnualLeaveDays }} days<br>

            </p>
            <!-- {{-- <p><strong>To:</strong> Stephen Kabwe</p> --}} -->
        </div>
        @php
        $totalAdvance = $payslip->salary->worker->advance ? $payslip->salary->worker->advance->sum('amount') : 0;
        $netPay = $payslip->salary->net_pay - $totalAdvance;
    @endphp
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
                <td>Advance Loan</td>
                <td>{{ formatCurrency($totalAdvance) ?? '*******' }}</td>
            </tr>
            <tr>
                <td>Medical Scheme (NHIMA)</td>
                <td>{{ formatCurrency($payslip->salary->nhima) }}</td>
            </tr>
            <tr>
                <td>NAPSA</td>
                <td>{{ formatCurrency($payslip->salary->napsa) }}</td>
            </tr>
            <tr>
                <td>PAYEE Tax</td>
                <td>{{ formatCurrency($payslip->salary->payee) }}</td>
            </tr>
            <tr>
                <th>Total Pay</th>
                {{-- <th>{{ formatCurrency($payslip->salary->monthly_gross + $payslip->salary->basic_salary + $payslip->salary->housing_allowance + $payslip->salary->transport_allowance - $payslip->salary->nhima - $payslip->salary->napsa - $payslip->salary->payee) }}</th> --}}
                <th>{{ formatCurrency($netPay) }}</th>
            </tr>
        </tbody>
    </table>
</div>

<div class="details">

    <p style="font-size:12px; line-height: 20px;">

        <strong style="font-size: 20px">Bank Details</strong><br>
        <strong>Bank Name:</strong> {{ $payslip->worker->bank_name }}<br>
        <strong>Account No:</strong> {{ $payslip->worker->account_number }}<br>
        <strong>Account Name:</strong> {{ $payslip->worker->account_name }}<br>
        <strong>Branch Code:</strong> {{ $payslip->worker->bank_code }}<br>
        <strong>Branch Location:</strong> {{ $payslip->worker->branch_location }}<br>
    </p>

</div>
<p style="font-size: 7px">CONFIDENTIALITY NOTICE<br>

    This document contains confidential and sensitive information intended only for the authorized recipient(s). Unauthorized access, disclosure, copying, or distribution is strictly prohibited.</p>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</body>
</html>
