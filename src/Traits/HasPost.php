<?php

namespace Avihs\PostReply\Traits;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Avihs\PostReply\Models\Post;
use Avihs\PostReply\Models\Comment;

trait HasPost {


    /**
     * Get the Posts for the user.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the Latest Posts for the user.
     */
    public function latest_posts(): Object
    {
        return $this->posts()->latest('updated_at');
    }
    public function getLatestPostsAttribute(): Object
    {
        return $this->latest_posts()->get();
    }

    /**
     * Get the status Posts for the user.
     */
    private function postStatus(Int $status): Object
    {
        return $this->posts()->where('status', $status);
    }
    
    /**
     * Get the Active Posts for the user.
     */
    public function active_posts(): Object
    {
        return $this->postStatus(1);
    }
    public function getActivePostsAttribute(): Object
    {
        return $this->active_posts()->get();
    }

    /**
     * Get the Inactive Posts for the user.
     */

    public function inactive_posts(): Object
    {
        return $this->postStatus(0);
    }
    public function getInactivePostsAttribute(): Object
    {
        return $this->inactive_posts()->get();
    }

    /**
     * Get the count of post for the user.
     */
    public function getPostsCountAttribute(): Int
    {
        return $this->posts()->count();
    }
    /**
     * Get the active count of post for the user.
     */
    public function getActivePostsCountAttribute(): Int
    {
        return $this->active_posts()->count();
    }
    /**
     * Get the inactive count of post for the user.
     */
    public function getInactivePostsCountAttribute(): Int
    {
        return $this->inactive_posts()->count();
    }

    /**
     * Get all of the comments for the user.
     */
    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class);
    }

    /**
     * Assign the given post to the user.
     *
     * @param array|string| ...$posts
     *
     * @return $this
     */
    public function assignPost(...$posts)
    {
        $posts = collect($posts)->flatten()->all();
        foreach ($posts as $post) {
            Post::find($post->id)->user()->associate($this)->save();
        }
        $this->load('posts');
        return $this->posts;
    }

    /**
     * Remove the given post to the user.
     *
     * @param array|string| ...$posts
     *
     * @return $this
     */
    public function removePost(...$posts)
    {
        $posts = collect($posts)->flatten()->all();

        foreach ($posts as $post) {
            $isPost = $post->user->id ?? null;
            if( isset($isPost) && $post->user->id == $this->id ){
                $post->user()->dissociate()->save();
            }
        }
        return $this->posts;
    }

     /**
     * Remove all current posts and set the given ones.
     *
     * @param  array|string  ...$posts
     *
     * @return $this
     */
    public function syncPosts(...$posts)
    {
        foreach ($this->posts as $post) {
            $post->user()->dissociate()->save();
        }
        return $this->assignPost($posts);
    }


}
