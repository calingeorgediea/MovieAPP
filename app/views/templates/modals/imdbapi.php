<?php
// Find Movie first
      $curl = curl_init();
      curl_setopt_array($curl, [
        CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/v2/find?title=".$data->MovieTitle."&limit=1&sortArg=moviemeter%2Casc",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
          "X-RapidAPI-Host: imdb8.p.rapidapi.com",
          "X-RapidAPI-Key: a309d2b49fmsh6418ee4b0bbc0a4p1eb029jsn7df10fd3dae9"
        ],
      ]);

      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      $reponse = json_decode($response, true);
      $reponse = $reponse["results"][0]["id"];
      $api_movieID = stripslashes($reponse);
      $api_movieID = explode("/",$api_movieID)[2];
// By MovieID fetched, retrieve all information by another call
      $curl = curl_init();
      curl_setopt_array($curl, [
        CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/get-overview-details?tconst=".$api_movieID."&currentCountry=US",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
          "X-RapidAPI-Host: imdb8.p.rapidapi.com",
          "X-RapidAPI-Key: 428ee192aamshb1dd564fa60d9adp128458jsnd5ce70f03f63"
        ],
      ]);
      $response = curl_exec($curl);
      $api_content = json_decode($response, true);
      $err = curl_error($curl);
      curl_close($curl);
// Fetch image
      $curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/get-base?tconst=".$api_movieID,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: imdb8.p.rapidapi.com",
		"X-RapidAPI-Key: 428ee192aamshb1dd564fa60d9adp128458jsnd5ce70f03f63"
	],
]);
$response = curl_exec($curl);
$api_image = json_decode($response, true);

curl_close($curl);
$API_movie_title = $api_content["title"]["title"];
$API_movie_image=$api_image['image']['url'];
$API_movie_rating=$api_content['ratings']['rating'];
$API_relase_date=$api_content["title"]["year"];
$API_plot_outline=$api_content["plotSummary"]["text"];
$API_genres = $api_content["genres"];
      ?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Advanced
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Connect to API</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container">
        <div class="row">
          <div class="col">
            <img src="<?php echo $api_image['image']['url'] ?>" width="100" height="200"/>
          </div>
          <div class="col">
            <p> Official IMDB title </p>
            <?php echo $API_movie_title; ?>
            <p> Rating </p>
            <?php echo $API_movie_rating; ?>
            <p> Year </p>
            <?php echo $API_relase_date; ?>
            <p> Official IMDB title </p>
            <?php echo $API_movie_title; ?>
            <p> Plot </p>
            <?php echo $API_plot_outline; ?>
            <p> Genres </p>
            <?php echo $API_plot_outline; ?>
            <?php foreach($api_content["genres"] as $genre) {
              echo $genre;
            }
            ?>
          </div>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>