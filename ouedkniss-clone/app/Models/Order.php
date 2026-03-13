<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعبئة (Fillable)
     * ملاحظة: بفضل الـ indexer، سيتعرف VS Code على هذه الحقول فوراً
     */
    protected $fillable = [
        'buyer_id',
        'listing_id',
        'seller_id',
        'size',
        'color',
        'quantity',
        'total_price',
        'status',
        'shipping_address',
        'phone',
    ];

    /**
     * علاقة الطلب بالمشتري (الذي قام بعملية الشراء)
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * علاقة الطلب بالبائع (صاحب قطعة الملابس)
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * علاقة الطلب بالمنتج (قطعة الملابس من جدول Listings)
     */
    public function listing(): BelongsTo
{
    // إذا كان اسم الموديل Ad
    return $this->belongsTo(Ad::class, 'listing_id'); 
}

    /**
     * دالة مساعدة لحساب السعر الإجمالي تلقائياً إذا أردت ذلك مستقبلاً
     */
    public function calculateTotal()
    {
        return $this->quantity * $this->listing->price;
    }
}