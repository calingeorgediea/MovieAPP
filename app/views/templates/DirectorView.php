<html>
<head>
<?php include('navbar.php'); ?>
<link rel="stylesheet" href="../content/css/rating.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="main">
    <div class="section-1">
        <div class="container">
        <div class="row">
        <div class="col-sm">
        <img src="../uploads/" class="movie-poster" alt="">
        </div>
        <div class="col-sm">
            <div id="movie-title">
                <h1> <?php echo $data->DirectorName ?> </h1>
            </div>
            <div id="director-name">
                <p>Director Name</p>
                <h2> <?php echo $data->DirectorName ?> </h2>
            </div>
             <div class="col-8">
        </div>
        </div>
        </div>
  </div>
</div>
    </div>
</div>
</body>
</html>