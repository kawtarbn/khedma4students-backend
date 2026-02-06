<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Notification;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['student', 'job', 'employer'])->get();
        return response()->json($applications);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'job_id' => 'required|exists:jobs,id',
            'employer_id' => 'required|exists:employers,id',
            'fullname' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
            'experience' => 'nullable|string',
        ]);

        $application = Application::create($validated);

        // Create notification for employer
        $student = \App\Models\Student::find($validated['student_id']);
        $job = \App\Models\Job::find($validated['job_id']);
        
        Notification::create([
            'student_id' => null,
            'employer_id' => $validated['employer_id'],
            'title' => 'New Application Received',
            'description' => "{$student->full_name} has applied for your job: {$job->title}",
            'type' => 'application_received',
            'is_read' => false,
        ]);

        return response()->json($application, 201);
    }

    public function show($id)
    {
        $application = Application::with(['student', 'job', 'employer'])->findOrFail($id);
        return response()->json($application);
    }

    public function update(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        
        $validated = $request->validate([
            'fullname' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
            'experience' => 'nullable|string',
            'status' => 'nullable|in:pending,accepted,rejected',
        ]);

        // Only update fields that are provided in the request
        $updateData = [];
        if (isset($validated['fullname'])) $updateData['fullname'] = $validated['fullname'];
        if (isset($validated['email'])) $updateData['email'] = $validated['email'];
        if (isset($validated['phone'])) $updateData['phone'] = $validated['phone'];
        if (isset($validated['message'])) $updateData['message'] = $validated['message'];
        if (isset($validated['experience'])) $updateData['experience'] = $validated['experience'];
        if (isset($validated['status'])) $updateData['status'] = $validated['status'];

        $oldStatus = $application->status;
        $application->update($updateData);

        // Create notification for student if status changed
        if (isset($validated['status']) && $oldStatus !== $validated['status']) {
            $student = $application->student;
            $job = $application->job;
            
            Notification::create([
                'student_id' => $application->student_id,
                'employer_id' => null,
                'title' => 'Application Status Updated',
                'description' => "Your application for {$job->title} has been {$validated['status']}",
                'type' => 'application_status',
                'is_read' => false,
            ]);
        }

        return response()->json($application);
    }

    public function updateStatus(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $oldStatus = $application->status;
        $application->update(['status' => $validated['status']]);

        // Create notification for student if status changed
        if ($oldStatus !== $validated['status']) {
            $student = $application->student;
            $job = $application->job;
            
            Notification::create([
                'user_id' => $application->student_id,
                'user_type' => 'student',
                'title' => 'Application Status Updated',
                'message' => "Your application for {$job->title} has been {$validated['status']}",
                'type' => 'application_status',
                'is_read' => false,
            ]);
        }

        return response()->json($application);
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();
        return response()->json(null, 204);
    }

    public function getStudentApplications($studentId)
    {
        $applications = Application::with(['job', 'job.employer'])
            ->where('student_id', $studentId)
            ->get();
        
        return response()->json($applications);
    }

    public function getEmployerApplications($employerId)
    {
        $applications = Application::with(['student', 'job'])
            ->where('employer_id', $employerId)
            ->get();
        
        return response()->json($applications);
    }
}
