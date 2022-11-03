<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

class API {
    // public $API_movie_title;
    // public $API_movie_image;
    // public $API_movie_rating;
    // public  $API_relase_date;
    // public $API_plot_outline;
    // public $API_genres;
    protected $url;

    function new_request( $url, $request ) {
		$this->ch = curl_init();
        $this->url = $url;
        $this->request = $request;

        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->request);
        curl_setopt($this->ch, CURLOPT_PUT, 1);
        $response = curl_exec($this->ch);
        return $response;
    }
}


class find extends API {
    function search() {
        $header_1 = "X-RapidAPI-Host: imdb8.p.rapidapi.com";
        $header_2 = "X-RapidAPI-Key: a309d2b49fmsh6418ee4b0bbc0a4p1eb029jsn7df10fd3dae9";
        $request = array($header_1,$header_2);
        $url = "https://imdb8.p.rapidapi.com/title/v2/find?title=wolverine&limit=1&sortArg=moviemeter%2Casc";
        $response = parent::new_request($url, $request);
        print_r($response);
    }
}

$extract = new find();
$extract->search();

?>