<?php /** @var \App\Models\Post\Post $post */ ?>
<?php /** @var \App\Models\User\User $user */ ?>

<?php if (\App\Utils\Http\Session::has('post_create_success')) : ?>
    <div class="alert alert-success" role="alert">
        <?= \App\Utils\Http\Session::flash('post_create_success') ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header"><?= $post->getTitle() ?></div>
    <div class="card-body">
        <div class="card-text"><?= $post->getBody() ?></div>
    </div>
    <div class="card-footer">
        <?= $user->getUsername() ?>
    </div>
</div>