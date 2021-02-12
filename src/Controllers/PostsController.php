<?php

namespace App\Controllers;

use App\Models\Post\Post;
use App\Models\User\User;
use App\Utils\Http\Request;
use App\Utils\Http\Session;

class PostsController extends AbstractBaseController
{
    public function canAccess(string $action, array $parameters = []): bool
    {
        return match ($action) {
            'delete' => false,
            default  => getSignedInUser()->getID() > 0,
        };
    }
    
    protected function getIncludePrefix(): string
    {
        return 'post/';
    }
    
    protected function toView(string $view, array $parameters = []): void
    {
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
        $post = new Post(Request::getID());
        $user = new User($post->getUserId());
        
        $this->toView('details', [
            'post' => $post,
            'user' => $user
        ]);
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
}
