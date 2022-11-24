<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Setup Director Page
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label>Associate a color with this director</label>
            <input value="<?php echo $data->color; ?>" name="color" type="text" class="form-control" placeholder=""
              id="color">
          </div>
          <div class="form-group">
            <label for="birthday">Birthday</label>
            <input value="<?php echo $data->birthday; ?>" name="birthday" type="date" class="form-control"
              id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="deathday">Deathday</label>
            <input value="<?php echo $data->deathday; ?>" name="deathday" type="date" class="form-control"
              id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="biography">Short biography</label>
            <input value="<?php echo $data->biography; ?>" name="biography" type="text" class="form-control"
              id="exampleInputPassword1" placeholder="Biography">
          </div>
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input onclick="" type="submit" value="Submit" id="btn" class="btn btn-primary">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>