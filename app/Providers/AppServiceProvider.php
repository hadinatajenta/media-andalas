<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB; // import untuk DB
use Artesaos\SEOTools\Facades\SEOTools as SEO; // import untuk SEO
use Illuminate\Support\ServiceProvider;
use App\Models\WebsiteModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $website = WebsiteModel::first(); 

        if ($website) {
            SEO::setTitle($website->nama_website);
            SEO::setDescription($website->deskripsi_website);
            SEO::metatags()->setKeywords($website->keyword_website);
            SEO::metatags()->addMeta('robots', $website->robot_txt);
        }
        else{

        }
    }
}
