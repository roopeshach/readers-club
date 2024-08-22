<?php

namespace App\Providers;

use App\Models\{Book, BookCategory, Author, Comment, React};
use App\Policies\{BookPolicy, BookCategoryPolicy, AuthorPolicy, CommentPolicy, ReactPolicy};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Book::class => BookPolicy::class,
        BookCategory::class => BookCategoryPolicy::class,
        Author::class => AuthorPolicy::class,
        Comment::class => CommentPolicy::class,
        React::class => ReactPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
