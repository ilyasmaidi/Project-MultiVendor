<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';

    public function render()
    {
        $query = Order::query();

        // السحر: إذا كان المستخدم أدمن، لا تضع أي قيود
        if (strtolower(auth()->user()->role) !== 'admin') {
            $query->where(function($q) {
                $q->where('seller_id', auth()->id())
                  ->orWhere('buyer_id', auth()->id());
            });
        }

        // الفلترة والبحث
        $query->when($this->search, function($q) {
            $q->where('id', 'like', '%'.$this->search.'%')
              ->orWhere('city', 'like', '%'.$this->search.'%');
        })->when($this->status, fn($q) => $q->where('status', $this->status));

        return view('livewire.admin.orders.order-index', [
            'orders' => $query->with(['buyer', 'listing'])->latest()->paginate(10)
        ])->layout('layouts.app');
    }
}