<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'comment' => 'required|string|max:255',
                'order_id' => 'required|exists:orders,id',
            ]);

            $comment = comment::create([
                'comment' => $validated['comment'],
                'order_id' => $validated['order_id'],
                'sender_id' => auth()->user()->id,
            ]);

            broadcast(new CommentPosted($comment))->toOthers();

            return response()->json([
                'comment' => $comment->comment,
                'created_at' => $comment->created_at,
                'sender_name' => $comment->sender->name,
            ]);
        } catch (\Exception $e) {
            Log::error('Comment submission error: ' . $e->getMessage());
            return response()->json(['error' => 'Could not submit comment.'], 500);
        }
    }
    public function show($orderId)
    {
        try {
            $user = auth()->user(); // Get the currently authenticated user

            // Check if the user is an admin
            if ($user->usertype === 'admin') {
                // Admins can see all comments for the order
                $comments = comment::with('sender')
                    ->where('order_id', $orderId)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                // Regular users can see only their comments for the order
                $comments = comment::with('sender')
                    ->where('order_id', $orderId)
                    ->where('sender_id', $user->id) // Only fetch their own comments
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

            // Return comments in JSON format
            return response()->json([
                'comments' => $comments->map(function ($comment) {
                    return [
                        'comment' => $comment->comment,
                        'created_at' => $comment->created_at->format('d-m-Y H:i'),
                        'sender_name' => $comment->sender->name,
                        'sender_id' => $comment->sender_id, // Include sender_id if needed for client-side logic
                        'read' => $comment->read,
                    ];
                }),
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching comments: ' . $e->getMessage());
            return response()->json(['error' => 'Could not retrieve comments.'], 500);
        }
    }
}
