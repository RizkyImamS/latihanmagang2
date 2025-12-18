<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\KategoriBerita;
use Illuminate\Support\Facades\View;

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
    public function boot(): void
    {
        View::share('global_kategori', KategoriBerita::all());
    }
}
