<?php

namespace App\Models\Post;

class PostComment
{
    public function __construct(
        protected int $post_comment_id,
        protected int $post_id,
        protected int $user_id,
        protected string $comment,
        protected string $username
    ) {}
    
    public function getPostCommentId(): int
    {
        return $this->post_comment_id;
    }
    
    public function getPostId(): int
    {
        return $this->post_id;
    }
    
    public function getUserId(): int
    {
        return $this->user_id;
    }
    
    public function getComment(): string
    {
        return $this->comment;
    }
    
    public function getUsername(): string
    {
        return $this->username;
    }
    
    public static function add(int $user_id, string $comment, int $post_id): int
    {
        $database = getDatabase();
        $statement = $database->prepare('INSERT INTO post_comment
                                            SET user_id = ?, comment = ?, post_id = ?');
        $statement->execute([
            $user_id,
            $comment,
            $post_id
        ]);
        
        return $database->lastInsertId();
    }
}
