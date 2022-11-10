<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
</div>

<script>
    $('#searchbar').on("keyup change",function(e){
        console.log(this.value);
        search(this.value);
    });

    function search(value) {
    //alert (javascriptVariable);
    $.ajax({
      type: "GET",
      url: "http://localhost/mvc/public/movie/search/"+value,
      dataType: 'json',
      data: value,
      success: function(response) {
       console.log(response);
            },
    });
  }

</script>