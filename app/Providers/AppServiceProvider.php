<?php

namespace App\Providers;

use App\Data\Models\Question;
use App\Data\Repositories\Contracts\QuestionRepositoryContract;
use App\Data\Repositories\QuestionRepository;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app
            ->singleton(QuestionRepositoryContract::class, static function () {
                return new QuestionRepository(Question::query());
            });
    }
}
