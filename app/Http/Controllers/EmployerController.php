<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EmployerController extends Controller
{
    public function index()
    {
        return response()->json(Employer::all());
    }

    public function show($id)
    {
        $employer = Employer::find($id);
        if (!$employer) {
            return response()->json(['message' => 'Employer not found'], 404);
        }
        return response()->json($employer);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employers,email',
            'password' => 'required|string|min:6',
            'company' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $verificationToken = Str::random(60);

        $employer = Employer::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company' => $request->company,
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
            Mail::to($request->email)->send(new \App\Mail\EmployerEmailVerificationCodeMail($employer, $verificationCode, $verificationToken));
            
            return response()->json([
                'message' => 'Registration successful! Please check your email for verification code.',
                'employer' => $employer,
                'requires_verification' => true,
                'verification_code' => $verificationCode, // Development mode
                'note' => 'Email service not configured - use the verification code above'
            ], 201);
        } catch (\Exception $e) {
            // Development mode - return verification code
            return response()->json([
                'message' => 'Registration successful! Please verify your email.',
                'employer' => $employer,
                'requires_verification' => true,
                'verification_code' => $verificationCode,
                'verification_url' => config('frontend.url') . '/employer-verify-email?token=' . $verificationToken . '&email=' . $request->email,
                'note' => 'Email service not configured - use the verification code above'
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $employer = Employer::find($id);
        if (!$employer) {
            return response()->json(['message' => 'Employer not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'full_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:employers,email,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $employer->update($request->only([
            'full_name', 'email', 'company', 'city',
            'contact_person', 'phone', 'location', 'description'
        ]));

        return response()->json($employer);
    }

    public function destroy($id)
    {
        $employer = Employer::find($id);
        if (!$employer) {
            return response()->json(['message' => 'Employer not found'], 404);
        }
        $employer->delete();
        return response()->json(['message' => 'Employer deleted']);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $employer = Employer::where('email', $request->email)->first();

        if (!$employer || !Hash::check($request->password, $employer->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json($employer);
    }

    // ✅ FIXED: return real jobs for this employer
    public function getJobs($employerId)
    {
        $jobs = Job::where('employer_id', $employerId)
            ->withCount('applications')
            ->get();
        
        return response()->json(['data' => $jobs]);
    }

    public function getApplications($employerId)
    {
        $applications = Application::with(['student', 'job'])
            ->where('employer_id', $employerId)
            ->get();
        
        return response()->json(['data' => $applications]);
    }
}
