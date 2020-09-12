<?php /** @var \App\Models\User\User $user */ ?>

<div class="row justify-content-center">
    <div class="<?php echo $show_skills ? 'col-lg-4' : 'col-md-8'; ?> mb-4">
        <div class="card">
            <div class="card-header">Account</div>
            <div class="card-body">
                <form id="UserEdit" method="post" action="/User/Update/<?= $user->getID() ?>">
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

    <?php if ($show_skills): ?>
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">Stats</div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($skills as $skill): ?>
                            <div class="col-md-4 mb-2">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img src="<?= $skill['src'] ?>" alt="<?= $skill['skill_name'] ?>">
                                        &nbsp;<?= $skill['skill_name'] ?>
                                        &nbsp;<?= $skill['level'] ?>
                                        <hr>
                                        <?= $skill['exp'] ?>
                                    </div>
                                    <div class="card-footer">
                                        # <?= $skill['rank'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card-footer">
                    Total Level: <?= $user->getTotalLevel() ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <?php if ($show_accolades): ?>
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">Accolades</div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($accolades as $accolade): ?>
                            <div class="col-md-4 mb-2">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img width="25" height="25" class="img-responsive" src="<?= $accolade['src'] ?>" alt="<?= $accolade['accolade_name'] ?>">
                                        &nbsp;<?= $accolade['accolade_name'] ?>
                                    </div>
                                    <div class="card-footer">
                                        # <?= $accolade['rank'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card-footer">
                    Total Level: <?= $user->getTotalLevel() ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
</div>


<script src="/public/js/user/profile.js"></script>