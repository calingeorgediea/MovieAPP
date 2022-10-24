<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
class Movie extends Eloquent {

    protected $primaryKey = 'MovieID';
    public $movieId;
    public $genreID;
    public $DirectorID;
    public $timestamps = [];
    protected $fillable = ['MovieID', 'GenreID', 'DirectorID'];
    protected $table = 'movies';

    public function insert($detailsID,$genreID,$directorID) {
        $new = movie::create([
            'MovieID' => $detailsID,
            'GenreID' => $genreID,
            'DirectorID' => $directorID,
        ]);
    }

    public function moviedetails() {
        return $this->hasOne(moviedetail::class, 'MovieID');
    }

    public function directors() {
        return $this->hasOne(Directors::class, 'DirectorID');
    }

    public function getMovies() {
        $movie = $this->with('moviedetails')->get();
        return $movie;
    }

}

?>