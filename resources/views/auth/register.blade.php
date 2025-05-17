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
    <h2 class="text-xl font-bold mb-4">تسجيل حساب جديد</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-3">
        @csrf

        <input name="name" value="{{ old('name') }}" placeholder="الاسم الكامل" class="w-full p-2 border rounded">

        <input name="email" type="email" value="{{ old('email') }}" placeholder="البريد الإلكتروني" class="w-full p-2 border rounded">

        <input name="phone" value="{{ old('phone') }}" placeholder="رقم الهاتف " class="w-full p-2 border rounded">

        <input name="profile_picture" value="{{ old('profile_picture') }}" placeholder="رابط الصورة الشخصية " class="w-full p-2 border rounded">

        <input name="birthday" type="date" value="{{ old('birthday') }}" placeholder="تاريخ الميلاد " class="w-full p-2 border rounded">

        <input name="password" type="password" placeholder="كلمة المرور" class="w-full p-2 border rounded">

        <input name="password_confirmation" type="password" placeholder="تأكيد كلمة المرور" class="w-full p-2 border rounded">

        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded">
            إنشاء حساب
        </button>
    </form>

    <div class="mt-3">
        <a href="{{ route('login') }}" class="text-sm text-blue-600">هل لديك حساب؟ تسجيل الدخول</a>
    </div>
@endsection
