@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">➕ إضافة تصنيف جديد</h2>
    <form method="POST" action="{{ route('categories.store') }}" class="space-y-3">
        @csrf
        <input name="name" placeholder="اسم التصنيف" value="{{ old('name') }}" class="w-full p-2 border rounded">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">حفظ</button>
    </form>
@endsection
