<?php

namespace Avihs\PostReply\Objects;

use Illuminate\Database\Eloquent\Model;

Class Message extends Model {


    /**
     * Get the attribute display to comment or reply for the post.
     *
     * @return string
     */

    protected $hidden = ['message','post_id', 'comment_id'];
    protected $appends = ['content', 'status', 'created_at', 'updated_at', 'user'];

    public function getContentAttribute()
    {
        return $this->message['content'];
    }

    public function getStatusAttribute()
    {
        return $this->message['status'];
    }

    public function getUserAttribute()
    {
        return $this->message['user'];
    }

    public function getCreatedAtAttribute()
    {
        return $this->message['created_at'];
    }

    public function getUpdatedAtAttribute()
    {
        return $this->message['updated_at'];
    }

    /**
     * Remove the specified resource from storage.
     * @return Boolean 
     */

    function delete(): bool
    {
        $this->message()->delete(); 
        return parent::delete();;
    }

}
