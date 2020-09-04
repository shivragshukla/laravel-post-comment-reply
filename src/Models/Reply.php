<?php

namespace Avihs\PostReply\Models;

use Avihs\PostReply\Models\Comment;
use Avihs\PostReply\Models\Message;
use Avihs\PostReply\Traits\HasReply;
use Avihs\PostReply\Objects\Message as MessageObject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Reply extends MessageObject
{
    use HasReply;
    
    protected $guarded = [];
    public $timestamps = false;

    protected $with = ['message'];

    /**
     * Get all of the message for the reply.
     */
    public function message(): MorphOne
    {
        return $this->morphOne(Message::class, 'messageable');
    }

    /**
	 * Get the comment of the reply.
	 */
	public function comment(): BelongsTo
	{
	    return $this->belongsTo(Comment::class);
	}
}
