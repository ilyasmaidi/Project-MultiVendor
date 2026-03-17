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

    // لإعادة الترقيم للصفحة 1 عند بدء البحث
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * تحديث حالة الطلب فوراً
     */
    public function updateStatus($orderId, $newStatus)
    {
        $order = Order::find($orderId);

        // حماية إضافية: التأكد أن المستخدم له الحق في تعديل هذا الطلب
        if (auth()->user()->role === 'admin' || $order->seller_id === auth()->id()) {
            $order->update(['status' => $newStatus]);
            
            // إشعار بسيط يظهر في المتصفح (اختياري)
            $this->dispatch('swal', [
                'title' => 'تمت العملية!',
                'text' => 'تم تحديث حالة الطلب بنجاح.',
                'icon' => 'success'
            ]);
        }
    }

    public function render()
    {
        $query = Order::query();

        // نظام الصلاحيات: الأدمن يرى الكل، البائع يرى منتجاته، المشتري يرى طلباته
        if (strtolower(auth()->user()->role) !== 'admin') {
            $query->where(function($q) {
                $q->where('seller_id', auth()->id())
                  ->orWhere('buyer_id', auth()->id());
            });
        }

        // الفلترة والبحث
        $query->when($this->search, function($q) {
            $q->where(function($sub) {
                $sub->where('id', 'like', '%'.$this->search.'%')
                    ->orWhere('city', 'like', '%'.$this->search.'%')
                    ->orWhere('phone', 'like', '%'.$this->search.'%');
            });
        })->when($this->status, fn($q) => $q->where('status', $this->status));

        return view('livewire.admin.orders.order-index', [
            'orders' => $query->with(['buyer', 'listing'])->latest()->paginate(10)
        ])->layout('layouts.app');
    }
}