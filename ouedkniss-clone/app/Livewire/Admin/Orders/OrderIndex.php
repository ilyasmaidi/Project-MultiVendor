<?php
namespace App\Livewire\Admin\Orders;

use Livewire\Component; // تأكد من هذا السطر
use Livewire\WithPagination;

class OrderIndex extends Component // يجب أن يرث من Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.orders.order-index')
            ->layout('layouts.app'); // تأكد من وجود الـ Layout
    }
}