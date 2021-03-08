<!--TaskList-->
<div class="mb-4">
    <div class="card">
        <div class="card-header flex justify-between items-center">
                <div>
                    Task List
                </div>
                <div>
                    <button class="btn btn-outline-primary" name="AddTask" data-toggle="modal" data-target="#AddTask">
                        Add Task
                    </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row" id="sortable">
                <?php foreach ($tasks as $value) : ?>
                    <?php $edit = $value->getTaskID(); $i = 0; ?>
                    <div class="col-md-6 col-lg-4 mb-2">
                        <div class="card card-sortable" data-id="<?= $value->getTaskID() ?>">
                            <div class="card-header text-right">
                                <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#TaskModal-<?= $edit ?>" title="Click to edit this task">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                Title:
                                <?= $value->getTitle() ?>
                                <hr>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" class="form-control" rows="5" maxlength="5" readonly><?= $value->getDescription() ?></textarea>
                                </div>
                                <hr>
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
                            <div class="card-footer">
                                <div class="flex justify-between">
                                    <div>
                                        <form name="Complete" id="Complete/<?= $i ?>" method="post" action="/Task/Complete/<?= $user->getID() ?>">
                                            <input class="btn btn-success" type="submit" value="Complete" name="Complete<?= $edit ?>" data-toggle="tooltip" title="Complete this task">
                                            <input type="hidden" name="hidden_complete" value="<?= $edit ?>">
                                        </form>
                                    </div>
                                    <div>
                                        <form name="Delete" id="deleteForm" method="post" action="/Task/Delete/<?= $user->getID() ?>">
                                            <input class="btn btn-danger deleteButton" type="submit" value="Delete" name="Delete<?= $edit ?>" data-toggle="tooltip" title="Delete this task">
                                            <input type="hidden" name="hidden_delete" value="<?= $edit ?>">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Modal for Editing Tasks-->
                    <div class="modal fade" id="TaskModal-<?= $edit ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalTitle">Edit Task</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">X
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="Edit" id="Edit/<?= $i ?>" method="post" action="/Task/Edit/<?= $user->getID() ?>">
                                        <input type="hidden" name="hidden_edit" value="<?= $edit ?>">
                                        <div class="form-group">
                                            <label for="title/<?= $i ?>">Title</label>
                                            <input class="form-control" name="title" id="title/<?= $i ?>" value="<?= $value->getTitle() ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="description/<?= $i ?>">Description</label>
                                            <textarea class="form-control" name="description" id="description/<?= $i ?>" rows="4"><?= $value->getDescription() ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="complete/<?= $i ?>">Complete</label>
                                            <select id="complete" name="complete/<?= $i ?>" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group text-right">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Save changes">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Modal for Editing Tasks-->
                <?php $i++; endforeach; ?>
                <!--Modal for Adding Tasks-->
                <div class="modal fade" id="AddTask" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalAddTask">Add Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X
                                </button>
                            </div>
                            <form method="post" action="/Task/Add/<?= $user->getID() ?>">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="Title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="Description">Description</label>
                                        <textarea name="description" class="form-control" rows="3" maxlength="5"></textarea>
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
                <!--End Modal for Adding Tasks-->
                <!--End Content Div-->
            </div>
        </div>
    </div>
</div>