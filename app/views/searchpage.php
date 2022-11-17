<head>
<?php include('templates/navbar.php'); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../../node_modules/lodash/lodash.js"></script>
  <!-- C:\MAMP\htdocs\MVC\node_modules\lodash\lodash.js -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="#about">About</a>
  <a href="#contact">Contact</a>
  <input id="searchbar" type="text" placeholder="Search..">
</div>

<div id="content1">
  <table class="table">
      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Director</th>
          <th scope="col">Genre</th>
          <th scope="col">Rating</th>
          <th scope="col">Movie Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody id="contentTable"> <?php
if($data) {
foreach ($data as $value) {
  ?>
      <tr id="movie-<?php echo $value['MovieID']; ?>">
        <td>
          <?php print_r($value['MovieTitle']) ?>
        </td>
        <td>
          <?php print_r($value['DirectorName']) ?>
        </td>
        <td>
          <?php print_r($value['GenreName']) ?>
        </td>
        <td>
          <?php print_r($value['MovieRating']) ?>
        </td>
        <td>
          <?php print_r($value['MovieDescription']) ?>
        </td>
        <td><a class="btn btn-primary" href="<?php echo PUBLIC_PATH ?>movie/?id=<?php echo $value['MovieID'] ?>"> Show
          </a></td>
        <td><button onclick="deleteItem(<?php echo $value['MovieID']; ?>)" type="submit"
            value="<?php echo $value['MovieID']; ?>" id="delete" class="btn btn-danger">Delete</button></td>
      </tr>
      <?php
  }
}
  ?>
    </tbody>
    </table>
</div>

<script>
function render(response){
  console.log(response);
  $('#contentTable').empty();
  for(const entry of response){
    $('#contentTable').append(
    "<tr id=movie-" + entry.MovieID + ">" +
        "<td>" + entry.MovieTitle + "</td>" +
        "<td>" + entry.DirectorName + "</td>" +
        "<td>" + entry.GenreName + "</td>" +
        "<td>" + entry.MovieRating + "</td>" +
        "<td>" + entry.MovieDescription + "</td>" +
        "<td><button class='btn btn-danger' onclick=deleteItem("+entry.MovieID+")>Delete</button></td>" +
        "<td><a class='btn btn-danger' href=movie/?id="+entry.MovieID+">View</a></td>" +
    "</tr>"
    );
  }
}

function debounce( callback, delay ) {
    let timeout;
    return function() {
        clearTimeout( timeout );
        timeout = setTimeout( callback, delay );
    }
}

const myInput = document.getElementById("searchbar");

myInput.addEventListener(
    "keyup",
    debounce( searchCache, 1000 )
);

    function searchCache() {
      if(myInput.value) {
        const url = new URL(window.location.href);
        url.searchParams.set('q', myInput.value);

        window.history.replaceState(null, null, url); // or pushState
        search(myInput.value);
      } else {
        const url = new URL(window.location.href);
        var currentUrl = url.HREF;
        console.log(currentUrl);
        let params = new URLSearchParams(currentUrl);
        params.delete('q'); //Query string is now: 'bar=2'
      }
    }


    function search(value) {
    //alert (javascriptVariable);
    $.ajax({
      type: "GET",
      url: "http://localhost/mvc/public/movie/search/"+value,
      dataType: 'json',
      data: value,
      success: function(response) {
        render(response);
      },
    });
  }

  function deleteItem(id) {
    //alert (javascriptVariable);
    $('#movie-' + id).remove();
    $.ajax({
      type: "POST",
      url: "http://localhost/mvc/public/movie/delete",
      dataType: 'text',
      data: id.toString(),
      success: function (data) {
      }
    });
  }

</script>