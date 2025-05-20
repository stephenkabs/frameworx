<!DOCTYPE html>
<html>
<head>
    <title>Employee Login</title>
</head>
<body>
    <h1>Employee Login</h1>
    <form action="{{ route('employee.login') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
