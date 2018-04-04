<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller {
	public function get_login() {
		if (Auth::check()) {
			if (Auth::user()->level_id < 3) {
				return redirect('admin');
			} else {
				return back()->with('error_level', 'Bạn chưa được phân quyền để truy cập vào trang này');
			}
		} else {
			return view('backend.login');
		}
	}
	public function post_login(request $request) {
		$login1 = [
			'email' => $request->email,
			'password' => $request->password,
			'level_id' => 1,
		];
		$login2 = [
			'email' => $request->email,
			'password' => $request->password,
			'level_id' => 2,
		];

		if (Auth::attempt($login1) or Auth::attempt($login2)) {
			$response = new Response;
			$timelive = 10000;
			$response->withCookie('email', $request->email, $timelive);
			$response->withCookie('password', $request->password, $timelive);
			return redirect('admin');
		} else {
			return back()->with('error_login', 'Sai email đăng nhập hoặc mật khẩu');
		}
	}
	public function logout() {
		Auth::logout();
		return redirect('login');
	}
}
