<!-- resources/views/emails/new_user.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to YourApp!</title>
</head>
<body>
    <h1>Welcome to YourApp!</h1>
    <p>Thank you for joining our platform. Click the button below to get started:</p>
    <a href="{{ url('/magic-login') }}/{{ $token }}">Activate Your Account</a>
</body>
</html>
