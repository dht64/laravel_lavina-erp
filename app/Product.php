<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    public function unit()
    {
    	return $this->belongsTo('App\Unit');
    }

    public function material()
    {
    	return $this->belongsTo('App\Material');
    }

}
