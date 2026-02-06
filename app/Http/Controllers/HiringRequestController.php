<?php

namespace App\Http\Controllers;

use App\Models\HiringRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HiringRequestController extends Controller
{
    /**
     * Store a new hiring request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'employer_id' => 'required|exists:employers,id',
            'service_id' => 'required|exists:requests,id',
            'employer_name' => 'required|string|min:3|max:255',
            'employer_email' => 'required|email',
            'employer_phone' => 'nullable|string|max:20',
            'message' => 'required|string|min:10',
            'service_title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create hiring request
        $hiringRequest = HiringRequest::create($request->only([
            'student_id',
            'employer_id',
            'service_id',
            'employer_name',
            'employer_email',
            'employer_phone',
            'message',
            'service_title',
        ]));

        // Create notification for student
        Notification::create([
            'student_id' => $request->student_id,
            'employer_id' => null,
            'title' => '🎉 Congratulations! You\'ve Been Hired!',
            'description' => "{$request->employer_name} from {$request->employer_email} wants to hire you for: {$request->service_title}. Message: {$request->message}",
            'type' => 'hiring_notification',
            'is_read' => false,
        ]);

        return response()->json([
            'message' => 'Hiring request sent successfully!',
            'hiring_request' => $hiringRequest,
            'notification' => $notification,
        ], 201);
    }

    /**
     * Get hiring requests for a student
     */
    public function getStudentHiringRequests($studentId)
    {
        $requests = HiringRequest::with(['employer', 'service'])
            ->where('student_id', $studentId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $requests]);
    }

    /**
     * Get hiring requests for an employer
     */
    public function getEmployerHiringRequests($employerId)
    {
        $requests = HiringRequest::with(['student', 'service'])
            ->where('employer_id', $employerId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($requests);
    }
}
