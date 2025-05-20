<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            width: 100%;
            max-width: 700px;
            margin: 10px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 5px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 150px;
        }

        .invoice-details {
            text-align: right;
        }

        .invoice-details h3 {
            margin: 0;
            color: #333;
            font-size: 13px;
        }

        .invoice-details p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }

        .customer-info, .billing-info {
            margin-top: 30px;
        }

        .customer-info h4, .billing-info h4 {
            margin-bottom: 10px;
            color: #333;
            font-size: 14px;
            font-weight: bold;
        }

        .customer-info p, .billing-info p {
            margin: 5px 0;
            color: #666;
            font-size: 12px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .items-table th, .items-table td {
            padding: 12px;
            text-align: left;
        }

        .items-table th {
            background-color: #f2f2f2;
            color: #333;
            font-size: 14px;
        }

        .items-table td {
            border-bottom: 1px solid #f2f2f2;
            color: #666;
            font-size: 12px;
        }

        .items-table td.total-cell {
            text-align: right;
            font-weight: bold;
            color: #333;
        }

        .total {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }

        .total div {
            width: 200px;
            display: flex;
            justify-content: space-between;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #888;
        }

        .footer a {
            color: #007BFF;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="invoice-container">
        <!-- Invoice Header -->
        <div class="header">
            <img src="https://via.placeholder.com/150x50" alt="Company Logo" class="logo">
            <div class="invoice-details">
                <h3>Invoice #12345</h3>
                <p>Issue Date:  {{ $quotation->created_at->format('d M Y, H:i') }}</p>
                {{-- <p>Due Date: November 20, 2024</p> --}}
            </div>
        </div>

        <!-- Customer Info -->
        <div class="customer-info" style="display: flex; justify-content: space-between; align-items: flex-start; padding: 10px;">
            <!-- Left Section -->
            <div>
                <h4>Customer Information</h4>
                <p><strong>{{ $quotation->client_name }}</strong></p>
                <p>{{ $quotation->client_address }}</p>
                <p>{{ $quotation->email }}</p>
                <p>TPIN: {{ $quotation->client_tpin }}</p>
            </div>

            <!-- Right Section -->
            <div style="text-align: right;">
                <h4>Billing Information</h4>
                <p><strong>XYZ Company</strong></p>
                <p>456 Business Blvd</p>
                <p>City, State, ZIP</p>
                <p>Email: billing@xyzcompany.com</p>
            </div>
        </div>


        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quotation->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td  class="text-end">{{ number_format($item->total, 2) }}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <br><br>

        <!-- Total Calculation -->
        <div class="total" style="background-color: #eaeaea; padding:10px; width:35%; margin-left: auto; display: block;">
            <div>
                <p style="font-size: 13px">
                    <b>Subtotal:</b> {{ number_format($item->quantity * $item->price, 2) }}<br><br>
                    <b>Tax Amount:</b> {{ number_format($quotation->tax_amount) }}<br><br>
                    <b>Tax</b> ({{ $quotation->tax_name }} {{ $quotation->tax_percentage }}%)
                </p>
            </div>
            <div>
                <p>
                    <strong>
                        <b><span style="font-size: 17px">TOTAL:</b>
                        <span style="font-size: 17px">{{ number_format($quotation->grand_total) }}</span>
                        </strong>
                    </span>
                </p>
            </div>
        </div>


        <!-- Footer -->
        {{-- <div class="footer">
            <p>Thank you for your business!</p>
            <p>If you have any questions, feel free to <a href="mailto:support@xyzcompany.com">contact us</a>.</p>
        </div> --}}
    </div>

</body>
</html>
