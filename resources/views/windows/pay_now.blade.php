<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Mobile Entry</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #115c7a, #0a2553);
            color: #ffffff;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            text-align: center;
            max-width: 400px;
            width: 100%;
            backdrop-filter: blur(10px);
        }

        h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #e3f2fd;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 12px;
            font-size: 1em;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input, select {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
            transition: background 0.3s, box-shadow 0.3s;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        input:focus, select:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        button {
            background: linear-gradient(135deg, #1d8dc9, #125a9b);
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #125a9b, #0a3e6d);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(1px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        .message {
            margin: 10px 0;
            font-size: 0.9em;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background: rgba(76, 175, 80, 0.2);
            color: #4caf50;
        }

        .error {
            background: rgba(244, 67, 54, 0.2);
            color: #f44336;
        }

        ul {
            padding-left: 20px;
            text-align: left;
        }

        li {
            list-style: square;
        }
    </style>
</head>
<body data-sidebar="dark" data-keep-enlarged="true" class="vertical-collapsed">


    <!-- Background image div with blur -->
    <div style="
        position: fixed;
        top: -2.5%;
        left: -2.5%;
        width: 105%;
        height: 105%;
        background:
            @php
                $latestBackground = $background->where('type', 'login_background')->sortByDesc('created_at')->first();
            @endphp
            @if ($latestBackground)
                url('{{ asset('background_images/' . $latestBackground->image) }}') no-repeat center center;
            @else
                radial-gradient(circle, rgb(17, 92, 122) 30%, rgba(10,37,83,1) 100%);
            @endif
        background-size: cover;
        filter: blur(0px);
        z-index: -2;">
    </div>

    <!-- Overlay for darkening the wallpaper background -->
    <div style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: -1;">
    </div>
    <div class="form-container">
        @include('includes.login_error')
        <h2>Payment Transfer</h2>
        {{-- <p>cool</p><br><br> --}}

        <form action="{{ route('mobile.store') }}" method="POST" id="paymentForm">
            @csrf
            <input name="name" type="hidden" value="{{ Auth::check() ? Auth::user()->name : '' }}">

            <input name="status" type="hidden" value="unapproved" >

            <select name="detail_id" required>
                <option value="">Select Address</option>
                @foreach($detail as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} | {{ $item->address }}</option>
                @endforeach
            </select>

            <select name="pricing_id" class="form-select" required>
                <option value="" disabled selected>Select a Price Packages</option>
                @foreach ($pricingPlan as $item)
                @if ($item->id !== 1)
                    <option value="{{ $item->id }}">{{ $item->name }} | {{ $item->price }}</option>
                @endif
            @endforeach

        </select>

            <input name="transaction_id" type="text" placeholder="Transaction ID " required>
            {{-- <select name="type" required>
                <option value="">Select Package Type</option>
                <option value="Student">Student</option>
                <option value="Individual">Individual </option>
                <option value="Business">Business</option>
            </select> --}}

            <select name="package" required>
                <option value="">Select Transfer Type</option>
                <option value="Airtel Money">Airtel Money</option>
                <option value="MTN Money">MTN Money </option>
                <option value="Bank">Bank Transfer </option>
            </select>

            <select name="country_id" required>
                <option value="">Select Country</option>
                @foreach($country as $c)
                    <option value="Zambia">{{ $c->name }}</option>
                @endforeach
            </select>
            <button type="submit">Submit</button>
        </form>
    </div>
    {{-- <script>
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form's default submission behavior
            // Optionally, you can perform validation or AJAX logic here
            window.location.href = "https://dashboard.stripe.com/test/payments";
        });
    </script> --}}
</body>

{{-- @include('includes.validation') --}}
</html>
