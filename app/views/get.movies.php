<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<div class="container">
  <form action="http://localhost/mvc/public/movies/list" method="POST">
    <h2>Add Movie</h2>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="title">Movie Title</label>
          <input value="title" name="title" type="text" class="form-control" placeholder="" id="first">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="genre">Movie Genre</label>
          <input value="genre" name="genre" type="text" class="form-control" placeholder="" id="last">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="rating">Rating</label>
          <input value="rating" name="rating" type="text" class="form-control" placeholder="" id="company">
        </div>
      </div>
      <div class="col-md-6">

        <div class="form-group">
          <label for="directorname">Director Name</label>
          <input value="directorname" name="directorname" type="text" class="form-control" id="directorname" placeholder="">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="form-group">
          <label for="moviedescription">Movie Description</label>
          <input value="moviedescription" name="moviedescription" type="text" class="form-control" id="email" placeholder="">
        </div>
      </div>
    </div>
    <input type="submit" value="Submit" id="btn" class="btn btn-primary">Submit</input>
  </form>
</div>
</html>