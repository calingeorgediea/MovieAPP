<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

class Movie extends Eloquent {
    public $movieTitle;
    public $movieId;
    public $movieGenre;
    public $movieRelaseDate;

    public $timestamps = [];
    protected $fillable = ['movieTitle','movieGenre', 'movieRelaseDate'];

    public function insertMovie($movieTitle,$movieGenre,$movieRelaseDate) {
        Movie::create([
            'movieTitle' => $movieTitle,
            'movieGenre' => $movieGenre,
            'movieRelaseDate' => $movieRelaseDate,
        ]);
    }
}

?>