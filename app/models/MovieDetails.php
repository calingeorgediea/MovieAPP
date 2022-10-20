<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;
class moviedetails extends Eloquent {

    public $movieId;
    public $movieTitle;
    public $movieRating;
    public $movieDescription;

    public $timestamps = [];
    protected $fillable = [ 'MovieTitle', 'MovieRating', 'MovieDescription'];
    public function getList($id) {
        return moviedetails::whereIn('MovieID', array($id))->get();
    }

    public function insert($MovieTitle,$MovieRating,$MovieDescription) {
        $new = moviedetails::create([
            'MovieTitle' => $MovieTitle,
            'MovieRating' => $MovieRating,
            'MovieDescription'=> $MovieDescription,
        ]);
        return($new->id);
    }

}

?>