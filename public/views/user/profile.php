<?php /** @var \App\Models\User $user */ ?>


<?php

//Todo Fix Tonys javascript, it breaks the Add Task button.

?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Account Details</div>
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
                    
                    <button  onclick="submit_UserEdit()" id="UserEdit" class="btn btn-primary">
                        Update
                    </button>
                </form>
            </div>
            <div class="card-footer">
                Total Level: <?= $user->getTotalLevel() ?>
            </div>
        </div>
    </div>
</div>


<script src="/public/js/user/profile.js"></script>