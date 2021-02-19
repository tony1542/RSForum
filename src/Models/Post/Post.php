<?php

namespace App\Models\Post;

use PDO;

class Post
{
    protected int $post_id;
    protected int $user_id;
    protected string $title;
    protected string $body;
    
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
    }
    
    protected function loadComments()
    {
        $database = getDatabase();
        
        $statement = $database->prepare("SELECT post_comment_id, post_id, user_id, comment FROM post_comment WHERE post_id = ?");
        $statement->execute([$this->getPostID()]);
        
        return $statement->fetchAll(PDO::FETCH_ASSOC);
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
}
