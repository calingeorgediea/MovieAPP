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
        $this->moviedetails = $this->model('MovieDetails');
        $this->genres = $this->model('Genres');
        $this->directors = $this->model('Directors');
        $this->requestBody = jsonify_reponse(file_get_contents('php://input'));
    }

    public function check(){
        print_r($this->movie->find());
    }


    /** Get all movies, unfiltred */
    public function list() {

        /** POST */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $directorID=$this->directors->insert($this->requestBody->directorname);
            $genreID = $this->genres->insert($this->requestBody->genre);
            $detailsID = $this->moviedetails->insert(
                $this->requestBody->title,
                $this->requestBody->rating,
                $this->requestBody->moviedescription
            );
            $this->movie->insert(
                $detailsID,
                $genreID,
                $directorID
            );
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            // print_r($this->movie->find(72));
            // print_r($this->movie->getList());
            $list = jsonify_reponse($this->movie->getList());


            foreach($list as $movie) {
                print_r($movie->MovieID);
            }
            //     // print_r($movie->MovieID);
            //     // print_r("\r\n");
            //     // print_r(jsonify_reponse($this->moviedetails->getList($movie->MovieID))[0]->MovieTitle);
            //     // print_r("\r\n");
            //     // print_r(jsonify_reponse($this->genres->getGenre($movie->GenreID))[0]->GenreName);
            //     // print_r("\r\n");
            //     // print_r(jsonify_reponse($this->directors->getDirector($movie->directorID))[0]->DirectorName);
            //     // print_r("\r\n");
            //     // print_r("\r\n");
            // }
    }

}
}