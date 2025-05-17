<?php
namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::where('user_id', Auth::id())->get();
        return view('restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('restaurants.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        Restaurant::create($data);

        return redirect()->route('restaurants.index')->with('success', 'تم إضافة المطعم بنجاح');
    }

    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        $restaurant->update($data);
        return redirect()->route('restaurants.index')->with('success', 'تم تحديث بيانات المطعم');
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return back()->with('success', 'تم حذف المطعم');
    }
}
