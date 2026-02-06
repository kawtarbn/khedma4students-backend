<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index() { 
        return response()->json(Job::with('employer')->get()); 
    }
    
    public function show($id) { 
        return response()->json(Job::with('employer')->findOrFail($id)); 
    }
    
    public function store(Request $request)
    {
        $job = Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'city' => $request->city,
            'contactEmail' => $request->contactEmail,
            'contactPhone' => $request->contactPhone,
            'status' => 'Active',
            'employer_id' => $request->employer_id // ✅ LINK JOB TO EMPLOYER
        ]);

        return response()->json($job, 201);
    }

    public function update(Request $request, $id) {
        $job = Job::findOrFail($id);
        $job->update($request->all());
        return response()->json($job);
    }
    public function destroy($id) {
        Job::findOrFail($id)->delete();
        return response()->json(['message' => 'Job deleted']);
    }
}
