<?php
use Carbon\Carbon;

function jsonify_reponse( $response ){
    $response=str_replace('},
    ]',"}]",$response);
    return json_decode($response);
}

class movies extends Controller {

    protected $user;
    public function __construct(){
        $this->movie = $this->model('Movie');
        /** Get HTTP REQUEST as Object */
        $this->requestBody = jsonify_reponse(file_get_contents('php://input'));
    }
    public function movie(){
        /** POST */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->movie->insertMovie(
                $this->requestBody->title,
                $this->requestBody->genre,
                Carbon::now());
        }
    }
    /** Get all movies, unfiltred */
    public function list(){
        /** GET */
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $list = jsonify_reponse($this->movie->getList());
            foreach($list as $movie) {
                print_r($movie->ID);
                print_r($movie->movieTitle);
                print_r($movie->movieGenre);
                print_r("\r\n");
            }
        }
    }
}