<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<base href="{{asset('/')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vietpro Shop - Email</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/details.css">
	<link rel="stylesheet" href="css/email.css">
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
	<!-- header -->

	<!-- end header -->
	<!-- wrap -->
	<div id="wrap" class="container">

		<div class="row">

			<div id="wrap-inner" class="col-md-9">
				<div class="row list-product">
					<div class="col-md-12">
						<div class="clearfix"></div>
						<h3>Thông tin khách hàng</h3>
						<p>
							<span class="info">Khách hàng: </span>
							{{$name}}
						</p>
						<p>
							<span class="info">Email: </span>
							{{$email}}
						</p>
						<p>
							<span class="info">Điện thoại: </span>
							{{$phone}}
						</p>
						<p>
							<span class="info">Địa chỉ: </span>
							{{$add}}
						</p>
					</div>
					<div class="col-md-12">
						<div class="clearfix"></div>
						<h3>Hóa đơn mua hàng</h3>
						<table class="table-striped table-responsive col-md-12">
							<tr class="bold">
								<td width="30%">Tên sản phẩm</td>
								<td width="25%">Giá (VNĐ)</td>
								<td width="15%">Số lượng</td>
								<td width="30%">Thành tiền (VNĐ)</td>
							</tr>
							@foreach($cart as $list)
							<tr>
								<td>{{$list->name}}</td>
								<td class="price">{{number_format($list->price)}}</td>
								<td class="text-center">{{$list->qty}}</td>
								<td class="price">{{number_format($list->subtotal)}}</td>
							</tr>
							@endforeach
							<tr>
								<td colspan="3">Tổng tiền:</td>
								<td class="total-price">{{$total}}</td>
							</tr>
						</table>
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
</body>
</html>