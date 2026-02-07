<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PublicController extends Controller
{
    // Public registration for any user
    public function registerStudent(Request $request)
    {
        try {
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'password' => 'required|min:6',
                'university' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'skills' => 'nullable|string',
                'description' => 'nullable|string'
            ]);

            $student = DB::table('students')->insert([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'university' => $validated['university'],
                'city' => $validated['city'],
                'phone' => $validated['phone'] ?? null,
                'skills' => $validated['skills'] ?? '',
                'description' => $validated['description'] ?? '',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Student registered successfully! Please login.',
                'data' => [
                    'email' => $validated['email'],
                    'full_name' => $validated['full_name']
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed: ' . $e->getMessage()
            ], 400);
        }
    }

    // Public registration for any employer
    public function registerEmployer(Request $request)
    {
        try {
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:employers,email',
                'password' => 'required|min:6',
                'company' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'description' => 'nullable|string'
            ]);

            $employer = DB::table('employers')->insert([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'company' => $validated['company'],
                'city' => $validated['city'],
                'phone' => $validated['phone'] ?? null,
                'description' => $validated['description'] ?? '',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Employer registered successfully! Please login.',
                'data' => [
                    'email' => $validated['email'],
                    'full_name' => $validated['full_name'],
                    'company' => $validated['company']
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed: ' . $e->getMessage()
            ], 400);
        }
    }

    // Public login for students
    public function loginStudent(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $student = DB::table('students')
                ->where('email', $validated['email'])
                ->first();

            if (!$student || !Hash::check($validated['password'], $student->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'message' => 'Login successful!',
                'data' => [
                    'id' => $student->id,
                    'full_name' => $student->full_name,
                    'email' => $student->email,
                    'university' => $student->university,
                    'city' => $student->city,
                    'phone' => $student->phone,
                    'skills' => $student->skills,
                    'description' => $student->description
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Public login for employers
    public function loginEmployer(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $employer = DB::table('employers')
                ->where('email', $validated['email'])
                ->first();

            if (!$employer || !Hash::check($validated['password'], $employer->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'message' => 'Login successful!',
                'data' => [
                    'id' => $employer->id,
                    'full_name' => $employer->full_name,
                    'email' => $employer->email,
                    'company' => $employer->company,
                    'city' => $employer->city,
                    'phone' => $employer->phone,
                    'description' => $employer->description
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get all public jobs (for any user to see)
    public function getPublicJobs()
    {
        try {
            $jobs = DB::table('jobs')
                ->join('employers', 'jobs.employer_id', '=', 'employers.id')
                ->select('jobs.*', 'employers.company as company_name', 'employers.city as company_city')
                ->where('jobs.status', 'Active')
                ->orderBy('jobs.created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $jobs
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch jobs: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get all public services (for any user to see)
    public function getPublicServices()
    {
        try {
            $services = DB::table('services')
                ->join('students', 'services.student_id', '=', 'students.id')
                ->select('services.*', 'students.full_name as student_name', 'students.university')
                ->where('services.status', 'Active')
                ->orderBy('services.created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $services
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch services: ' . $e->getMessage()
            ], 500);
        }
    }

    // Public job application (any authenticated student can apply)
    public function applyToJob(Request $request)
    {
        try {
            $validated = $request->validate([
                'student_id' => 'required|exists:students,id',
                'job_id' => 'required|exists:jobs,id',
                'fullname' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'nullable|string|max:20',
                'message' => 'required|string',
                'experience' => 'nullable|string'
            ]);

            // Check if already applied
            $existing = DB::table('applications')
                ->where('student_id', $validated['student_id'])
                ->where('job_id', $validated['job_id'])
                ->first();

            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already applied to this job'
                ], 400);
            }

            // Get job details for employer_id
            $job = DB::table('jobs')->where('id', $validated['job_id'])->first();

            $application = DB::table('applications')->insert([
                'student_id' => $validated['student_id'],
                'job_id' => $validated['job_id'],
                'employer_id' => $job->employer_id,
                'fullname' => $validated['fullname'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'message' => $validated['message'],
                'experience' => $validated['experience'] ?? '',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Application failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
