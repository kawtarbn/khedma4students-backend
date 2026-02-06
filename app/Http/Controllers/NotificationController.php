<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * Store a new notification
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'nullable|integer|min:1',
            'employer_id' => 'nullable|integer|min:1',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:50',
            'is_read' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $notification = Notification::create([
            'student_id' => $request->student_id,
            'employer_id' => $request->employer_id,
            'title' => $request->title,
            'description' => $request->description, // Use description field directly
            'type' => $request->type,
            'is_read' => $request->is_read ?? false,
        ]);

        return response()->json($notification, 201);
    }

    /**
     * Get notifications for a user (student or employer)
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'nullable|integer|min:1',
            'employer_id' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $notifications = [];
        
        if ($request->student_id) {
            $notifications = Notification::where('student_id', $request->student_id)
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($request->employer_id) {
            $notifications = Notification::where('employer_id', $request->employer_id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $unreadCount = $notifications->where('is_read', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json($notification);
    }

    /**
     * Mark all notifications as read for a user
     */
    public function markAllAsRead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'nullable|integer|min:1',
            'employer_id' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->student_id) {
            Notification::where('student_id', $request->student_id)
                ->update(['is_read' => true]);
        } elseif ($request->employer_id) {
            Notification::where('employer_id', $request->employer_id)
                ->update(['is_read' => true]);
        }

        return response()->json(['message' => 'All notifications marked as read']);
    }

    /**
     * Delete a notification
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return response()->json(['message' => 'Notification deleted']);
    }
}
