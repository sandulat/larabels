<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Larabels') }} - Labels Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('/vendor/larabels/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset(mix('larabels.css', 'vendor/larabels')) }}">
</head>
<body class="h-full bg-gray-300 font-body px-5 md:px-0">
    <nav class="container mx-auto border-b border-gray-400 py-5 mb-6">
        <a href="/" class="tracking-wider mr-1 text-gray-800 font-medium">{{ config('app.name', 'Larabels') }}</a>
        <sup class="tracking-widest text-white text-xs uppercase bg-indigo-700 px-1 rounded shadow font-medium">Labels</sup>
    </nav>
    <main id="app" class="container mx-auto" v-cloak>
        @if (session()->has('success'))
            @include('larabels::partials.alert_success', ['message' => session()->get('success')])
        @endif
        @if (session()->has('error'))
            @include('larabels::partials.alert_error', ['message' => session()->get('error')])
        @endif
        @yield('content')
    </main>
    <script src="{{ asset(mix('larabels.js', 'vendor/larabels')) }}"></script>
</body>
</html>
