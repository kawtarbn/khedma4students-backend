<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class SimpleServiceController extends Controller
{
    public function index()
    {
        try {
            // Get services without student relationship to avoid 500 errors
            $services = Service::select('id', 'title', 'description', 'category', 'student_id', 'price', 'availability', 'city', 'created_at', 'updated_at')
                        ->orderBy('created_at', 'desc')
                        ->get();
            
            return response()->json([
                'success' => true,
                'data' => $services,
                'count' => count($services)
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Unable to fetch services'
            ], 500);
        }
    }
    
    public function show($id)
    {
        try {
            $service = Service::select('id', 'title', 'description', 'category', 'student_id', 'price', 'availability', 'city', 'created_at', 'updated_at')
                        ->find($id);
            
            if (!$service) {
                return response()->json(['message' => 'Service not found'], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $service
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Unable to fetch service details'
            ], 500);
        }
    }
    
    public function store(Request $request)
    {
        try {
            $service = Service::create([
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'student_id' => $request->student_id ?? 1, // Default student if not provided
                'price' => $request->price ?? 'Negotiable',
                'availability' => $request->availability ?? 'Available',
                'city' => $request->city,
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Service created successfully',
                'data' => $service
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Unable to create service'
            ], 500);
        }
    }
}
