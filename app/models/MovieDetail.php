<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class moviedetail extends Eloquent
{

    public $movieID;
    public $movieTitle;
    public $movieRating;
    public $imageURL;
    public $movieDescription;
    public $timestamps = [];
    protected $fillable = ['MovieTitle', 'MovieRating', 'MovieDescription', 'Image'];

    public function search($input) {
        $results = $this
        ->where('MovieTitle', 'LIKE', '%'.$input.'%')
        ->get();

        $subset = $results->map->only(['MovieTitle', 'MovieID']);


        return $subset;
    }
    public function insert($MovieTitle, $MovieRating, $MovieDescription, $ImageURL)
    {
        $new = moviedetail::create(
            [
                'MovieTitle' => $MovieTitle,
                'MovieRating' => $MovieRating,
                'MovieDescription' => $MovieDescription,
                'Image' => $ImageURL
            ]
        );
        return ($new->id);
    }

}

?>