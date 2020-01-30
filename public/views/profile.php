<?php /** @var \App\Models\User\User $user */ ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <b>Username:</b>
                        <label for="username"><?= $user->getUsername() ?></label><br>
                    </div>
                    <div class="form-group">
                        <b>Email Address: </b>
                        <label for="email"><?= $user->getEmail() ?></label><br>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                Total Level: <?= $user->getTotalLevel() ?: 'N/A' ?>
            </div>
        </div>
    </div>
</div>