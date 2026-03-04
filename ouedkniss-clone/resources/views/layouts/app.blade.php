<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Changed to @yield so your views can push a title --}}
    <title>@yield('title', 'TRICO | منصة الأزياء العالمية')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700;800&family=Montserrat:wght@700;900&display=swap" rel="stylesheet">
    
    <style>
        :root { --emerald-light: #10b981; --emerald-deep: #064e3b; --bg-dark: #0f1115; --card-bg: #1a1d23; }
        body { font-family: 'Almarai', sans-serif; background-color: var(--bg-dark); color: #f3f4f6; letter-spacing: -0.02em; }
        .font-heavy { font-weight: 800; }
        .font-international { font-family: 'Montserrat', sans-serif; }
        .bg-gradient-subtle { background: radial-gradient(circle at top right, #064e3b22 0%, #0f1115 40%); }
        .btn-premium { background-color: var(--emerald-light); color: #000; font-weight: 800; transition: all 0.3s ease; border: 1px solid var(--emerald-light); text-transform: uppercase; }
        .btn-premium:hover { background-color: transparent; color: var(--emerald-light); box-shadow: 0 0 20px rgba(16, 185, 129, 0.2); }
        .heavy-title { font-weight: 900; line-height: 1.1; letter-spacing: -1px; }
        .nav-link { position: relative; font-weight: 700; transition: color 0.3s; }
        .nav-link::after { content: ''; position: absolute; bottom: -5px; right: 0; width: 0; height: 2px; background: var(--emerald-light); transition: width 0.3s; }
        .nav-link:hover::after { width: 100%; }
        .nav-link:hover { color: var(--emerald-light); }
    </style>
    @livewireStyles
</head>
<body class="min-h-screen bg-gradient-subtle">

    {{-- تضمين النافبار --}}
    @include('partials.navbar')

    {{-- CHANGED: We now use @yield('content') instead of {{ $slot }} --}}
    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    {{-- تضمين الفوتر --}}
    @include('partials.footer')

    @livewireScripts
</body>
</html>