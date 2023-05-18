<?php

namespace App\Providers;

use App\Models as Models;
use App\Repositories as Repositories;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array|string[]
     */
    protected array $repositories = [
        Models\User::class    => Repositories\UserRepository::class,
        Models\Task::class    => Repositories\TaskRepository::class,
        Models\Project::class => Repositories\ProjectRepository::class,
    ];

    /**
     * Register any repositories for your application.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $model => $repository) {
            $this->bindRepository($model, $repository);
        }
    }

    protected function bindRepository(string $modelClass, string $repositoryClass)
    {
        $this->app->bind($repositoryClass, function () use ($modelClass, $repositoryClass) {
            return new $repositoryClass($modelClass);
        });
    }
}
