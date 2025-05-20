@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">➕ خيار جديد</h2>
    <form method="POST" action="{{ route('item-options.store') }}" class="space-y-3">
        @csrf
        <select name="category_id" class="w-full p-2 border rounded">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <input name="name_ar" placeholder="الاسم عربي" class="w-full p-2 border rounded">
        <input name="name_en" placeholder="الاسم إنجليزي" class="w-full p-2 border rounded">
        <label><input type="checkbox" name="is_active" value="1" checked> مفعل</label>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">حفظ</button>
    </form>
@endsection
