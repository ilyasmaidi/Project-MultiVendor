<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-[#0a0a0a] p-6" dir="rtl">
    <div class="w-full max-w-md">
        
        {{-- Header البسيط --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-black text-zinc-900 dark:text-white tracking-tighter">
                TRI<span class="text-emerald-500">CO</span>
            </h1>
            <p class="text-zinc-500 text-sm mt-2">إنشاء حساب جديد في المنصة</p>
        </div>

        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/5 p-8 rounded-3xl shadow-xl">
            
            <form wire:submit.prevent="register" class="space-y-5">
                
                {{-- الحقول الأساسية --}}
                <div>
                    <label class="block text-xs font-bold text-zinc-400 mb-2 mr-2">الاسم الكامل</label>
                    <input wire:model.defer="name" type="text" 
                           class="w-full bg-zinc-50 dark:bg-black border border-zinc-200 dark:border-white/10 py-4 px-5 rounded-2xl text-sm focus:border-emerald-500 outline-none transition-all dark:text-white">
                    @error('name') <span class="text-[10px] text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-zinc-400 mb-2 mr-2">رقم الهاتف</label>
                    <input wire:model.defer="phone" type="tel" dir="ltr"
                           class="w-full bg-zinc-50 dark:bg-black border border-zinc-200 dark:border-white/10 py-4 px-5 rounded-2xl text-sm focus:border-emerald-500 outline-none transition-all dark:text-white text-right">
                    @error('phone') <span class="text-[10px] text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- يظهر البريد فقط إذا كان الحساب يحتاجه --}}
                <div x-data="{ role: @entangle('role') }">
                    <div x-show="role === 'vendor'" x-transition>
                        <label class="block text-xs font-bold text-zinc-400 mb-2 mr-2">البريد الإلكتروني</label>
                        <input wire:model.defer="email" type="email" 
                               class="w-full bg-zinc-50 dark:bg-black border border-zinc-200 dark:border-white/10 py-4 px-5 rounded-2xl text-sm focus:border-emerald-500 outline-none transition-all dark:text-white">
                        @error('email') <span class="text-[10px] text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-zinc-400 mb-2 mr-2">كلمة المرور</label>
                    <input wire:model.defer="password" type="password" 
                           class="w-full bg-zinc-50 dark:bg-black border border-zinc-200 dark:border-white/10 py-4 px-5 rounded-2xl text-sm focus:border-emerald-500 outline-none transition-all dark:text-white">
                    @error('password') <span class="text-[10px] text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- زر التسجيل --}}
                <button type="submit" wire:loading.attr="disabled"
                        class="w-full bg-zinc-900 dark:bg-emerald-500 text-white dark:text-black py-4 rounded-2xl font-bold text-sm hover:opacity-90 transition-all active:scale-95 disabled:opacity-50 mt-4">
                    <span wire:loading.remove>تسجيل الحساب</span>
                    <span wire:loading>جاري الإنشاء...</span>
                </button>

            </form>
        </div>

        <p class="text-center mt-6 text-xs text-zinc-500">
            لديك حساب بالفعل؟ <a href="/login" class="text-emerald-500 font-bold">تسجيل الدخول</a>
        </p>
    </div>
</div>