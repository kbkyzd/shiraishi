<?php

namespace shiraishi\Providers;

use Illuminate\Support\Facades\Blade;
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // L5.6, today.
        Blade::directive('csrf', function () {
            return '<?php echo csrf_field(); ?>';
        });

        Blade::directive('method', function ($method) {
            return "<?php echo method_field({$method}); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }

        $this->app->make('api.exception')->register(function (ModelNotFoundException $exception) {
            return abort(404);
        });
    }
}
