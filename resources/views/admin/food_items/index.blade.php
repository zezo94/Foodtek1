@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">📋 قائمة عناصر الطعام</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('food-items.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded inline-block mb-4">➕ إضافة عنصر جديد</a>

    <table class="min-w-full bg-white shadow-md rounded">
        <thead>
        <tr class="bg-gray-200 text-left">
            <th class="p-2">#</th>
            <th class="p-2">الاسم</th>
            <th class="p-2">السعر</th>
            <th class="p-2">المطعم</th>
            <th class="p-2">الخيارات</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($items as $item)
            <tr class="border-t">
                <td class="p-2">{{ $item->id }}</td>
                <td class="p-2">{{ $item->name_ar }} / {{ $item->name_en }}</td>
                <td class="p-2">{{ $item->price }} ﷼</td>
                <td class="p-2">{{ $item->restaurant->name ?? '-' }}</td>
                <td class="p-2">{{ $item->itemOption->name_ar ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-4 text-center text-gray-500">لا توجد عناصر</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
