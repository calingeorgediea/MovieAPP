
<html>
<head>
<?php include('templates/navbar.php'); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Title</th>
        <th scope="col">Director</th>
        <th scope="col">Genre</th>
        <th scope="col">Your rating</th>
        <th scope="col">Movie Description</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody id="contentTable">
      <?php
  foreach ($data as $value) {
  ?>
      <tr id="movie-<?php echo $value->MovieID; ?>">
        <td>
          <?php print_r($value->MovieTitle) ?>
        </td>
        <td>
          <?php print_r($value->DirectorName) ?>
        </td>
        <td>
          <?php print_r($value->GenreName) ?>
        </td>
        <td>
          <?php print_r($value->MovieRating) ?>
        </td>
        <td>
          <?php print_r($value->MovieDescription) ?>
        </td>
        <td><a class="btn btn-primary" href="<?php echo PUBLIC_PATH ?>movie/?id=<?php echo $value->MovieID ?>"> Show
          </a></td>
        <td><button onclick="deleteItem(<?php echo $value->MovieID; ?>)" type="submit"
            value="<?php echo $value->MovieID; ?>" id="delete" class="btn btn-danger">Delete</button></td>
      </tr>
      <?php
  }
    ?>
    </tbody>
  </table>
</body>
<script>

$( document ).ready(function() {
  const url = new URL(window.location.href);
  // Check if there is any search Query and if so, pass it to the searchtab.
    const queryString = window.location.search;
    const parameters = new URLSearchParams(queryString);
    const value = parameters.get('q');
    if ( value ) {
      $("#searchbar").val(value);
    }
});

function debounce( callback, delay ) {
    let timeout;
    return function() {
        clearTimeout( timeout );
        timeout = setTimeout( callback, delay );
    }
}


function search(value) {
    //alert (javascriptVariable);
    if(!value){
      value = false;
    }
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

  function searchCache() {
    if(myInput.value) {
      const url = new URL(window.location.href);
      url.searchParams.set('q', myInput.value);
      window.history.replaceState(null, null, url); // or pushState
      search(myInput.value);
    } else {
      console.log("empty");
      history.replaceState({}, "Title", "movie");
      search(false);
    }
  }

const myInput = document.getElementById("searchbar");

myInput.addEventListener(
    "keyup",
    debounce( searchCache, 750 )
);

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

  function render(response){
  console.log(response);
  $('#contentTable').empty();
  // For now, models return data in different ways.
  // Some details can be found in moviedetails attribute and others as a whole.
  for(const entry of response){

    var MovieTitle = entry.MovieTitle;
    var Director = entry.DirectorName;
    var Genre = entry.GenreName;
    var Rating = entry.MovieRating;
    var MovieDescription = entry.MovieDescription;

    $('#contentTable').append(
    "<tr id=movie-" + entry.MovieID + ">" +
        "<td>" + MovieTitle + "</td>" +
        "<td>" + Director + "</td>" +
        "<td>" + Genre + "</td>" +
        "<td>" + Rating + "</td>" +
        "<td>" + MovieDescription + "</td>" +
        "<td><a class='btn btn-primary' href=movie/?id="+entry.MovieID+">Show</a></td>" +
        "<td><button class='btn btn-danger' onclick=deleteItem("+ entry.MovieID +")>Delete</button></td>" +
    "</tr>"
    );
  }
}

</script>

</html>