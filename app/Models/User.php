<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions, HasRoles, HasUuids;

    protected $fillable = [
        "name",
        "email",
        "password",
        "phone"
    ];

    public function document()
    {
        return $this->hasOne(UserDocument::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

    public function services()
    {
        return $this->hasMany(UserService::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function hasActiveSubscription(): bool
    {
        return $this->subscriptions()
            ->where('ends_at', '>', now())
            ->where(function ($query) {
                $query->whereHas('payment', function ($q) {
                    $q->where('status', 'paid');
                })->orWhereHas('subscription', function ($q) {
                    $q->where('price', 0);
                });
            })
            ->exists();
    }


    public function roleObjects()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id')
            ->where('model_type', self::class);
    }
}
