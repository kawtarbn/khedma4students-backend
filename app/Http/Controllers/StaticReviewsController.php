<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class StaticReviewsController extends Controller
{
    public function index()
    {
        // Return empty reviews array to prevent frontend errors
        return response()->json([
            'success' => true,
            'data' => [],
            'message' => 'No reviews available - database is being reset'
        ]);
    }
    
    public function store()
    {
        return response()->json([
            'success' => false,
            'message' => 'Reviews are temporarily disabled during system maintenance'
        ], 503);
    }
}
