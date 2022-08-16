<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CustomServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    Validator::extend('space', function ($attribute, $value, $parameters, $validator) {
      mb_ereg_match("^(\s|　)+$", $value) ? true : false;
    });
  }
}
