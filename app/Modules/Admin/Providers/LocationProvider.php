<?php

namespace App\Modules\Admin\Providers;

use App\Modules\Admin\Services\GoogleLocationService;
use App\Modules\Admin\Services\Interfaces\LocationInterface;
use Illuminate\Support\ServiceProvider;

class LocationProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LocationInterface::class, function () {
            $httpClient = $this->app->get(\GuzzleHttp\Client::class);
            $key = 'AIzaSyC7EbCoJC1eDuWnJeUcK8k6S02Y92mPsIU';

            return new GoogleLocationService($httpClient, 'json', $key);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
