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
        $this->directordetails = $this->model('DirectorDetail');
        $this->user = $this->model('User');
        $this->requestBody = jsonify_reponse(file_get_contents('php://input'));
    }

    public function movieview() {
        $movieID = $_GET['id'];
        $movieData = jsonify_reponse($this->Movie->get($movieID))[0];
        return $this->view('/templates/MovieView', $data = $movieData);
    }

    public function directors() {
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
            $name = isset($_POST['directorname']) ?   $_POST['directorname']  : NULL;
            if ( $_POST['title'] && $_POST['genre'] && $_POST['rating'] && $_POST['directorname'] && $_POST['moviedescription'] ) {

                $directorID = $this->directors->insert($_POST['directorname']);

                $genreID = $this->genres->insert($_POST['genre']);
                if($_FILES["fileToUpload"]["name"]) {
                    $fullPath = dir(getcwd())->path;
                    $target_dir = $fullPath."\uploads\\";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $x = $_FILES["fileToUpload"]["name"];
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                      echo "File is an image - " . $check["mime"] . ".";
                      $uploadOk = 1;
                    } else {
                      echo "File is not an image.";
                      $uploadOk = 0;
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["fileToUpload"]["size"] > 5000000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    }

                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } else {
                        $x = $_FILES['image']['error'];
                        if (copy($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                        } else {
                        echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }
                $detailsID = $this->moviedetails->insert(
                    $_POST['title'],
                    $_POST['rating'],
                    $_POST['moviedescription'],
                    $_FILES["fileToUpload"]["name"]
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