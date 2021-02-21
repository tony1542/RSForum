<?php /** @var \App\Models\Post\Post $post */ ?>
<?php /** @var \App\Models\User\User $user */ ?>

<?php if (\App\Utils\Http\Session::has('post_create_success')) : ?>
    <div class="alert alert-success" role="alert">
        <?= \App\Utils\Http\Session::flash('post_create_success') ?>
    </div>
<?php endif; ?>

<?php if (\App\Utils\Http\Session::has('comment_create_success')) : ?>
    <div class="alert alert-success" role="alert">
        <?= \App\Utils\Http\Session::flash('comment_create_success') ?>
    </div>
<?php endif; ?>

<div class="card mb-2">
    <div class="card-header"><?= $post->getTitle() ?></div>
    <div class="card-body">
        <div class="card-text"><?= $post->getBody() ?></div>
    </div>
    <div class="card-footer flex justify-between">
        <div class="text-muted">
            Posted by: <?= $user->getUsername() ?>
        </div>
        <div>
            <a href="/Post/All">Back</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Comments</div>
    <div class="card-body">
        <div class="mb-4">
            <form method="post" action="/Post/AddComment/<?= $post->getPostID() ?>">
                <div class="form-group">
                    <input type="text" name="new_comment" class="form-control" />
                </div>
                <button class="btn btn-primary">
                    Add comment
                </button>
            </form>
        </div>
        
        <div>
            <?php if ($post->hasComments()): ?>
                <ul>
                    <?php foreach ($post->getComments() as $comment): ?>
                        <li class="mb-4">
                            <?= $comment->getUsername() . ': ' . $comment->getComment() ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
