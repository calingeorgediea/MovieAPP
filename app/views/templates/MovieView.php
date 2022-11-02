<html>
<head>
<?php define('CSS_PATH', 'http://localhost/mvc/public/'); ?>
<?php include('navbar.php'); ?>
<link rel="stylesheet" href="<?=CSS_PATH?>/css/movie.view.css">
<script type="module" src="<?=CSS_PATH?>/js/star_rating.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="main">
    <div class="section-1">
        <div class="container">
        <div class="row">
        <div class="col-sm">
        <img src="../uploads/<?php echo $data->Image; ?>" class="movie-poster" alt="Simply Easy Learning"">
        </div>
        <div class="col-sm">
            <div id="movie-title">
                <h1> <?php echo $data->MovieTitle ?> </h1>
            </div>
            <div id="director-name">
                <a href="directors?id=<?php echo $data->DirectorID; ?>">
                <h2> <?php echo $data->DirectorName ?> </h2>
                </a>
            </div>
            <ul data-rating=<?php echo $data->MovieRating; ?> class="ratings">
                <li rating="5" class="star"></li>
                <li rating="4" class="star"></li>
                <li rating="3" class="star"></li>
                <li rating="2" class="star"></li>
                <li rating="1" class="star"></li>
            </ul>
            <?php include('modals/imdbapi.php'); ?>
             </div>

             <div class="col-8">
            <div id="movie-description">
                <p> <?php echo $data->MovieDescription ?> </p>
            </div>
        </div>
        </div>
        </div>
  </div>
</div>
    </div>
</div>
</body>
</html>