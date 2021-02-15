<div class="card-columns">
    <?php foreach ($data['members'] as $member) : ?>
        <div class="card">
            <div class="card-body d-flex justify-content-between">
                <span><?= $member['username'] ?></span>
                <span>
                    <a target="_blank" href="/User/Details/<?= $member['user_id'] ?>">
                        <i class="fas fa-eye"></i>
                    </a>
                </span>
            </div>
            <div class="card-footer text-muted">
                Last active: <?= $member['last_active'] ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
