<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Book;
use App\Policies\BookPolicy;
use App\Models\Comment;
use App\Policies\CommentPolicy;
use App\Models\Publisher;
use App\Policies\PublisherPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Book::class => BookPolicy::class,
        Publisher::class => PublisherPolicy::class,

        Comment::class => CommentPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
