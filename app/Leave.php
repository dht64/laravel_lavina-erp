<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    //
    protected $fillable = [
    	'human_id', 'annual_leave', 'sick_leave', 'maternity_leave', 'avai_annual_leave', 'avai_sick_leave', 'avai_maternity_leave', 'unpaid_leave'
    ];

    public function human(){
    	return $this->belongsTo('App\Human');
    }
}
