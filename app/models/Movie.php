<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
class movie extends Eloquent {

    public $movieId;
    public $genreID;
    public $DirectorID;
    protected $primaryKey = 'MovieID';
    public $timestamps = [];
    protected $fillable = ['MovieID', 'GenreID', 'DirectorID'];

    public function insert($detailsID,$genreID,$directorID) {
        $new = movie::create([
            'MovieID' => $detailsID,
            'GenreID' => $genreID,
            'DirectorID' => $directorID,
        ]);
    }
    public function getList() {
        return Movie::whereIn('MovieID', array(72))->get();
    }
}

?>