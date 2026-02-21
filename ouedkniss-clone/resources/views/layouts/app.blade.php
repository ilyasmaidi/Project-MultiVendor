<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRICO | منصة الأزياء العالمية</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700;800&family=Montserrat:wght@700;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --emerald-light: #10b981; /* أخضر زمردي راقي */
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

        /* تدرج زمردي خفيف جداً للخلفية */
        .bg-gradient-subtle {
            background: radial-gradient(circle at top right, #064e3b22 0%, #0f1115 40%);
        }

        /* نحت الأزرار - فخامة دولية */
        .btn-premium {
            background-color: var(--emerald-light);
            color: #000;
            font-weight: 800; /* خط غليظ للأزرار */
            transition: all 0.3s ease;
            border: 1px solid var(--emerald-light);
            text-transform: uppercase;
        }

        .btn-premium:hover {
            background-color: transparent;
            color: var(--emerald-light);
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.2);
        }

        /* الخط الغليظ الجريء */
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
    </style>
</head>
<body class="min-h-screen bg-gradient-subtle">

    <nav class="sticky top-0 z-50 bg-[#0f1115]/90 backdrop-blur-xl border-b border-white/5">
        <div class="container mx-auto px-4 lg:px-8 h-20 flex items-center justify-between">
            
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="font-international text-3xl font-black tracking-tighter text-white uppercase">TRI<span class="text-[#10b981]">CO</span></span>
                </a>
            </div>

            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('ads.index') }}" class="nav-link text-sm uppercase">اكتشف الكل</a>
                <a href="{{ route('ads.by-category', 'men') }}" class="nav-link text-sm uppercase">الرجال</a>
                <a href="{{ route('ads.by-category', 'women') }}" class="nav-link text-sm uppercase text-emerald-400">النساء</a>
                <a href="{{ route('stores.index') }}" class="nav-link text-sm uppercase">المتاجر العالمية</a>
                <a href="{{ route('categories.index') }}" class="nav-link text-sm uppercase">التصنيفات</a>
            </div>

            <div class="flex items-center gap-5">
                <div class="relative hidden sm:block">
                    <input type="text" placeholder="ابحث عن ماركة..." class="bg-white/5 border border-white/10 px-4 py-2 rounded-full text-xs w-64 focus:border-emerald-500 outline-none transition-all text-white">
                </div>
                
                @auth
                    <a href="{{ route('store.dashboard') }}" class="text-xl hover:text-emerald-500 transition-colors" title="لوحة التحكم">
                        <i class="fa-solid fa-chart-line"></i>
                    </a>
                    <a href="{{ route('profile') }}" class="text-xl hover:text-emerald-500 transition-colors">
                        <i class="fa-regular fa-user"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold hover:text-emerald-400 transition-colors uppercase tracking-widest">دخول</a>
                @endauth

                <button class="lg:hidden text-2xl text-emerald-500"><i class="fa-solid fa-bars-staggered"></i></button>
                <a href="{{ route('ads.create') }}" class="btn-premium px-6 py-2.5 rounded-full text-xs hidden sm:block">ابدأ البيع</a>
            </div>
        </div>
    </nav>

    <section class="container mx-auto px-4 py-16 lg:py-24">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">
                <span class="text-emerald-500 font-black tracking-[0.4em] text-xs block uppercase">إصدارات شتاء 2026 الدولية</span>
                <h1 class="heavy-title text-7xl lg:text-9xl tracking-tighter">
                    أناقة <span class="text-emerald-500">بلا</span> <br> حدود.
                </h1>
                <p class="text-gray-400 text-xl max-w-md font-medium leading-relaxed">
                    اكتشف المجموعات الحصرية من الماركات العالمية والمحلية في مساحة رقمية واحدة. وجهتك الأولى للنخبة.
                </p>
                <div class="flex gap-6 pt-4">
                    <a href="{{ route('ads.index') }}" class="btn-premium px-12 py-5 text-sm rounded-none">تسوق الآن</a>
                    <a href="{{ route('stores.index') }}" class="border-2 border-white/10 hover:border-white px-12 py-5 text-sm font-black transition-all uppercase tracking-widest">اكتشف المتاجر</a>
                </div>
            </div>
            <div class="relative group">
                <div class="absolute -inset-4 bg-emerald-500/10 blur-3xl rounded-full group-hover:bg-emerald-500/20 transition-all duration-700"></div>
                <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?auto=format&fit=crop&w=800&q=80" 
                     alt="Fashion" class="relative rounded-[2rem] grayscale hover:grayscale-0 transition-all duration-1000 shadow-[0_35px_60px_-15px_rgba(0,0,0,0.6)] border border-white/5">
                <div class="absolute -bottom-6 -right-6 bg-zinc-900 border border-emerald-500/30 p-6 rounded-2xl shadow-2xl hidden md:block">
                    <p class="text-emerald-500 font-black text-2xl font-international tracking-tight">NEW ARRIVAL</p>
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">Collection 2026</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 py-12 border-y border-white/5 my-20">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center group cursor-default">
                <h3 class="font-international font-black text-4xl mb-2 group-hover:text-emerald-500 transition-colors">500+</h3>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-[0.2em]">ماركة عالمية</p>
            </div>
            <div class="text-center group cursor-default">
                <h3 class="font-international font-black text-4xl mb-2 group-hover:text-emerald-500 transition-colors">12K</h3>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-[0.2em]">بائع موثوق</p>
            </div>
            <div class="text-center group cursor-default">
                <h3 class="font-international font-black text-4xl mb-2 group-hover:text-emerald-500 transition-colors">24H</h3>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-[0.2em]">توصيل سريع</p>
            </div>
            <div class="text-center group cursor-default">
                <h3 class="font-international font-black text-4xl mb-2 group-hover:text-emerald-500 transition-colors">FREE</h3>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-[0.2em]">إرجاع دولي</p>
            </div>
        </div>
    </section>

    <footer class="bg-black py-24 mt-40 border-t border-emerald-500/10">
        <div class="container mx-auto px-4 grid md:grid-cols-4 gap-16">
            <div class="col-span-1 md:col-span-1">
                <span class="font-international text-4xl font-black text-white uppercase tracking-tighter">TRI<span class="text-emerald-500">CO</span></span>
                <p class="mt-8 text-gray-500 leading-relaxed text-sm font-medium">
                    المنصة العربية الأولى للأزياء العالمية. جودة، ثقة، وأناقة تفوق التوقعات. نحن نغير مفهوم التسوق الرقمي.
                </p>
                <div class="flex gap-4 mt-8 text-xl text-gray-400">
                    <a href="#" class="hover:text-emerald-500"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="hover:text-emerald-500"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" class="hover:text-emerald-500"><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>
            <div>
                <h4 class="font-black text-white mb-8 uppercase tracking-widest text-sm">عن TRICO</h4>
                <ul class="space-y-4 text-gray-500 text-sm font-bold">
                    <li><a href="{{ route('help') }}" class="hover:text-emerald-400 transition-colors uppercase">مركز المساعدة</a></li>
                    <li><a href="{{ route('safety') }}" class="hover:text-emerald-400 transition-colors uppercase">دليل الأمان</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-emerald-400 transition-colors uppercase">الشروط والأحكام</a></li>
                    <li><a href="{{ route('privacy') }}" class="hover:text-emerald-400 transition-colors uppercase">سياسة الخصوصية</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-black text-white mb-8 uppercase tracking-widest text-sm">حسابي</h4>
                <ul class="space-y-4 text-gray-500 text-sm font-bold uppercase">
                    @auth
                        <li><a href="{{ route('my-ads') }}" class="hover:text-emerald-400 transition-colors">إعلاناتي</a></li>
                        <li><a href="{{ route('profile') }}" class="hover:text-emerald-400 transition-colors">إعدادات الحساب</a></li>
                        <li><a href="{{ route('store.dashboard') }}" class="hover:text-emerald-400 transition-colors">لوحة التاجر</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:text-emerald-400 transition-colors">تسجيل الدخول</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-emerald-400 transition-colors">فتح متجر</a></li>
                    @endauth
                </ul>
            </div>
            <div>
                <h4 class="font-black text-white mb-8 uppercase tracking-widest text-sm">النشرة الدولية</h4>
                <p class="text-gray-500 text-xs mb-6 font-bold uppercase tracking-tighter">كن أول من يعرف عن مجموعاتنا الحصرية</p>
                <div class="flex bg-white/5 rounded-full p-1 border border-white/10 focus-within:border-emerald-500 transition-all">
                    <input type="email" placeholder="البريد الإلكتروني" class="bg-transparent px-6 py-2 w-full outline-none text-xs text-white">
                    <button class="bg-emerald-500 text-black px-6 py-2 rounded-full font-black text-[10px] uppercase">انضم</button>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-4 mt-24 pt-8 border-t border-white/5 text-center">
            <p class="text-[10px] font-black text-gray-600 uppercase tracking-[0.5em] font-international">© 2026 TRICO GLOBAL SYSTEM - ALL RIGHTS RESERVED</p>
        </div>
    </footer>

</body>
</html>