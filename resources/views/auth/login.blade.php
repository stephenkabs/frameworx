
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plus Login</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            background: linear-gradient(35deg, #095ba4, #092751);
        }

        .microsoft-login {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    border-radius: 16px;
    background-color: #ffffff;
    color: white;
    font-size: 14px;
    font-weight: bold;
    text-decoration: none;
    width: 94%;
    border: 1px solid #ccc;
}

.microsoft-login:hover {
    background-color: #d5d5d5;
    text-decoration: none;
}

.microsoft-login img {
    margin-right: 8px;
}


        .login-container {
            width: 350px;
            padding: 20px;
            border-radius: 12px;
            background-color: white;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container h1 {
            font-size: 24px;
            font-weight: bold;
            color: #18509e;
            margin-bottom: 16px;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container input {
            margin-bottom: 16px;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 16px;
            font-size: 13px;
        }

        .login-container select {
            margin-bottom: 16px;
            padding: 10px;
            border: 1px solid #d4d4d4;
            border-radius: 16px;
            font-size: 13px;
            background-color: white;
            color: #878888;
        }

        .login-container button {
            padding: 12px;
            border: none;
      border-radius: 16px;
            background-color: #18509e;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #18509e;
        }

        .login-container a {
            font-size: 14px;
            color: #18509e;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 12px;
            font-size: 12px;
            color: #6b7280;
        }

        .footer span {
            font-weight: bold;
        }


        .status-message {
            margin-bottom: 16px;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
        }

        .error-message {
            background-color: #ffebee;
            color: #d32f2f;
            border: 1px solid #d32f2f;
        }

        .success-message {
            background-color: #e8f5e9;
            color: #388e3c;
            border: 1px solid #388e3c;
        }

        .alert {
    padding: 15px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 500px;
    margin: 10px auto;
    position: relative;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.5s ease-in-out;
}

.alert-success {
    background-color: #d1f7d1;
    color: #155724;
    border-left: 5px solid #28a745;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border-left: 5px solid #dc3545;
}

.alert .close-btn {
    background: none;
    border: none;
    font-size: 12px;
    font-weight: bold;
    cursor: pointer;
    color: inherit;
    outline: none;
}

.alert .close-btn:hover {
    opacity: 0.7;
}

/* Fade-in animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }


}
/* button {
    position: relative;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 120px;
} */

button:disabled {
    background-color: #18509e;
    cursor: not-allowed;
}

/* Spinner */
.spinner {
    width: 8px;
    height: 8px;
    border: 3px solid #fff;
    border-top: 3px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

/* Keyframes for rotation */
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}


    </style>
</head>
<body>
    <div class="login-container">

        <h2 style="font-size: 17px">
            {{-- Log in to your Virtual Machine. --}}
            {{-- <style>
                .logo-main {
                    filter: brightness(0) invert(1);
                }
                </style> --}}
                <img class="logo-main" src="/login_images/logo.webp" alt="" width="180px">

        </h2>

               {{-- <!-- Display Error or Success Message -->
               @if (session('status'))
               <div class="status-message error-message">
                   {{ session('status') }}
               </div>
           @endif --}}

           @if(session('success'))
           <div class="alert alert-success">
               {{ session('status') }}
               <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
           </div>
       @endif

       @if($errors->has('error'))
           <div class="alert alert-danger">
               {{ $errors->first('error') }}
               <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
           </div>
       @endif


        <form method="POST" action="{{ route('login') }}" onsubmit="showLoading(event)">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" id="submit-btn">
                <span id="btn-text">Login</span>
                <span id="loading-spinner" class="spinner" style="display: none;"></span>
            </button>
            <br>
<a href="{{ route('microsoft.login') }}" class="microsoft-login">
    <img src="/login_images/logo.svg" alt="Microsoft Logo" height="20">
    Login with Microsoft
</a>
<br><br>

        </form>

        <!-- JavaScript -->
        <script>
            function showLoading(event) {
                event.preventDefault(); // Prevent multiple form submissions

                let submitBtn = document.getElementById("submit-btn");
                let btnText = document.getElementById("btn-text");
                let spinner = document.getElementById("loading-spinner");

                // Hide button text and show spinner
                btnText.style.display = "none";
                spinner.style.display = "inline-block";

                // Disable the button
                submitBtn.disabled = true;

                // Submit the form after a short delay
                setTimeout(() => {
                    event.target.submit();
                }, 500);
            }
        </script>





        <a href="{{ route('password.request') }}"><span style="font-size: 12px; color:#18509e">Forgot Password ?</span></a>
        <div class="footer">Powered by <span>Frameworx Technologies</span></div><br>
    </div>
</body>
</html>

