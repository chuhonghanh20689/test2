<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	protected $table = 'posts';
	public function User() {
		return $this->belongsTo('App\User', 'user_id');
	}
	public function Product() {
		return $this->belongsTo('App\Product', 'pro_id');
	}
}
