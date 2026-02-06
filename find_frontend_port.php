<?php

echo "=== FINDING FRONTEND PORT ===\n\n";

echo "🔍 Since you said 'yes' to running on another port,\n";
echo "the frontend is NOT running on port 3000.\n\n";

echo "📱 CHECK WHAT PORT FRONTEND IS RUNNING ON:\n";
echo "1. Check the terminal where you ran 'npm start'\n";
echo "2. Look for a line like: 'Local: http://localhost:PORT'\n";
echo "3. The PORT number is what you need\n\n";

echo "🔧 COMMON PORTS:\n";
echo "- 3000 (default)\n";
echo "- 3001\n";
echo "- 3002\n";
echo "- 8080\n";
echo "- 5173 (Vite default)\n\n";

echo "🎯 ONCE YOU KNOW THE PORT:\n";
echo "1. Go to: http://localhost:PORT/reset-password\n";
echo "2. Use fresh code: 904083\n";
echo "3. Email: kawtarbenabdelmoumene@gmail.com\n";
echo "4. It should work!\n\n";

echo "🔧 IF YOU CAN'T FIND THE PORT:\n";
echo "1. Open browser developer tools (F12)\n";
echo "2. Go to Console tab\n";
echo "3. Refresh the forgot password page\n";
echo "4. Look for any errors or network requests\n";
echo "5. The URL will show the correct port\n\n";

echo "🚀 QUICK TEST:\n";
echo "Try these URLs until one works:\n";
echo "- http://localhost:3001/reset-password\n";
echo "- http://localhost:3002/reset-password\n";
echo "- http://localhost:8080/reset-password\n";
echo "- http://localhost:5173/reset-password\n\n";

echo "📧 The email template still points to port 3000,\n";
echo "but if frontend is on different port, use that URL directly!\n";
?>
