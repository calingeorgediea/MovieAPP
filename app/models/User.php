<?php // app/models/User.php
use Illuminate\Database\Eloquent\Model as Eloquent;
class User extends Eloquent {

   // Determines which database table to use
   protected $table = 'users';

   public function medicineType()
   {
      return $this->belongsTo('MedicineType', 'id');
   }

   public function getMyUser() {
    $user = User::find(1);
    return $user->medicine_types->name;
   }

}