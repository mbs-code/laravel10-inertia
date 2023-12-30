<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

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
        /**
         * トーストを発行する
         *
         * @param string{'info'|'success'|'warning'|'error'} $type
         * @param string $message
         */
        Session::macro('toast', fn ($type, $message) =>
            session()->flash('toast', [
                'type' => $type,
                'message' => $message,
            ])
        );
    }


    /**
     * Undocumented function
     *
 * @param string{'open'|'closed'|'pending'} $plotType
     * @param 'info'|'error'|'success'|'warning' $type
     * @param string $message
     * @return void
     */
    public function asd(string $type, string $message): void {

    }
}
