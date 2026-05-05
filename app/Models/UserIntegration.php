<?php

namespace App\Models;

use App\Enums\IntegrationSystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserIntegration extends Model
{
    protected $fillable = [
        'user_id',
        'system',
        'external_id',
        'metadata',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'system'   => IntegrationSystem::class,
            'metadata' => 'array',
            'active'   => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
