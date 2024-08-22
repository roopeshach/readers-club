<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Publisher;
use App\Models\Comment;
use App\Models\User;
use App\Policies\BookPolicy;
use App\Policies\BookCategoryPolicy;
use App\Policies\PublisherPolicy;
use App\Policies\CommentPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Book::class => BookPolicy::class,
        BookCategory::class => BookCategoryPolicy::class,
        Publisher::class => PublisherPolicy::class,
        Comment::class => CommentPolicy::class,
        User::class => UserPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
