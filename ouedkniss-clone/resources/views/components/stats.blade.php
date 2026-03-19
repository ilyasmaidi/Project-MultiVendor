<section class="container mx-auto px-4 py-20 my-28 relative">
    {{-- تدرج خلفي معكوس: غامق في اللايت ومضيء في الدارك --}}
    <div class="absolute inset-0 bg-zinc-900/5 dark:bg-white/[0.03] -z-10 rounded-[4rem] border border-zinc-900/5 dark:border-white/[0.05]"></div>
    
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-16 gap-x-4">
        
        {{-- Item: Brands --}}
        <div class="text-center group cursor-default relative">
            <div class="absolute inset-0 flex items-center justify-center -top-10 select-none pointer-events-none">
                {{-- النصوص الخلفية أصبحت أغمق في الفاتح وأفتح في الغامق --}}
                <span class="text-5xl font-black text-zinc-900/[0.05] dark:text-white/[0.08] tracking-[0.2em] font-international transition-all duration-700 group-hover:tracking-[0.4em]">BRANDS</span>
            </div>
            <h3 class="font-international font-black text-5xl md:text-6xl mb-4 text-zinc-900 dark:text-white group-hover:text-brand transition-all duration-500 tracking-tighter">
                500<span class="text-brand text-3xl ml-1">+</span>
            </h3>
            <p class="text-[10px] md:text-xs text-zinc-600 dark:text-zinc-300 font-black uppercase tracking-[0.4em] leading-none">
                ماركة عالمية
            </p>
        </div>

        {{-- Item: Trusted Sellers --}}
        <div class="text-center group cursor-default relative border-r border-zinc-900/10 dark:border-white/10">
            <div class="absolute inset-0 flex items-center justify-center -top-10 select-none pointer-events-none">
                <span class="text-5xl font-black text-zinc-900/[0.05] dark:text-white/[0.08] tracking-[0.2em] font-international transition-all duration-700 group-hover:tracking-[0.4em]">TRUSTED</span>
            </div>
            <h3 class="font-international font-black text-5xl md:text-6xl mb-4 text-zinc-900 dark:text-white group-hover:text-brand transition-all duration-500 tracking-tighter">
                12<span class="text-brand text-3xl ml-1">K</span>
            </h3>
            <p class="text-[10px] md:text-xs text-zinc-600 dark:text-zinc-300 font-black uppercase tracking-[0.4em] leading-none">
                بائع موثوق
            </p>
        </div>

        {{-- Item: Fast Shipping --}}
        <div class="text-center group cursor-default relative border-r border-zinc-900/10 dark:border-white/10">
            <div class="absolute inset-0 flex items-center justify-center -top-10 select-none pointer-events-none">
                <span class="text-5xl font-black text-zinc-900/[0.05] dark:text-white/[0.08] tracking-[0.2em] font-international transition-all duration-700 group-hover:tracking-[0.4em]">EXPRESS</span>
            </div>
            <h3 class="font-international font-black text-5xl md:text-6xl mb-4 text-zinc-900 dark:text-white group-hover:text-brand transition-all duration-500 tracking-tighter">
                24<span class="text-brand text-3xl ml-1">H</span>
            </h3>
            <p class="text-[10px] md:text-xs text-zinc-600 dark:text-zinc-300 font-black uppercase tracking-[0.4em] leading-none">
                توصيل سريع
            </p>
        </div>

        {{-- Item: Free Return --}}
        <div class="text-center group cursor-default relative border-r border-zinc-900/10 dark:border-white/10">
            <div class="absolute inset-0 flex items-center justify-center -top-10 select-none pointer-events-none">
                <span class="text-5xl font-black text-zinc-900/[0.05] dark:text-white/[0.08] tracking-[0.2em] font-international transition-all duration-700 group-hover:tracking-[0.4em]">POLICY</span>
            </div>
            <h3 class="font-international font-black text-5xl md:text-6xl mb-4 text-zinc-900 dark:text-white group-hover:text-brand transition-all duration-500 tracking-tighter">
                FREE
            </h3>
            <p class="text-[10px] md:text-xs text-zinc-600 dark:text-zinc-300 font-black uppercase tracking-[0.4em] leading-none">
                إرجاع دولي
            </p>
        </div>

    </div>
</section>