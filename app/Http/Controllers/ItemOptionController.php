<?php

namespace App\Http\Controllers;

use App\Models\ItemOption;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemOptionController extends Controller
{
    public function index()
    {
        $options = ItemOption::with('category')->get();
        return view('admin.item_options.index', compact('options'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.item_options.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_ar' => 'required|string|unique:item_options,name_ar',
            'name_en' => 'required|string|unique:item_options,name_en',
            'is_active' => 'boolean',
        ]);

        ItemOption::create($data);

        return redirect()->route('item-options.index')->with('success', 'تمت إضافة الخيار بنجاح');
    }

    public function edit(ItemOption $itemOption)
    {
        $categories = Category::all();
        return view('admin.item_options.edit', compact('itemOption', 'categories'));
    }

    public function update(Request $request, ItemOption $itemOption)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_ar' => 'required|string|unique:item_options,name_ar,' . $itemOption->id,
            'name_en' => 'required|string|unique:item_options,name_en,' . $itemOption->id,
            'is_active' => 'boolean',
        ]);

        $itemOption->update($data);

        return redirect()->route('item-options.index')->with('success', 'تم تحديث بيانات الخيار');
    }

    public function destroy(ItemOption $itemOption)
    {
        $itemOption->delete();
        return back()->with('success', 'تم حذف الخيار');
    }
}
