<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="username">Username</label>

                        <input name="username" class="form-control" id="username" placeholder="Enter Username">

                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email_address" class="form-control" id="email_address" placeholder="Enter Email">
                    </div>
                   <div class="form-group">
                       <label for="acc_type">Account Type:</label>
                       <select name="acc_type">
                           <option value="0">Regular Account</option>
                           <option value="1">IronMan</option>
                           <option value="2">Hardcore IronMan</option>
                           <option value="3">Ultimate IronMan</option>
                       </select>
                   </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type ="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">Password (Confirm)</label>
                        <div class="form-group">
                            <input type ="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Password">
                        </div>
                        <button class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




