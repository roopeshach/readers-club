<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Policies\BookPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\AuthorPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Book::class => BookPolicy::class,
        Category::class => CategoryPolicy::class,
        Author::class => AuthorPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
