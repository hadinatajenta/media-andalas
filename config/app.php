<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [


    'env' => env('APP_ENV', 'production'),

    'debug' => (bool) env('APP_DEBUG', false),


    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    'timezone' => 'UTC',

    'locale' => 'id',


    'fallback_locale' => 'id',

    'faker_locale' => 'en_US',

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class,

    ])->toArray(),

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
        'SEOMeta'       => Artesaos\SEOTools\Facades\SEOMeta::class,
        'OpenGraph'     => Artesaos\SEOTools\Facades\OpenGraph::class,
        'Twitter'       => Artesaos\SEOTools\Facades\TwitterCard::class,
        'JsonLd'        => Artesaos\SEOTools\Facades\JsonLd::class,
        'JsonLdMulti'   => Artesaos\SEOTools\Facades\JsonLdMulti::class,
        'SEO' => Artesaos\SEOTools\Facades\SEOTools::class,

    ])->toArray(),

];
