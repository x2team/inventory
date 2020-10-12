<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\PaymentGatewayContract;
use App\Http\View\Composers\ChannelsComposer;
use App\Mixin\StrMixins;
use App\Models\Channel;
use App\PostcardSendingService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentGatewayContract::class, function($app){

            if(request()->has('credit')){
                return new CreditPaymentGateway('usd');
            }
            return new BankPaymentGateway('usd');
        });


        // Example for Facades
        $this->app->singleton('Postcard', function($app){
            return new PostcardSendingService('us', 4, 6);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Option 1: Every single view
//        View::share('channels', Channel::orderBy('name')->get());

        // Option 2: Granular views with wildcards
//        View::composer(['post.*', 'channel.index'], function($view){
//            $view->with('channels', Channel::orderBy('name')->get());
//        });

        // Option 3: Dedicated Class
        View::composer('partials.channels.*', ChannelsComposer::class);


        /**
         * Example for Macros
         */
        Str::macro('partNumber', function ($part){
            return 'AB-' . substr($part, 0, 3) . '-' . substr($part, 3);
        });


        Str::mixin(new StrMixins(), false);

        ResponseFactory::macro('errorJson', function ($message = 'Default error message'){
            return [
                'message' => $message,
                'error_code' => '123'
            ];
        });
    }
}
