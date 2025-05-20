<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->slug }} - Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #333;
        }
        .receipt-container {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #0f2c5a;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .details {
            padding: 20px;
        }
        .details p {
            margin: 5px 0;
            font-size: 14px;
        }
        .details strong {
            display: inline-block;
            width: 120px;
        }
        .items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .items th, .items td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .items th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            padding: 20px;
            background: #f4f4f4;
            border-top: 2px solid #213579;
            font-size: 18px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #777;
        }
        .footer a {
            color: #324cbe;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="header">
            <div>

            </div><br>
            <h1>Thank You for Your Purchase!</h1>
        </div>
        <div class="details">
            <p><strong>Order Number:</strong> #{{ $user->id }}</p>
            <p><strong>Order Date:</strong> {{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y') }}</p>
            <p><strong>Customer:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
        <table class="items">
            <thead>
                <tr>
                    <th>Package Type</th>
                    <th>Date</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->pricingPlan->name }}
                    </td>
                    <td>
                        <b style="font-size: 12px">{{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y') }}</b>
                        <br>
                        <span
                            style="font-size: 9px; color: {{ \Carbon\Carbon::parse($user->created_at)->addMonths(1)->isToday()? 'red': 'rgb(112, 112, 112)' }};">
                            Due On:
                            {{ \Carbon\Carbon::parse($user->created_at)->addMonths(1)->format('F j, Y') }}
                        </span>
                    </td>
                    <td>
                        {{ $user->pricingPlan->currency }}   {{ $user->pricingPlan->price }}

                    </td>
                </tr>

            </tbody>
        </table>
        <div class="total">
            Total: {{ $user->pricingPlan->currency }}   {{ $user->pricingPlan->price }}
        </div>
        <div class="footer">
            @foreach ($generalSetting as $item)
            <p>If you have any questions, contact us at <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>.</p>
            <p>&copy; 2025 {{ $item->name }}. All rights reserved.</p>
            @endforeach
        </div>
    </div>
</body>
</html>
