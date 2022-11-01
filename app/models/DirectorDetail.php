<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

class DirectorDetail extends Eloquent {
    public $movieID;
    public $DirectorID;
    public $DirectorName;

    public $timestamps = [];
    protected $fillable = [ 'DirectorID', 'color', 'birthday', 'biography', 'deathday', 'image'];
    protected $table = 'directordetails';

    public function insert($directorID,$color,$birthday,$biography,$deathday,$image) {
        $new = DirectorDetail::create([
            'DirectorID' => $directorID,
            'color' => $color,
            'birthday' => $birthday,
            'biography' => $biography,
            'deathday' => $deathday,
            'image' => $image
        ]);
    }

}

?>