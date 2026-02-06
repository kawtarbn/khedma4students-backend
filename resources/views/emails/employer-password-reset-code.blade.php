<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset Code - Khedma4Students</title>
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
            padding: 40px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 40px;
            border-radius: 0 0 10px 10px;
            text-align: center;
        }
        .code-box {
            background: #fff;
            border: 3px solid #667eea;
            padding: 25px;
            border-radius: 10px;
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 10px;
            color: #667eea;
            margin: 30px 0;
            font-family: monospace;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .button {
            display: inline-block;
            padding: 18px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin: 30px 0;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
        .message {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }
        .security {
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Khedma4Students</h1>
        <p>Password Reset</p>
    </div>
    
    <div class="content">
        <p class="message">Hello {{ $employer->full_name }},</p>
        <p class="message">Your password reset code is:</p>
        
        <div class="code-box">{{ $verificationCode }}</div>
        
        <a href="{{ config('frontend.url') }}/employer-reset-password?email={{ $employer->email }}" class="button">Reset Password</a>
        
        <p class="security">This code expires in 30 minutes. For security, never share this code with anyone.</p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} Khedma4Students. All rights reserved.</p>
        <p>Connecting Algerian students with opportunities</p>
    </div>
</body>
</html>
