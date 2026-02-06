# Email Configuration Guide

## Quick Setup for Development

### Option 1: Gmail SMTP (Recommended)
1. Enable 2-Step Verification on your Google Account
2. Generate an App Password:
   - Go to: https://myaccount.google.com/apppasswords
   - Select "Mail" for app
   - Generate password
3. Update your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-16-character-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Option 2: Mailtrap (Testing Only)
1. Sign up at: https://mailtrap.io
2. Get your credentials from the dashboard
3. Update your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Testing the System

### Without Email Configuration
The system will work in development mode and show tokens in the response.

### With Email Configuration
1. Configure your `.env` file
2. Run: `php artisan config:cache`
3. Test the forgot password functionality
4. Check your email for the reset link

## Current Status
✅ Backend API working
✅ Frontend components created
✅ Database migrations completed
✅ Email templates ready
⚠️ Email service needs configuration

## URLs to Test
- Student Forgot Password: http://localhost:3000/forgot-password
- Employer Forgot Password: http://localhost:3000/employer-forgot-password
- Student Reset Password: http://localhost:3000/reset-password
- Employer Reset Password: http://localhost:3000/employer-reset-password
