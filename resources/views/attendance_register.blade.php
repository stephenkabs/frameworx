<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Smart Employee Attendance</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      flex-direction: column;
    }

    .icon {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background-color: #0e3069;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 10px;
    }

    .icon::before {
      content: '👤'; /* Placeholder icon */
      font-size: 36px;
      color: white;
    }

    .button-wrapper {
  display: flex;
  justify-content: center;
}


    h2 {
      color: #0e3069;
      margin-bottom: 20px;
      font-weight: bold;
    }

    input[type="text"] {
      width: 400px;
      padding: 15px;
      font-size: 18px;
      text-align: center;
      border: 1px solid #ccc;
      border-radius: 40px;
      outline: none;
      margin-bottom: 20px;
      font-weight: bold;
      color: #777;
    }

    button {
      width: 300px;
      padding: 15px;
      font-size: 18px;
      border: none;
      border-radius: 40px;
      background-color: #0e3069;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0b254f;
    }
  </style>
</head>
<body>
  <div class="icon"></div>
  <h2>SMART EMPLOYEE ATTENDANCE</h2>

  @if(session('success'))
  <div id="success-alert" style="
    background-color: #d4edda;
    color: #155724;
    padding: 15px 25px;
    border-radius: 10px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
    border: 1px solid #c3e6cb;
    width: 100%;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
  ">
    {{ session('success') }}
  </div>

  <script>
    setTimeout(() => {
      const alert = document.getElementById('success-alert');
      if (alert) {
        alert.style.transition = 'opacity 0.5s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500); // Optional: remove from DOM after fade out
      }
    }, 1000);
  </script>
@endif

  <form id="clock-in-form" class="row needs-validation" action="{{ route('attendance.store') }}"
  novalidate method="POST" enctype="multipart/form-data">
@csrf

<div style="display: flex; flex-direction: column; align-items: center; width: 100%;">
<input type="text" id="tracking_code" name="tracking_code" placeholder="Enter Employee MAN ID" style="
  width: 400px;
  padding: 15px;
  font-size: 18px;
  text-align: center;
  border: 1px solid #ccc;
  border-radius: 40px;
  outline: none;
  font-weight: bold;
  color: #777;
  margin-bottom: 10px;
" />

<!-- Where details will show -->
<div id="worker-info" style="
  min-height: 24px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 30px;
  font-size: 18px;
  font-weight: bold;
  color: #0e3069;
  text-align: center;
"></div>
</div>

<div class="button-wrapper" style="text-align: center; margin-top: 20px;">
<button type="submit" style="
  width: 300px;
  padding: 15px;
  font-size: 18px;
  border: none;
  border-radius: 40px;
  background-color: #0e3069;
  color: white;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
">Clock In</button>
</div>
</form>

<script>
document.getElementById('tracking_code').addEventListener('input', function () {
    const code = this.value.trim();

    if (code.length >= 3) {
        fetch('/get-worker', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ tracking_code: code })

        })
        .then(response => response.json())
        .then(data => {
            const infoDiv = document.getElementById('worker-info');
            if (data && data.name) {
                infoDiv.innerHTML = `
                    <strong>Name:</strong> ${data.name} <br>
                    <strong>Position:</strong> ${data.designation || 'N/A'} <br>
                    <input type="hidden" name="clock_in[${data.id}]" value="1" />
                `;
            } else {
                infoDiv.innerHTML = '<span style="color:red;">No employee found with that MAN ID.</span>';
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
});

    </script>


</body>
</html>
