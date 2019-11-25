<?php
$form_errors = [];
if (empty($_SESSION['username']) OR empty($_SESSION['email_address']) OR empty($_SESSION['password'])) {
    $login_error[] = 'Please log in to see this page.';
}
if (count($login_error)) {
    view('home_page', [
        'errors' => $login_error
    ]);
}
    ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <b>Username:</b> <label for="username"><?=$_SESSION['username']?></label><br>
                    </div>
                    <div class="form-group">
                       <b>Email Address: </b> <label for="email"><?=$_SESSION['email_address'] ?></label><br>
                    </div>
                    <div class="form-group">
                       <b>Password: </b> <label for="password_confirm"><?=$_SESSION['password'] ?></label><br>
                        <div class="form-group">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>