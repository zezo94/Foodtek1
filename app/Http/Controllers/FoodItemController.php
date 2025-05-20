<?php
namespace App\Http\Controllers;

use App\Models\FoodItem;
use App\Models\Category;
use App\Models\ItemOption;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class FoodItemController extends Controller
{
    public function index(Request $request)
    {
        $categories = \App\Models\Category::all();
        $restaurants = \App\Models\Restaurant::all();

        $query = \App\Models\FoodItem::with(['restaurant', 'category', 'itemOption']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('restaurant_id')) {
            $query->where('restaurant_id', $request->restaurant_id);
        }

        if ($request->filled('is_available')) {
            $query->where('is_available', $request->is_available);
        }

        $items = $query->get();

        return view('admin.food_items.index', compact('items', 'categories', 'restaurants'));
    }

    public function create()
    {
        $restaurants = Restaurant::all();
        $categories = Category::all();
        $options = ItemOption::all();

        return view('admin.food_items.create', compact('restaurants', 'categories', 'options'));
    }

    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'restaurant_id' => 'required|exists:restaurants,id',
                'category_id' => 'required|exists:categories,id',
                'item_option_id' => 'required|exists:item_options,id',
                'name_ar' => 'required|string|unique:food_items,name_ar',
                'name_en' => 'required|string|unique:food_items,name_en',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'image_path' => 'nullable|image|mimes:jpg,jpeg,png',
                'is_available' => 'boolean',
            ]);

            if ($request->hasFile('image_path')) {
                $data['image_path'] = $request->file('image_path')->store('food_images', 'public');
            }

            FoodItem::create($data);

            return redirect()->route('food-items.index')->with('success', 'تمت إضافة العنصر بنجاح');
        } catch (\Exception $e) {
            \Log::error('FoodItem store failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'حدث خطأ أثناء حفظ العنصر');    }
    }
}
