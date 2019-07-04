<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Larabels') }} - Labels Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('/vendor/larabels/favicon.ico') }}">
</head>
<body class="larabels-font-sans larabels-h-full larabels-bg-gray-300 larabels-px-5 md:larabels-px-0">
    <nav class="larabels-container larabels-mx-auto larabels-border-b larabels-border-gray-400 larabels-py-5 larabels-mb-6">
        <a href="/" class="larabels-tracking-wider larabels-mr-1 larabels-text-gray-800 larabels-font-medium">{{ config('app.name', 'Larabels') }}</a>
        <sup class="larabels-tracking-widest larabels-text-white larabels-text-xs larabels-uppercase larabels-bg-indigo-700 larabels-px-1 larabels-rounded larabels-shadow larabels-font-medium">Labels</sup>
    </nav>
    <main class="larabels-container larabels-mx-auto">
        @if (session()->has('success'))
            @include('larabels::partials.alert_success', ['message' => session()->get('success')])
        @endif
        @if (session()->has('error'))
            @include('larabels::partials.alert_error', ['message' => session()->get('error')])
        @endif
        @yield('content')
    </main>
</body>
</html>
