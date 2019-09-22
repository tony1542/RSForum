<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form action="/User/Register" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input name="user" class="form-control" id="username" placeholder="Enter Username">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" class="form-control" id="email" placeholder="Enter Email">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" class="form-control" id="password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">Password (Confirm)</label>
                        <div class="form-group">
                            <input name="password" class="form-control" id="password_confirm" placeholder="Password">
                        </div>
                        <button class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>