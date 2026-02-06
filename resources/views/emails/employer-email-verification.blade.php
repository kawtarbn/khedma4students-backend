<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Email Verification - Khedma4Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .button {
            display: inline-block;
            padding: 15px 30px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Khedma4Students</h1>
        <p>Verify Your Email Address</p>
    </div>
    
    <div class="content">
        <h2>Welcome {{ $employer->full_name }}!</h2>
        
        <p>Thank you for signing up with Khedma4Students. To complete your registration, please verify your email address.</p>
        
        <p>Click the button below to verify your email:</p>
        
        <a href="{{ url('/employer-verify-email?token=' . $token) }}" class="button">
            Verify Email
        </a>
        
        <p>Or copy and paste this link in your browser:</p>
        <p>{{ url('/employer-verify-email?token=' . $token) }}</p>
        
        <p><strong>This link will expire in 24 hours.</strong></p>
        
        <p>If you didn't create an account with Khedma4Students, you can safely ignore this email.</p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} Khedma4Students. All rights reserved.</p>
        <p>Connecting Algerian students with opportunities</p>
    </div>
</body>
</html>
