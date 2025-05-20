<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Ticket</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .ticket {
      width: 800px;
      display: flex;
      border: 2px solid #d0d0d0;
      border-radius: 8px;
      background-color: #fff;
      margin: 40px auto;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    }

    .left-section {
      flex: 3;
      padding: 20px;
      border-right: 2px solid #d0d0d0;
    }

    .right-section {
      flex: 1;
      text-align: center;
      background-color: #f8f8f8;
      padding: 20px;
    }

    .event-title {
      font-size: 18px;
      font-weight: bold;
      margin: 10px 0;
    }

    .section-title {
      font-size: 10px;
      font-weight: bold;
      color: #aaa;
    }

    .details {
      font-size: 14px;
      font-weight: bold;
      color: #000;
    }

    .qr-code img {
      max-width: 100px;
      margin-top: 10px;
    }

    .pass-info {
      margin-top: 20px;
      font-size: 10px;
      color: #aaa;
    }

    .highlight {
      color: #555;
    }

    .code {
      font-weight: bold;
      margin: 10px 0;
      color: #333;
    }
  </style>
</head>
<body>
  <div class="ticket">
    <!-- Left Section -->
    <div class="left-section">

        {{-- <div class="section-title">EVENT</div> --}}
        <img src="/assets/images/logo-dark.png" alt="" height="50">
      {{-- <div class="event-title" style="text-transform: uppercase;">{{ $purchase->event->name }}</div> --}}
      <br><br>

      <div class="section-title">EVENT</div>
      <div class="event-title" style="text-transform: uppercase;">{{ $purchase->event->name }}</div>


      <div class="section-title">LOCATION</div>
      <div class="details" style="text-transform: uppercase;">{{ $purchase->event->location }}</div><br>

      <div class="section-title">DATE AND TIME</div>
      <div class="details">
        {{ \Carbon\Carbon::parse($purchase->event->date)->format('d M Y') }},  TIME: {{  strtoupper($purchase->event->start_time) }} TO {{  strtoupper($purchase->event->end_time) }}<br>
        {{-- TO <br>
        {{  strtoupper($purchase->event->start_time) }} --}}
      </div><br><br>


      <div class="section-title">ABOUT EVENT</div>
      <div class="details">
        <span style="font-size: 10px; color: #737272; line-height: 0;">{{ $purchase->event->description }}</span>

      </div><br>

      <div class="section-title">PRICE</div>
      <div class="details">
        <span style="font-size: 10px; color: #737272; line-height: 0;">{{ formatCurrency($purchase->event->ticket->price) }}</span>

      </div>
    </div>

    <!-- Right Section -->
    <div class="right-section">
      <div class="qr-code">
        <!-- Placeholder for QR Code -->
        {!! $qrCode !!}
      </div>
      <div class="code"> #{{ $purchase->transaction_number }}</div>

      <div class="pass-info">
        {{ $purchase->ticket->type }}<br>
        <span class="highlight">{{ Auth::user()->name ?? 'Admin' }}</span>

        <br>

        <br>

       info@eventixzambia.com
      </div>
    </div>
  </div>
</body>
</html>
