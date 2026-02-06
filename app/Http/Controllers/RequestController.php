<?php

namespace App\Http\Controllers;

use App\Models\RequestModel;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    // Get all requests
    public function index()
    {
        return response()->json(RequestModel::all());
    }

    // Get a single request by ID
    public function show($id)
    {
        return response()->json(RequestModel::findOrFail($id));
    }

    // Store a new request safely
    public function store(HttpRequest $request)
    {
        // ✅ Validate input
        $validator = Validator::make($request->all(), [
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
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Only allow fields defined in $fillable
        $data = $request->only([
            'title',
            'description',
            'category',
            'city',
            'contactEmail',
            'contactPhone',
            'pay',
            'availability',
            'status',
            'student_id',
        ]);

        // Set default status if not provided
        $data['status'] = $data['status'] ?? 'Pending';

        $req = RequestModel::create($data);

        return response()->json($req, 201);
    }

    // Update an existing request safely
    public function update(HttpRequest $request, $id)
    {
        $req = RequestModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'category' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'contactEmail' => 'sometimes|required|email',
            'contactPhone' => 'sometimes|required|string',
            'pay' => 'sometimes|required|numeric',
            'availability' => 'sometimes|required|string',
            'student_id' => 'sometimes|required|exists:students,id',
            'status' => 'sometimes|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only([
            'title',
            'description',
            'category',
            'city',
            'contactEmail',
            'contactPhone',
            'pay',
            'availability',
            'status',
            'student_id',
        ]);

        // Keep current status if not sent
        $data['status'] = $data['status'] ?? $req->status;

        $req->update($data);

        return response()->json($req);
    }

    // Delete a request
    public function destroy($id)
    {
        RequestModel::findOrFail($id)->delete();

        return response()->json(['message' => 'Request deleted']);
    }
}
