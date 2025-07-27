<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <header class="bg-white shadow p-4">
        <h1 class="text-xl font-bold">My Website</h1>
    </header>

    <div class="p-6">
        @yield('content')
    </div>

</body>
</html>
