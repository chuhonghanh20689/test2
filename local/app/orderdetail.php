<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderdetail extends Model {
	protected $table = 'orderdetails';
	protected $guard = '';
	public function order() {
		return $this->belongsTo('App\order', 'ord_id');
	}
	public function Product() {
		return $this->belongsTo('App\Product', 'pro_id');
	}
}
