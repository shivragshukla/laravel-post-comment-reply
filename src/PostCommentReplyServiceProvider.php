<?php

namespace Avihs\PostReply;

use Illuminate\Support\ServiceProvider;
use Avihs\PostReply\Models\Reply;
use Avihs\PostReply\Models\Comment;
use Illuminate\Database\Eloquent\Relations\Relation;

class PostCommentReplyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([ 'Comments' => Comment::class,  'Replies' => Reply::class ]);
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadFactoriesFrom(__DIR__.'/database/factories');
    }
}
