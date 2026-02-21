<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ad;
use App\Models\Category;

class AdListing extends Component
{
    use WithPagination;

    public $search = '';
    public $category = null;
    public $minPrice = null;
    public $maxPrice = null;
    public $city = null;
    public $condition = null;
    public $sortBy = 'latest';

    // تحسين مراقبة المتغيرات لإعادة الترقيم عند التغيير
    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => null],
        'minPrice' => ['except' => null],
        'maxPrice' => ['except' => null],
        'city' => ['except' => null],
        'condition' => ['except' => null],
        'sortBy' => ['except' => 'latest'],
    ];

    // إعادة ضبط الترقيم عند كتابة أي بحث جديد لضمان ظهور النتائج من الصفحة الأولى
    public function updatingSearch() { $this->resetPage(); }
    public function updatingCategory() { $this->resetPage(); }

    public function render()
    {
        $query = Ad::active()
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->category, fn($q) => $q->whereHas('category', fn($sq) => $sq->where('slug', $this->category)))
            ->when($this->minPrice, fn($q) => $q->where('price', '>=', $this->minPrice))
            ->when($this->maxPrice, fn($q) => $q->where('price', '<=', $this->maxPrice))
            ->when($this->city, fn($q) => $q->where('city', $this->city))
            ->when($this->condition, fn($q) => $q->where('condition', $this->condition));

        $query = match($this->sortBy) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'oldest' => $query->oldest(),
            default => $query->latest(),
        };

        // تم التعديل إلى 30 منتجاً مبدئياً
        $ads = $query->with(['category', 'user', 'images'])->paginate(30);
        $categories = Category::root()->active()->menu()->get();

        return view('livewire.ad-listing', [
            'ads' => $ads,
            'categories' => $categories,
        ])->layout('layouts.main');
    }
}