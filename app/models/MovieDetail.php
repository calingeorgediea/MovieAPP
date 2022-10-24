<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;
class moviedetail extends Eloquent {

    public $movieId;
    public $movieTitle;
    public $movieRating;
    public $movieDescription;

    public $timestamps = [];
    protected $fillable = [ 'MovieTitle', 'MovieRating', 'MovieDescription'];

    public function get() {
        return moviedetails::whereIn('MovieID', '77')->get();
    }

    public function insert($MovieTitle,$MovieRating,$MovieDescription) {
        $new = moviedetail::create([
            'MovieTitle' => $MovieTitle,
            'MovieRating' => $MovieRating,
            'MovieDescription'=> $MovieDescription,
        ]);
        return($new->id);
    }

}

?>