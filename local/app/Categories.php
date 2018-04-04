<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {
	protected $table = 'categories';
	public function Product() {
		return $this->hasMany('App\Product', 'cat_id');
	}
	public function cat_add() {
		return $this->belongsTo('App\User', 'created_by');
	}
	public function cat_edit() {
		return $this->belongsTo('App\User', 'updated_by');
	}
}
