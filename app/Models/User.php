<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'avatar',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function filmsTracked(): HasMany
    {
        return $this->hasMany(FilmTracked::class);
    }

    public function filmsWantWatch(): HasMany
    {
        return $this->hasMany(FilmWantWatch::class);
    }

    public function filmsWatched(): HasMany
    {
        return $this->hasMany(FilmWatched::class);
    }

    public function verifyCodes(): HasMany
    {
        return $this->hasMany(UserVerifyCode::class, 'user_id', 'id');
    }

    public function createVerifyCode()
    {
        $this->verifyCodes()->create([
            'code' => Str::random(6),
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);
    }

    public function getVerifyCode()
    {
        return $this->verifyCodes()
            ->latest()
            ->value('code');
    }

    public function isAdmin(): bool
    {
        return $this->role_id === 2;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
