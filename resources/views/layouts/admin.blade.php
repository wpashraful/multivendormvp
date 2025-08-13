<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- ✅ Topbar -->
    <header class="bg-blue-600 text-white p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Admin Panel</h1>
        <div class="space-x-3">
            <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-3 py-1 rounded">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </header>
    

    <div class="flex">
        
        <!-- ✅ Sidebar -->
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-4 space-y-2">
            <h2 class="text-lg font-semibold mb-4">Menu</h2>
            <ul class="space-y-2">
                <li><a href="{{ route('category.index') }}" class="block p-2 rounded hover:bg-gray-700"><i class="fas fa-box mr-2"></i>Categories</a></li>
                <li><a href="{{ route('products.index') }}" class="block p-2 rounded hover:bg-gray-700"><i class="fas fa-shopping-cart mr-2"></i>Products</a></li>
                <li><a href="{{ route('lottery.index') }}" class="block p-2 rounded hover:bg-gray-700"><i class="fas fa-dice mr-2"></i>Lottery</a></li>
                <li><a href="{{ route('coupon.index') }}" class="block p-2 rounded hover:bg-gray-700"><i class="fas fa-tags mr-2"></i>Coupon</a></li>
                <li><a href="#" class="block p-2 rounded hover:bg-gray-700"><i class="fas fa-users mr-2"></i>Users</a></li>
            </ul>
        </aside>

        


        <!-- ✅ Main Content -->
        <main class="flex-1 p-6">
            <!-- ✅ Success Message -->
        @if (session('success'))
            <div class="max-w-7xl mx-auto mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success! </strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif
            @yield('content')
        </main>
    </div>

    

</body>
</html>
