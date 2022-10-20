<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

class directors extends Eloquent {

    public $DirectorID;
    public $DirectorName;

    public $timestamps = [];
    protected $fillable = [ 'DirectorID', 'DirectorName'];

    public function insert($directorName) {
        $existent_director = directors::where('DirectorName', '=', $directorName)->first();
        if ( $existent_director !== null  ) {
            return directors::where('DirectorName', '=', $directorName)->pluck('directorID')->toArray()[0];
        } else {
            $new = directors::create([
                'DirectorName' => $directorName,
            ]);
            return($new->id);
        }
    }

    public function getDirector($id) {
        return directors::whereIn('DirectorID', array($id))->get();
    }
}

?>