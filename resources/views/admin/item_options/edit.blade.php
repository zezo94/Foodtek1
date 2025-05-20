@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">✏️ تعديل الخيار</h2>
    <form method="POST" action="{{ route('item-options.update', $itemOption) }}" class="space-y-3">
        @csrf @method('PUT')
        <select name="category_id" class="w-full p-2 border rounded">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $itemOption->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <input name="name_ar" value="{{ old('name_ar', $itemOption->name_ar) }}" class="w-full p-2 border rounded">
        <input name="name_en" value="{{ old('name_en', $itemOption->name_en) }}" class="w-full p-2 border rounded">
        <label><input type="checkbox" name="is_active" value="1" {{ $itemOption->is_active ? 'checked' : '' }}> مفعل</label>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">تحديث</button>
    </form>
@endsection
