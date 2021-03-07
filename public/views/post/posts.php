<?php /** @var \App\Models\User\User $user */ ?>

<div class="text-right mb-2">
    <a href="/Post/Create" class="btn btn-primary">
        Create a post
    </a>
</div>

<div class="card-columns">
    <?php foreach ($posts as $post): ?>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <a href="/Post/Details/<?= $post['post_id'] ?>">
                        <?= $post['title'] ?>
                    </a>
                </div>
            </div>
            <div class="card-footer text-muted flex justify-between">
                <div>
                    Posted by <?= $post['username'] ?>
                </div>
                <div>
                    <?php if(getSignedInUser()->getUsername() === $post['username'] || getsignedinUser()->isAdmin()) : ?>
                        <a href="/Post/Delete/<?=$post['post_id']?>" class='btn btn-secondary btn-sm deletePost'>Delete Post</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>