<?php

namespace App\Controllers;

use App\Models\Post\Post;
use App\Models\Post\PostCollector;
use App\Models\Post\PinnedPostCollector;
use App\Utils\Http\Request;
use App\Models\User\User;
use App\Utils\Input\Sanitizer;
use App\Utils\Http\Session;
use PDO;

class PostsController extends AbstractBaseController
{
    protected function getIncludePrefix(): string
    {
        return 'user/';
    }

    public function canAccess(string $action, array $parameters = []): bool
    {
        $signed_in_user = getSignedInUser();
        $same_user_as_requesting = $signed_in_user->getID() === Request::getID();

        switch ($action) {
            case 'add':
            case 'delete':
            case 'edit':
            case 'complete':
                return $same_user_as_requesting;
            default:
                return true;
        }
    }

    public function show()
    {
       $user_id= Request::getID();
       $user = new User($user_id);
       $post = new PostCollector($user_id);
       $pinned_posts = new PinnedPostCollector($user_id);
       view($this->getIncludePrefix() . 'post', [
           'user' => $user,
           'pinned_post' => $pinned_posts->getPinnedPosts(),
           'post' => $post->getPosts()
       ]);
    }

    public function add()
    {
        $error = [];
        if(!$_POST['title']){
            $error[] = 'Please enter a title';
        }
        if(!$_POST['description']){
            $error[] = 'Please enter a description';
        }

        $user_id = Request::getID();
        $user = new User($user_id);
        $pinned_post = new PinnedPostCollector($user_id);
        $post = new PostCollector($user_id);

        if(count($error)) {
            view($this->getIncludePrefix() . 'post', [
                'errors' => $error,
                'user' => $user,
                'pinned_post' => $pinned_post->getPinnedPosts(),
                'post' => $post->getPosts()
            ]);
        }

        $title = Sanitizer::sanitize($_POST['title']);
        $description = Sanitizer::sanitize($_POST['description']);
        $date = date('Y-m-d');
        $username = $user->getUsername();

        Post::add($username, $user_id, $date, $title, $description);
    }

    public function delete()
    {

    }

    public function edit()
    {

    }

}