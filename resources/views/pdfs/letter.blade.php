<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $clearance->bank_name }} - PDF Export</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
/*            border: 1px solid #ddd;*/
            background-color: #f9f9f9;
        }
        h1, h2 {
            text-align: center;
        }
        .content p {
            margin: 1px 0;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;

        }
        .content table, .content th, .content td {
            border: 1px solid #ccc;
        }
        .content th, .content td {
            padding: 8px;
            text-align: left;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #555;
        }

        table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 2px solid #000; /* Black borders */
    padding: 8px;
    text-align: left;
}

thead {
    background-color: #333; /* Dark header background */
    color: #fff; /* White text for header */
}

tbody tr:nth-child(odd) {
    background-color: #f2f2f2; /* Light gray for odd rows */
}

tbody tr:nth-child(even) {
    background-color: #ffffff; /* White for even rows */
}

    </style>
</head>
<body>
    <div class="container">
        <h1 style="font-size:10px">
            <img src="{{ public_path('assets/images/logo-dark.png') }}" width="150px" alt="Company Logo">
        </h1>
        {{-- <p><strong>My Tax Your Tax Our Destiny</strong></p> --}}
        <hr>

        <p><strong>ZRA2024/DRU/oc/mm/MM/606-615</strong><br> {{ $clearance->created_at }}</p>
        <p> {{ $clearance->director }}<br> {{ $clearance->bank_name }}<br> {{ $clearance->bank_address }}</p>

        <p>Dear Sir/ Madam,</p>

        <h2 style="font-size:14px">NOTICE UNDER SECTION 23 OF THE VAT ACT (CAP 331), SECTION 171A OF THE CUSTOMS AND EXCISE ACT (CAP 322) AND SECTION 84 OF THE INCOME TAX ACT (CAP 323) IN RESPECT OF TAX ARREARS OWED BY: VARIOUS</h2>

        <p>Reference is made to the above.</p>
        <p>Please be informed that the garnish on the current <b>{{ $clearance->bank_name }}</b> payment batch should be treated as follows:</p>

        <p>Kindly withhold and remit to ZRA amounts as per schedule below and pay taxpayers balance of monies owed to them. Advise when making the next payment batch to facilitate for clearance.</p>

        <table>
            <thead>
                <tr>
                    <th>TPIN</th>
                    <th>SUPPLIER</th>
                    <th>GARNISHED AMOUNT (USD/KWACHA)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $garnish->document->tpin }}</td>
                    <td class="text-center">{{ $garnish->document->supplier_name }}</td>
                    <td class="text-end">{{ $garnish->document->currency }} {{ $garnish->amount ?? 'None Garnished' }}</td>
                </tr>
            </tbody>
        </table>




        <p>Note that this clearance is specific to the garnish placed on your suppliers and is different from your appointment as Withholding VAT (WHVAT) agents.</p>

        <p><strong>ZRA2024/DRU/oc/mm/MM/606-615</strong><br>The Managing Director<br>June 7, 2024<br>ABSA Bank Zambia<br>LUSAKA</p>

        <p>Kindly notify the following:</p>
        <ol>
            <li>Company Director - Suppliers Above</li>
            <li>Director – Treasury Enforcement ZRA</li>
        </ol>

        <p>Any question on the notice should be referred to the undersigned</p>

        <p>Yours faithfully,<br><strong>{{ $clearance->prepared_by }}</strong><br>{{ $clearance->position }}</p>

        <p><strong>Cc:</strong> Acting Commissioner – Business Facilitation<br>New Revenue House<br>P.O. Box 35710 Lusaka<br>Tel: +260 211 382002<br>Email: <a href="mailto:KASAPATE@zra.org.zm">KASAPATE@zra.org.zm</a><br>Website: <a href="http://www.zra.org.zm">www.zra.org.zm</a></p>

        <div class="footer">
            <p>Office of the Director Enforcement<br>Taxpayer Focus | Integrity | Professionalism | Innovation | Networking</p>
        </div>
    </div>
</body>
</html>
