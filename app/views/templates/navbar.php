<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <?php include('paths.php'); ?>
  <a class="navbar-brand">MyMovies</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo PUBLIC_PATH ?>movie/add">Add Movie</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo PUBLIC_PATH ?>movie">My Movies</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo PUBLIC_PATH ?>genre">Genres</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo PUBLIC_PATH ?>director">Directors</a>
      </li>
    </ul>
  </div>
  <input id="searchbar" type="text" placeholder="Search Movie">
</nav>