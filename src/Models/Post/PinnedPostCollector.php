<?php

namespace App\Models\Post;
use PDO;

class PinnedPostCollector
{
    protected array $pinned_posts = [];

    public function __construct($user_id)
    {
        if (!$user_id){
            return;
        }

        $pinned_posts = [];
        $db = getDatabase();
        $stm = $db->prepare('SELECT * FROM post WHERE pin_post = 1 ORDER BY date DESC');
        $stm->execute();
        $pinned_query = $stm->fetchAll(PDO::FETCH_ASSOC);

        if (!$pinned_query){
            return;
        }

        foreach ($pinned_query as $pinned) {
            $post_id = $pinned['post_id'];
            $username = $pinned['username'];
            $user_id = $pinned['user_id'];
            $date = $pinned['date'];
            $title = $pinned['title'];
            $description = $pinned['description'];
            $pin_post = $pinned['pin_post'];
            $pinned_posts[] = new Post($post_id, $username, $user_id, $date, $title, $description, $pin_post);
        }
        $this->pinned_posts = $pinned_posts;
    }

    public function getPinnedPosts()
    {
        return $this->pinned_posts;
    }

}