<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'listing_id',
        'seller_id',
        'size',
        'color',
        'quantity',
        'total_price',
        'status',
        'phone',
        'city',
        'shipping_address',
        'notes',
    ];

    /**
     * علاقة الطلب بالمشتري
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * علاقة الطلب بالبائع
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * علاقة الطلب بالمنتج
     * تم التعديل للإشارة إلى Ad::class بدلاً من Listing
     */
    public function listing(): BelongsTo
    {
        // نستخدم Ad هنا لأن هذا هو اسم الموديل في مشروعك
        return $this->belongsTo(Ad::class, 'listing_id');
    }

    /**
     * دالة مساعدة للحصول على لون الحالة (Status Badge)
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending'   => 'zinc-500',
            'processing'=> 'blue-500',
            'shipped'   => 'emerald-500',
            'delivered' => 'emerald-600',
            'cancelled' => 'red-500',
            default     => 'zinc-400',
        };
    }
}