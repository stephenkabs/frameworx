<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $contract->employee->name }} Employee Agreement Contract</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.8;
               font-size: 12px;
        }

        .contract-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
/*            border: 1px solid #ddd;*/
            padding: 30px;
            border-radius: 8px;
/*            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);*/
        }

        h1, h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            text-transform: uppercase;
            color: #34495e;
            border-bottom: 2px solid #2c3e50;
            display: inline-block;
            margin-bottom: 10px;
        }

        p {
            text-align: justify;
            margin: 10px 0;
        }

        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .signature-block {
            width: 45%;
            text-align: center;
            border-top: 1px solid #333;
            padding-top: 10px;
        }

        .signature-block span {
            display: block;
            margin-top: 5px;
            font-size: 14px;
            color: #666;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="contract-container">
        <h1>Employee Agreement Contract</h1>
        <p>This Employee Agreement (the “Agreement”) is made and entered into on <strong>{{ $contract->created_at->format('d M Y, H:i') }}</strong> by and between <strong>{{ $contract->name }}</strong>, a company duly registered under the laws of [Country/State], with its registered address at <strong>{{ $contract->address }}</strong> (hereinafter referred to as the “Employer”), and <strong>{{ $contract->employee->name }}</strong>, residing at <strong>{{ $contract->employee->address }}</strong> (hereinafter referred to as the “Employee”).</p>

        <h2 class="section-title">Terms of Employment</h2>
        <p><strong>Position:</strong> The Employee shall serve as <strong>{{ $contract->position }}</strong> and report directly to [MANAGER/SUPERVISOR]. The Employee shall perform all duties and responsibilities reasonably associated with the position as assigned by the Employer.</p>
        <p><strong>Employment Type:</strong> The Employee is hired on a <strong>[FULL-TIME/PART-TIME/CONTRACT]</strong> basis for a term of <strong>[CONTRACT DURATION]</strong>.
            {{-- <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Duty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($duties as $index => $dutyItem)
                        <tr>
                            <td>{{ $index + 1 }}</td> <!-- Increment the index for numbering -->
                            <td>{{ $dutyItem }}</td>    <!-- Display the duty -->
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}

        </p>

        <h2 class="section-title">Compensation and Benefits</h2>
        <p><strong>Salary:</strong> The Employee shall receive a monthly salary of <strong>____________</strong>, payable on the [PAYMENT DATE] of each month.</p>
        <p><strong>Benefits:</strong> The Employee is entitled to benefits as outlined in the company's policies, including <strong>[BENEFITS DETAILS]</strong>.</p>

        <h2 class="section-title">Confidentiality</h2>
        <p>The Employee agrees to maintain the confidentiality of all proprietary information, trade secrets, and sensitive business data during and after the term of employment. Unauthorized disclosure of such information may result in legal action.</p>

        <h2 class="section-title">Termination</h2>
        <p>This Agreement may be terminated by either party with <strong>[NOTICE PERIOD]</strong> notice. The Employer reserves the right to terminate employment immediately for cause, including but not limited to misconduct or breach of this Agreement.</p>
<br><br><br>
<br><br><br>
        <h2 class="section-title">Governing Law</h2>
        <p>This Agreement shall be governed by and construed in accordance with the laws of <strong>[STATE/COUNTRY]</strong>.</p>

        {{-- <div class="signature-section">
            <div class="signature-block">
                <p><strong>Employee Signature</strong></p>
                <span>Name: _______________________</span>
                <span>Date: _______________________</span>
            </div>
            <div class="signature-block">
                <p><strong>Employer Signature</strong></p>
                <span>Name: _______________________</span>
                <span>Date: _______________________</span>
            </div>
        </div> --}}

        <div class="footer">
            <p>This document is a legally binding agreement between the parties mentioned above.</p>
        </div>
    </div>
</body>
</html>
