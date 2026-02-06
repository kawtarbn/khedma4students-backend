<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset - Khedma4Students</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        <p>Password Reset Request</p>
    </div>
    
    <div class="content">
        <h2>Hello {{ $student->full_name }},</h2>
        
        <p>You requested to reset your password for your Khedma4Students student account.</p>
        
        <p>Click the button below to reset your password:</p>
        
        <a href="{{ url('/reset-password?token=' . $token . '&email=' . $student->email) }}" class="button">
            Reset Password
        </a>
        
        <p>Or copy and paste this link in your browser:</p>
        <p>{{ url('/reset-password?token=' . $token . '&email=' . $student->email) }}</p>
        
        <p><strong>This link will expire in 60 minutes.</strong></p>
        
        <p>If you didn't request this password reset, you can safely ignore this email.</p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} Khedma4Students. All rights reserved.</p>
        <p>Connecting Algerian students with opportunities</p>
    </div>
</body>
</html>
