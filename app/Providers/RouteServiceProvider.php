<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

           // Customize route model binding for User
   Route::bind('user', function ($value) {
    return User::where('slug', $value)->firstOrFail();
});




        Route::model('document', \App\Models\Document::class);

        // Define how to retrieve the model by slug
        Route::bind('document', function ($value) {
        return \App\Models\Document::where('slug', $value)->firstOrFail(); });


        Route::model('garnish', \App\Models\Garnish::class);

        // Define how to retrieve the model by slug
        Route::bind('garnish', function ($value) {
        return \App\Models\Garnish::where('slug', $value)->firstOrFail(); });

        Route::model('clearance', \App\Models\Clearance::class);

        // Define how to retrieve the model by slug
        Route::bind('clearance', function ($value) {
        return \App\Models\Clearance::where('slug', $value)->firstOrFail(); });

        Route::model('hero', \App\Models\Hero::class);

        // Define how to retrieve the model by slug
        Route::bind('hero', function ($value) {
        return \App\Models\Hero::where('slug', $value)->firstOrFail(); });



        Route::model('department', \App\Models\Department::class);

        // Define how to retrieve the model by slug
        Route::bind('department', function ($value) {
            return \App\Models\Department::where('slug', $value)->firstOrFail();
        });

        Route::model('worker', \App\Models\Worker::class);

        // Define how to retrieve the model by slug
        Route::bind('worker', function ($value) {
            return \App\Models\Worker::where('slug', $value)->firstOrFail();
        });

        Route::model('salary', \App\Models\Salary::class);

        // Define how to retrieve the model by slug
        Route::bind('salary', function ($value) {
            return \App\Models\Salary::where('slug', $value)->firstOrFail();
        });

        Route::model('leave', \App\Models\Leave::class);

        // Define how to retrieve the model by slug
        Route::bind('leave', function ($value) {
            return \App\Models\Leave::where('slug', $value)->firstOrFail();
        });

        Route::model('advance', \App\Models\Advance::class);

        // Define how to retrieve the model by slug
        Route::bind('advance', function ($value) {
            return \App\Models\Advance::where('slug', $value)->firstOrFail();
        });


        Route::model('payslip', \App\Models\Payslip::class);

        // Define how to retrieve the model by slug
        Route::bind('payslip', function ($value) {
            return \App\Models\Payslip::where('slug', $value)->firstOrFail();
        });


        Route::model('setting', \App\Models\Setting::class);

        // Define how to retrieve the model by slug
        Route::bind('setting', function ($value) {
            return \App\Models\Setting::where('slug', $value)->firstOrFail();
        });


        Route::model('quotation', \App\Models\Quotation::class);

        // Define how to retrieve the model by slug
        Route::bind('quotation', function ($value) {
            return \App\Models\Quotation::where('slug', $value)->firstOrFail();
        });

        Route::model('detail', \App\Models\Detail::class);

        // Define how to retrieve the model by slug
        Route::bind('detail', function ($value) {
            return \App\Models\Detail::where('slug', $value)->firstOrFail();
        });

        Route::model('client', \App\Models\Client::class);

        // Define how to retrieve the model by slug
        Route::bind('client', function ($value) {
            return \App\Models\Client::where('slug', $value)->firstOrFail();
        });

        Route::model('profit', \App\Models\Profit::class);

        // Define how to retrieve the model by slug
        Route::bind('profit', function ($value) {
            return \App\Models\Profit::where('slug', $value)->firstOrFail();
        });

        Route::model('program', \App\Models\Program::class);

        // Define how to retrieve the model by slug
        Route::bind('program', function ($value) {
            return \App\Models\Program::where('slug', $value)->firstOrFail();
        });

               Route::model('branch', \App\Models\Branch::class);

        // Define how to retrieve the model by slug
        Route::bind('branch', function ($value) {
            return \App\Models\Branch::where('slug', $value)->firstOrFail();
        });

                      Route::model('category', \App\Models\Category::class);

        // Define how to retrieve the model by slug
        Route::bind('category', function ($value) {
            return \App\Models\Category::where('slug', $value)->firstOrFail();
        });

        Route::model('task', \App\Models\Task::class);

        // Define how to retrieve the model by slug
        Route::bind('task', function ($value) {
            return \App\Models\Task::where('slug', $value)->firstOrFail();
        });


               Route::model('asset', \App\Models\Asset::class);

        // Define how to retrieve the model by slug
        Route::bind('asset', function ($value) {
            return \App\Models\Asset::where('slug', $value)->firstOrFail();
        });

                       Route::model('expense', \App\Models\Expense::class);

        // Define how to retrieve the model by slug
        Route::bind('expense', function ($value) {
            return \App\Models\Expense::where('slug', $value)->firstOrFail();
        });









        // Route::model('event', \App\Models\Event::class);

        // // Define how to retrieve the model by slug
        // Route::bind('event', function ($value) {
        // return \App\Models\Event::where('slug', $value)->firstOrFail(); });


        // Route::model('purchase', \App\Models\Purchase::class);

        // // Define how to retrieve the model by slug
        // Route::bind('purchase', function ($value) {
        // return \App\Models\Purchase::where('slug', $value)->firstOrFail(); });




    }
}
