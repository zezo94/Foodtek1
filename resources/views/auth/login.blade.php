@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    <h2 class="text-xl font-bold mb-4">تسجيل الدخول</h2>

    @if (session('error'))
        <div class="bg-red-100 text-red-600 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-3">
        @csrf

        <input type="email" name="email" value="{{ old('email') }}" placeholder="البريد الإلكتروني" required class="w-full p-2 border rounded">

        <input type="password" name="password" placeholder="كلمة المرور" required class="w-full p-2 border rounded">

        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded">
            دخول
        </button>
    </form>

    <div class="mt-3">
        <a href="{{ route('register') }}" class="text-sm text-blue-600">
            ليس لديك حساب؟ سجّل الآن
        </a>
    </div>
@endsection
