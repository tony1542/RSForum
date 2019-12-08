<div class="card-deck">
    <?php /** @var \App\Models\User $member */ ?>
    <?php foreach ($data['members'] as $member) : ?>
        <div class="card">
            <div class="card-header"><?= $member->getUsername() ?></div>
            <div class="card-body text-center">
                <img class="img-fluid" src="/public/images/comic2.png" />
            </div>
        </div>
    <?php endforeach; ?>
</div>
