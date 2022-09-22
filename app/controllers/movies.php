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
    }

    public function addmovie(){
        $body = file_get_contents('php://input');
        $body = jsonify_reponse($body);
        $this->movie->insertMovie("Dark","Comedy",Movie::now());
    }

    public function helloworld(){
        print_r("Hello world");
    }

}