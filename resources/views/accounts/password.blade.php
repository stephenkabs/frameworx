

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Password</title>
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
            gap: 10px; /* Spacing between elements */
        }

        input,
        button {
            width: 100%; /* Full width */
            padding: 12px; /* Consistent padding */
            font-size: 1em; /* Uniform font size */
            border-radius: 5px; /* Same border radius */
            box-sizing: border-box; /* Consistent sizing model */
        }

        input {
            background: rgba(255, 255, 255, 0.2); /* Semi-transparent background */
            border: none;
            color: white;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
            transition: background 0.3s, box-shadow 0.3s;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.3); /* Brighter background */
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        button {
            background: linear-gradient(135deg, #1d8dc9, #125a9b); /* Gradient background */
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
            transform: translateY(-2px); /* Lift effect */
        }

        button:active {
            transform: translateY(1px); /* Press effect */
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

        .footer-text {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 20px;
        }

        .forgot-password {
            font-size: 0.9em;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            margin-top: 10px;
            display: block;
        }

        .forgot-password:hover {
            text-decoration: underline;
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
        @foreach ($displaySettings as $setting )
        <h2 style="font-size: 17px">
            {{-- Log in to your Virtual Machine. --}}
            <style>
                .logo-main {
                    filter: brightness(0) invert(1);
                }
                </style>
                <img class="logo-main" src="/settings/logo_white/{{ $setting->file }}" alt="" width="170px">

        </h2>
        @endforeach

        @if(session('success'))
        <div class="message success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
        <div class="message error">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('accounts.verifyPassword') }}" method="POST">
            @csrf
            {{-- <input name="email" type="email" placeholder="Enter Email" required> --}}
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Login</button>
        </form>
<br>
<a style="font-size: 9px; line-height: 0.5;">Secure Access Required: Please enter your account password to access this section.</a>

        {{-- @foreach ($displaySettings as $setting )
        <div class="footer-text">{{ $setting->copyright }}</div>
        @endforeach --}}
    </div>
</body>
</html>
