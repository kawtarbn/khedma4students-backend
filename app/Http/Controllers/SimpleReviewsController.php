<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SimpleReviewsController extends Controller
{
    public function index()
    {
        try {
            // Direct database query with hardcoded connection
            $reviews = DB::connection('pgsql')->select('SELECT * FROM reviews ORDER BY created_at DESC');
            
            return response()->json([
                'success' => true,
                'data' => $reviews,
                'count' => count($reviews)
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Unable to fetch reviews'
            ], 500);
        }
    }
    
    public function store()
    {
        return response()->json([
            'success' => false,
            'message' => 'Reviews are temporarily disabled for maintenance'
        ], 503);
    }
}
