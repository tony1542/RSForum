<div class="card-columns">
    <?php foreach ($data['members'] as $member) : ?>
        <div class="card">
            <div class="card-body">
                <span class="card-text"><?= $member['username'] ?></span>
            </div>
            <div class="card-footer text-muted">
                Last active: <?= $member['last_active'] ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
