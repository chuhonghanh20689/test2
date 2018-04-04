<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model {
	protected $table = 'orders';
	protected $guard = '';
	public function orderdetail() {
		return $this->hasMany('App\orderdetail', 'ord_id');
	}
	public function User() {
		return $this->belongsTo('App\User', 'cus_id');
	}
}
