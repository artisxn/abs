<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use ApaiIO\ApaiIO;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Request\GuzzleRequest;
use GuzzleHttp\Client;

use App\Amazon\ResponseTransformer\XmlToCollection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('keyword', \Request::input('keyword'));
        view()->share('category', \Request::input('category'));

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('apaiio', function ($app) {

            $conf = new GenericConfiguration();
            $client = new Client();
            $request = new GuzzleRequest($client);

            $conf->setCountry(config('amazon.country'))
                ->setAccessKey(config('amazon.api_key'))
                ->setSecretKey(config('amazon.api_secret_key'))
                ->setAssociateTag(config('amazon.associate_tag'))
                ->setResponseTransformer(new XmlToCollection())
                ->setRequest($request);

            return new ApaiIO($conf);
        });

        $this->app->alias('apaiio', 'ApaiIO\ApaiIO');
    }
}
