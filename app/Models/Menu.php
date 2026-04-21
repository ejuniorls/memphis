<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'label',
    'icon',
    'route',
    'is_route',
    'parent_id',
    'order',
    'active',
    'section',
    'is_section_header',
])]
class Menu extends Model
{
    // --------------------------------------------------------------------------
    // Relacionamentos
    // --------------------------------------------------------------------------

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    // --------------------------------------------------------------------------
    // Helpers
    // --------------------------------------------------------------------------

    /**
     * Resolve a URL do item: route() ou URL direta.
     */
    public function url(): string
    {
        if (!$this->route) {
            return '#';
        }

        if ($this->is_route) {
            try {
                return route($this->route);
            } catch (\Throwable) {
                return '#';
            }
        }

        return $this->route;
    }

    /**
     * Verifica se este item (ou algum filho) está ativo na rota atual.
     */
    public function isActive(): bool
    {
        if ($this->is_route && $this->route) {
            try {
                return request()->routeIs($this->route);
            } catch (\Throwable) {
                return false;
            }
        }

        return false;
    }

    /**
     * Verifica se algum filho está ativo (para expandir o accordion).
     */
    public function hasActiveChild(): bool
    {
        foreach ($this->children as $child) {
            if ($child->isActive() || $child->hasActiveChild()) {
                return true;
            }
        }

        return false;
    }

    // --------------------------------------------------------------------------
    // Scopes
    // --------------------------------------------------------------------------

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
