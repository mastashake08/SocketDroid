<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    protected $guarded = [];
    public function user(){
      return $this->belongsTo('App\User');
    }
    public function texts(){
      return $this->hasMany('App\Text');
    }
}
