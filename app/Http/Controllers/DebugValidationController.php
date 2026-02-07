<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class DebugValidationController extends Controller
{
    public function debugValidation(Request $request)
    {
        try {
            $data = $request->all();
            
            Log::info('Registration attempt data: ' . json_encode($data));
            
            $validator = Validator::make($data, [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'password' => 'required|string|min:6',
                'university' => 'required|string|max:255',
                'city' => 'required|string|max:255',
            ]);
            
            if ($validator->fails()) {
                Log::error('Validation failed: ' . json_encode($validator->errors()->all()));
                
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->all(),
                    'data_received' => $data,
                    'validation_rules' => [
                        'full_name' => 'required|string|max:255',
                        'email' => 'required|email|unique:students,email',
                        'password' => 'required|string|min:6',
                        'university' => 'required|string|max:255',
                        'city' => 'required|string|max:255',
                    ]
                ], 422);
            } else {
                Log::info('Validation passed');
                
                return response()->json([
                    'success' => true,
                    'message' => 'Validation passed',
                    'data_received' => $data
                ]);
            }
            
        } catch (\Exception $e) {
            Log::error('Debug validation error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
