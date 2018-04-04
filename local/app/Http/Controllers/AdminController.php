<?php

namespace App\Http\Controllers;
use App\Categories;
use App\Post;
use App\Product;
use App\User;

class AdminController extends Controller {
	public function get_admin() {
		$pro = Product::all()->count();
		$cat = Categories::all()->count();
		$post = Post::all()->count();
		$user = User::all()->count();
		return view('backend.admin', compact('pro', 'cat', 'post', 'user'));
	}
}
