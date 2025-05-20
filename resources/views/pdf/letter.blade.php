<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $letter->reference }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .letterhead {
            /* width: 210mm; */
            /* height: 297mm; A4 size */
            /* margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border: 1px solid #ffffff; */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #696969;
            padding-bottom: 10px;
        }
        .header img {
            width: 250px;
            height: auto;
        }
        .header .company-details {
            text-align: right;
            color: #333;
            line-height: 1.2; /* Reduced line-height */
        }
        .header .company-details h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header .company-details p {
            margin: 2px 0;
            font-size: 11px;
            color: #767676;
        }
        .content {
            margin-top: 20px;
            padding: 40px;
            font-size: 12px;
            color: #333;
            line-height: 1.5; /* Default line-height for content */
        }
        .footer {
            margin-top: 50px;
            border-top: 1px solid #7f7f7f;
            padding-top: 10px;
            text-align: center;
            font-size: 9px;
            color: #828282;
        }
        .footer .footer-content {
            /* display: flex; */
            justify-content: center;
            padding-top: 0px;
        }
        .footer .footer-content div {
            width: 30%;
        }
    </style>
</head>
<body>
    <div class="letterhead">
        <!-- Header Section -->
        <div class="header">
            <img src="{{ public_path('logos/' . $letter->detail->image) }}" alt="Company Logo"><br>
            <div class="company-details">
                <h1>{{ $letter->detail->name }}</h1>
                <p>{{ $letter->detail->address }}</p>
                <p>Phone: {{ $letter->detail->phone }} | Email: {{ $letter->detail->email }}</p>
                <p>Website: {{ $letter->detail->website }}</p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="content">

            <p>{!! $letter->description !!}</p>

        </div>

        <!-- Footer Section -->
        <div class="footer">
            <div class="footer-content">

                    {{-- <p>{{ $letter->specialized }}</p> --}}

            </div>
        </div>
    </div>
</body>
</html>
