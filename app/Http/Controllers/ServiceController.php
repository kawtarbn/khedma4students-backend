<?php

namespace App\Http\Controllers;

use App\Models\RequestModel;

/**
 * ServiceController - Services are student requests (offered services)
 */
class ServiceController extends Controller
{
    public function index()
    {
        return response()->json(RequestModel::all());
    }

    public function show($id)
    {
        $service = RequestModel::find($id);
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }
        return response()->json($service);
    }
}
