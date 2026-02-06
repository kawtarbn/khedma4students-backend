<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Store a new contact message
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255|not_in:Select a subject',
            'message' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $message = ContactMessage::create($request->only([
            'name',
            'email',
            'subject',
            'message',
        ]));

        return response()->json([
            'message' => 'Message sent successfully!',
            'data' => $message,
        ], 201);
    }
}
