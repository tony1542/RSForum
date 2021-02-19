<?php /** @var \App\Models\User\User $user */ ?>

<div class="row justify-content-center">
    <div class="<?php echo $show_skills ? 'col-lg-4' : 'col-md-8'; ?> mb-4">
        <div class="card">
            <div class="card-header">Account</div>
            <div class="card-body">
                <?php if (getSignedInUser()->isAdmin() || getSignedInUser()->getID() === $user->getID()) : ?>
                    <form id="UserEdit" method="post" action="/User/Update/<?= $user->getID() ?>">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user->getUsername() ?>" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" disabled value="<?= $user->getEmail() ?>" />
                        </div>
                        <div class="form-group">
                            <label for="account_type">Account type</label>
                            <div id="account_type">
                                <?php foreach (\App\Utils\Runescape\AccountType::getAll() as $player_type_id => $text): ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php if ($user->getAccountTypeID() === $player_type_id): ?>
                                                <input type="radio" class="form-check-input" name="account_type" checked value="<?= $player_type_id ?>"><?= $text ?>
                                            <?php else: ?>
                                                <input type="radio" class="form-check-input" name="account_type" value="<?= $player_type_id ?>"><?= $text ?>
                                            <?php endif; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary submitProfileUpdate">
                            Update
                        </button>
                    </form>
                <?php else: ?>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" disabled value="<?= $user->getUsername() ?>" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" disabled value="<?= $user->getEmail() ?>" />
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if ($show_skills): ?>
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">
                    Stats
                    <?php if($user->getAccountTypeID() !== \App\Utils\Runescape\AccountType::PLAYER_TYPE_NORMAL): ?>
                        - <?= $user->getAccountTypeText() ?>
                    <?php endif; ?>
                </div>
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
    
            <?php if ($show_accolades): ?>
                <div class="card mt-4">
                    <div class="card-header">
                        Accolades
                        <?php if($user->getAccountTypeID() !== \App\Utils\Runescape\AccountType::PLAYER_TYPE_NORMAL): ?>
                            - <?= $user->getAccountTypeText() ?>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($accolades as $accolade): ?>
                                <div class="col-md-4 mb-2">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <img width=25 height=25 class="img-responsive" src="<?= $accolade['src'] ?>" alt="<?= $accolade['accolade_name'] ?>">
                                            &nbsp;<?= $accolade['accolade_name'] ?>
                                            <hr>
                                            <?= $accolade['score'] ?>
                                        </div>
                                        <div class="card-footer">
                                            Rank # <?= $accolade['rank'] ?>
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
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
</div>
