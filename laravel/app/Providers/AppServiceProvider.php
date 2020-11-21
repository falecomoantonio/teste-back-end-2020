<?php

namespace App\Providers;

use App\Models\Product;
use Flugg\Responder\Contracts\Transformers\TransformerResolver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->make(TransformerResolver::class)->bind([
            Product::class => \App\Transformers\Product::class,
        ]);
        //
    }
}
