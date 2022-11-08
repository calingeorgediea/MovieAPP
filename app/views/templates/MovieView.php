<html>
<head>
<?php include('navbar.php'); ?>
<link rel="stylesheet" href="<?=PUBLIC_PATH?>/css/movie.view.css">
<script type="module" src="<?=PUBLIC_PATH?>/js/star_rating.js"></script>
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
        <?php
        clearstatcache();
        $filename = "../uploads/".$data->Image;
        $filename = PUBLIC_PATH."uploads/photo.jpg";
        $thruth = file_exists($filename);
        $thruth;
        clearstatcache();
        if($data->Image) { ?>
        <img src="../uploads/<?php echo $data->Image; ?>" class="movie-poster">
        <?php } elseif ($data->API_movie_image) { ?>
        <img src="<?php echo $data->API_movie_image; ?>" class="movie-poster">
        <?php } else { ?>
            <img src="../uploads/missing.jpg" class="movie-poster">
            <?php } ?>
        </div>
        <div class="col-sm">
            <div id="movie-title">
                <h1> <?php echo $data->MovieTitle ?> </h1>
            </div>
            <div id="director-name">
                <a href="<?php echo PUBLIC_PATH ?>director?id=<?php echo $data->DirectorID; ?>">
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
            <div id="movie-description">
            <?php if( $data->api_fetched == true ) { ?>
                <strong> Genre </strong>
                <p> <?php echo $data->GenreName ?> </p>
                <strong> IMDB rating </strong>
                <p> <?php echo $data->API_movie_rating ?> </p>
                <strong> Relase Year </strong>
                <p> <?php echo $data->relase_date ?> </p>
            <?php } else { ?>
            <p>
           <button onclick='imdbUpdate("<?php echo $data->MovieTitle; ?>")' type="submit" id="delete" class="btn btn-danger">Synchronise with IMDb</button>
           <?php } ?>
            </p>
                <strong> Description </strong>
                <p> <?php echo $data->MovieDescription ?> </p>
            </div>
             </div>
             <div class="col-8">

        </div>
        </div>
        </div>
  </div>
</div>
    </div>
</div>
<?php include('loadingspinner.html'); ?>
</body>

<script>
function imdbUpdate(title){
    $('.main').hide();
    $('.loading-spinner').show();
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    if(urlParams.has('id')){
        var id = urlParams.get('id');
    }
    console.log(id)
    $.ajax({
        type: "PATCH",
        // Pass data to PHP using URL and then retrieve using $_get[param]
        url: "http://localhost/mvc/public/movie/update_on_api?title=" + title,
        dataType: 'text',
        data: id,
        success: function (data) {
            window.location.reload();
        }
    });
}
</script>
</html>