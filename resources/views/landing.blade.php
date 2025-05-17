@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">مرحبًا بك في Foodtek</h1>

    @auth
        <p>مرحبًا {{ auth()->user()->name }}!</p>
        <a href="{{ route('dashboard') }}" class="text-blue-600">اذهب إلى لوحة التحكم</a>
    @else
        <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">تسجيل الدخول</a>
        <a href="{{ route('register') }}" class="bg-green-500 text-white px-4 py-2 rounded">إنشاء حساب</a>
    @endauth
@endsection
