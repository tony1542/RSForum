<?php


namespace App\Models\Post;
use PDO;


class PostCollector
{
    protected array $posts = [];

    public function __construct($user_id)
    {
        if (!$user_id){
            return;
        }

        $posts = [];
        $db = getDatabase();
        $query = $db->prepare("SELECT * FROM post WHERE pin_post = 0 ORDER BY post_id DESC");
        $query->execute();
        $value = $query->fetchAll(PDO::FETCH_ASSOC);


        if (!$value) {
            return;
        }

        foreach ($value as $row) {
            $post_id = $row['post_id'];
            $username = $row['username'];
            $user_id = $row['user_id'];
            $date = $row['date'];
            $title = $row['title'];
            $description = $row['description'];
            $pin_post = $row['pin_post'];
            $posts[] = new Post($post_id, $username, $user_id, $date, $title, $description, $pin_post);
        }
        $this->posts = $posts;
    }

    public function getPosts()
    {
        return $this->posts;
    }


}