<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'TRICO | منصة الأزياء العالمية')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: { light: '#10b981', dark: '#059669', DEFAULT: '#10b981' },
                        surface: { 50: '#fafafa', 900: '#18181b', 950: '#09090b' }
                    },
                    fontFamily: {
                        'international': ['Montserrat', 'sans-serif'],
                        'arabic': ['Almarai', 'sans-serif']
                    }
                }
            }
        }
    </script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700;800&family=Montserrat:wght@700;900&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        function applyTheme() {
            const theme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.classList.toggle('dark', theme === 'dark');
        }
        applyTheme();
    </script>

    <style>
        [x-cloak] { display: none !important; }
        
        body { 
            font-family: 'Almarai', sans-serif; 
            background-color: #ffffff;
            color: #09090b;
            line-height: 1.6;
            -webkit-tap-highlight-color: transparent;
        }

        .dark body {
            background-color: #09090b;
            color: #f4f4f5;
        }

        /* تحسين مظهر السكرول بار */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 10px; }

        /* منع مشاكل التمرير العرضي */
        html, body { overflow-x: hidden; width: 100%; position: relative; scroll-behavior: smooth; }

        /* انيميشن خاص لمحرك البحث */
        .search-appear {
            animation: search-fade-in 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes search-fade-in {
            from { opacity: 0; transform: translateY(-20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
    </style>
    @livewireStyles
</head>
<body class="min-h-screen antialiased selection:bg-emerald-500/30 selection:text-emerald-500">

    {{-- النافبار هنا --}}
    @include('components.navbar')

    <main>
        {{-- بقعة ضوئية جمالية خلفية (تظهر فقط في الديسكتاب) --}}
        <div class="hidden md:block fixed top-[-10%] left-[-10%] -z-10 h-[500px] w-[500px] rounded-full bg-emerald-500/10 blur-[120px] pointer-events-none"></div>
        <div class="hidden md:block fixed bottom-[-10%] right-[-10%] -z-10 h-[500px] w-[500px] rounded-full bg-emerald-500/5 blur-[120px] pointer-events-none"></div>
        
        <div class="relative min-h-[calc(100vh-200px)]">
            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </main>

    @include('components.footer')
    
    @livewireScripts
</body>
</html>