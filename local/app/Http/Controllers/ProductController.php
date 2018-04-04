<?php

namespace App\Http\Controllers;
use App\Categories;
use App\Product;
use Auth;
use File;
use Illuminate\Http\Request;

class ProductController extends Controller {
	public function get_categories() {
		if (Auth::user()->level_id < 3) {
			$cat = Categories::paginate(5);
			return view('backend.category', compact('cat'));
		} else {
			return redirect('login')->with('error_level', 'Bạn chưa được phân quyền để truy cập vào trang này');
		}

	}
	public function post_add_categories(request $request) {
		if (Auth::user()->level_id == 1) {
			$this->validate($request,
				[
					'cat_name' => 'required|unique:categories,cat_name',
				],
				[
					'cat_name.required' => 'Vui lòng nhập tên danh mục sản phẩm',
					'cat_name.unique' => 'Tên danh mục sản phẩm vừa nhập đã tồn tại',
				]
			);
			$cat = new Categories;
			$cat->cat_name = $request->cat_name;
			$cat->created_by = Auth::user()->id;
			$cat->save();
			return back()->with('success_add_cat', 'Danh mục sản phẩm đã được thêm thành công');
		} else {
			return back()->with('error_level', 'Bạn chưa được phân quyền để truy cập vào trang này');
		}
	}
	public function get_cat_edit($id) {
		$cat = Categories::find($id);
		return view('backend.editcategory', compact('cat'));

	}
	public function post_cat_edit(request $request, $id) {
		if (Auth::user()->level_id == 1) {
			$this->validate($request,
				[
					'cat_name' => 'required|unique:categories,cat_name,' . $id,
				],
				[
					'cat_name.required' => 'Vui lòng nhập tên danh mục sản phẩm',
					'cat_name.unique' => 'Tên danh mục sản phẩm vừa nhập đã tồn tại',
				]
			);
			$cat = Categories::find($id);
			$cat->cat_name = $request->cat_name;
			$cat->updated_by = Auth::user()->id;
			$cat->save();
			return redirect('category')->with('success_edit_cat', 'Danh mục đã được sửa thành công');
		} else {
			return back()->with('error_level', 'Bạn chưa được phân quyền để sử dụng chức năng này');
		}

	}
	public function cat_del(request $request, $id) {
		$cat_del = Categories::find($id);
		$cat_del->delete();
		return back()->with('success_del_cat', 'Danh mục đã được xóa thành công');
	}
	public function get_pro_add() {
		$cat = Categories::all();
		return view('backend.addproduct', compact('cat'));
	}
	public function post_pro_add(request $request) {
		$this->validate($request,
			[
				'pro_name' => 'unique:product,pro_name',
				'img' => 'image',
			],
			[
				'pro_name.unique' => 'Tên sản phẩm vừa nhập đã tồn tại',
				'img.image' => 'Ảnh sản phẩm cần có định dạng ảnh',

			]);
		$pro = new Product;
		$pro->pro_name = $request->pro_name;
		$pro->pro_price = $request->pro_price;
		$img = $request->file('img');
		$name = $img->getClientOriginalName();
		$name = str_random(5) . '-' . $name;
		$img->move('public/Product_upload/', $name);
		$pro->img = $name;
		$pro->accessories = $request->accessories;
		$pro->warranty = $request->warranty;
		$pro->promotion = $request->promotion;
		$pro->condition = $request->condition;
		$pro->des = $request->des;
		$pro->cat_id = $request->cat_id;
		$pro->total_qtt = $request->total_qtt;
		$pro->remaining_qtt = $request->total_qtt;
		$pro->hot = $request->hot;
		$pro->created_by = Auth::user()->id;
		$pro->save();
		return redirect('product')->with('success_add_pro', 'Sản phẩm mới đã được thêm thành công');

	}
	public function get_pro_list() {
		if (Auth::user()->level_id < 3) {
			$product = Product::orderBy('created_at', 'desc')->paginate(2);
			return view('backend.product', compact('product'));
		} else {
			return redirect('login')->with('error_level', 'Bạn chưa được phân quyền sử dụng chức năng này');
		}
	}
	public function get_pro_edit($id) {
		$product = Product::find($id);
		$cat = Categories::all();
		return view('backend.editproduct', compact('product', 'cat'));
	}
	public function post_pro_edit(request $request, $id) {
		$this->validate($request,
			[
				'pro_name' => 'unique:product,pro_name,' . $id,
				'img' => 'image',
			],
			[
				'pro_name.unique' => 'Tên sản phẩm vừa nhập đã tồn tại',
				'img.image' => 'Ảnh sản phẩm cần có định dạng ảnh',

			]);
		$pro = Product::find($id);
		$pro->pro_name = $request->pro_name;
		$pro->pro_price = $request->pro_price;
		$current_pic = 'public/Product_upload/' . $pro->img;
		if ($request->hasFile('img')) {
			if (File::exists($current_pic)) {
				File::delete($current_pic);
				$img = $request->file('img');
				$name = $img->getClientOriginalName();
				$name = str_random(5) . '-' . $name;
				$img->move('public/Product_upload/', $name);
				$pro->img = $name;
			}
		}
		$pro->accessories = $request->accessories;
		$pro->warranty = $request->warranty;
		$pro->promotion = $request->promotion;
		$pro->condition = $request->condition;
		$pro->des = $request->des;
		$pro->cat_id = $request->cat_id;
		$pro->total_qtt = $request->total_qtt;
		$pro->remaining_qtt = $request->remaining_qtt;
		$pro->hot = $request->hot;
		$pro->updated_by = Auth::user()->id;
		$pro->save();
		return redirect('product')->with('success_edit_pro', 'Sản phẩm đã được sửa thành công');
	}
	public function pro_del($id) {
		$pro = Product::find($id);
		$current_pic = 'public/Product_upload/' . $pro->img;
		File::delete($current_pic);
		$pro->delete();
		return back()->with('success_del_pro', 'Sản phẩm đã được xóa thành công');
	}

}
