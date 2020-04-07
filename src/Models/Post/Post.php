<?php


namespace App\Models\Post;


class Post
{
    protected string $post_id ='';
    protected string $username = '';
    protected string $user_id = '';
    protected string $date = '';
    protected string $title = '';
    protected string $description ='';
    protected string $pin_post = '';

    public function __construct($post_id, $username, $user_id, $date, $title, $description, $pin_post)
    {
        if (!$user_id) {
            return;
        }

        $this->post_id = $post_id;
        $this->username = $username;
        $this->user_id = $user_id;
        $this->date = $date;
        $this->title = $title;
        $this->description = $description;
        $this->pin_post = $pin_post;
    }


    public function getPostId(): string
    {
        return $this->post_id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPinPost(): string
    {
        return $this->pin_post;
    }

    public function edit()
    {

    }

    public function add($username, $user_id, $date, $title, $description)
    {
        if (!count($_POST)) {
            redirect("Post/Show/" . getSignedInUser()->getID());
        }

        $db = getDatabase();
        $query = $db->prepare("INSERT INTO post (username, user_id, date, title, description) VALUES (?, ?, ?, ?, ?)");
        $query->execute([
           $username,
           $user_id,
           $date,
           $title,
           $description
        ]);
        redirect("Post/Show/" . getSignedInUser()->getID());
    }

    public function delete()
    {

    }

}