<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ad;

class AdDetail extends Component
{
    public $slug;
    public $ad;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->ad = Ad::where('slug', $slug)
            ->with(['user', 'store', 'category', 'images', 'attributes'])
            ->firstOrFail();
        $this->ad->incrementViews();
    }

    public function render()
    {
        $template = 'ads.show-' . $this->ad->template;
        if (!view()->exists($template)) {
            $template = 'ads.show-general';
        }

        return view($template, ['ad' => $this->ad])->layout('layouts.main');
    }
}
