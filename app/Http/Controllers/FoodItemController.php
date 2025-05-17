<?php
namespace App\Http\Controllers;

use App\Models\FoodItem;
use App\Models\Category;
use App\Models\ItemOption;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class FoodItemController extends Controller
{
    public function index()
    {
        $items = FoodItem::with(['restaurant', 'category', 'itemOption'])->get();
        return view('admin.food_items.index', compact('items'));
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
    }
}
