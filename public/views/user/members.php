<div class="card-columns">
    <?php /** @var \App\Models\User\User $member */ ?>
    <?php foreach ($data['members'] as $member) : ?>
        <div class="card">
            <div class="card-header flex">
                <?= $member->getUsername() ?>
                <span class="float-right">
                    <a target="_blank" href="/User/Details/<?= $member->getID() ?>">
                        <i class="fas fa-eye"></i>
                    </a>
                </span>
            </div>
            <div class="card-footer">
                Total level: <?= $member->getTotalLevel() ?: 'N/A' ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
