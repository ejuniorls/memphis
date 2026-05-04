<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * Percorre a estrutura lang/{locale}/{modulo}/{pagina}.json
     * e registra cada arquivo como um namespace de tradução no formato:
     *
     *   {modulo}.{pagina}::chave
     *
     * Exemplo:
     *   trans('auth.login.title')
     *   trans('auth.register.heading')
     */
    public function boot(): void
    {
        $locale = app()->getLocale();
        $localePath = lang_path($locale);

        if (! File::isDirectory($localePath)) {
            return;
        }

        foreach (File::directories($localePath) as $moduleDir) {
            $module = basename($moduleDir);

            foreach (File::files($moduleDir) as $file) {
                if ($file->getExtension() !== 'json') {
                    continue;
                }

                $page = $file->getFilenameWithoutExtension();
                $key  = "{$module}.{$page}";

                $translations = json_decode(File::get($file->getPathname()), true) ?? [];

                // Mescla no grupo de traduções do Laravel para acesso via trans() / __()
                app('translator')->addLines(
                    collect($translations)
                        ->mapWithKeys(fn ($value, $k) => ["{$key}.{$k}" => $value])
                        ->all(),
                    $locale,
                );
            }
        }
    }
}
