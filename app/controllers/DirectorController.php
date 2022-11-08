<?php

use Carbon\Carbon;
class DirectorController extends Controller {
    public function __construct(){
        $this->directors = $this->model('Directors');
        $this->requestBody = jsonify_reponse(file_get_contents('php://input'));
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if(isset($_GET['id'])) {
                $directorID = $_GET['id'];
                $directorData = jsonify_reponse($this->directors->getAll($directorID));
                return $this->view('/templates/DirectorView', $data = $directorData);
            } else {
                $movieData = jsonify_reponse($this->directors->get(null));
                return $this->view('show.directors', $data = $movieData);
            }
        }
    }

    public function list() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->directors->insert_details(
                $_GET['id'],
                $_POST['birthday'],
                $_POST['deathday'],
                $_POST['biography'],
                $_POST['color'],
                ''
            );
            if(isset($_GET['id'])) {
                $directorID = $_GET['id'];
                $directorData = jsonify_reponse($this->directors->get($directorID));
                return $this->view('/templates/DirectorView', $data = $directorData);
            } else {
                $movieData = jsonify_reponse($this->directors->get(null));
                return $this->view('show.directors', $data = $movieData);
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if(isset($_GET['id'])) {
                $directorID = $_GET['id'];
                $directorData = jsonify_reponse($this->directors->getAll($directorID));
                return $this->view('/templates/DirectorView', $data = $directorData);
            } else {
                $movieData = jsonify_reponse($this->directors->get(null));
                return $this->view('show.directors', $data = $movieData);
            }
        }

    }

    public function find() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->directors->insert_details(
                $_GET['id'],
                $_POST['birthday'],
                $_POST['deathday'],
                $_POST['biography'],
                $_POST['color'],
                ''
            );
            if(isset($_GET['id'])) {
                $directorID = $_GET['id'];
                $directorData = jsonify_reponse($this->directors->get($directorID));
                return $this->view('/templates/DirectorView', $data = $directorData);
            } else {
                $movieData = jsonify_reponse($this->directors->get(null));
                return $this->view('show.directors', $data = $movieData);
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if(isset($_GET['id'])) {
            $directorID = $_GET['id'];
            $directorData = jsonify_reponse($this->directors->getAll($directorID));
            if($directorData) {
                return $this->view('/templates/DirectorView', $data = $directorData);
            } else {
                return $this->view('/templates/DirectorView', $data = null);
            }
        } else {
            $movieData = jsonify_reponse($this->directors->get(null));
            return $this->view('show.directors', $data = $movieData);
        }
    }
    }
}