@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">📋 قائمة المستخدمين</h2>

    <table class="w-full bg-white shadow-md rounded">
        <thead>
        <tr class="bg-gray-200 text-right">
            <th class="p-2">الاسم</th>
            <th class="p-2">البريد</th>
            <th class="p-2">الدور</th>
            <th class="p-2">تحكم</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr class="border-t text-right">
                <td class="p-2">{{ $user->name }}</td>
                <td class="p-2">{{ $user->email }}</td>
                <td class="p-2">{{ $user->role }}</td>

                <td class="p-2">
                    <a href="{{ route('users.show', $user) }}" class="text-blue-600">عرض</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
