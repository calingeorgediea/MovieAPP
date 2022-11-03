<?php
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