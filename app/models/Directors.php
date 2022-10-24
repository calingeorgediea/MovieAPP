<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

class Directors extends Eloquent {

    public $DirectorID;
    public $DirectorName;

    public $timestamps = [];
    protected $fillable = [ 'DirectorID', 'DirectorName'];
    protected $table = 'Directors';
    protected $primaryKey = 'DirectorID';

    public function insert($directorName) {
        $existent_director = Directors::where('DirectorName', '=', $directorName)->first();
        if ( $existent_director !== null  ) {
            return Directors::where('DirectorName', '=', $directorName)->pluck('directorID')->toArray()[0];
        } else {
            $new = Directors::create([
                'DirectorName' => $directorName,
            ]);
            return($new->id);
        }
    }

    public function Movie() {
        return $this->hasMany(Directors::class, 'DirectorID');
    }

    public function get() {
        $movie = $this->with('Movie')->get();
        return $movie;
    }




}

?>