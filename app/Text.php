<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    //
    public $guarded = [];
    public function device(){
      return $this->belongsTo('App\Device');
    }
}
