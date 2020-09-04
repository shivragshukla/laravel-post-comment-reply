<?php

namespace Avihs\PostReply\Traits;

use Avihs\PostReply\Models\Comment;

trait HasComment {
    
    use HasMessage, HasReply;

     /**
     * Assign the given comment to the post.
     *
     * @param string|object|integer $comment
     *
     * @return $comment
     */
    public function addComment( String $content, Object $user, $status = 1 ): Object
    {
        return $this->addOrEditMessage(Comment::create(['post_id' => $this->id]), $content, $user->id, $status);
    }

    /**
     * Assign the given comment to the post.
     *
     * @param object|string| $comment
     *
     * @return $this->comments
     */
    public function addAllComments( String $content, Object $user, $status = 1 ) : Object
    {
        return $this->addComment($content, $user, $status)->post->comments;
    }

    /**
     * Update the given comment to the post.
     *
     * @param string|integer $content|1
     *
     * @return $this
     */
    public function editComment( String $content, $status = 1 ): Object
    {
        return $this->addOrEditMessage($this, $content, $this->message->user->id, $status);
    }

}
