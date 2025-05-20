@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <h2 class="text-xl font-bold mb-4">➕ إضافة عنصر طعام</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('food-items.store') }}" enctype="multipart/form-data" class="space-y-3">
        @csrf

        <select name="restaurant_id" class="w-full p-2 border rounded" required>
            <option value="">اختر مطعم</option>
            @foreach ($restaurants as $restaurant)
                <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
            @endforeach
        </select>

        <select name="category_id" class="w-full p-2 border rounded" required>
            <option value="">اختر تصنيف</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <select name="item_option_id" class="w-full p-2 border rounded" required>
            <option value="">اختر خيار</option>
            @foreach ($options as $option)
                <option value="{{ $option->id }}">{{ $option->name_ar }} / {{ $option->name_en }}</option>
            @endforeach
        </select>

        <input name="name_ar" placeholder="الاسم بالعربية" class="w-full p-2 border rounded">
        <input name="name_en" placeholder="الاسم بالإنجليزية" class="w-full p-2 border rounded">
        <textarea name="description_ar" placeholder="الوصف بالعربية" class="w-full p-2 border rounded"></textarea>
        <textarea name="description_en" placeholder="الوصف بالإنجليزية" class="w-full p-2 border rounded"></textarea>
        <input type="number" step="0.01" name="price" placeholder="السعر" class="w-full p-2 border rounded">
        <input type="file" name="image_path" class="w-full p-2 border rounded">


        <input type="hidden" name="is_available" value="0">
        <label><input type="checkbox" name="is_available" value="1" checked> متاح</label>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">حفظ</button>
    </form>
@endsection
