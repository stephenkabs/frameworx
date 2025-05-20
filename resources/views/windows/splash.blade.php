<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Screen</title>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: black;
            color: white;
            font-family: 'Share Tech Mono', monospace;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .logo {
            width: 120px;
            height: 120px;
            background: url('/assets/logo_loader.webp') no-repeat center center;
            background-size: contain;
            margin-bottom: 30px;
        }

        .loader {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top: 5px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        .loading-text {
            font-size: 1.5rem;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .os-text {
            font-size: 1.2rem;
            color: #888;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body id="loader">
    <!-- Logo -->
    <div class="logo"></div>

    <!-- Loader -->
    <div class="loader"></div>

    <!-- Loading Text -->
    <div id="splash" class="loading-text">Loading...</div>

    <!-- OS Name -->
    <div class="os-text">Operating System</div>

    <script>
        let percentage = 0;

        // Function to update loading percentage
        function updateLoadingText() {
            if (percentage <= 100) {
                document.getElementById("splash").innerText = `Loading... ${percentage}%`;
                percentage++;
                setTimeout(updateLoadingText, 50); // Update every 50ms for smooth progression
            }
        }

        // Start updating loading percentage
        updateLoadingText();

        // Redirect after 5 seconds (if you want to add time with percentage loading)
        setTimeout(() => {
            window.location.href = "{{ route('windows.setup') }}";
        }, 5000); // 5 seconds
    </script>
</body>
</html>
