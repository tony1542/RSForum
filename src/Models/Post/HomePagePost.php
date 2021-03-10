<?php

namespace App\Models\Post;

use Carbon\Carbon;
use PDO;

class HomePagePost
{
    protected int $user_id;
    protected string $title;
    protected string $body;
    protected string $date_added;
    protected int $home_page_post_id;
    
    public function __construct(int $user_id, string $title, string $body, string $date_added)
    {
        $this->user_id = $user_id;
        $this->title = $title;
        $this->body = $body;
        $this->date_added = $date_added;
    }
    
    public static function getAll(): array
    {
        $database = getDatabase();
        $statement = $database->prepare('SELECT * FROM home_page_posts
                                         ORDER BY date_added DESC');
        $statement->execute();
        
        $return = [];
        $home_page_posts = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($home_page_posts as $home_page_post) {
            $return[] = new self(
                $home_page_post['user_id'],
                $home_page_post['title'],
                $home_page_post['body'],
                $home_page_post['date_added']
            );
        }
        
        return $return;
    }
    
    public static function create(string $title, string $body): void
    {
        $database = getDatabase();
        $statement = $database->prepare('INSERT INTO home_page_posts SET user_id = ?, title = ?, body = ?');
        $statement->execute([
            getSignedInUser()->getID(),
            $title,
            $body
        ]);
    }
    
    public function getHomePagePostId(): int
    {
        return $this->home_page_post_id;
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
    
    public function getDateAdded(): string
    {
        $datetime = Carbon::create($this->date_added);
    
        return $datetime->ago();
    }
}
