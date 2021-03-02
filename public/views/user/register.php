<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input name="username" class="form-control" id="username" placeholder="Settled">
                    </div>
                    <div class="form-group">
                        <label for="email_address">Email</label>
                        <input name="email_address" class="form-control" id="email_address" placeholder="not_a_bot@jagex.com">
                    </div>
                   <div class="form-group">
                       <label for="acc_type">Account Type</label>
                       <select id="acc_type" name="acc_type" class="form-control">
                           <?php foreach (\App\Utils\Runescape\AccountType::getAll() as $account_type_id => $account_type_text) : ?>
                               <option value="<?= $account_type_id ?>"><?= $account_type_text ?></option>
                           <?php endforeach; ?>
                       </select>
                   </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type ="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">Password (Confirm)</label>
                        <input type ="password" name="password_confirm" class="form-control" id="password_confirm">
                    </div>
                    <div>
                        <button class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




