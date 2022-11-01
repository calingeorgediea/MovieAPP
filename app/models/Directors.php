<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

class Directors extends Eloquent {
    public $movieID;
    public $DirectorID;
    public $DirectorName;

    public $timestamps = [];
    protected $fillable = [ 'DirectorID', 'DirectorName'];
    protected $table = 'directors';

    public function insert($directorName) {
        $existent_director = Directors::where('DirectorName', '=', $directorName)->first();
        if ( $existent_director !== null  ) {
            $existent_director;
            return Directors::where('DirectorName', '=', $directorName)->pluck('directorID')->toArray()[0];
        } else {
            $new = Directors::create([
                'DirectorName' => $directorName,
            ]);
            $new->id;
            return $new->id;
        }
    }

    public function get($directorID) {
        if(!isset($directorID)) {
            return $this->all();
        } else {
        $result = Directors::where('DirectorID', '=', $directorID)->first();
        return $result;
        }
    }

}

?>