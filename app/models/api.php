<?php
class API {
    // public $API_movie_title;
    // public $API_movie_image;
    // public $API_movie_rating;
    // public  $API_relase_date;
    // public $API_plot_outline;
    // public $API_genres;
    protected $url;

    function new_request( $url ) {
		$this->ch = curl_init();
        $this->url = $url;
        $host = "imdb8.p.rapidapi.com";
        $key = "a309d2b49fmsh6418ee4b0bbc0a4p1eb029jsn7df10fd3dae9";
        $this->httpheader = array("X-RapidAPI-Host:".$host, $header_2 = "X-RapidAPI-Key:".$key);

        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->httpheader);
        curl_setopt($this->ch, CURLOPT_PUT, 1);
        $response = curl_exec($this->ch);
        return $response;
    }
}

class API_movie extends API {

    function getID($title) {
        $url = "https://imdb8.p.rapidapi.com/title/v2/find?title=".$title."&limit=1&sortArg=moviemeter%2Casc";
        $response = parent::new_request($url);
        $tt = json_decode($response, true);
        $tt = $tt["results"][0]["id"];
        $tt = stripslashes($tt);
        $tt = explode("/",$tt)[2];
        // Returns ID of movie, ex tt=121412 after strip
        return $tt;
    }

    function overview($tt) {
        $url = "https://imdb8.p.rapidapi.com/title/get-overview-details?tconst=".$tt."&currentCountry=US";
        $response = parent::new_request($url);
        $response = json_decode($response, true);
        return $response;
    }

    // function images($tt) {
    //     $url = "https://imdb8.p.rapidapi.com/title/get-base?tconst=".$tt;
    //     $response = parent::new_request($url);
    //     $response = json_decode($response, true);
    //     return $response;
    // }

    function crew($tt) {
        $url = "https://imdb8.p.rapidapi.com/title/get-full-credits?tconst=".$tt;
        $response = parent::new_request($url);
        $response = json_decode($response, true);
        return $response;
    }

    function __construct($keyword){
        $this->keyword = $keyword;
        $this->tt=$this->getID($this->keyword);
    }

    function response(){
        $crew = $this->crew($this->tt);
        $overview = $this->overview($this->tt);
        $response = array(
            "title" => $overview["title"]["title"] ?? null,
            "rating" => $overview['ratings']['rating'] ?? null,
            "API_movie_image" => $overview['title']['image']['url'] ?? null,
            "plot" => $overview["plotSummary"]["text"] ?? null,
            "relase_date" => $overview["title"]["year"] ?? null,
            "genre" => $overview["genres"][0] ?? null,
            "director" => $crew['crew']['director'][0]['name'] ?? null,
            // "full_overview" => $overview ?? null,
            // "full_cast" => $crew ?? null
        );
        $response = json_encode($response);
        $response = json_decode($response);
        return $response;
    }
}