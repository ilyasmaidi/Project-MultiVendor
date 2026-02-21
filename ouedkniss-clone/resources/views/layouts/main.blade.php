<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    
    <title>@yield('title', 'TRICO | منصة الأزياء العالمية')</title>
    
    @yield('styles')
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700;800&family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --emerald-light: #10b981;
            --emerald-deep: #064e3b;
            --bg-dark: #0f1115;
            --card-bg: #1a1d23;
        }

        body {
            font-family: 'Almarai', sans-serif;
            background-color: var(--bg-dark);
            color: #f3f4f6;
            letter-spacing: -0.02em;
        }

        .font-heavy { font-weight: 800; }
        .font-international { font-family: 'Montserrat', sans-serif; }

        .bg-gradient-subtle {
            background: radial-gradient(circle at top right, #064e3b22 0%, #0f1115 40%);
        }

        .btn-premium {
            background-color: var(--emerald-light);
            color: #000;
            font-weight: 800;
            transition: all 0.3s ease;
            border: 1px solid var(--emerald-light);
            text-transform: uppercase;
        }

        .btn-premium:hover {
            background-color: transparent;
            color: var(--emerald-light);
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.2);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--emerald-light);
            border: 1px solid var(--emerald-light);
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background-color: var(--emerald-light);
            color: #000;
        }

        .heavy-title {
            font-weight: 900;
            line-height: 1.1;
            letter-spacing: -1px;
        }

        .nav-link {
            position: relative;
            font-weight: 700;
            transition: color 0.3s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            right: 0;
            width: 0;
            height: 2px;
            background: var(--emerald-light);
            transition: width 0.3s;
        }

        .nav-link:hover::after { width: 100%; }
        .nav-link:hover { color: var(--emerald-light); }
        .nav-link.active { color: var(--emerald-light); }
        .nav-link.active::after { width: 100%; }

        .card {
            background-color: var(--card-bg);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 1rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            border-color: rgba(16, 185, 129, 0.3);
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.5);
        }

        .form-input {
            background-color: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: #fff;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: var(--emerald-light);
            outline: none;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-input::placeholder { color: rgba(255,255,255,0.4); }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .badge-emerald { background: rgba(16, 185, 129, 0.2); color: #10b981; }
        .badge-amber { background: rgba(245, 158, 11, 0.2); color: #f59e0b; }
        .badge-rose { background: rgba(244, 63, 94, 0.2); color: #f43f5e; }
        .badge-blue { background: rgba(59, 130, 246, 0.2); color: #3b82f6; }

        .alert {
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
        }

        .alert-success { background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; }
        .alert-error { background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.3); color: #f43f5e; }
        .alert-warning { background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); color: #f59e0b; }
        .alert-info { background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); color: #3b82f6; }

        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    
    @livewireStyles
</head>
<body class="min-h-screen bg-gradient-subtle">
    
    @include('components.navbar')
    
    <main>
        @yield('content')
    </main>
    
    @include('components.footer')
    
    @yield('scripts')
    @livewireScripts
</body>
</html>
