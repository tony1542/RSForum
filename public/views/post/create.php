<form method="post" action="/Post/Create">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $title ?? null ?>" />
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea type="text" class="form-control" id="body" name="body"><?= $body ?? null ?></textarea>
    </div>
    
    <div class="text-right">
        <button class="btn btn-primary">Create</button>
        <a class="btn btn-default" href="/Post/All">Cancel</a>
    </div>
</form>