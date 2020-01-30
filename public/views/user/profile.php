<?php /** @var \App\Models\User\User $user */ ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Account</div>
            <div class="card-body">
                <form method="post" action="/User/Update/<?= $user->getID() ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user->getUsername() ?>" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" disabled value="<?= $user->getEmail() ?>" />
                    </div>
                    
                    <button class="btn btn-primary">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Stats</div>
            <div class="card-body">
                <?php foreach ($user->getSkills() as $skill): ?>
                    <!-- TODO i think the getSkills() function returns differently if it is pulled from the DB versus our API calls -->
                    <!-- TODO normalize them so they are the same -->
                    <img src="<?= \App\Utils\Runescape\Skills::getSkillIconFromIndex($skill['skill_index']); ?>" alt="<?= $skill['skill_name'] ?>">
                <?php endforeach; ?>
            </div>
            <div class="card-footer">
                Total Level: <?= $user->getTotalLevel() ?>
            </div>
        </div>
        
    </div>
</div>

<script src="/public/js/user/profile.js"></script>