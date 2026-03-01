<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'store_id',
        'category_id',
        'title',
        'slug',
        'description',
        'price',
        'price_type',
        'currency',
        'location',
        'city',
        'condition',
        'status',
        'template',
        'is_featured',
        'featured_until',
        'views_count',
        'favorites_count',
        'contact_phone',
        'contact_whatsapp',
        'contact_messenger',
        'show_contact_info',
        'accept_offers',
        'is_negotiable',
        'seo_meta',
        'published_at',
        'expires_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'show_contact_info' => 'boolean',
        'accept_offers' => 'boolean',
        'is_negotiable' => 'boolean',
        'seo_meta' => 'array',
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
        'featured_until' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(AdImage::class)->orderBy('sort_order');
    }

    public function primaryImage()
    {
        return $this->hasOne(AdImage::class)->where('is_primary', true);
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'ad_attributes')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function featuredAd(): BelongsTo
    {
        return $this->belongsTo(FeaturedAd::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)
            ->whereNotNull('featured_until')
            ->where('featured_until', '>', now());
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByTemplate($query, $template)
    {
        return $query->where('template', $template);
    }

    public function scopeByPriceRange($query, $min, $max)
    {
        return $query->when($min, fn($q) => $q->where('price', '>=', $min))
            ->when($max, fn($q) => $q->where('price', '<=', $max));
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('city', $city);
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function getContactWhatsAppUrlAttribute(): ?string
    {
        if ($this->contact_whatsapp) {
            $phone = preg_replace('/[^0-9]/', '', $this->contact_whatsapp);
            return "https://wa.me/{$phone}";
        }
        return null;
    }

    public function getShareUrlAttribute(): string
    {
        return route('ads.show', $this->slug);
    }
}
