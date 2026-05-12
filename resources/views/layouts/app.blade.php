<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-100">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <main class="ml-72 min-h-screen">
            @if (isset($header))
                <header class="bg-slate-100 border-b border-slate-200">
                    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
                        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 px-8 py-6">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endif

            {{ $slot }}
        </main>
    </div>
</body>

</html>
