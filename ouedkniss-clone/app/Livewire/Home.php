<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ad;
use App\Models\Category;
use App\Models\FeaturedAd;

class Home extends Component
{
    public function render()
    {
        $featuredAds = FeaturedAd::active()->header()->ordered()->limit(30)->get();
        $recentAds = Ad::active()->latest()->limit(12)->get();
        $categories = Category::root()->active()->menu()->get();

        return view('livewire.home', [
            'featuredAds' => $featuredAds,
            'recentAds' => $recentAds,
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
