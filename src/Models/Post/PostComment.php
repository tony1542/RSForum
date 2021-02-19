<?php

namespace App\Models\Post;

class PostComment
{
    protected int $post_comment_id;
    protected int $post_id;
    protected int $user_id;
    protected string $comment;
    
    public function __construct($post_comment_id)
    {
    
    }
}
