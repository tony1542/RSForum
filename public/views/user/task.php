<!--Grid layout-->
<!--End Todo add task div-->

<!--TodoList-->
<div class="col-lg-12 mb-4">
    <div class="card">
        <div class="card-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        Todo List
                    </div>
                    <div class="col-sm">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-outline-primary" name="AddTask" data-toggle="modal" data-target="#AddTask">Add Task
                            </button>
                        </div>
                    </div>
                    <div class="col-sm">
                        <!--Filler-->
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <?php  $i= 0; foreach ($todo as $value) : ?>
                    <?php $edit = $value->getTaskID(); ?>
                    <div class="col-md-6 col-lg-4 mb-2">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-right">
                                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#TaskModal-<?= $edit ?>" title="Click to edit this task">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                Title: <br>
                                <?= $value->getTitle(); ?>
                                <hr>
                                <div class="form-group purple-border">
                                    Description:
                                    <textarea class="form-control" rows="5" maxlength="5" readonly><?= $value->getDescription() ?></textarea>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            Complete:<br>
                                            <?php if ($value->getIsCompleted() == 0) {echo '<i class="far fa-times-circle"></i>';} elseif ($value->getIsCompleted() == 1) {echo '<i class="fas fa-check"></i>';} ?>
                                        </div>
                                        <div class="col-sm">
                                            Date Created:<br>
                                            <?= $value->getDate() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <form name="Complete" id="Complete/<?= $i ?>" method="post" action="/Todo/Complete/<?= $user->getID() ?>">
                                            <input class="btn btn-success" type="submit" value="Complete" name="Complete<?= $edit ?>" data-toggle="tooltip" title="Complete this task">
                                            <input type="hidden" name="hidden_complete" value="<?= $edit ?>">
                                        </form>
                                    </div>
                                    <div>
                                        <form name="Delete" class="deleteButton" method="post" action="/Todo/Delete/<?= $user->getID() ?>">
                                            <input class="btn btn-danger" type="submit" value="Delete" name="Delete<?= $edit ?>" data-toggle="tooltip" title="Delete this task">
                                            <input type="hidden" name="hidden_delete" value="<?= $edit ?>">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Model for Editing Tasks-->
                    <div class="modal fade" id="TaskModal-<?= $edit ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalTitle">Edit Task</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">X
                                    </button>
                                </div>
                                <form name="Edit" id="Edit/<?=$i;?>" method="post" action="/Todo/Edit/<?= $user->getID() ?>">
                                    <div class="modal-body">
                                        <input type="hidden" name="hidden_edit" value="<?= $edit ?>"></td>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><b>Title</b></span>
                                            </div>
                                            <textarea class="form-control" name="title" rows="1"><?= $value->getTitle(); ?></textarea>
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><b>Description</b></span>
                                            </div>
                                            <textarea class="form-control" name="description" rows="4"><?= $value->getDescription(); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="complete"><b>Complete:</b> </label>
                                            <select name="complete" class="form-control">
                                                <option value="0">No
                                                </option>
                                                <option value="1">Yes
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <input type="submit" class="btn btn-primary" value="Save changes">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End model for Editing Tasks-->
                <?php $i++; endforeach; ?>
                <!--Model for Adding Tasks-->
                <div class="modal fade" id="AddTask" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalAddTask">Add Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X
                                </button>
                            </div>
                            <form name="AddTask" id="AddTask" method="post" action="/Todo/Add/<?= $user->getID() ?>">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="Title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="Description">Description</label>
                                        <input type="text" class="form-control" id="description" name="description"/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary">Add Task</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--End Model for Adding Tasks-->
                <!--End Content Div-->
            </div>
        </div>
    </div>
</div>

<script src="/public/js/todo/todo.js"></script>