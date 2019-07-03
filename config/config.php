<?php

use Sandulat\Larabels\Http\Middleware\Authorize;

return [

    /*
    |--------------------------------------------------------------------------
    | Larabels Activity
    |--------------------------------------------------------------------------
    |
    | This option may be used to enable and disable Larabels.
    |
    */

    'enabled' => env('LARABELS_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Larabels Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middlewares will be assigned to every Larabels route. Note that
    | in any case Larabels routes implicitly belong to the "web" middleware.
    |
    */

    'middleware' => [
        Authorize::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Localization Files Whitelist
    |--------------------------------------------------------------------------
    |
    | This value determines which localization files should be included in the
    | dashboard. Files will be loaded from "/resources/lang/{locale}". Use
    | file names without extension: "auth", "pagination", "validation",
    | "passwords", etc. Leave empty to load all files.
    |
    */

    'whitelist' => [],

    /*
    |--------------------------------------------------------------------------
    | Dashboard path
    |--------------------------------------------------------------------------
    |
    | This value determines the base route path where the dashboard will be
    | accessible from.
    |
    */

    'path' => '/larabels',

];
