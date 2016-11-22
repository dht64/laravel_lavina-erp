<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //
    protected $fillable = [
    	'human_id', 'basic_salary', 'nondeduct_leave', 'deduct_leave', 'change', 'dates', 'total' 
    ];

    public function human(){
    	return $this->belongsTo('App\Human');
    }
}
