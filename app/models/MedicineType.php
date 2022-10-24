<?php // app/models/MedicineType.php

use Illuminate\Database\Eloquent\Model as Eloquent;

class MedicineType extends Eloquent {

   // Determines which database table to use
   protected $table = 'medicine_types';

   public function users() 
   {
      return $this->hasMany('User');
   }

}