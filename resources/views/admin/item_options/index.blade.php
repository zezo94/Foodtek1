@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">📋 قائمة الخيارات</h2>
    <a href="{{ route('item-options.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">➕ خيار جديد</a>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200 text-right">
        <tr>
            <th class="p-2">ID</th>
            <th class="p-2">الاسم</th>
            <th class="p-2">التصنيف</th>
            <th class="p-2">الحالة</th>
            <th class="p-2">تحكم</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($options as $option)
            <tr class="border-t text-right">
                <td class="p-2">{{ $option->id }}</td>
                <td class="p-2">{{ $option->name_ar }} / {{ $option->name_en }}</td>
                <td class="p-2">{{ $option->category->name ?? '-' }}</td>
                <td class="p-2">{{ $option->is_active ? '✅' : '❌' }}</td>
                <td class="p-2">
                    <a href="{{ route('item-options.edit', $option) }}" class="text-blue-600">تعديل</a>
                    <form method="POST" action="{{ route('item-options.destroy', $option) }}" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600 ml-2" onclick="return confirm('حذف؟')">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
