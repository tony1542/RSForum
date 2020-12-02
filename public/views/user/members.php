<div class="card-columns">
    <?php /** @var \App\Models\User\User $member */ ?>
    <?php foreach ($data['members'] as $member) : ?>
        <div class="card">
            <div class="card-header"><?= $member->getUsername() ?></div>
            <div class="card-footer">
                Total level: <?= $member->getTotalLevel() ?: 'N/A' ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
