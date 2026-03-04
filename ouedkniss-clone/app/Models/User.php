<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method bool canCreateMoreAds()
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'whatsapp',
        'address',
        'bio',
        'avatar',
        'role',
        'is_active',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }

    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function staffInvitations(): HasMany
    {
        return $this->hasMany(StaffInvitation::class, 'invited_by');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->hasRole('admin');
    }

    public function isVendor(): bool
    {
        return $this->role === 'vendor' || $this->hasRole('vendor');
    }

    public function isStaff(): bool
    {
        return $this->role === 'staff' || $this->hasRole('staff');
    }

    public function isBuyer(): bool
    {
        return $this->role === 'buyer' || $this->hasRole('buyer');
    }

    public function hasStore(): bool
    {
        return $this->store !== null;
    }

    public function canCreateStore(): bool
    {
        return !$this->hasStore() && ($this->isVendor() || $this->isAdmin());
    }

    public function getAdsCount(): int
    {
        return $this->ads()->count();
    }

    public function canCreateMoreAds(): bool
    {
        return $this->getAdsCount() < 30 || $this->isAdmin();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function markLastLogin(): void
    {
        $this->update(['last_login_at' => now()]);
    }
}
