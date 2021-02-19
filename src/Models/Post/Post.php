<?php

namespace App\Models\Post;

use PDO;

class Post
{
    protected int $post_id;
    protected int $user_id;
    protected string $title;
    protected string $body;
    
    /** @var PostComment[] $comments
     */
    protected array $comments;
    
    public function __construct($post_id = 0)
    {
        if ($post_id) {
            $this->load($post_id);
        }
    }
    
    public function load(int $post_id = 0): void
    {
        if (!$post_id) {
            $post_id = $this->getPostID();
        }
    
        $instance = getDatabase();
        $statement = $instance->prepare('SELECT post_id, user_id, title, body
                                            FROM post
                                         WHERE post_id = ?');
        $statement->execute([$post_id]);
        $values = $statement->fetch(PDO::FETCH_ASSOC);
    
        if (!$values || !is_array($values)) {
            return;
        }
        
        $this->post_id = $values['post_id'];
        $this->user_id = $values['user_id'];
        $this->title = $values['title'];
        $this->body = $values['body'];

        $this->loadComments();
    }
    
    protected function loadComments(): void
    {
        $database = getDatabase();
        
        $statement = $database->prepare("SELECT pc.post_comment_id, pc.post_id, pc.user_id, pc.comment, u.username
                                            FROM post_comment pc
                                            INNER JOIN user u ON u.user_id = pc.user_id
                                         WHERE post_id = ?");
        $statement->execute([$this->getPostID()]);
        
        $all = $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
        
        $comments = [];
        foreach ($all as $comment) {
            $comments[] = new PostComment(
                $comment['post_comment_id'],
                $comment['post_id'],
                $comment['user_id'],
                $comment['comment'],
                $comment['username']
            );
        }
        
        $this->comments = $comments;
    }
    
    /**
     * @return int[]
     */
    public static function getAllPosts(): array
    {
        $instance = getDatabase();
        $statement = $instance->query('SELECT p.post_id, p.user_id, p.title, u.username
                                       FROM post p
                                       INNER JOIN user u ON u.user_id = p.user_id');
    
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create(string $title, string $body): int
    {
        $instance = getDatabase();
        $statement = $instance->prepare('INSERT INTO post SET user_id = ?, title = ?, body = ?');
        $statement->execute([
            getSignedInUser()->getID(),
            $title,
            $body
        ]);
        
        return $instance->lastInsertId();
    }
    
    public function delete(int $post_id): void
    {
        $instance = getDatabase();
        $statement = $instance->prepare('DELETE FROM post WHERE post_id = ? LIMIT 1');
        $statement->execute([$post_id]);
    }
    
    public function getPostID(): int
    {
        return $this->post_id;
    }
    
    public function getUserId(): int
    {
        return $this->user_id;
    }
    
    public function getTitle(): string
    {
        return $this->title;
    }
    
    public function getBody(): string
    {
        return $this->body;
    }
    
    /**
     * @return PostComment[]
     */
    public function getComments(): array
    {
        return $this->comments;
    }
    
    public function hasComments(): bool
    {
        return count($this->comments) > 0;
    }
}
