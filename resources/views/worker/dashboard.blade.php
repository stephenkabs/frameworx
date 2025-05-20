<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
</head>
<body>
    <h1>Welcome, {{ Auth::guard('employee')->user()->name }}</h1>
    <form action="{{ route('employee.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
