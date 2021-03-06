
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<base href="{{asset('/')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vietpro Shop - Cart</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/cart.css">
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
</head>
<body>
	<!-- header -->
	<div id="header" class="row">
		<div class="container">
			<div id="logo" class="col-xs-6 col-sm-6 col-md-3 text-center">
				<h1>
					<a href="#"><img src="img/home/logo.png"></a>
				</h1>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-9">
		    	<div id="search-bar" class="col-md-6 col-md-offset-1">
			        <form class="navbar-form" role="search">
				        <div class="input-group">
				        	<div class="input-group-btn">
				            	<input type="text" class="form-control" placeholder="Search" name="q">
				            </div>
				            <div class="input-group-btn">
				                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				            </div>
				        </div>
        			</form>
				</div>
				<div id="cart" class="col-md-3 col-md-offset-2 text-center">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				    </button>
					<a class="display" href="#">Giỏ hàng</a>
					<a href="#" >{{$cart_count}}</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->
	<!-- wrap -->
	<div id="wrap" class="container">
		<div class="row">
			<div id="menu" class="col-md-3">
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav">
						<li>Danh mục sản phẩm</li>
						<li><a href="#">iPhone</a></li>
						<li><a href="#">Samsung</a></li>
						<li><a href="#">Sony</a></li>
						<li><a href="#">HTC</a></li>
						<li><a href="#">LG</a></li>
						<li><a href="#">OPPO</a></li>
						<li><a href="#">Blackbery</a></li>
					</ul>
				</div>
			</div>
			<div id="slide" class="col-md-9">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" role="listbox">
					    <div class="item active">
					      <img src="img/home/slide.jpg" alt="Chania">
					    </div>

					    <div class="item">
					      <img src="img/home/slide2.jpg" alt="Chania">
					    </div>

					    <div class="item">
					      <img src="img/home/slide3.jpg" alt="Flower">
					    </div>
				  	</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div id="v-banner" class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-3 col-md-offset-0 text-center">
				<img src="img/home/v-banner1.jpg">
				<img src="img/home/v-banner2.jpg">
				<img src="img/home/v-banner3.jpg">
				<img src="img/home/v-banner4.jpg">
				<img src="img/home/v-banner5.jpg">
				<img src="img/home/v-banner6.jpg">
				<img src="img/home/v-banner7.jpg">
			</div>
			<div id="wrap-inner" class="col-md-9">
				<div class="row list-product">
					<div class="col-md-12">
						<div class="clearfix"></div>
						<h3>Giỏ hàng</h3>

							<table class="table table-bordered .table-responsive text-center" id="table">
								<tr class="active">
									<td width="11.111%">Ảnh mô tả</td>
									<td width="22.222%">Tên sản phẩm</td>
									<td width="22.222%">Số lượng</td>
									<td width="16.6665%">Đơn giá</td>
									<td width="16.6665%">Thành tiền</td>
									<td width="11.112%">Xóa</td>
								</tr>

								@foreach($cart as $list)
								<tr>
									<td><img class="img-responsive" src="{{asset('public/product_upload/'.$list->options->img)}}"></td>

									<td>{{$list->name}}</td>
									<td>
										<div class="form-group">
											<input class="form-control updated_qty" type="number" name="qty" value="{{$list->qty}}" data-id="{{$list->rowId}}"  onchange="updateCart('{{$list->rowId}}',this.value)">
										</div>
								</td>
									<td><span class="price">{{number_format($list->price)}}</span></td>
									<td><span class="price total_price_item" id="{{$list->rowId}}">{{number_format($list->subtotal)}}</span></td>
									<td><a href="{{asset('frontend/cart_process/remove_one/'.$list->rowId)}}"><span class="glyphicon glyphicon-remove"></span></a></td>
								</tr>
								@endforeach
							</table>
							<div class="row" id="total-price">
								<div class="col-md-12">
									Tổng thanh toán: <span class="total-price">{{Cart::total()}}</span>
									<a href="{{asset('frontend')}}"><button class="my-btn btn">Mua tiếp</button></a>

									<a href="{{asset('frontend/cart_process/remove_all')}}"><button class="my-btn btn">Xóa giỏ hàng</button></a>
								</div>
							</div>

					</div>
				</div>
				<div class="row list-product">
					<div class="col-md-9">
						<h3>Xác nhận mua hàng</h3>
							<form method="post" action="{{asset('frontend/mail')}}">
							{{csrf_field()}}
								<div class="form-group">
									<label for="email">Email address:</label>
									<input required type="email" class="form-control" name="email">
								</div>
								<div class="form-group">
									<label for="name">Họ và tên:</label>
									<input required type="text" class="form-control" name="name">
								</div>
								<div class="form-group">
									<label for="phone">Số điện thoại:</label>
									<input required type="number" class="form-control" name="phone">
								</div>
								<div class="form-group">
									<label for="add">Địa chỉ:</label>
									<input required type="text" class="form-control" name="add">
								</div>
								<div class="form-group text-right">
									<button type="submit" class="btn btn-default">Thực hiện đơn hàng</button>
								</div>
							</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrap -->
	<!-- footer -->
	<div id="footer" class="row">
		<div id="top-footer">
			<div class="container">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div id="footer-logo" class="col-xs-8 col-sm-12 col-md-6 text-center">
						<h1>
							<a href="#"><img src="img/home/logo.png"></a>
						</h1>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6">
						<h3>About us</h3>
						<p class="text-justify">Vietpro Academy thành lập năm 2009. Chúng tôi đào tạo chuyên sâu trong 2 lĩnh vực là Lập trình Website & Mobile nhằm cung cấp cho thị trường CNTT Việt Nam những lập trình viên thực sự chất lượng, có khả năng làm việc độc lập, cũng như Team Work ở mọi môi trường đòi hỏi sự chuyên nghiệp cao.</p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="col-xs-12 col-sm-12 col-md-6">
						<h3>Hot Line</h3>
						<p>Phone Sale: (+84) 0988 550 553</p>
						<p>Email: sirtuanhoang@gmail.com</p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6">
						<h3>Contact Us</h3>
						<p>Address 1: B8A Võ Văn Dũng - Hoàng Cầu Đống Đa - Hà Nội</p>
						<p>Address 2: Số 25 Ngõ 178/71 - Tây Sơn Đống Đa - Hà Nội</p>
					</div>
				</div>
			</div>
		<div id="bot-footer">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 text-center">
						<p>Học viện Công nghệ Vietpro - www.vietpro.edu.vn</p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 text-center">
					<p>
						<span>© 2017 Vietpro Academy. All Rights Reserved</span>
						<a href="#"><span class="glyphicon glyphicon-chevron-up"></span></a>
					</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->
	<script  type="text/javascript" charset="utf-8" async defer>
	// $('.updated_qty').change(function(e){
	// 	e.preventDefault();
	// 	var href=$('#form_updated_qty').attr('action');

	// 	var id = $(this).attr('data-id');
	// 	var qty = $('input#'+id).val();



	// 	$.ajax({
	// 	url:href,
	// 	type:'GET',
	// 	data:{qty:qty},

	// 	success:function(){

	// 		$('#total-price').load(location.href + " #total-price>*","");
	// 		$('#'+id).load(location.href + "#"+id);

	// 	}
	// });
	// })
	// $('.updated_qty').trigger('change');

	function updateCart(rowId,qty){
			$.get(
			 	"{{asset('frontend/cart_process/update')}}"+'/'+rowId+'/'+qty,
			 	{
        			rowId: rowId,
        			qty: qty
    			},
			 	function(result){
			 		var result = JSON.parse(result);
			 		$('#'+rowId).html(result.sub_total);
			 		$('.total-price').html(result.total);
    			}
    		);
		}
	</script>
</body>
</html>