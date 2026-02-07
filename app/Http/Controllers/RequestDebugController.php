<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestDebugController extends Controller
{
    public function debugRequest(Request $request)
    {
        // Log all incoming data for debugging
        Log::info('Request Debug - All Data:', [
            'all_data' => $request->all(),
            'headers' => $request->headers->all(),
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'content_type' => $request->header('Content-Type'),
            'raw_body' => $request->getContent()
        ]);
        
        // Check validation requirements
        $requiredFields = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'city' => $request->input('city'),
            'contactEmail' => $request->input('contactEmail'),
            'contactPhone' => $request->input('contactPhone'),
            'pay' => $request->input('pay'),
            'availability' => $request->input('availability'),
            'student_id' => $request->input('student_id'),
            'status' => $request->input('status')
        ];
        
        $missingFields = [];
        foreach ($requiredFields as $field => $value) {
            if ($value === null || $value === '') {
                $missingFields[] = $field;
            }
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Request data logged for debugging',
            'received_data' => $request->all(),
            'required_fields_status' => $requiredFields,
            'missing_fields' => $missingFields,
            'validation_will_pass' => empty($missingFields),
            'debug_info' => [
                'content_type' => $request->header('Content-Type'),
                'method' => $request->method(),
                'student_id_exists' => $request->input('student_id') ? 'Yes' : 'No',
                'all_fields_present' => empty($missingFields) ? 'Yes' : 'No'
            ]
        ]);
    }
    
    public function testRequest()
    {
        return response()->json([
            'success' => true,
            'message' => 'Debug endpoint is working',
            'required_fields_for_requests' => [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'contactEmail' => 'required|email',
                'contactPhone' => 'required|string',
                'pay' => 'required|numeric',
                'availability' => 'required|string',
                'student_id' => 'required|exists:students,id',
                'status' => 'sometimes|string'
            ],
            'example_request' => [
                'title' => 'Web Development Services',
                'description' => 'I offer professional web development services',
                'category' => 'Web Development',
                'city' => 'Casablanca',
                'contactEmail' => 'student@university.edu',
                'contactPhone' => '+212600000001',
                'pay' => '1000-5000 MAD/project',
                'availability' => 'Weekends, Evenings',
                'student_id' => 7,
                'status' => 'Active'
            ]
        ]);
    }
}
