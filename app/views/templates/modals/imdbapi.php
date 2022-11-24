<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Advanced
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Connect to API</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col">
              <img src="<?php echo $api_image['image']['url'] ?>" width="100" height="200" />
            </div>
            <div class="col">
              <p> Official IMDB title </p>
              <?php echo $API_movie_title; ?>
              <p> Rating </p>
              <?php echo $API_movie_rating; ?>
              <p> Year </p>
              <?php echo $API_relase_date; ?>
              <p> Official IMDB title </p>
              <?php echo $API_movie_title; ?>
              <p> Plot </p>
              <?php echo $API_plot_outline; ?>
              <p> Genres </p>
              <?php echo $API_plot_outline; ?>
              <?php foreach ($api_content["genres"] as $genre) {
              echo $genre;
            }
            ?>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>