@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">📋 قائمة التصنيفات</h2>
    <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">➕ تصنيف جديد</a>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200 text-right ">
        <tr>
            <th class="p-2">ID</th>
            <th class="p-2">الاسم</th>
            <th class="p-2">التحكم</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr class="border-t text-right">
                <td class="p-2">{{ $category->id }}</td>
                <td class="p-2">{{ $category->name }}</td>
                <td class="p-2">
                    <a href="{{ route('categories.edit', $category) }}" class="text-blue-600">تعديل</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600 ml-2" onclick="return confirm('حذف؟')">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
