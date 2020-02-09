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

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Todo List</div>
            <div class="card-body">
                <form name="TaskEdit" id="TaskEdit" method="post" action="/User/Todo/<?= $user->getID()?>">
                    <div class="form-group">
                        <label for="Title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"/>
                    </div>
                    <div class="form-group">
                        <label for="Description">Description</label>
                        <input type="text" class="form-control" id="description" name="description"/>
                    </div>

                    <button  onclick="" id="" class="btn btn-primary">
                        Add Task
                    </button>
                </form>
                <form>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Task ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Complete</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Task Editor</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;?>
                            <?php foreach ($todo as $value){ ?>
                            <th scope="row"><?=$i?></th>
                            <td><?=$value->getTaskID();?></td>
                            <td><?=$value->getTitle();?></td>
                            <td><?=$value->getDescription();?></td>
                            <?php  $complete = $value->getIsCompleted(); ?>
                            <?php  if($complete == 0) : ?>
                                <td>No</td>
                                <?php elseif($complete == 1) : ?>
                                <td>Yes</td>
                            <?php endif; ?>
                            <td><?=$value->getUID();?></td>
                                <td><button type="button">Complete</button></td>
                                <td><button type="button" id="<?=$value->getTaskID()?>">Delete</button></td>
                                <td><button type="button">Edit</button></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/public/js/user/profile.js"></script>