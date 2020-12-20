<h1 class="text-center">Import txt file in DB</h1>
<form class="col-6 m-auto" method="post" action="import-list" name="import" enctype="multipart/form-data">
    <div class="form-group">
        <label for="import">Import doc file</label>
        <input type="file" lang="en_en" class="form-control-file" id="import" name="import" accept="text/plain">
        <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Import in BD</button>
</form>
