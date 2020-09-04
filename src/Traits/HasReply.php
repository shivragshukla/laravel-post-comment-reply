<?php

namespace Avihs\PostReply\Traits;

use Avihs\PostReply\Models\Reply;

trait HasReply {
    
    use HasMessage;
  
     /**
     * Assign the given comment to the post.
     *
     * @param string|object|integer $comment
     *
     * @return $comment
     */
    public function addReply( String $content, Object $user, $status = 1 ): Object
    {
        return $this->addOrEditMessage(Reply::create(['comment_id' => $this->id]), $content, $user->id, $status);
    }

    /**
     * Assign the given comment to the post.
     *
     * @param object|string| $comment
     *
     * @return $this->comments
     */
    public function addAllReplies( String $content, Object $user, $status = 1 ) : Object
    {
        return $this->addReply($content, $user, $status)->comment->replies;
    }

    /**
     * Update the given comment to the post.
     *
     * @param string|integer $content|1
     *
     * @return $this
     */
    public function editReply( String $content, $status = 1 ): Object
    {
        return $this->addOrEditMessage($this, $content, $this->message->user->id, $status);
    }

}
