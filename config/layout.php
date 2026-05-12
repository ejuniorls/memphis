<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Container padrão das páginas
    |--------------------------------------------------------------------------
    |
    | Define a classe CSS do container que envolve o conteúdo das páginas no
    | layout admin. Os valores suportados são:
    |
    |   'kt-container-fixed'  — largura máxima fixa (recomendado para painéis)
    |   'kt-container-fluid'  — 100% da largura disponível
    |
    | Pode ser sobrescrito por LAYOUT_CONTAINER no .env.
    |
    */

    'container' => env('LAYOUT_CONTAINER', 'kt-container-fixed'),

];
