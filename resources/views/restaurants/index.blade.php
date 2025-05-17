@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">المطاعم الخاصة بك</h2>

    <a href="{{ route('restaurants.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">➕ إضافة مطعم</a>

    @foreach ($restaurants as $restaurant)
        <div class="p-4 bg-white shadow rounded mb-2">
            <h3 class="font-semibold text-lg">{{ $restaurant->name }}</h3>
            <p>{{ $restaurant->description }}</p>
            <a href="{{ route('restaurants.edit', $restaurant) }}" class="text-blue-600">تعديل</a>
            <form method="POST" action="{{ route('restaurants.destroy', $restaurant) }}" class="inline-block">
                @csrf @method('DELETE')
                <button class="text-red-600 ml-2">حذف</button>
            </form>
        </div>
    @endforeach
@endsection
