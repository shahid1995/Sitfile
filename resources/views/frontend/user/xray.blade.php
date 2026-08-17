@extends('layouts.userinner')
@section('title', 'Profile')
@section('content')
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
<!-- 	<div>
		<table class="table">
			<tr>
				<th>Image</th>
				<th>Brand Name</th>
				<th>Model Name</th>
				<th>Model Number</th>
				<th>Price</th>
				<th>Detection Method</th>
			</tr>
			@php foreach($xray as $val): @endphp
			<tr>
				@php if($val->thumb_image): @endphp
					<td><img src="{{url('/')}}/{{$val->thumb_image}}"></td>
				@php else: @endphp
					<td><img src="{{url('/')}}/public/images/no-image.png" height="160px" width="160px"></td>
				@php endif; @endphp
				<td>{{$val->brand_title}}</td>
				<td>{{$val->model_title}}</td>
				<td>{{$val->model_number}}</td>
				<td>{{$val->price}}/-</td>
				<td>{{$val->detection_method}}</td>
			</tr>
			@php endforeach; @endphp
		</table>
	</div> -->
	<div class="xray_box_main">
	<div class="row xray_box_main_row">

		@php foreach($xray as $val): @endphp
		<div class="col-md-4 col-sm-6 col-xs-6 xray_box_main_col">
			<div class="xray_box">
				<span class="xray_box_top_img"></span>
				<a href="JavaScript:Void(0);" class="xray_box_wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a>
				<div class="xray_box_product_img">
					@php if($val->thumb_image): @endphp
					<td><img src="{{url('/')}}/{{$val->thumb_image}}"></td>
					@php else: @endphp
					<td><img src="{{url('/')}}/public/images/no-image.png" height="160px" width="160px"></td>
					@php endif; @endphp
				</div>
				<div class="xray_box_content">
					<p>Brand : <span>{{$val->brand_title}},</span></p>
					<h5><span>Model Number : </span> {{$val->model_number}},</h5>
					<div><span class="label">Price:</span><span class="val">{{$val->price}}/-</span></div>
					<a href="{{url('/')}}/user/xraydetails/{{$val->id}}" class="submitbtn xray_box_btn">details</a>
				</div>
			</div>
		</div>
		@php endforeach; @endphp

	</div>
	</div>
</div>

@endsection