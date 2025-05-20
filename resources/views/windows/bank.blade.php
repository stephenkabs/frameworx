<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company - Detail</title>
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
            font-size: 20px;
            margin-bottom: 20px;
            color: #e3f2fd;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input, select, button {
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

        .file-input-container {
            position: relative;
            margin-top: 10px;
        }

        .file-label {
            display: block;
            background: linear-gradient(135deg, #1d8dc9, #125a9b);
            color: white;
            padding: 12px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .file-label:hover {
            background: linear-gradient(135deg, #125a9b, #0a3e6d);
        }

        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .image-preview {
            margin-top: 15px;
            max-width: 100%;
            max-height: 200px;
            display: none;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
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


        <h2>Enter Business Details</h2>



        <form id="business-form" action="{{ route('accounts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input name="name" type="text" placeholder="Account Names" required>
            <input name="account_name" type="text" placeholder="Bank Name" required>
            <input name="account_number" type="text" placeholder="Account Number" required>
            <input name="branch" type="text" placeholder="Branch" required>
            <select name="target" required>
                <option value="" disabled selected>Select Description</option>
                <option>Main</option>
                <option value="yearly_savings">Yearly </option>
                <option value="monthly_savings">Monthly Savings </option>
                <option value="daily_savings">Daily Savings </option>
                <option value="business_account">Business Account </option>
                <option>Other </option>
            </select>

            <select name="type" required>
                <option value="" disabled selected>Select Type</option>
                <option>Online Payment</option>
            </select>


            <button type="button" id="submit-button">Submit</button>
        </form>
    </div>

   <!-- Modal Structure -->
   <div id="confirmation-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <p>Set Up Desktop Wallpaper</p>
        <div class="button-container">
            <button id="yes-button"><span style="font-size: 12px">Yes</span></button>
            <button id="no-button"><span style="font-size: 12px">No Thank</span></button>
        </div>
    </div>

</div>
    <style>
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .modal-content button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-container {
        display: flex;
        justify-content: center; /* Center the buttons horizontally */
        gap: 10px; /* Add spacing between the buttons */
        margin-top: 15px; /* Add some space above the buttons */
    }

        /* .modal-content button {
        padding: 10px 20px;
        font-size: 1em;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    } */

        #yes-button {
            background-color: #4CAF50;
            color: white;
        }

        #no-button {
            background-color: #f44336;
            color: white;
        }
    </style>
    <script>
        const fileInput = document.getElementById('file-input');
        const imagePreview = document.getElementById('image-preview');

        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
        });
    </script>

<script>
    const submitButton = document.getElementById('submit-button');
    const modal = document.getElementById('confirmation-modal');
    const yesButton = document.getElementById('yes-button');
    const noButton = document.getElementById('no-button');
    const form = document.getElementById('business-form');

    submitButton.addEventListener('click', function () {
        modal.style.display = 'flex';
    });

    yesButton.addEventListener('click', function () {
        modal.style.display = 'none';
        window.location.href = '/wallpaper-selection'; // Redirect to the "bank" blade
    });

    noButton.addEventListener('click', function () {
        modal.style.display = 'none';
        form.submit(); // Submit the form
    });
</script>
</body>
</html>
