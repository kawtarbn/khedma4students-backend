<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SimpleJobController extends Controller
{
    public function index()
    {
        try {
            // Get jobs without employer relationship to avoid 500 errors
            $jobs = Job::select('id', 'title', 'description', 'category', 'city', 'pay_range', 'contactEmail', 'contactPhone', 'status', 'created_at', 'updated_at')
                        ->orderBy('created_at', 'desc')
                        ->get();
            
            return response()->json([
                'success' => true,
                'data' => $jobs,
                'count' => count($jobs)
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Unable to fetch jobs'
            ], 500);
        }
    }
    
    public function show($id)
    {
        try {
            $job = Job::select('id', 'title', 'description', 'category', 'city', 'pay_range', 'contactEmail', 'contactPhone', 'status', 'employer_id', 'created_at', 'updated_at')
                        ->find($id);
            
            if (!$job) {
                return response()->json(['message' => 'Job not found'], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $job
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Unable to fetch job details'
            ], 500);
        }
    }
    
    public function store(Request $request)
    {
        try {
            $job = Job::create([
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'city' => $request->city,
                'pay_range' => $request->pay_range ?? 'Negotiable',
                'contactEmail' => $request->contactEmail,
                'contactPhone' => $request->contactPhone,
                'status' => 'Active',
                'employer_id' => $request->employer_id ?? 1 // Default employer if not provided
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Job created successfully',
                'data' => $job
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Unable to create job'
            ], 500);
        }
    }
}
