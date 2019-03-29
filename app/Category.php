<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
// use App\Posts;

class Category extends Model
{
    protected $table = 'category';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function posts() {
        return $this->hasMany('App\Posts');
    }

    
}
