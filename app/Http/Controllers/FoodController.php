<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    public function show($id)
    {
        $food = Food::findOrFail($id);
        $foods = Food::all();
        // Check if the authenticated user has marked the food as favorite
        $user = Auth::user();
        if ($user) {
            $favoriteFoodIds = Favorite::where('user_id', $user->id)->pluck('food_id')->toArray();
            foreach ($foods as $foodItem) {
                $foodItem->isFavorite = in_array($foodItem->id, $favoriteFoodIds);
            }
        }

        return view('food.show', compact('food', 'foods'));
    }

    public function favorite(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $favorite = Favorite::where('user_id', $user->id)
                ->where('food_id', $request->food_id)
                ->first();

            if ($favorite) {
                // Remove from favorites
                $favorite->delete();

                $food = Food::findOrFail($request->food_id);
                $food->isFavorite = false;
                $food->save();

                return response()->json(['success' => 'Food item removed from favorites', 'isFavorite' => false]);
            } else {
                // Add to favorites
                $favorite = new Favorite();
                $favorite->user_id = $user->id;
                $favorite->food_id = $request->food_id;
                $favorite->save();
                $food = Food::findOrFail($request->food_id);
                $food->isFavorite = true;
                $food->save();

                return response()->json(['success' => 'Food item added to favorites', 'isFavorite' => true]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update favorite status'], 500);
        }
    }

    public function showFavorites()
    {
        $userId = Auth::id();
        $favorites = Favorite::where('user_id', $userId)->with('food')->get();
        return view('food.fav', compact('favorites'));
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $foods = Food::where('name', 'like', "%$search%")->paginate(9);
        return view('welcome', compact('foods'));
    }
    public function getFoodItems()
    {
        // Group food items by category and count the items in each category
        $foodCategories = Food::select('category', DB::raw('count(*) as item_count'))
            ->groupBy('category')
            ->get();

        return response()->json($foodCategories);
    }

    public function getFoodItemDetails()
    {
        $foodItems = Food::select('name', 'description', 'price', \DB::raw('CONCAT("' . asset('storage') . '/", image) as image'))
            ->take(8) // Limit to 8 items to match frontend
            ->get();
        return response()->json($foodItems);
    }

    public function categoryIndex($category = null)
    {
        $categories = Food::select('category')->distinct()->get();

        if ($category) {
            // Fetch items by the selected category
            $foods = Food::where('category', $category)->get();
            // Pass the selected category name to the view
            $selectedCategory = $category;
        } else {
            // Fetch all items if no category is selected
            $foods = Food::all();
            $selectedCategory = 'all';
        }

        return view('welcome', compact('foods', 'categories', 'selectedCategory'));
    }
}
