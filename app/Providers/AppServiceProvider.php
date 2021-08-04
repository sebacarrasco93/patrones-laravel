<?php

namespace App\Providers;

use App\Contracts\VerifiableAdapter;
use App\Services\Adapters\AbstractApiAdapter;
use App\Services\Adapters\MailboxLayerAdapter;
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
        /* Usamos Mailbox (ApiLayer) */
        $this->app->bind(
            VerifiableAdapter::class,
            config('adapter.driver',MailboxLayerAdapter::class)
        );

        /* Y si falla o pasa algo, cambiamos acá, y seguimos usando AbstractApi */
        // $this->app->bind(
        //     VerifiableAdapter::class,
        //     config('adapter.driver',AbstractApiAdapter::class)
        // );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
