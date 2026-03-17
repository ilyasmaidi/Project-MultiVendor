<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class OrderShow extends Component
{
    // تعريف المتغير لاستقبال بيانات الطلب
    public Order $order;

    /**
     * يتم استدعاء هذه الدالة تلقائياً عند تحميل الصفحة
     * تقوم بربط رقم الطلب من الرابط (URL) بقاعدة البيانات
     */
    public function mount(Order $order)
    {
        // تحميل الطلب مع علاقة 'buyer' (المشتري) و 'items' (المنتجات) لتجنب البطء
        $this->order = $order->load(['buyer']);
    }

    public function render()
    {
        // عرض صفحة التفاصيل واستخدام ملف التصميم الرئيسي للموقع
        return view('livewire.admin.orders.order-show')
            ->layout('layouts.app'); 
    }
}