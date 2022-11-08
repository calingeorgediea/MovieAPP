<?php

use Carbon\Carbon;

class GenreController extends Controller
{

    public function __construct()
    {
        $this->Genres = $this->model('Genres');
        $this->requestBody = jsonify_reponse(file_get_contents('php://input'));
    }

    public function index()
    {
        if (isset($_GET['q'])) {
            $list = jsonify_reponse($this->Genres->sortbygenre($_GET['q']));
            return $this->view('/templates/GenreView', $data = $list);
        } else {
            $list = jsonify_reponse($this->Genres->get());
            return $this->view('show.genres', $data = $list);
        }
    }
}