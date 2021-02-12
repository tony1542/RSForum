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
            <div class="card-footer text-muted">
                Posted by <?= $post['username'] ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>