
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<base href="{{asset('/')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vietpro Shop - Details</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/details.css">

</head>
<body>
	<!-- header -->
	<div id="header" class="row">
		<div class="container">
			<div id="logo" class="col-xs-6 col-sm-6 col-md-3 text-center">
				<h1>
					<a href="{{asset('frontend')}}"><img src="img/home/logo.png"></a>
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
					<a class="display" href="{{asset('frontend/cart')}}">Giỏ hàng</a>
					<a href="{{asset('frontend/cart')}}">0</a>
				</div>
				<div id="cart" class="col-md-3 col-md-offset-2 text-center">
					{{-- {{Auth::user()->id}} --}}
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
						@foreach($cat_all as $list)
						<li><a href="frontend/category/{{$list->id}}">{{$list->cat_name}}</a></li>
						@endforeach
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
						<h3>{{$pro->pro_name}}</h3>
						<div id="product-img" class="col-xs-12 col-sm-12 col-md-3 text-center">
							<img class="img-responsive" src="{{asset('public/product_upload/'.$pro->img)}}">
						</div>
						<div id="product-details" class="col-xs-12 col-sm-12 col-md-9">
							<p>Giá: <span class="price">{{$pro->pro_price}}</span></p>
							<p>Bảo hành: {{$pro->warranty}} tháng</p>
							<p>Phụ kiện: {{$pro->accessories}}</p>
							<p>Tình trạng: {{$pro->condition}}</p>
							<p>Khuyến mại: {{$pro->promotion}}</p>
							<p>Còn hàng: @if($pro->remaining_qtt>0) {{'Còn hàng'}} @else {{'hết hàng'}} @endif</p>
							<p class="add-cart text-center"><a href="{{asset('frontend/cart_process/add/'.$pro->id)}}">Đặt hàng online</a></p>
						</div>
					</div>
				</div>
				<div class="row list-product">
					<div class="col-md-12">
						<h3>Chi tiết sản phẩm</h3>
						<p class="text-justify">{!!$pro->des!!}</p>
					</div>
				</div>
				<div class="row list-product">
					<div class="col-md-12">
						<h3>Bình luận</h3>
						<div> @include('errors.note') </div>
						<p><a href="{{asset('frontend/login')}}" id="detail_login">Đăng nhập để bình luận</a></p>
						<div class="col-md-9 comment">
							<form method="post">
							{{csrf_field()}}
								<div class="form-group">
									<label for="email">Email:</label>
									<input required name="post_email" type="email" class="form-control" id="email" value="{{-- @if(Auth::user()->id){{Auth::user()->email}}@endif --}}">
								</div>
								<div class="form-group">
									<label for="name">Tên:</label>
									<input required type="text" class="form-control" name="post_name" value="{{-- @if(Auth::user()->id){{Auth::user()->name}}@endif --}}">
								</div>
								<div class="form-group">
									<label for="cm">Bình luận:</label>
									<textarea required rows="10" id="cm" class="form-control" name="content"></textarea>
								</div>
								<div class="form-group text-right">
									<button type="submit" class="btn btn-default" >Gửi</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row list-product">
					<div class="col-md-12 comment-list">
						<div class="col-md-9 comment">

						@foreach($post_per_pro as $list)
							<ul>
								<li class="com-title">
									{{$list->post_name}}
									<br>
									<span>{{$list->created_at}}</span>
								</li>
								<li class="com-details">
									{{$list->content}}
								</li>
							</ul>
						@endforeach
						{{$post_per_pro->links()}}
						</div>

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
							<a href="{{asset('frontend')}}"><img src="img/home/logo.png"></a>
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
	{{-- <div class="modal fade" id="login">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Đăng nhập</h4>
					<a href="{{asset('frontend/signup')}}"><h5 class="modal-title">Đăng ký để trở thành thành viên</h5></a>
				</div>
				<div class="modal-body">
							<form role="form" method="post" id="form_login">
							{{csrf_field()}}

								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Password" name="password" type="password" value="">
									</div>

								</fieldset>

								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Đăng nhập</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Không, cảm ơn!</button>
								</div>
							</form>
				</div>
			</div>
		</div>
	</div> --}}
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	{{-- <script type="text/javascript" charset="utf-8" async defer>
	$('#detail_login').click(function(e){
		e.preventDefault();
		var href=$(this).attr('href');
		$('#login').modal('show');
		var formData = $('form#form_login').serialize();
	});

	</script> --}}
</body>
</html>