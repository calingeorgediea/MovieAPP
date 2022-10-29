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
        $this->Movie = $this->model('Movie');
        $this->moviedetails = $this->model('moviedetail');
        $this->genres = $this->model('genres');
        $this->directors = $this->model('Directors');
        $this->user = $this->model('User');
        $this->requestBody = jsonify_reponse(file_get_contents('php://input'));
    }

    public function movieview() {
        $movieID = $_GET['id'];
        $movieData = jsonify_reponse($this->Movie->get($movieID))[1];
        return $this->view('/templates/MovieView', $data = $movieData);
    }

    public function list() {
        $list = jsonify_reponse($this->Movie->getMovies());
        return $this->view('show.movies', $data=$list);
    }

    public function delete() {
            $this->Movie::destroy($this->requestBody);
            $this->moviedetails::destroy($this->requestBody);
            return "200";
            // response in http
    }

    public function add() {
        /** POST */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name       = isset($_POST['directorname']) ?   $_POST['directorname']  : NULL;
            if ( $_POST['title'] && $_POST['genre'] && $_POST['rating'] && $_POST['directorname'] && $_POST['moviedescription'] ) {
                $directorID = $this->directors->insert($_POST['directorname']);
                $genreID = $this->genres->insert($_POST['genre']);
                $detailsID = $this->moviedetails->insert(
                    $_POST['title'],
                    $_POST['rating'],
                    $_POST['moviedescription']
                );
                $this->Movie->insert(
                    $detailsID,
                    $genreID,
                    $directorID
                );
                return $detailsID;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            return $this->view('get.movies', '');
        }
    }
}