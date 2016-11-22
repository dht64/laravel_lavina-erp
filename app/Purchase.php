<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    public function material()
    {
    	return $this->belongsTo('App\Material');
    }

    public function supplier()
    {
    	return $this->belongsTo('App\Supplier');
    }
}
