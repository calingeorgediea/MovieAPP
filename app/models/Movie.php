<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
class Movie extends Eloquent {

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

    public function Directors() {
        return $this->belongsTo('directors', 'DirectorID');
    }

    protected $primaryKey = 'DirectorID';

    public function get() {
        $movie = Movie::all();
        return $movie;
    }

    public function moviedetails():hasOne {
        return $this->hasOne(MovieDetails::class, 'MovieID');
    }

    public function find() {
        print_r(movie::find(72));
    }
}

?>