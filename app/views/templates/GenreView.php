<html>

<head>
    <?php include('navbar.php'); ?>
    <link rel="stylesheet" href="../content/css/rating.css">
    <link rel="stylesheet" href="<?= PUBLIC_PATH ?>/css/director.view.css">
    <link rel="stylesheet" href="<?= PUBLIC_PATH ?>/css/global.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
    integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
    integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
    crossorigin="anonymous"></script>

<body>

    <div class="main">
        <!-- <?php var_dump($data) ?> -->
        <div class="section-1">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                    </div>
                    <div class="col-sm">
                        <div id="movie-title">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
$numOfCols = 3;
$rowCount = 3;
$bootstrapColWidth = 12 / $numOfCols;

foreach ($data as $row) {
    if ($rowCount % $numOfCols == 0) { ?>
        <div class="row">
            <?php }
    $rowCount++; ?>
            <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                <div class="thumbnail">
                    <a href="<?php echo PUBLIC_PATH ?>movie?id=<?php echo $row->MovieID; ?>">
                        <?php if ($row->Image && file_exists($uploads_dir . $row->Image)) { ?>
                        <img src="<?php echo PUBLIC_PATH ?>uploads/<?php echo $row->Image; ?>" width="100%">
                        <?php } elseif ($row->API_movie_image) { ?>
                        <img src="<?php echo $row->API_movie_image; ?>" width="100%">
                        <?php } else { ?>
                        <img src="<?php echo $missing_image; ?>" width="100%">
                        <?php } ?>
                    </a>
                    <h3>
                        <?php echo $row->MovieTitle; ?>
                    </h3>
                    <p>
                        <?php echo $row->MovieDescription; ?>
                    </p>
                </div>
            </div>
            <?php
    if ($rowCount % $numOfCols == 0) { ?>
        </div>
        <?php }
} ?>
    </div>
    </div>
    </div>
</body>

</html>