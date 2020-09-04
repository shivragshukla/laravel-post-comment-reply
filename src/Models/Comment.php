<?php

namespace Avihs\PostReply\Models;

use Avihs\PostReply\Models\Post;
use Avihs\PostReply\Models\Reply;
use Avihs\PostReply\Models\Message;
use Avihs\PostReply\Traits\HasComment;
use Avihs\PostReply\Objects\Message as MessageObject;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Comment extends MessageObject
{
    use HasComment;
    
    protected $guarded = [];
    public $timestamps = false;

    protected $with = ['replies'];
    
    /**
     * Get all of the message for the comment.
     */
    public function message(): MorphOne
    {
        return $this->morphOne(Message::class, 'messageable');
    }

    /**
	 * Get the post of the comment.
	 */
	public function post(): BelongsTo
	{
	    return $this->belongsTo(Post::class);
	}

	/**
	 * Get all of the replies for the comment.
	 */
	public function replies(): HasMany
	{
	    return $this->hasMany(Reply::class);
	}

}
