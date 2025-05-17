@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">✏️ تعديل المطعم: {{ $restaurant->name }}</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('restaurants.update', $restaurant) }}" class="space-y-3">
        @csrf
        @method('PUT')

        <input type="text" name="name" placeholder="اسم المطعم" class="w-full p-2 border rounded" value="{{ old('name', $restaurant->name) }}" required>

        <textarea name="description" placeholder="وصف المطعم" class="w-full p-2 border rounded">{{ old('description', $restaurant->description) }}</textarea>

        <input type="text" name="image" placeholder="رابط صورة" class="w-full p-2 border rounded" value="{{ old('image', $restaurant->image) }}">

        <input type="text" name="address" placeholder="العنوان" class="w-full p-2 border rounded" value="{{ old('address', $restaurant->address) }}">

        <input type="text" name="phone" placeholder="رقم الهاتف" class="w-full p-2 border rounded" value="{{ old('phone', $restaurant->phone) }}">

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">تحديث</button>
    </form>
@endsection
