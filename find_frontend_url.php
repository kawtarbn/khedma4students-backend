<?php

echo "=== FINDING YOUR FRONTEND URL ===\n\n";

echo "🔍 The FRONTEND_URL in .env.production.example is just a placeholder\n";
echo "You need to find your ACTUAL frontend URL and use that instead.\n\n";

echo "📱 HOW TO FIND YOUR FRONTEND URL:\n\n";

echo "METHOD 1: Check Your Frontend Terminal\n";
echo "------------------------------------\n";
echo "1. Look at the terminal where you ran 'npm start'\n";
echo "2. Find the line that says 'Local:' or 'localhost:'\n";
echo "3. It will show something like:\n";
echo "   Local:   http://localhost:3001/\n";
echo "   or http://localhost:5173/\n";
echo "   or http://localhost:8080/\n\n";

echo "METHOD 2: Check Browser Address Bar\n";
echo "------------------------------------\n";
echo "1. Open your frontend in browser\n";
echo "2. Look at the URL in the address bar\n";
echo "3. It will be something like:\n";
echo "   http://localhost:3001/login\n";
echo "   http://localhost:3001/forgot-password\n\n";

echo "METHOD 3: Check Network Requests\n";
echo "------------------------------------\n";
echo "1. Open browser F12 → Network tab\n";
echo "2. Go to your frontend pages\n";
echo "3. Look at the request URLs\n";
echo "4. The frontend URL is the base part\n\n";

echo "🔧 COMMON FRONTEND URLS:\n";
echo "- http://localhost:3000 (default)\n";
echo "- http://localhost:3001\n";
echo "- http://localhost:3002\n";
echo "- http://localhost:5173 (Vite default)\n";
echo "- http://localhost:8080\n\n";

echo "⚙️ HOW TO SET FRONTEND_URL:\n\n";

echo "FOR DEVELOPMENT (current setup):\n";
echo "Add to your .env file:\n";
echo "FRONTEND_URL=http://localhost:3001\n";
echo "(Replace 3001 with your actual port)\n\n";

echo "FOR PRODUCTION:\n";
echo "Add to your .env file:\n";
echo "FRONTEND_URL=https://your-actual-domain.com\n";
echo "(Replace with your real domain)\n\n";

echo "🎯 CURRENT SITUATION:\n";
echo "Since you said 'yes' to running on another port,\n";
echo "your frontend is probably NOT on port 3000\n\n";

echo "🚀 QUICK TEST:\n";
echo "1. Find your frontend URL from terminal\n";
echo "2. Add FRONTEND_URL=http://localhost:PORT to .env\n";
echo "3. Run: php artisan config:cache\n";
echo "4. Test password reset again\n";
echo "5. Email links will now point to correct URL!\n\n";

echo "💡 TIP:\n";
echo "The FRONTEND_URL is used in email templates.\n";
echo "When students click 'Reset Password' in email,\n";
echo "it takes them to this URL.\n\n";

echo "🔍 RIGHT NOW:\n";
echo "Check your frontend terminal and find the URL!\n";
echo "Then add FRONTEND_URL=that-url to your .env file.\n";
?>
