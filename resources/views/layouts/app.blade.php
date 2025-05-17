<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Foodtek</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="bg-gray-100 text-gray-900">

<div class="max-w-xl mx-auto p-4">
    @yield('content')
</div>

</body>
</html>
