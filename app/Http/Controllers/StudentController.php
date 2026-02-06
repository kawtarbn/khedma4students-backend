<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\RequestModel;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(Student::all());
    }

    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'university' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ], [
            'password.regex' => 'Password must be at least 8 characters and contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $verificationToken = Str::random(60);

        $student = Student::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'university' => $request->university,
            'city' => $request->city,
            'email_verification_token' => $verificationToken,
        ]);

        // Store verification code in password_resets table for email verification
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $verificationToken,
            'verification_code' => $verificationCode,
            'created_at' => Carbon::now(),
            'code_expires_at' => Carbon::now()->addMinutes(30),
        ]);

        // Send verification email
        try {
            Mail::to($request->email)->send(new \App\Mail\StudentEmailVerificationCodeMail($student, $verificationCode, $verificationToken));
            
            return response()->json([
                'message' => 'Registration successful! Please check your email for verification code.',
                'student' => $student,
                'requires_verification' => true,
                'verification_code' => $verificationCode, // Development mode
                'note' => 'Email service not configured - use the verification code above'
            ], 201);
        } catch (\Exception $e) {
            // Development mode - return verification code
            return response()->json([
                'message' => 'Registration successful! Please verify your email.',
                'student' => $student,
                'requires_verification' => true,
                'verification_code' => $verificationCode,
                'verification_url' => config('frontend.url') . '/verify-email?token=' . $verificationToken . '&email=' . $request->email,
                'note' => 'Email service not configured - use the verification code above'
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'full_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:students,email,'.$id,
            'password' => 'sometimes|string|min:6',
            'university' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'skills' => 'sometimes|string',
            'description' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updateData = $request->all();
        
        if (isset($updateData['password'])) {
            $updateData['password'] = Hash::make($request->password);
        }

        $student->update($updateData);

        return response()->json($student);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted']);
    }

    public function login(Request $request)
    {
        $student = Student::where('email', $request->email)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json(['student' => $student]);
    }

    // ✅ FIXED: get student services (actually requests)
    public function getServices($studentId)
    {
        $services = RequestModel::where('student_id', $studentId)->get();

        // Wrap in 'data' to match React code
        return response()->json(['data' => $services]);
    }

    // Optional: applications
    public function getApplications($studentId)
    {
        $applications = Application::with(['job', 'job.employer'])
            ->where('student_id', $studentId)
            ->get();
        
        // Debug: Log the actual query result
        \Log::info('Applications query result:', $applications->toArray());
        
        return response()->json(['data' => $applications]);
    }

    // Get service applications for a student
    public function getServiceApplications($studentId)
    {
        // For now, return empty array as service applications are not implemented yet
        // This can be extended later if needed
        return response()->json(['data' => []]);
    }
}
