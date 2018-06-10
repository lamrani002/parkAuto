<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{

    protected $fillable = [
      'destination',
      'description',
      'date_depart',
      'date_arrive',
      'validation',
    ];


  public function users(){
    return $this->belongsTo('App\User');
  }
  public function vehicules(){
    return $this->belongsTo('App\vehicule');
  }

}
