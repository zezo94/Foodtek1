@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">👤 معلومات المستخدم</h2>

    <div class="bg-white p-4 shadow rounded space-y-2">
        <p><strong>الاسم:</strong> {{ $user->name }}</p>
        <p><strong>البريد:</strong> {{ $user->email }}</p>
        <p><strong>الدور:</strong> {{ $user->role }}  @if(auth()->user()->role === 'SuperAdmin')
            <form method="POST" action="{{ route('users.toggleRole', $user) }}" class="inline">
                @csrf @method('PATCH')
                <button class="text-orange-600 ml-2">تبديل الدور</button>
            </form>
            @endif</p>
        <p><strong>الهاتف:</strong> {{ $user->phone ?? '---' }}</p>
        <p><strong>تاريخ الميلاد:</strong> {{ $user->birthday ?? '---' }}</p>
    </div>

    <a href="{{ route('users.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">🔙 عودة للقائمة</a>
@endsection
