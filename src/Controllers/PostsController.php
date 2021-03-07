<?php

namespace App\Controllers;

use App\Models\Post\Post;
use App\Models\Post\PostComment;
use App\Models\User\User;
use App\Utils\Http\Request;
use App\Utils\Http\Session;

class PostsController extends AbstractBaseController
{
    public function canAccess(string $action, array $parameters = []): bool
    {
        return match ($action) {
            'delete' => $this->verifyDelete(),
            default  => getSignedInUser()->getID() > 0,
        };
    }
    
    protected function getIncludePrefix(): string
    {
        return 'post/';
    }
    
    protected function toView(string $view, array $parameters = []): void
    {
        $id = Request::getID();
        $array_to_merge = [];
        
        if ($id) {
            $post = new Post(Request::getID());
            $user = new User($post->getUserId());
    
            $array_to_merge = [
                'post' => $post,
                'user' => $user
            ];
        }
        
        $parameters = array_merge($parameters, $array_to_merge);
        view($this->getIncludePrefix() . $view, $parameters);
    }

    public function index(): void {}
    
    public function all(): void
    {
        $this->toView('posts', [
            'posts' => Post::getAllPosts()
        ]);
    }
    
    public function details(): void
    {
        $this->toView('details');
    }
    
    public function create(): void
    {
        $parameters = Request::getPostValues();
        if (!count($parameters)) {
            $this->toView('create');
        }
    
        $errors = [];
    
        if (!$parameters['title']) {
            $errors[] = 'Must provide a title';
        }

        if (!$parameters['body']) {
            $errors[] = 'Must provide a body';
        }
        
        if (count($errors)) {
            $this->toView('create', [
                'errors' => $errors,
                'title'  => $parameters['title'],
                'body'   => $parameters['body']
            ]);
        }
        
        $post = new Post();
        $post_id = $post->create(
            $parameters['title'],
            $parameters['body']
        );
        
        Session::set('post_create_success', 'Post created successfully');
        redirect('Post/Details/' . $post_id);
    }
    
    public function addComment(): void
    {
        $post = new Post(Request::getID());
        
        $post_values = Request::getPostValues();
        $comment = $post_values['new_comment'];
        
        if (!$comment) {
            $this->toView('details', [
                'errors' => ['Must enter a comment']
            ]);
        }
        
        PostComment::add(
            $post->getUserId(),
            $comment,
            Request::getID()
        );
    
        Session::set('comment_create_success', 'Comment created successfully');
        redirect('Post/Details/' . $post->getPostID());
    }
    
    public function delete(): void
    {
            $post = Request::getID();
            $db = getDatabase();
            $sql = $db->prepare('DELETE FROM post WHERE post_id = ?');
            $sql->execute([$post]);
           redirect('Post/All');

    }

    public function verifyDelete(): bool
    {
        $post = new Post(Request::getID());
        $user = getSignedInUser()->getID();

        return (int) $user ===  $post->getUserId() || getSignedInUser()->isAdmin();
    }
}
