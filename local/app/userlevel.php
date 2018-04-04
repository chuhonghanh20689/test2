<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userlevel extends Model {
	protected $table = 'userlevels';
	public function User() {
		return $this->hasMany('App\User', 'level_id');
	}
}
