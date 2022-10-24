<?php include('templates/navbar.php'); ?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<table class="table">
  <thead>
    <tr>
      </th>
      <th scope="col">Director Name</th>
      <th scope="col">Genres</th>
      <th scope="col">Movies</th>
    </tr>
  </thead>
  <tbody>
  <?php
    foreach ($data as $value) {
    ?>
    <tr>
      <td><?php print_r($value['DirectorName'])?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
</body>
<script>
function deleteItem(id) {
  console.log("Okj");
    //alert (javascriptVariable);
    $.ajax({
        type: "POST",
        url: "http://localhost/mvc/public/movies/delete",
        dataType: 'text',
        data: id.toString(),
        success: function (data) {}
    });
}
</script>
</html>