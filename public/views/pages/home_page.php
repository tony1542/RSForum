<?php
    use App\Utils\Http\Session;
    
    /** @var $posts \App\Models\Post\HomePagePost[] */
?>

<?php if (Session::has('name')) : ?>
    <div class="alert alert-success" role="alert">
        Welcome <?= Session::flash('name') ?>
    </div>
<?php endif; ?>

<?php if (getSignedInUser()->isAdmin()) : ?>
    <div class="mb-2 text-right">
        <a class="btn btn-primary" href="/HomePagePost/Create">Create a post</a>
    </div>
<?php endif; ?>

<div class="flex flex-wrap">
    <?php foreach ($posts as $post) : ?>
        <div class="card col-sm-12 mb-2">
            <div class="card-body">
                <div class="card-title flex justify-between">
                    <h3><?= $post->getTitle() ?></h3>
                    <span class="text-muted"><?= $post->getDateAdded() ?></span>
                </div>
                <p class="card-text">
                    <?= $post->getBody() ?>
                </p>
    
                <!-- TODO implement link embedding -->
                <div class="row">
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>