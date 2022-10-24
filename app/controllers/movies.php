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
        $this->moviedetails = $this->model('MovieDetail');
        $this->genres = $this->model('Genres');
        $this->directors = $this->model('Directors');
        $this->user = $this->model('User');
        $this->requestBody = jsonify_reponse(file_get_contents('php://input'));
    }

    public function check(){
        var_dump($this->requestBody);
    }

    public function list() {
        $list = jsonify_reponse($this->Movie->get());
        print_r($this->Movie->get(1));
        // return $this->view('show.movies', $data=$list);
    }


    /** Get all movies, unfiltred */
    public function user() {
        return $this->user->getMyUser();
    }
    public function add() {
        /** POST */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name       = isset($_POST['directorname']) ?   $_POST['directorname']  : NULL;
            if ( $_POST['title'] && $_POST['genre'] && $_POST['rating'] && $_POST['directorname'] && $_POST['moviedescription'] ) {
                $directorID=$this->directors->insert($_POST['directorname']);
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
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $list = jsonify_reponse($this->Movie->get());
            return $this->view('get.movies', '');
        }
    }
}