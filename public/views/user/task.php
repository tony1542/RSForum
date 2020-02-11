<?php /** @var \App\Models\User $user */ ?>
<?php /** @var \App\Models\Todo $tasks */ ?>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Todo List</div>
            <div class="card-body">
                <form name="TaskEdit" id="TaskEdit" method="post" action="/Todo/Add/<?= $user->getID() ?>">
                    <div class="form-group">
                        <label for="Title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"/>
                    </div>
                    <div class="form-group">
                        <label for="Description">Description</label>
                        <input type="text" class="form-control" id="description" name="description"/>
                    </div>

                    <button class="btn btn-primary">
                        Add Task
                    </button>
                </form>
                <br>
                <?php if (!$todo) : ?>
                    <p>Your list looks empty..</p>
                <?php else : ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Complete</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Task Editor</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($todo as $value) { ?>
                            <th scope="row"><?= $i ?></th>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#titleModel-<?=$i;?>">
                                <?= $value->getTitle(); ?>
                                </button>
                            </td>
                            <?php $complete = $value->getIsCompleted(); ?>
                            <?php if ($complete == 0) : ?>
                                <td>No</td>
                            <?php elseif ($complete == 1) : ?>
                                <td>Yes</td>
                            <?php endif; ?>
                            <td><?= $value->getDate() ?></td>
                            <form name="Complete" id="Complete" method="post"
                                  action="/Todo/Complete/<?= $user->getID() ?>">
                                <?php $edit = $value->getTaskID(); ?>
                                <td><input type="submit" name="Complete" value="Complete">
                                    <input type="hidden" name="hidden_complete" value="<?= $edit ?>"></td>
                            </form>
                            <form name="Delete" id="Delete" method="post" action="/Todo/Delete/<?= $user->getID() ?>">
                                <td><input type="submit" name="Delete" value="Delete">
                                    <input type="hidden" name="hidden_delete" value="<?= $edit ?>"></td>
                            </form>
                            <td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#myModal-<?= $edit ?>">
                                    Edit
                                </button>
                            </td>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal-<?= $edit ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Task</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form name="Edit" id="Edit" method="post"
                                                  action="/Todo/Edit/<?= $user->getID() ?>">
                                                <input type="hidden" name="hidden_edit" value="<?= $edit ?>"></td>
                                                <label for="title">Title:</label><input type="text" name="title"
                                                                                        value="<?= $value->getTitle(); ?>"><br>

                                                <label for="title">Description: </label>
                                                <textarea rows="5" cols="60" type="text" name="description" value="<?= $value->getDescription(); ?>"><?= $value->getDescription(); ?></textarea><br>
                                                <label for="title">Complete: </label>
                                                <select id="complete" name="complete">
                                                    <option <?php if ($complete == 0) echo 'selected'; ?> value="0"
                                                                                                          name="zero">No
                                                    </option>
                                                    <option <?php if ($complete == 1) echo 'selected'; ?> value="1"
                                                                                                          name="one">Yes
                                                    </option>
                                                </select><br>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <input type="submit" class="btn btn-primary" value="Save changes">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </td>
                            </tr>


                            <!-- Modal -->
                            <div class="modal fade" id="titleModel-<?=$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"><?=$value->getTitle();?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea rows="5" cols="60" readonly><?=$value->getDescription();?></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php $i++;
                        } ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<script src="/public/js/todo/todo.js"></script>