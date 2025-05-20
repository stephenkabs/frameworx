<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
            background: {{ optional($receipts->detail)->primary_color ?? '#ffffff' }};
            color: white;
                        border: 1px solid #ddd;
        }
        .payment-table th {
            background: {{ optional($receipts->detail)->secondary_color ?? '#ffffff' }};
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
            <img src="{{ public_path('logos/' . $receipts->detail->image) }}" width="250px" />


        </h2>
        <!-- <h3>EIA/EIS INVOICE</h3> -->
    </div>
        <p style="font-size:12px; color: #878787;"><strong style="font-size:25px">RECEIPT</strong><br><br>
        <strong>{{ $receipts->detail->name }}</strong><br>
        {{ $receipts->detail->email }}<br>
        {{ $receipts->detail->address }}<br>
        @if ($receipts->detail->website > 0)
        {{ $receipts->detail->website }}
        @endif
        </p>

        <div class="details">
            <p style="font-size:12px; line-height: 20px;"><strong>Client:</strong> {{ $receipts->client->client_name }}<br>

                <strong>Date:</strong> {{ $receipts->created_at->format('d M Y, H:i') }}
            </p>
            <!-- {{-- <p><strong>To:</strong> Stephen Kabwe</p> --}} -->
        </div>
<table border="1">
    <thead>
        <tr>
            <th>Item</th>
            <th>Description</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($receipts->items as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->product_name }}</td>
            <td class="qty">{{ $item->quantity }}</td>
            <td class="unit-price">{{ number_format($item->price, 2) }}</td>
            <td class="total-price">{{ formatCurrency($item->total) }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot style="background-color: #e3e3e3;">
        <tr>
            <td colspan="3"></td>
            <td><strong>Sub Total</strong></td>
            <td id="grand-total"><strong>          {{ number_format($item->quantity * $item->price, 2) }}</strong></td>
        </tr>
        @if ($receipts->tax_percentage > 0)
        <tr>
            <td colspan="3"></td>
            <td><strong>{{ $receipts->tax_name }}</strong></td>
            <td id="grand-total"><strong>
                 {{ $receipts->tax_percentage }}%:
            </strong></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td><strong>
                Tax Amount
            </strong></td>
            <td id="grand-total"><strong> {{ number_format($receipts->tax_amount, 2) }} {{ $receipts->tax_percentage }}</strong></td>
        </tr>
        @endif
        <tr style="background-color:{{ $receipts->detail->primary_color ?? '#ffffff'  }};">
            <td colspan="3"></td>
            <td><strong style="color: #ddd">Total</strong></td>
            <td id="grand-total"><strong style="color: #ddd">{{ formatCurrency($receipts->grand_total) }}</strong></td>
        </tr>
    </tfoot>
</table>

<script>
    // Calculate total price dynamically
    function calculateTotal() {
        let total = 0;
        document.querySelectorAll(".total-price").forEach((cell) => {
            total += parseFloat(cell.textContent) || 0;
        });
        document.getElementById("grand-total").textContent = total.toLocaleString();
    }

    // Run the calculation when the page loads
    calculateTotal();
</script>

        <br>
        <table class="payment-table">
            <tr>
                <th>Item</th>
                {{-- <th>Description</th> --}}
                <th>Amount</th>
                <th>Percentage (%)</th>
            </tr>
            <tr>
                <td>Payment</td>
                <td>{{ $receipts->profit->amount_paid ?? 'None' }}</td>
                {{-- <td></td> --}}
                @php
                $grandTotal = $receipts->grand_total;
                $amountPaid = optional($receipts->profit)->amount_paid;
                $percentage = ($grandTotal > 0 && $amountPaid) ? ($amountPaid / $grandTotal) * 100 : 0;
            @endphp

            <td>
                @if($amountPaid)
                    {{ number_format($percentage, 2) }}%
                @else
                    --
                @endif
            </td>

            </tr>
            {{-- <tr>
                <td>Final Payment</td>
                @if(optional($receipts->profit)->amount_paid == formatCurrency($item->total))
                <td>{{ $receipts->profit->amount_paid }}</td>
            @else
                <td></td>
            @endif

            @if(optional($receipts->profit)->amount_paid == formatCurrency($item->total))
            <td>100%</td>
        @else
            <td></td>
        @endif

            </tr> --}}
        </table>
        <div class="footer">

{{-- <div style="line-height: 20px;" class="bank-details-box">
    <p style="font-size: 12px;"><strong><i class="fa-solid fa-user"></i> Angela .T. Mulenga</strong></p>
    <p style="font-size: 12px;"><i class="fa-solid fa-briefcase"></i> ZIPHO HR SOLUTIONS / Consultant</p>
    <p style="font-size: 12px;"><i class="fa-solid fa-phone"></i> +260 974 225 923</p>
    <p style="font-size: 12px;"><i class="fa-solid fa-envelope"></i> <a href="mailto:admin@ziphohr.com">admin@ziphohr.com</a></p>
    <p style="font-size: 12px;"><i class="fa-solid fa-globe"></i> <a href="https://www.ziphohr.com" target="_blank">www.ziphohr.com</a></p>
    <p style="font-size: 12px;"><i class="fa-solid fa-location-dot"></i> 23505/M Ibex Hill, Lusaka Zambia.</p>
</div> --}}

        </div>
                <div class="details">
            <p style="font-size:12px"><strong>NOTE:</strong> {{ $receipts->receipts_note ?? 'Thank you for your purchase! Please keep this receipt for your records."'}} </p>

        </div>
    </div>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</body>
</html>
