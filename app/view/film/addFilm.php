<h1 class="text-center">Add new film in DB</h1>
<?php if(!empty($data['error'])):?>
<div class="col-3 m-auto pe-auto">
    <p class="text-center alert-danger" ><?= $data['error']?></p>
</div>
<?php elseif (!empty($data['success'])):?>
<div class="col-3 m-auto pe-auto">
    <p class="text-center alert-success" ><?= $data['success']?></p>
</div>
<?php endif;?>
<form class="col-6 m-auto" method="post" action="addFilm" name="createForm">
    <div class="form-group">
        <label for="title">Name</label>
        <input type="text" class="form-control" placeholder="Write film" name="title" required>
    </div>
    <div class="form-group">
        <label for="release_year">Release year</label>
        <input type="number" class="form-control" placeholder="For example: 1970" name="release_year" maxlength="4" required>
    </div>
    <div class="form-group">
        <label for="format">Format</label>
        <input type="text" class="form-control" placeholder="For example: VHS, DVD, Blu-Ray ets." name="format" id="format" required>
    </div>
    <div class="form-group">
        <label for="stars">Stars</label>
        <input type="text" class="form-control" placeholder="Enter stars. For example: Paul Newman, Robert Redford" name="stars" required>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>

