<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - {{ config('app.name', 'Laravel') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-gray-100 text-gray-900 antialiased">
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="font-semibold">{{ config('app.name', 'Laravel') }} Admin</span>
                <nav class="flex items-center gap-3 text-sm">
                    <a href="{{ route('admin.tours.index') }}" class="text-gray-700 hover:text-blue-600">Tours</a>
                    <a href="{{ route('admin.tour-categories.index') }}" class="text-gray-700 hover:text-blue-600">Categories</a>
                    <a href="{{ route('admin.tour-itineraries.index') }}" class="text-gray-700 hover:text-blue-600">Itineraries</a>
                </nav>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8">
        @if (session('success'))
            <div class="mb-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <ul class="list-disc pl-5">
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