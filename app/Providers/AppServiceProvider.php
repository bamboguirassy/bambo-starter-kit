<?php

namespace App\Providers;

use App\Custom\AccessChecker;
use App\Custom\MenuBuilder;
use App\Models\GroupeRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        setlocale(LC_TIME, "fr_FR");
        // Using view composer to set following variables globally
        view()->composer('*', function ($view) {
            $view->with('menus', MenuBuilder::buildMenu());
        });
        view()->share('primary_color', config('app.primary_color'));
        Blade::if('listable', function ($role_name) {
            return AccessChecker::checkListingAccess($role_name);
        });
        Blade::if('creable', function ($role_name) {
            return AccessChecker::checkCreatingAccess($role_name);
        });
        Blade::if('editable', function ($role_name) {
            return AccessChecker::checkEditingAccess($role_name);
        });
        Blade::if('showable', function ($role_name) {
            return AccessChecker::checkShowingAccess($role_name);
        });
        Blade::if('deletable', function ($role_name) {
            return AccessChecker::checkDeletingAccess($role_name);
        });
        Blade::if('allowed', function ($role_name) {
            return AccessChecker::checkFonctionnalityAccess($role_name);
        });
    }
}
