<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - Foodtek</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow mb-6">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap justify-between items-center gap-4">
        <h1 class="text-xl font-bold">🍔 Foodtek Admin Panel</h1>
        <nav class="flex flex-wrap gap-4 items-center text-sm">
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">🏠 الرئيسية</a>
            <a href="{{ route('categories.index') }}" class="text-blue-600 hover:underline">📂 التصنيفات</a>
            <a href="{{ route('item-options.index') }}" class="text-blue-600 hover:underline">🧾 الخيارات</a>
            <a href="{{ route('food-items.index') }}" class="text-blue-600 hover:underline">🍔 العناصر</a>
            <a href="{{ route('restaurants.index') }}" class="text-blue-600 hover:underline">🏪 المطاعم</a>
            <a href="{{ route('users.index') }}" class="text-blue-600 hover:underline">👤 المستخدمين</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="text-red-600 hover:underline">🚪 تسجيل الخروج</button>
            </form>
        </nav>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4">
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

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

</body>
</html>
