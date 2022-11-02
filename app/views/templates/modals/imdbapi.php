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
$a = $reponse["results"][0]["id"];
// $a = str_replace("/title/", "");
$str = preg_replace('/title/', '', $a);
$text = "replace \ backslash";
$rep = "";
$pattern = ".*\/\/(.*)\/";
$matches = array();
$t = preg_match($pattern, $str);
$t;

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}

?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>