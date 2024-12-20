<?php

namespace App\Http\Controllers;

use App\Mail\OrderStatusUpdated;
use App\Models\comment;
use App\Models\Food;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{

    public function index()
    {
        $foods = Food::paginate(10);
        $users = User::paginate(10);
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        $activities = Activity::with('causer') // Eager load the causer (user)
            ->latest()
            ->get();
        $nonAdminUsers = User::where('usertype', '!=', 'admin')->get();
        $comments = comment::with('sender')->latest()->get();
        $pendingCount = Order::where('status', 'pending')->count();
        //dd($activities);
        return view('admin.dashboard', compact('foods', 'users', 'orders', 'nonAdminUsers', 'activities', 'comments', 'pendingCount'));
    }
    public function create()
    {
        $categories = Food::distinct()->pluck('category');

        return view('admin.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category' => 'required|exists:food,category',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/foods', 'public');
            $data['image'] = $imagePath;
        }
        $foods = Food::create($data);
        activity()->performedOn($foods)
            ->causedBy(auth()->user()) // Associate the activity with the logged-in user
            ->event('created')
            ->log('created');

        return redirect()->route('admin.dashboards');
    }

    public function edit($id)
    {
        $food = Food::findOrFail($id); // Assuming you have a Food model and 'id' is the primary key
        $categories = Food::select('category')->distinct()->pluck('category');

        // Pass the food item and categories to the view
        return view('admin.edit', compact('food', 'categories'));
    }

    public function update(Request $request, Food $food)
    {
        $data = $request->validate([
            'name' => 'required',
            'category' => 'required|exists:food,category',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/foods', 'public');
            $data['image'] = $imagePath;
        }

        $food->update($data);
        activity()->performedOn($food)
            ->causedBy(auth()->user()) // Associate the activity with the logged-in user
            ->event('updated')
            ->log('updated');
        return redirect()->route('admin.dashboards');
    }
    public function view($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.view', ['food' => $food]);
    }

    public function destroy(Food $food)
    {
        activity()->performedOn($food)
            ->causedBy(auth()->user()) // Associate the activity with the logged-in user
            ->event('updated')
            ->log('deleted');
        $food->delete();
        return redirect(route('admin.dashboard'));
    }
    public function getActivityLog(Request $request)
    {
        $query = Activity::with('causer') // Eager load the user
            ->latest();

        if ($request->has('user_id') && $request->user_id) {
            $query->where('causer_id', $request->user_id); // Filter by user ID
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $activities = $query->get();

        return response()->json($activities);
    }


    public function fetchComments()
    {
        $comments = comment::with('sender', 'order')->latest()->get();
        $unreadCount = comment::where('read', false)->count();
        return response()->json([
            'comments' => $comments,
            'unreadCount' => $unreadCount,
        ]);
    }
    public function markAsRead(Request $request, $id)
    {
        $comment = comment::find($id);
        if ($comment) {
            $comment->read = true; // Assuming you have a 'read' column in your comments table
            $comment->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
    public function reply($commentId, Request $request)
    {
        // Find the comment by ID
        $comment = Comment::find($commentId);

        if (!$comment) {
            return response()->json(['error' => 'Comment not found'], 404);
        }

        // Append the admin reply to the existing comment text
        $adminReply = $request->input('reply');
        $comment->comment = $comment->comment . "\n\nAdmin Reply: " . $adminReply;
        $comment->read = true;
        $comment->save();

        return response()->json(['success' => 'Reply submitted successfully']);
    }
    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        if ($order) {
            $order->status = $request->status; // Update status
            $order->save();

            Mail::to($order->user->email)->send(new OrderStatusUpdated($order, $request->status));
            // Optionally, you can return a response or redirect
            return redirect()->route('admin.dashboards', $orderId)->with('success', 'Order status updated and email sent successfully.');
        }

        return redirect()->back()->with('error', 'Order not found.');
    }
}
