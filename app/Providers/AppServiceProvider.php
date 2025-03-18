<?php

namespace App\Providers;

use App\Modules\Authors\Domain\Repositories\AuthorRepositoryInterface;
use App\Modules\Authors\Infrastructure\Repositories\AuthorRepository;
use App\Modules\Books\Domain\Repositories\BookRepositoryInterface;
use App\Modules\Books\Infrastructure\Repositories\BookRepository;
use App\Modules\Reports\Domain\Repositories\ReportRepositoryInterface;
use App\Modules\Reports\Infrastructure\Repositories\ReportRepository;
use App\Modules\Subjects\Domain\Repositories\SubjectRepositoryInterface;
use App\Modules\Subjects\Infrastructure\Repositories\SubjectRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(BookRepositoryInterface::class, BookRepository::class);
        $this->app->singleton(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->app->singleton(SubjectRepositoryInterface::class, SubjectRepository::class);
        $this->app->singleton(ReportRepositoryInterface::class, ReportRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
