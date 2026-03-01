<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ad;
use App\Models\Category;
use App\Models\FeaturedAd;
use Livewire\Attributes\Layout;

#[Layout('layouts.main')]
class Home extends Component
{
    public function render()
    {
        // جلب البيانات باستخدام الـ Scopes
        $featuredAds = FeaturedAd::active()->header()->ordered()->limit(5)->get();
        $recentAds = Ad::active()->latest()->limit(12)->get();
        $categories = Category::root()->active()->menu()->limit(10)->get();

        return view('livewire.home', [
            'featuredAds' => $featuredAds,
            'recentAds' => $recentAds,
            'categories' => $categories,
        ]);
    }
}
