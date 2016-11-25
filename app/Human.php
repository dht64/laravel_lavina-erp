<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Human extends Model
{
    //
	protected $fillable = [
		'name', 'salary', 'start_day', 'birth', 'gender', 'address1', 'address2', 'phone', 'photo', 'job', 'idnum'
	];

	public function salary()
	{
		return $this->hasOne('App\Salary');
	}

	public function humanId()
	{
		return $this->id;
	}

}
