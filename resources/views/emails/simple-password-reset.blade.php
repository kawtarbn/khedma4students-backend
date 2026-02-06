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
        .token-box {
            background: #fff;
            border: 2px dashed #667eea;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            word-break: break-all;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Khedma4Students</h1>
        <p>{{ $userType === 'student' ? 'Student' : 'Employer' }} Password Reset</p>
    </div>
    
    <div class="content">
        <h2>Hello {{ $user->full_name }},</h2>
        
        <p>You requested to reset your password for your Khedma4Students {{ $userType }} account.</p>
        
        <p><strong>Option 1: Click the link below to reset your password:</strong></p>
        
        <a href="{{ $resetUrl }}" class="button">Reset Password</a>
        
        <p><strong>Option 2: Copy and paste this link in your browser:</strong></p>
        <p>{{ $resetUrl }}</p>
        
        <p><strong>Option 3: Use this reset token:</strong></p>
        <div class="token-box">{{ $token }}</div>
        <p>Go to {{ $userType === 'student' ? 'http://localhost:3000/reset-password' : 'http://localhost:3000/employer-reset-password' }} and enter this token.</p>
        
        <p><strong>This link will expire in 60 minutes.</strong></p>
        
        <p>If you didn't request this password reset, you can safely ignore this email.</p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} Khedma4Students. All rights reserved.</p>
        <p>Connecting Algerian students with opportunities</p>
    </div>
</body>
</html>
