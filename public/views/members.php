<div class="card-deck">
    <?php /** @var \App\Models\User\User $member */ ?>
    <?php foreach ($data['members'] as $member) : ?>
        <div class="card">
            <div class="card-header"><?= $member->getUsername() ?></div>
            <div class="card-body text-center">
                <img class="img-fluid" src="/public/images/comic2.png" />
            </div>
            <div class="card-footer">
                Total level: <?= $member->getTotalLevel() ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
