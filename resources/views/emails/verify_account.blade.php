<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f7;
            color: #51545e;
            margin: 0;
            padding: 0;
        }
        .email-wrapper {
            width: 100%;
            padding: 20px;
            background-color: #f4f4f7;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        }
        .email-header {
            background-color: #3f51b5;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-body {
            padding: 30px;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333333;
        }
        p {
            line-height: 1.6;
            color: #51545e;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            color: #ffffff;
            background-color: #3f51b5;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #2e3b8b;
        }
        .email-footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #999999;
        }
        .email-footer p {
            margin: 0;
        }
    </style>
</head>
<body>
<div class="email-wrapper">
    <div class="email-content">
        <div class="email-header">
            <h2>{{ config('app.name') }}</h2>
        </div>
        <div class="email-body">
            <h1>Welcome, {{ $user->name }}!</h1>
            <p>Thank you for registering with us. Please click the button below to verify your email address:</p>
            <a href="{{ $verificationUrl }}" class="button">Verify Your Email</a>
            <p>If you did not create an account with us, please ignore this email.</p>
            <p>Best regards,<br>The {{ config('app.name') }} Team</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</div>
</body>
</html>
