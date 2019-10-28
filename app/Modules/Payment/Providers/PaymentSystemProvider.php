<?php

namespace App\Modules\Payment\Providers;

use App\Modules\Payment\Service\CloudPaymentsService;
use Illuminate\Support\ServiceProvider;

class PaymentSystemProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CloudPaymentsService::class, function ($app) {
            return new CloudPaymentsService(
                env('CLOUD_PAYMENTS_PUBLIC_ID', 'pk_f5473e33edb52cd05a238f382de02'),
                env('CLOUD_PAYMENTS_SECRET_API', '264c8ac7333775e3d7ad65736cc81013'),
            );
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
