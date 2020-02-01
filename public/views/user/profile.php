<?php /** @var \App\Models\User $user */ ?>
<?php /** @var \App\Models\Todo $todo */?>


<?php


?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <form name="UserEdit" id="UserEdit" method="post" action="/User/Update/<?= $user->getID() ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user->getUsername() ?>" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" disabled value="<?= $user->getEmail() ?>" />
                    </div>
                    
                    <button  onclick="submit_UserEdit" id="UserEdit" class="btn btn-primary">
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


<div class="heading">
    <h2>ToDo List</h2>
</div>
<table border="1">
<thead>
<th>ID</th>
<th>Task ID</th>
<th>Title</th>
<th>Description</th>
<th>Complete</th>
<th>User ID</th>
</thead>
<tbody>
<td></td><tr>
<form method="post" action="/Todo/" class="input_form">
    <input type="text" name="title" class="title">
    <input type="text" name="description" class="description">
    <button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
</form>
</tr>
</td>




<?php

dd($data['todos']);

{ ?>
<tr>
    <td> <?php echo $i; ?> </td>
   <?php foreach ($data['todos'] as $task) : ?>
       <td><?php echo $todos[1]->getTitle() ?></td>
       <td><?php echo $todos->getDescription() ?></td>
       <td><?php echo $todos->getIsCompleted()?></td>
       <td><?php echo $task->getUID() ?></td>

    <?php endforeach; ?>

</tr>
<?php $i++; } ?>
</tbody>
</table>


<script src="/public/js/user/profile.js"></script>