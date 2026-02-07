<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khedma4Students - Public API</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .endpoint { background: #f5f5f5; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .method { display: inline-block; padding: 3px 8px; border-radius: 3px; color: white; font-weight: bold; }
        .get { background: #61dafb; }
        .post { background: #4caf50; }
        .url { font-family: monospace; background: #e8e8e8; padding: 2px 5px; border-radius: 3px; }
        .success { color: #4caf50; }
        .error { color: #f44336; }
    </style>
</head>
<body>
    <h1>🎓 Khedma4Students - Public API</h1>
    <p><strong>This is a real website for any user to use anytime!</strong></p>
    
    <h2>🌐 Frontend URL</h2>
    <div class="endpoint">
        <a href="https://khedma4students-frontend.vercel.app" target="_blank">https://khedma4students-frontend.vercel.app</a>
    </div>

    <h2>📱 Public API Endpoints (For Any User)</h2>
    
    <div class="endpoint">
        <span class="method post">POST</span>
        <span class="url">/api/public/register-student</span>
        <p><strong>Register as a Student</strong></p>
        <pre>{
    "full_name": "John Doe",
    "email": "john@university.edu",
    "password": "password123",
    "university": "University of Technology",
    "city": "Casablanca",
    "phone": "+212600000001",
    "skills": "Web Development, React",
    "description": "Computer Science student"
}</pre>
    </div>

    <div class="endpoint">
        <span class="method post">POST</span>
        <span class="url">/api/public/register-employer</span>
        <p><strong>Register as an Employer</strong></p>
        <pre>{
    "full_name": "HR Manager",
    "email": "hr@company.com",
    "password": "password123",
    "company": "Tech Company",
    "city": "Casablanca",
    "phone": "+212500000001",
    "description": "Leading technology company"
}</pre>
    </div>

    <div class="endpoint">
        <span class="method post">POST</span>
        <span class="url">/api/public/login-student</span>
        <p><strong>Login as Student</strong></p>
        <pre>{
    "email": "john@university.edu",
    "password": "password123"
}</pre>
    </div>

    <div class="endpoint">
        <span class="method post">POST</span>
        <span class="url">/api/public/login-employer</span>
        <p><strong>Login as Employer</strong></p>
        <pre>{
    "email": "hr@company.com",
    "password": "password123"
}</pre>
    </div>

    <div class="endpoint">
        <span class="method get">GET</span>
        <span class="url">/api/public/jobs</span>
        <p><strong>View All Available Jobs (No login required)</strong></p>
    </div>

    <div class="endpoint">
        <span class="method get">GET</span>
        <span class="url">/api/public/services</span>
        <p><strong>View All Student Services (No login required)</strong></p>
    </div>

    <div class="endpoint">
        <span class="method post">POST</span>
        <span class="url">/api/public/apply-job</span>
        <p><strong>Apply to a Job (Student login required)</strong></p>
        <pre>{
    "student_id": 1,
    "job_id": 1,
    "fullname": "John Doe",
    "email": "john@university.edu",
    "phone": "+212600000001",
    "message": "I am interested in this position",
    "experience": "2 years of web development"
}</pre>
    </div>

    <h2>🚀 How to Use</h2>
    <ol>
        <li><strong>Visit the website:</strong> <a href="https://khedma4students-frontend.vercel.app" target="_blank">https://khedma4students-frontend.vercel.app</a></li>
        <li><strong>Register:</strong> Create an account as a student or employer</li>
        <li><strong>Login:</strong> Use your credentials to access your dashboard</li>
        <li><strong>Browse:</strong> View jobs and services without logging in</li>
        <li><strong>Apply:</strong> Students can apply to jobs, employers can post jobs</li>
    </ol>

    <h2>✅ Features Available</h2>
    <ul>
        <li>✅ Student registration & login</li>
        <li>✅ Employer registration & login</li>
        <li>✅ Browse jobs (public)</li>
        <li>✅ Browse student services (public)</li>
        <li>✅ Apply to jobs</li>
        <li>✅ Post jobs (employers)</li>
        <li>✅ Offer services (students)</li>
        <li>✅ Real database with PostgreSQL</li>
        <li>✅ Live on Vercel + Render</li>
    </ul>

    <div style="background: #e3f2fd; padding: 15px; border-radius: 5px; margin-top: 20px;">
        <h3>🎯 This is a REAL WEBSITE for ANY USER!</h3>
        <p>Anyone can register, login, and use this platform anytime. No hardcoded users, no testing limitations - it's fully functional for real users!</p>
    </div>
</body>
</html>
