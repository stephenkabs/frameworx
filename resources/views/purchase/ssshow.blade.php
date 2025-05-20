<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .ticket-container {
            margin: 20px auto;
            width: 400px;
            padding: 20px;
            border: 2px solid #444;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #d9534f;
        }
        p {
            margin: 5px 0;
        }
        .qr-code {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <h1>Event Ticket</h1>
        <p><strong>Event Name:</strong> {{ $purchase->event->name }}</p>
        <p><strong>Ticket Type:</strong> {{ $purchase->ticket->type }}</p>
        <p><strong>Quantity:</strong> {{ $purchase->quantity }}</p>
        <p><strong>Transaction ID:</strong> {{ $purchase->transaction_number }}</p>

        <div class="qr-code">
            <!-- Display QR Code -->
            {!! $qrCode !!}
        </div>
        <p><strong>Ticket ID:</strong> {{ $purchase->slug }}</p>
    </div>
</body>
</html>
