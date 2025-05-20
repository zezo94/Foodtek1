@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">✏️ تعديل التصنيف: {{ $category->name }}</h2>
    <form method="POST" action="{{ route('categories.update', $category->id) }}" class="space-y-3">
        @csrf
        @method('PUT')
        <input name="name" value="{{ old('name', $category->name) }}" class="w-full p-2 border rounded">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">تحديث</button>
    </form>
@endsection
