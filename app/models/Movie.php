<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
class Movie extends Eloquent {

    protected $primaryKey = 'MovieID';
    public $movieID;
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

    public function get($movieID) {
        $movie = $this->find($movieID)->with(['moviedetails','directors'])->get();
        return $movie;
    }

    public function moviedetails() {
        return $this->hasOne(moviedetail::class, 'MovieID', 'MovieID');
    }

    public function directors() {
        return $this->hasOne(Directors::class, 'DirectorID','DirectorID');
    }

    public function getMovies() {
        $movie = $this->with(['moviedetails'])->get();
        return $movie;
    }

}

?>