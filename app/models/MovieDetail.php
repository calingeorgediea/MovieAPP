<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;
class moviedetail extends Eloquent {

    public $movieID;
    public $movieTitle;
    public $movieRating;
    public $movieDescription;
    public $timestamps = [];
    protected $fillable = [ 'MovieTitle', 'MovieRating', 'MovieDescription'];

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