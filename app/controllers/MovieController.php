<?php
use Carbon\Carbon;

class MovieController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->Movie = $this->model('Movie');
        $this->moviedetails = $this->model('moviedetail');
        $this->genres = $this->model('genres');
        $this->directors = $this->model('Directors');
        $this->directordetails = $this->model('DirectorDetail');
        $this->user = $this->model('User');
        $this->API = $this->model('api');
        $this->requestBody = jsonify_reponse(file_get_contents('php://input'));
    }

    public function filter()
    {
        $filters = get_query_strings();
        var_dump($filters);

    }

    public function index()
    {
        if (isset($_GET['id'])) {
            $movieID = $_GET['id'];
            try {
                if (sizeof($this->Movie->get($movieID)) > 0) {
                    $movieData = jsonify_reponse($this->Movie->get($movieID))[0];
                } else {
                    throw new Exception('Movie not found');
                }
            } catch (Exception $e) {
                $movieData = null;
            }
            if ($movieData) {
                return $this->view('/templates/MovieView', $data = $movieData);
            } else {
                return $this->view('/templates/error');
            }
        } else {
            $list = jsonify_reponse($this->Movie->getMovies());
            return $this->view('show.movies', $data = $list);
        }
    }

    function update_on_api()
    {
        $title = $_GET["title"];
        // PATCH is used to update an existing entity with new information.
        if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
            $movie_details = new API_movie($title);
            $movie_details = $movie_details->response();

            $this->moviedetails::where('MovieID', '=', $this->requestBody)->update(
                [
                    'MovieTitle' => $movie_details->title,
                    'API_movie_rating' => $movie_details->rating,
                    'API_movie_image' => $movie_details->API_movie_image,
                    'MovieDescription' => $movie_details->plot,
                    'relase_date' => $movie_details->relase_date,
                    'api_fetched' => 1,
                    // "api_overview_fullresponse" => $movie_details->full_overview,
                    // "api_cast_fullresponse" => $movie_details->full_cast,

                ]
            );
            $directorID = $this->directors->insert($movie_details->director);
            $directorID;
            $this->Movie::where('MovieID', '=', $this->requestBody)->update(
                [
                    'DirectorID' => $directorID
                ]
            );
        }
    }
    function update_rating()
    {
        $movieID = $_GET["movieid"];
        $newRating = $this->requestBody;
        // PATCH is used to update an existing entity with new information.
        if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
            $this->moviedetails::where('MovieID', '=', $movieID)->update(['MovieRating' => $newRating]);
        }
    }

    public function delete()
    {
        $this->Movie::destroy($this->requestBody);
        $this->moviedetails::destroy($this->requestBody);
        return "200";
        // response in http
    }

    public function add()
    {
        /** POST */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $title = $_POST['title'] ? $_POST['title'] : 'unknown_title';
            $moviedescription = $_POST['moviedescription'] ? $_POST['moviedescription'] : "";
            $directorname = $_POST['directorname'] ? $_POST['directorname'] : 'unknown_director';
            $genre = $_POST['genre'] ? $_POST['genre'] : "unknown_genre";
            $rating = $_POST['rating'] ? $_POST['rating'] : "unknown_rating";


            $directorID = $this->directors->insert($directorname);
            $genreID = $this->genres->insert($genre);

            if ($_FILES["fileToUpload"]["name"]) {
                $fullPath = dir(getcwd())->path;
                $target_dir = $fullPath . "\uploads\\";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $x = $_FILES["fileToUpload"]["name"];
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
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
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    $x = $_FILES['image']['error'];
                    if (copy($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }

            }
            $detailsID = $this->moviedetails->insert(
                $title,
                $rating,
                $moviedescription,
                $_FILES["fileToUpload"]["name"] ?? null
            );

            $this->Movie->insert(
                $detailsID,
                $genreID,
                $directorID
            );
            return $detailsID;
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            return $this->view('get.movies', '');
        }
    }
}