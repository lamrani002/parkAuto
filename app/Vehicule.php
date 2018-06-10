<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    public function missions(){
      return $this->hasMany('App\Mission');
    }
}
