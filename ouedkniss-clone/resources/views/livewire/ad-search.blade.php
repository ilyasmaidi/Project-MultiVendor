<div class="relative">
    <div class="flex">
        <input type="text"
               wire:model="search"
               placeholder="بحث في الإعلانات..."
               class="w-full px-4 py-3 rounded-r-lg border-0 focus:ring-2 focus:ring-red-500"
               wire:keydown.enter="$emit('searchUpdated', search)">
        <button class="bg-red-600 text-white px-6 py-3 rounded-l-lg hover:bg-red-700">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>
