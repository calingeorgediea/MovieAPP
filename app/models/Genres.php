<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;
class genres extends Eloquent {

    public $GenreID ;
    public $GenreName;
    public $timestamps = [];
    protected $fillable = [ 'GenreID', 'GenreName'];

    public function insert($genre) {
        $existent_genre = genres::where('GenreName', '=', $genre)->first();
        if ( $existent_genre !== null  ) {
            return genres::where('GenreName', '=', $genre)->pluck('genreID')->toArray()[0];
        } else {
            $new = genres::create([
                'GenreName' => $genre,
            ]);
            return($new->id);
        }
    }

    public function getGenre($id) {
        return genres::whereIn('GenreID', array($id))->get();
    }

    public function get() {
        $director = $this->with('Movie')->get();
        return $director;
    }

}

?>