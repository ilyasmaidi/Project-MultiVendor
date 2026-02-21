<div class="min-h-screen bg-gradient-subtle py-12">
    <div class="container mx-auto px-4 lg:px-8">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div>
                <span class="text-emerald-500 font-black tracking-[0.3em] text-xs block uppercase mb-2">Global Marketplace</span>
                <h1 class="heavy-title text-6xl text-white uppercase italic">Luxury <span class="text-emerald-500">Ads</span></h1>
            </div>
            
            <div class="flex gap-4 w-full md:w-auto">
                <input wire:model.live.debounce.500ms="search" type="text" placeholder="ابحث عن قطعة محددة..." 
                       class="bg-white/5 border border-white/10 px-6 py-3 rounded-full text-sm w-full md:w-80 outline-none focus:border-emerald-500 text-white">
                
                <select wire:model.live="sortBy" class="bg-zinc-900 border border-white/10 text-white text-[10px] font-black px-6 py-3 rounded-full outline-none uppercase cursor-pointer hover:border-emerald-500 transition-all">
                    <option value="latest">الأحدث</option>
                    <option value="price_asc">الأقل سعراً</option>
                    <option value="price_desc">الأعلى سعراً</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <aside class="lg:col-span-3 space-y-8">
                <div class="bg-white/[0.02] border border-white/5 p-8 rounded-3xl">
                    <h3 class="text-white font-black text-sm uppercase tracking-widest mb-6 pb-4 border-b border-white/5">الأقسام</h3>
                    <ul class="space-y-4">
                        <li>
                            <button wire:click="$set('category', null)" class="text-sm font-bold uppercase {{ is_null($category) ? 'text-emerald-500' : 'text-gray-500 hover:text-white' }}">كل القطع</button>
                        </li>
                        @foreach($categories as $cat)
                            <li>
                                <button wire:click="$set('category', '{{ $cat->slug }}')" 
                                        class="text-sm font-bold uppercase {{ $category == $cat->slug ? 'text-emerald-500' : 'text-gray-500 hover:text-white' }}">
                                    {{ $cat->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <main class="lg:col-span-9">
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($ads as $ad)
                        <livewire:ad-card :ad="$ad" :key="'ad-'.$ad->id" />
                    @empty
                        <div class="col-span-full py-40 text-center border-2 border-dashed border-white/5 rounded-3xl">
                            <p class="text-gray-600 font-black uppercase tracking-[0.5em]">No items found matching your search</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-20 flex justify-center">
                    {{ $ads->links() }}
                </div>
            </main>
        </div>
    </div>
</div>