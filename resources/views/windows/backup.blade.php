{{-- Back up 1 --}}

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setup Wizard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
background: rgb(10,206,255);
background: linear-gradient(248deg, rgba(10,206,255,1) 0%, rgba(5,9,38,1) 82%);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .setup-container {
      width: 800px;
      height: 600px;
      background-color: #e6f2ff;
      display: flex;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 10px;
      overflow: hidden;
    }

    .sidebar {
      width: 25%;
      background-color: #003366;
      color: white;
      display: flex;
      flex-direction: column;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar li {
      padding: 15px 20px;
      cursor: pointer;
      background-color: #004080;
      margin: 5px 0;
      text-align: left;
    }

    .sidebar li.active {
      background-color: #0059b3;
    }

    .sidebar li:hover {
      background-color: #0059b3;
    }

    .content-container {
      flex: 1;
      padding: 20px;
      display: none;
    }

    .content-container.active {
      display: block;
    }

    .content-container h2 {
      margin-top: 0;
      color: #003366;
    }

    .form {
      margin-top: 20px;
    }

    .form label {
      display: block;
      margin: 10px 0 5px;
    }

    .form input, .form select, .form textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="setup-container">
<!-- Success Modal -->
<div id="success-modal" class="modal">
    <div class="modal-content success">
      <span class="icon">&#10003;</span>
      <span id="success-message-content"></span>
      <button class="close-btn" onclick="closeModal('success-modal')">&times;</button>
    </div>
  </div>

  <!-- Error Modal -->
  <div id="error-modal" class="modal">
    <div class="modal-content error">
      <span class="icon">&#9888;</span>
      <ul id="error-message-content"></ul>
      <button class="close-btn" onclick="closeModal('error-modal')">&times;</button>
    </div>
  </div>
  <style>
    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .modal-content {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      text-align: center;
      animation: fadeIn 0.3s ease-in-out;
    }

    .modal-content.success {
      background: #e7f9e7;
      color: #2e7d32;
      border-left: 5px solid #2e7d32;
    }

    .modal-content.error {
      background: #fdecea;
      color: #d32f2f;
      border-left: 5px solid #d32f2f;
    }

    .modal .icon {
      font-size: 1.5em;
      margin-bottom: 10px;
    }

    .close-btn {
      background: none;
      border: none;
      font-size: 1.5em;
      cursor: pointer;
      color: inherit;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>
<script>
    function openModal(modalId, content) {
      const modal = document.getElementById(modalId);
      if (modalId === 'success-modal') {
        document.getElementById('success-message-content').innerText = content;
      } else if (modalId === 'error-modal') {
        const errorList = document.getElementById('error-message-content');
        errorList.innerHTML = '';
        content.forEach(error => {
          const li = document.createElement('li');
          li.innerText = error;
          errorList.appendChild(li);
        });
      }
      modal.style.display = 'flex';

      // Auto-hide after 2 seconds
      setTimeout(() => {
        modal.style.display = 'none';
      }, 2000);
    }

    function closeModal(modalId) {
      document.getElementById(modalId).style.display = 'none';
    }

    // Display modals based on session data
    document.addEventListener('DOMContentLoaded', () => {
      @if(session('success'))
        openModal('success-modal', "{{ session('success') }}");
      @endif

      @if($errors->any())
        openModal('error-modal', @json($errors->all()));
      @endif
    });
  </script>

    <div class="sidebar"><br><br>
      <ul style="font-size: 12px;">
        <li data-target="business-details" class="active">Business Details</li>
        <li data-target="currency">Set your Currency</li>
        {{-- <li data-target="bank-accounts">Bank Accounts</li> --}}
        <li data-target="wallpaper">Set your Desk Wallpaper</li>
        <li data-target="finish">Finish</li>

      </ul>
      <!-- <li data-target="finish"><span style="font-size:8px;"><b>Powered by AwCloud Technologies</b><br></span></li> -->
    </div>
    <div id="business-details" class="content-container active">

      <h2>Business Details</h2>
    <form id="business-form" action="{{ route('details.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <input type="text" id="business-name" name="name" placeholder="Enter your business name">
      </div>
      <div class="form-group">
        <input type="text" id="business-type" name="address" placeholder="Enter your business Address">
      </div>
      <div class="form-group">
        <input type="email" id="business-industry" name="email" placeholder="Enter your business Email">
      </div>
      <div class="form-group">
        <input type="text" id="business-location" name="phone" placeholder="Enter your business Contact">
      </div>
      <div class="form-group">
        <input type="text" id="business-location" name="website" placeholder="Enter your business Website">
      </div>
      <div class="form-group">
        <input type="file" id="business-contact" name="image">
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
  <style>
    /* General Form Container */
    form {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #f9f9f9;
    }

    /* Form Heading */
    form h2 {
      text-align: center;
      margin-bottom: 20px;
      font-family: Arial, sans-serif;
      color: #333;
    }

    /* Form Groups */
    form .form-group {
      margin-bottom: 15px;
    }

    /* Labels */
    form label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      color: #555;
    }

    /* Input Fields and Textareas */
    form input[type="text"],
    form input[type="email"],
    form input[type="file"],
    form select,
    form textarea {
      display: block;
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box; /* Ensures consistent padding and border sizing */
    }

    /* Submit Button */
    form button[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    /* Button Hover Effect */
    form button[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>



    <div id="currency" class="content-container">

      <h2>Set your Currency</h2>
      <form action="{{ route('currency.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="currency" class="form-label">Select Default Currency</label>
            <select name="currency" class="form-select" id="currency" required>
                <option value="USD"
                    {{ config('app.currency') == 'USD' ? 'selected' : '' }}>USD - US
                    Dollar</option>
                <option value="EUR"
                    {{ config('app.currency') == 'EUR' ? 'selected' : '' }}>EUR - Euro
                </option>
                <option value="GBP"
                    {{ config('app.currency') == 'GBP' ? 'selected' : '' }}>GBP -
                    British Pound</option>
                <option value="ZMW"
                    {{ config('app.currency') == 'ZMW' ? 'selected' : '' }}>ZMW -
                    Zambian Kwacha</option>
                <option value="AUD"
                    {{ config('app.currency') == 'AUD' ? 'selected' : '' }}>AUD -
                    Australian Dollar</option>
                <option value="CAD"
                    {{ config('app.currency') == 'CAD' ? 'selected' : '' }}>CAD -
                    Canadian Dollar</option>
                <option value="CHF"
                    {{ config('app.currency') == 'CHF' ? 'selected' : '' }}>CHF - Swiss
                    Franc</option>
                <option value="JPY"
                    {{ config('app.currency') == 'JPY' ? 'selected' : '' }}>JPY -
                    Japanese Yen</option>
                <option value="CNY"
                    {{ config('app.currency') == 'CNY' ? 'selected' : '' }}>CNY -
                    Chinese Yuan</option>
                <option value="NZD"
                    {{ config('app.currency') == 'NZD' ? 'selected' : '' }}>NZD - New
                    Zealand Dollar</option>
                <option value="SGD"
                    {{ config('app.currency') == 'SGD' ? 'selected' : '' }}>SGD -
                    Singapore Dollar</option>
                <option value="NOK"
                    {{ config('app.currency') == 'NOK' ? 'selected' : '' }}>NOK -
                    Norwegian Krone</option>
                <option value="SEK"
                    {{ config('app.currency') == 'SEK' ? 'selected' : '' }}>SEK -
                    Swedish Krona</option>
                <option value="DKK"
                    {{ config('app.currency') == 'DKK' ? 'selected' : '' }}>DKK -
                    Danish Krone</option>
                <option value="MXN"
                    {{ config('app.currency') == 'MXN' ? 'selected' : '' }}>MXN -
                    Mexican Peso</option>
                <option value="BRL"
                    {{ config('app.currency') == 'BRL' ? 'selected' : '' }}>BRL -
                    Brazilian Real</option>
                <option value="INR"
                    {{ config('app.currency') == 'INR' ? 'selected' : '' }}>INR -
                    Indian Rupee</option>
                <option value="RUB"
                    {{ config('app.currency') == 'RUB' ? 'selected' : '' }}>RUB -
                    Russian Ruble</option>
                <option value="ZAR"
                    {{ config('app.currency') == 'ZAR' ? 'selected' : '' }}>ZAR - South
                    African Rand</option>
                <option value="THB"
                    {{ config('app.currency') == 'THB' ? 'selected' : '' }}>THB - Thai
                    Baht</option>
                <option value="AED"
                    {{ config('app.currency') == 'AED' ? 'selected' : '' }}>AED -
                    United Arab Emirates Dirham</option>
                <option value="PLN"
                    {{ config('app.currency') == 'PLN' ? 'selected' : '' }}>PLN -
                    Polish Zloty</option>
                <option value="HUF"
                    {{ config('app.currency') == 'HUF' ? 'selected' : '' }}>HUF -
                    Hungarian Forint</option>

                <!-- Add more currencies as needed -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Currency</button>
    </form>
    </div>

    <div id="wallpaper" class="content-container">

      <h2>Set your Desk Wallpaper</h2>
      <form action="{{ route('wallpaper.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <button class="btn btn-info waves-effect waves-light" type="submit">Set Wallpaper</button>
        <a class="btn btn-link btn-sm waves-effect waves-light">
            <input name="file" type="file" class="form-control" />
        </a>
        <div class="wallpaper-options scrollable">
            @foreach ($wallpapers as $wallpaper)
                <label class="wallpaper-item">
                    <input type="radio" name="wallpaper" value="{{ $wallpaper }}">
                    <img
                        src="{{ file_exists(public_path($wallpaper)) ? asset($wallpaper) : asset('/login_style/images/login-bg-3.jpg') }}"
                        alt="Wallpaper"
                    >
                </label>
            @endforeach
        </div>
    </form>

    <style>
        .scrollable {
            max-height: 300px; /* Adjust as needed */
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .wallpaper-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 10px;
        }

        .wallpaper-item img {
            width: 100px;
            height: 80px;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>



    </div>
    <div id="finish" class="content-container">
      <h2>Finish</h2>
      <p>Setup is complete. Click 'Save' to finalize your settings.</p>
      <a href="/dashboard">Save</a>
    </div>
  </div>

  <script>
    const sidebarItems = document.querySelectorAll('.sidebar li');
    const contentSections = document.querySelectorAll('.content-container');

    sidebarItems.forEach(item => {
      item.addEventListener('click', () => {
        // Remove active class from all sidebar items
        sidebarItems.forEach(el => el.classList.remove('active'));
        // Hide all content sections
        contentSections.forEach(section => section.classList.remove('active'));

        // Add active class to clicked item
        item.classList.add('active');
        // Show the corresponding content section
        const target = item.getAttribute('data-target');
        document.getElementById(target).classList.add('active');
      });
    });
  </script>

</body>
</html>
{{-- end back up 1 --}}









<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setup Wizard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
background: rgb(10,206,255);
background: linear-gradient(248deg, rgba(10,206,255,1) 0%, rgba(5,9,38,1) 82%);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .setup-container {
      width: 800px;
      height: 600px;
      background-color: #e6f2ff;
      display: flex;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 10px;
      overflow: hidden;
    }

    .sidebar {
      width: 25%;
      background-color: #003366;
      color: white;
      display: flex;
      flex-direction: column;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar li {
      padding: 15px 20px;
      cursor: pointer;
      background-color: #004080;
      margin: 5px 0;
      text-align: left;
    }

    .sidebar li.active {
      background-color: #0059b3;
    }

    .sidebar li:hover {
      background-color: #0059b3;
    }

    .content-container {
      flex: 1;
      padding: 20px;
      display: none;
    }

    .content-container.active {
      display: block;
    }

    .content-container h2 {
      margin-top: 0;
      color: #003366;
    }

    .form {
      margin-top: 20px;
    }

    .form label {
      display: block;
      margin: 10px 0 5px;
    }

    .form input, .form select, .form textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="setup-container">

    <div class="sidebar"><br><br>
      <ul style="font-size: 12px;">
        <li data-target="business-details" class="active">Business Details</li>
        <li data-target="currency">Set your Currency</li>
        <li data-target="bank-accounts">Bank Accounts</li>
        <li data-target="wallpaper">Set your Desk Wallpaper</li>
        <li data-target="finish">Finish</li>

      </ul>
      <!-- <li data-target="finish"><span style="font-size:8px;"><b>Powered by AwCloud Technologies</b><br></span></li> -->
    </div>
    <div id="business-details" class="content-container active">
        @include('includes.login_error')
      <h2>Business Details</h2>
    <form id="business-form" action="{{ route('details.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <input type="text" id="business-name" name="name" placeholder="Enter your business name">
      </div>
      <div class="form-group">
        <input type="text" id="business-type" name="address" placeholder="Enter your business Address">
      </div>
      <div class="form-group">
        <input type="email" id="business-industry" name="email" placeholder="Enter your business Email">
      </div>
      <div class="form-group">
        <input type="text" id="business-location" name="phone" placeholder="Enter your business Contact">
      </div>
      <div class="form-group">
        <input type="text" id="business-location" name="website" placeholder="Enter your business Website">
      </div>
      <div class="form-group">
        <input type="file" id="business-contact" name="image">
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
  <style>
    /* General Form Container */
    form {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #f9f9f9;
    }

    /* Form Heading */
    form h2 {
      text-align: center;
      margin-bottom: 20px;
      font-family: Arial, sans-serif;
      color: #333;
    }

    /* Form Groups */
    form .form-group {
      margin-bottom: 15px;
    }

    /* Labels */
    form label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      color: #555;
    }

    /* Input Fields and Textareas */
    form input[type="text"],
    form input[type="email"],
    form input[type="file"],
    form select,
    form textarea {
      display: block;
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box; /* Ensures consistent padding and border sizing */
    }

    /* Submit Button */
    form button[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    /* Button Hover Effect */
    form button[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>



    <div id="currency" class="content-container">
        @include('includes.login_error')
      <h2>Set your Currency</h2>
      <form action="{{ route('currency.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="currency" class="form-label">Select Default Currency</label>
            <select name="currency" class="form-select" id="currency" required>
                <option value="USD"
                    {{ config('app.currency') == 'USD' ? 'selected' : '' }}>USD - US
                    Dollar</option>
                <option value="EUR"
                    {{ config('app.currency') == 'EUR' ? 'selected' : '' }}>EUR - Euro
                </option>
                <option value="GBP"
                    {{ config('app.currency') == 'GBP' ? 'selected' : '' }}>GBP -
                    British Pound</option>
                <option value="ZMW"
                    {{ config('app.currency') == 'ZMW' ? 'selected' : '' }}>ZMW -
                    Zambian Kwacha</option>
                <option value="AUD"
                    {{ config('app.currency') == 'AUD' ? 'selected' : '' }}>AUD -
                    Australian Dollar</option>
                <option value="CAD"
                    {{ config('app.currency') == 'CAD' ? 'selected' : '' }}>CAD -
                    Canadian Dollar</option>
                <option value="CHF"
                    {{ config('app.currency') == 'CHF' ? 'selected' : '' }}>CHF - Swiss
                    Franc</option>
                <option value="JPY"
                    {{ config('app.currency') == 'JPY' ? 'selected' : '' }}>JPY -
                    Japanese Yen</option>
                <option value="CNY"
                    {{ config('app.currency') == 'CNY' ? 'selected' : '' }}>CNY -
                    Chinese Yuan</option>
                <option value="NZD"
                    {{ config('app.currency') == 'NZD' ? 'selected' : '' }}>NZD - New
                    Zealand Dollar</option>
                <option value="SGD"
                    {{ config('app.currency') == 'SGD' ? 'selected' : '' }}>SGD -
                    Singapore Dollar</option>
                <option value="NOK"
                    {{ config('app.currency') == 'NOK' ? 'selected' : '' }}>NOK -
                    Norwegian Krone</option>
                <option value="SEK"
                    {{ config('app.currency') == 'SEK' ? 'selected' : '' }}>SEK -
                    Swedish Krona</option>
                <option value="DKK"
                    {{ config('app.currency') == 'DKK' ? 'selected' : '' }}>DKK -
                    Danish Krone</option>
                <option value="MXN"
                    {{ config('app.currency') == 'MXN' ? 'selected' : '' }}>MXN -
                    Mexican Peso</option>
                <option value="BRL"
                    {{ config('app.currency') == 'BRL' ? 'selected' : '' }}>BRL -
                    Brazilian Real</option>
                <option value="INR"
                    {{ config('app.currency') == 'INR' ? 'selected' : '' }}>INR -
                    Indian Rupee</option>
                <option value="RUB"
                    {{ config('app.currency') == 'RUB' ? 'selected' : '' }}>RUB -
                    Russian Ruble</option>
                <option value="ZAR"
                    {{ config('app.currency') == 'ZAR' ? 'selected' : '' }}>ZAR - South
                    African Rand</option>
                <option value="THB"
                    {{ config('app.currency') == 'THB' ? 'selected' : '' }}>THB - Thai
                    Baht</option>
                <option value="AED"
                    {{ config('app.currency') == 'AED' ? 'selected' : '' }}>AED -
                    United Arab Emirates Dirham</option>
                <option value="PLN"
                    {{ config('app.currency') == 'PLN' ? 'selected' : '' }}>PLN -
                    Polish Zloty</option>
                <option value="HUF"
                    {{ config('app.currency') == 'HUF' ? 'selected' : '' }}>HUF -
                    Hungarian Forint</option>

                <!-- Add more currencies as needed -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Currency</button>
    </form>
    </div>
    <div id="bank-accounts" class="content-container">
        @include('includes.login_error')
      <h2>Bank Accounts</h2>
      <form class="row needs-validation" action="{{ route('accounts.store') }}" novalidate
      method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Account Name -->
      <div class="mb-3 position-relative">
          <label class="form-label">Account Name</label>
          <div>
              <input name="name" type="text" class="form-control"
                  placeholder="Enter Account Name" required />
          </div>
      </div>


      <!-- Account Name -->
      <div class="mb-3 position-relative">
          <label class="form-label">Bank Name</label>
          <div>
              <input name="account_name" type="text" class="form-control"
                  placeholder="Enter Bank Name" required />
          </div>
      </div>

      <!-- Account Number -->
      <div class="mb-3 position-relative">
          <label class="form-label">Account Number</label>
          <div>
              <input name="account_number" type="text" class="form-control"
                  placeholder="Enter Account Number" required />
          </div>
      </div>

      <!-- Branch -->
      <div class="mb-3 position-relative">
          <label class="form-label">Branch</label>
          <div>
              <input name="branch" type="text" class="form-control"
                  placeholder="Enter Branch" required />
          </div>
      </div>

      <!-- Account Type -->
      <div class="mb-3 position-relative">
          <label class="form-label" for="validationCustom01">Account Payment
              Way</label>
          <select type="text" name="type" class="form-select"
              id="validationCustom01" placeholder="Enter Project name" required>
              <option value="" disabled selected>Select Payment Way</option>
              <option>Online Payment </option>
              {{-- <option>Offline Giving </option> --}}
          </select>

      </div>

      <!-- Target -->
      <div class="mb-3 position-relative">
          <label class="form-label" for="validationCustom01">Accounts For</label>
          <select type="text" name="target" class="form-select"
              id="validationCustom01" placeholder="Enter Project name" required>
              <option value="" disabled selected>Select Description</option>
              <option>Main</option>
              <option value="yearly_savings">Yearly </option>
              <option value="monthly_savings">Monthly Savings </option>
              <option value="daily_savings">Daily Savings </option>
              <option value="business_account">Business Account </option>
              <option>Other </option>

          </select>

      </div>



      <!-- Submit and Reset buttons -->
      <div class="mb-0">
          <div>
              <button type="submit" class="btn btn-info waves-effect waves-light">
                  Save
              </button>

          </div>
      </div>
  </form>
    </div>
    <div id="wallpaper" class="content-container">
        @include('includes.login_error')
      <h2>Set your Desk Wallpaper</h2>
      <form action="{{ route('wallpaper.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <button class="btn btn-info waves-effect waves-light" type="submit">Set Wallpaper</button>
        <a class="btn btn-link btn-sm waves-effect waves-light">
            <input name="file" type="file" class="form-control" />
        </a>
        <div class="wallpaper-options scrollable">
            @foreach ($wallpapers as $wallpaper)
                <label class="wallpaper-item">
                    <input type="radio" name="wallpaper" value="{{ $wallpaper }}">
                    <img
                        src="{{ file_exists(public_path($wallpaper)) ? asset($wallpaper) : asset('/login_style/images/login-bg-3.jpg') }}"
                        alt="Wallpaper"
                    >
                </label>
            @endforeach
        </div>
    </form>

    <style>
        .scrollable {
            max-height: 300px; /* Adjust as needed */
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .wallpaper-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 10px;
        }

        .wallpaper-item img {
            width: 100px;
            height: 80px;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>



    </div>
    <div id="finish" class="content-container">
      <h2>Finish</h2>
      <p>Setup is complete. Click 'Save' to finalize your settings.</p>
      <a href="/dashboard">Save</a>
    </div>
  </div>

  <script>
    const sidebarItems = document.querySelectorAll('.sidebar li');
    const contentSections = document.querySelectorAll('.content-container');

    sidebarItems.forEach(item => {
      item.addEventListener('click', () => {
        // Remove active class from all sidebar items
        sidebarItems.forEach(el => el.classList.remove('active'));
        // Hide all content sections
        contentSections.forEach(section => section.classList.remove('active'));

        // Add active class to clicked item
        item.classList.add('active');
        // Show the corresponding content section
        const target = item.getAttribute('data-target');
        document.getElementById(target).classList.add('active');
      });
    });
  </script>

</body>
</html>
