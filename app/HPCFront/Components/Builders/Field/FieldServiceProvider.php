<?php namespace HPCFront\Components\Builders\Field;

use Illuminate\Html\FormBuilder as Form;
use Illuminate\View\Factory as View;
use Illuminate\Session\Store as Session;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['field'] = $this->app->share(function($app){
            //Form $form, View $view
            $filedBuilder = new FieldBuilder($app['form'], $app['view'], $app['session']);
            return $filedBuilder;
        });
    }
}