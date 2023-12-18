<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('username', function ($attribute, $value, $parameters, $validator) {
            // Your custom validation logic for the username
            // Example: Check if the username meets certain criteria
            return preg_match('/^[a-zA-Z0-9_]+$/', $value);
        });

        // You can also add a custom error message for the rule
        Validator::replacer('username', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute must only contain letters, numbers, and underscores.');
        });
    }
}
