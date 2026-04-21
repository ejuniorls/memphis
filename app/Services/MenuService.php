<?php

namespace App\Services;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class MenuService
{
    /**
     * TTL do cache em segundos (5 minutos).
     * Ajuste conforme necessário.
     */
    protected const CACHE_TTL = 300;

    protected const CACHE_KEY = 'sidebar_menu_tree';

    /**
     * Retorna a árvore de menus raiz com children eager-loaded.
     *
     * Objetos Eloquent não serializam bem em todos os drivers de cache.
     * Por isso validamos o tipo ao recuperar e descartamos se corrompido.
     */
    public function tree(): Collection
    {
        $cached = null;

        try {
            $cached = Cache::get(self::CACHE_KEY);

            // Descarta se não for uma Collection válida (ex: __PHP_Incomplete_Class)
            if ($cached !== null && ! ($cached instanceof Collection)) {
                Cache::forget(self::CACHE_KEY);
                $cached = null;
            }
        } catch (\Throwable) {
            Cache::forget(self::CACHE_KEY);
            $cached = null;
        }

        if ($cached !== null) {
            return $cached;
        }

        $tree = Menu::with(['children' => function ($query) {
            $query->active()->ordered()
                ->with(['children' => function ($q) {
                    $q->active()->ordered();
                }]);
        }])
            ->active()
            ->roots()
            ->ordered()
            ->get();

        try {
            Cache::put(self::CACHE_KEY, $tree, self::CACHE_TTL);
        } catch (\Throwable) {
            // Cache indisponível: continua sem cache, não quebra a aplicação
        }

        return $tree;
    }

    /**
     * Limpa o cache do menu.
     * Chamar após salvar ou deletar um item de menu.
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
