<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Order extends Model
{
    //
    public function user() {
    	return $this->belongsTo('App\User');    
    }

    public function customer() {
    	return $this->belongsTo('App\Customer');    
    }
	    
	public function product() {
    	return $this->belongsTo('App\Product');    
    }  

    public function getDeliveryAtAttribute($value)
    {
        return Carbon::parse($value, 'Asia/Ho_Chi_Minh');
    }
}
