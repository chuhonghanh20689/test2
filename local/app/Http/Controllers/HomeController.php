<?php

namespace App\Http\Controllers;
use App\Categories;
use App\order;
use App\orderdetail;
use App\Post;
use App\Product;
use App\User;
use Auth;
use Cart;
use Illuminate\Http\Request;
use Mail;

class HomeController extends Controller {
	public function get_home() {
		$cat = Categories::all();
		$pro_new = Product::orderBy('created_at', 'desc')->paginate(8);
		return view('frontend.home', compact('cat', 'pro_new'));
	}
	public function get_cat($cat_id) {
		$cat = Categories::find($cat_id)->Product()->orderBy('created_at', 'desc')->paginate(8);
		$cat_name = Categories::find($cat_id);
		$cat_all = Categories::all();
		return view('frontend.category', compact('cat', 'cat_name', 'cat_all'));
	}
	public function get_pro(request $request, $pro_id) {
		$pro = Product::find($pro_id);
		$cat_all = Categories::all();
		$post_per_pro = Product::find($pro_id)->Post()->orderBy('created_at', 'desc')->paginate(10);
		return view('frontend.details', compact('pro', 'cat_all', 'post_per_pro'));
	}
	public function get_post(request $request, $pro_id) {

		$post = new Post;
		$post->pro_id = $pro_id;
		if (Auth::user()->id) {
			$post->user_id = Auth::user()->id;
			$post->post_name = Auth::user()->name;
			$post->post_email = Auth::user()->email;
		} else {
			$post->post_name = $request->name;
			$post->post_email = $request->email;
		}

		$post->content = $request->content;
		$post->save();

		return back()->with('success_post', 'Bạn đã bình luận thành công');

	}
	public function get_frontend_login(request $request) {
		return view('frontend.login');
	}
	public function post_frontend_login(request $request) {
		$login = [
			'email' => $request->email,
			'password' => $request->password,
		];
		if (Auth::attempt($login)) {
			return redirect('frontend')->with('success_login', 'Bạn đã đăng nhập thành công');
		} else {
			return back()->with('error_login', 'Sai tên đăng nhập hoặc mật khẩu');
		}
	}
	public function get_frontend_signup(request $request) {
		return view('frontend.signup');
	}
	public function post_frontend_signup(request $request) {
		$this->validate($request,
			[
				'email' => 'unique:users,email',
				'password' => 'min:6',
				're_password' => 'same:password',
			],
			[
				'email.unique' => "Email bạn vừa nhập đã tồn tại",
				'password.min' => "Mật khẩu phải chứa ít nhất 6 ký tự",
				're_password.same' => "Mật khẩu phải trùng khớp",
			]);
		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->level_id = 3;
		$user->phone = $request->phone;
		$user->address = $request->address;
		$user->save();
		$login = [
			'email' => $request->email,
			'password' => $request->password,
		];
		if (Auth::attempt($login)) {
			return redirect('frontend')->with('success_signup', 'Bạn đã đăng ký thành công');
		}
	}
	public function get_cart() {
		$cart = Cart::content();
		$cart_count = $cart->count();
		$total_price = 0;
		foreach ($cart as $list) {
			$total_price += $list->subtotal;
		}

		$pro = Product::all();

		return view('frontend.cart', compact('cart', 'pro', 'updated_qty', 'total_price', 'cart_count'))->with('total_price', $total_price);
	}
	public function add_cart($pro_id) {
		$pro = Product::find($pro_id);
		Cart::add(['id' => $pro_id, 'name' => $pro->pro_name, 'price' => $pro->pro_price, 'qty' => 1, 'options' => ['img' => $pro->img]]);

		return redirect('frontend/cart');
	}
	public function update_cart($rowId, $qty) {

		Cart::update($rowId, $qty);

		$data['total'] = Cart::total() . 'đ';
		$data['cart_update'] = Cart::get($rowId);
		$data['sub_total'] = number_format($data['cart_update']->subtotal) . 'đ';

		$json = json_encode($data);
		return $json;

	}
	public function remove_one_cart($rowId) {

		Cart::remove($rowId);

		return redirect('frontend/cart');
	}
	public function remove_all_cart() {
		$cart = Cart::content();
		foreach ($cart as $list) {
			Cart::remove($list->rowId);
		}

		return redirect('frontend/cart');
	}

	public function postEmail(request $request) {
		$cart = Cart::content();
		$order = new order;
		$order->cus_email = $request->email;
		$order->cus_name = $request->name;
		$order->cus_phone = $request->phone;
		$order->cus_phone = $request->add;

		$total_price = 0;
		foreach ($cart as $list) {
			$total_price += ($list->qty * $list->price);
		}
		$order->total_price = $total_price;
		$order->total_items = Cart::content()->count();
		$order->save();
		$ord_id = $order->id;

		foreach ($cart as $list) {
			$orderdetail = new orderdetail;
			$orderdetail->ord_id = $ord_id;
			$orderdetail->pro_id = $list->id;
			$orderdetail->pro_name = $list->name;
			$orderdetail->pro_price = $list->price;
			$orderdetail->qty = $list->qty;
			$orderdetail->total_price = $list->price * $list->qty;
			$orderdetail->save();
			$pro = Product::find($list->id);
			$sum_qtt = orderdetail::where('pro_id', $list->id)->sum('qty');
			$pro->remaining_qtt = $pro->total_qtt - $sum_qtt;
			$pro->save();
		}
		$data = [
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'add' => $request->add,
			'cart' => Cart::content(),
			'total' => Cart::total(),

		];
		$email = $request->email;
		$name = $request->name;
		$mail = Mail::send('frontend.email', $data, function ($m) use ($email, $name) {
			$m->from('sellphonemart.contact@gmail.com', 'sellphoneMart');
			$m->to($email, $name)->subject('sellphoneMart Xác nhận đặt hàng');
		});

		return redirect('frontend/finish');
	}
	// public function getEmail() {
	// 	return view('frontend.email');
	// }
	public function get_finish() {

		$cart = Cart::content();
		foreach ($cart as $list) {
			Cart::remove($list->rowId);
		}
		return view('frontend.hoanthanh');
	}

}
