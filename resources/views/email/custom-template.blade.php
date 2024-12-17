<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .email-header {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .email-body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="email-header">
        <h1>{{ config('app.name') }}</h1>
    </div>
    <div class="email-body" style="font-family: Arial, sans-serif; color: #333;">
    <p>Hello Alice,</p>
    <p>Your account has been created successfully. Please log in to access your dashboard.</p>
    <p>You can log in to your account using the link below:</p>
    <p>
        <a href="{{ route('login') }}" style="color: #007bff; text-decoration: none;">
            Click here to log in
        </a>
    </p>
    <p>Thank you!</p>
</div>

</body>
</html>
