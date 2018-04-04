<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
	protected $table = 'product';
	public function Categories() {
		return $this->belongsTo('App\Categories', 'cat_id');
	}
	public function pro_add() {
		return $this->belongsTo('App\User', 'created_by');
	}
	public function pro_edit() {
		return $this->belongsTo('App\User', 'updated_by');
	}
	public function Post() {
		return $this->hasMany('App\Post', 'pro_id');
	}
}
