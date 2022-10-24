<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Movie Name</th>
      <th scope="col">Director Name</th>
    </tr>
  </thead>
  <tbody>
  <?php
    foreach ($data as $value) {
    ?>
    <tr>
      <td><?php print_r($value->MovieID)?></td>
      <td></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
</body>
</html>