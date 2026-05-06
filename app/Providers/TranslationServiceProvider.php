<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * Percorre recursivamente a estrutura lang/{locale}/**‌/pagina.json
     * e registra cada arquivo como grupo de tradução no formato:
     *
     *   {pasta1}.{pasta2}.{arquivo}::chave
     *
     * Exemplos de uso nas views:
     *   __('pages.auth.login.heading')
     *   __('pages.settings.profile.save')
     *   __('layouts.auth.branded.portal_title')
     *   __('partials.settings-heading.title')
     *   __('components.password-input.toggle_visibility')
     */
    public function boot(): void
    {
        $locale = app()->getLocale();
        $localePath = lang_path($locale);

        if (! File::isDirectory($localePath)) {
            return;
        }

        $this->loadJsonFiles($localePath, $locale, '');
    }

    /**
     * Recursivamente percorre os diretórios e carrega os arquivos JSON.
     */
    private function loadJsonFiles(string $directory, string $locale, string $prefix): void
    {
        foreach (File::files($directory) as $file) {
            if ($file->getExtension() !== 'json') {
                continue;
            }

            $groupKey = ltrim($prefix . '.' . $file->getFilenameWithoutExtension(), '.');
            $translations = json_decode(File::get($file->getPathname()), true) ?? [];

            app('translator')->addLines(
                collect($translations)
                    ->mapWithKeys(fn($value, $key) => ["{$groupKey}.{$key}" => $value])
                    ->all(),
                $locale,
            );
        }

        foreach (File::directories($directory) as $subDir) {
            $segment = ltrim($prefix . '.' . basename($subDir), '.');
            $this->loadJsonFiles($subDir, $locale, $segment);
        }
    }
}
