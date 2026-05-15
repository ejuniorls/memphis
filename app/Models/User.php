<?php

namespace App\Models;

use App\Notifications\Auth\ResetPassword;
use App\Notifications\Auth\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

#[Fillable([
    'name',
    'email',
    'password',
    'avatar',
    'bio',
    'job_title',
    'company',
    'phone',
    'location',
    'website',
    'linkedin',
    'github',
    'twitter',
    'instagram',
    'profile_public',
    'show_email',
    'show_phone',
    'appearance_preferences',
    'notification_preferences',
])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, SoftDeletes;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'profile_public' => 'boolean',
            'show_email' => 'boolean',
            'show_phone' => 'boolean',
            'deleted_at' => 'datetime',
            'appearance_preferences' => 'array',
            'notification_preferences' => 'array',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function avatarUrl(): string
    {
        if ($this->avatar) {
            return Storage::url($this->avatar);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random&color=fff&size=200';
    }

    /**
     * Retorna as preferências de aparência mescladas com os defaults.
     */
    public function appearancePreferences(): array
    {
        $defaults = [
            'layout_width' => 'fixed',
            'sidebar_default' => 'expanded',
            'sidebar_mini' => false,
            'theme_mode' => 'system',
            'primary_color' => 'blue',
            'font_size' => 'md',
            'font_family' => 'inter',
            'density' => 'comfortable',
            'topbar_sticky' => true,
            'show_breadcrumbs' => true,
            'show_page_title' => true,
            'animations' => true,
        ];

        return array_merge($defaults, $this->appearance_preferences ?? []);
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail());
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPassword($token));
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(UserContact::class);
    }

    public function integrations(): HasMany
    {
        return $this->hasMany(UserIntegration::class);
    }

    public function accessLogs(): HasMany
    {
        return $this->hasMany(UserAccessLog::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function hasRole(string $name): bool
    {
        return $this->roles->contains('name', $name);
    }
}
