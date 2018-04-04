<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'level_id', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	public function UserLevel() {
		return $this->belongsTo('App\userlevel', 'level_id');
	}
	public function pro_add() {
		return $this->hasMany('App\Product', 'created_by');
	}
	public function pro_edit() {
		return $this->hasMany('App\Product', 'updated_by');
	}
	public function cat_add() {
		return $this->hasMany('App\Categories', 'created_by');
	}
	public function cat_edit() {
		return $this->hasMany('App\Categories', 'updated_by');
	}
	public function post() {
		return $this->hasMany('App\Post', 'user_id');
	}
	public function order() {
		return $this->hasMany('App\order', 'cus_id');
	}
}
