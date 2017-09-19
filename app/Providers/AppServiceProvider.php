<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('checkstepprice', function ($attribute, $value, $parameters) {
            $type = \Request::get('type', '');
            $price = \Request::get('price', '');
            $person = \Request::get('person', '');
            $model = app()->make('App\Benefit');

            $model = $model->where(function ($query) use ($type, $price, $person) {
                $query->where('type', $type);
                $query->where('price', $price);
                $query->where('person', $person);
                if (\Request::has('id_step')) {
                    $query->where('id', '!=', \Request::get('id_step'));
                }
            })->get();
            return ($model->count() > 0) ? false : true;
        });

        Validator::extend('checkexistingstep', function ($attribute, $value, $parameters) {
            $model = app()->make('App\Benefit');
            $type = \Request::get('type', '');
            $step = \Request::get('step', '');
            $person = \Request::get('person', '');

            $checkType = $model->where(function ($query) use ($step, $type, $person) {
                $query->where('step', $step);
                $query->where('type', $type);
                $query->where('person', $person);
                if (\Request::has('id_step')) {
                    $query->where('id', '!=', \Request::get('id_step'));
                }
            })->get();
            // dump($)
            return ($checkType->count() > 0) ? false : true;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interfaces\ServiceTransactionInterface',
            'App\Repositories\Modify\ServiceTransactionRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\ServiceWarpTemplateInterface',
            'App\Repositories\Modify\ServiceWarpTemplateRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\ServiceBenefitInterface',
            'App\Repositories\Modify\ServiceBenefitRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\ServiceTemplateInterface', function ($app) {
                return new \App\Repositories\Modify\ServiceTemplateRepository(\Config::get('formconfig'));
            }
        );
    }
}
