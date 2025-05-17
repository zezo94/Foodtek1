@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">➕ إضافة مطعم جديد</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('restaurants.store') }}" class="space-y-3">
        @csrf

        <input type="text" name="name" placeholder="اسم المطعم" class="w-full p-2 border rounded" value="{{ old('name') }}" required>

        <textarea name="description" placeholder="وصف المطعم" class="w-full p-2 border rounded">{{ old('description') }}</textarea>

        <input type="text" name="image" placeholder="رابط صورة" class="w-full p-2 border rounded" value="{{ old('image') }}">

        <input type="text" name="address" placeholder="العنوان" class="w-full p-2 border rounded" value="{{ old('address') }}">

        <input type="text" name="phone" placeholder="رقم الهاتف" class="w-full p-2 border rounded" value="{{ old('phone') }}">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">حفظ</button>
    </form>
@endsection
