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
    <h2 class="text-2xl font-bold mb-4">لوحة التحكم</h2>

    <p class="mb-4">مرحباً، {{ auth()->user()->name }} ({{ auth()->user()->role }}) 👋</p>

    @if ($role === 'admin')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-semibold text-lg">عدد المستخدمين</h3>
                <p class="text-2xl text-blue-500 font-bold">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-semibold text-lg">عدد المطاعم</h3>
                <p class="text-2xl text-green-500 font-bold">{{ \App\Models\Restaurant::count() }}</p>
            </div>
            <div class="bg-white p-4 shadow rounded">
                <h3 class="font-semibold text-lg">عدد عناصر الطعام</h3>
                <p class="text-2xl text-red-500 font-bold">{{ \App\Models\FoodItem::count() }}</p>
            </div>
        </div>


    @elseif ($role === 'client')
        <p>مرحباً بك في تطبيق Foodtek! يمكنك استعراض المطاعم وطلب الطعام بسهولة.</p>
        <a href="#" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">ابدأ الطلب الآن</a>
    @elseif ($role === 'delivery')
        <p>هذه لوحة تحكم مندوب التوصيل. هنا يمكنك متابعة الطلبات الموكلة إليك.</p>
        <a href="#" class="mt-4 inline-block bg-yellow-500 text-white px-4 py-2 rounded">عرض الطلبات الحالية</a>
    @endif
@endsection
