@extends('layouts.userinner')
@section('title', 'Profile')
@section('content')

<?php //echo "<pre>";print_r($info);die(); ?>
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
	<div class="profile_block package_table">
	<div class="table-responsive">
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Sub Title</th>
				<th>Price</th>
				<th>Action</th>
			</tr>
		@php
			foreach($info as $package):
		@endphp
			<tr>
				<td><i class="{{$package->icon_class}}"></i>&nbsp;{{$package->package_name}}</td>
				<td>{!!$package->description!!}</td>
				<td>{{$package->sub_title}}</td>
				<td>INR {{$package->price}}/-</td>
				<td><a href="#"><button class="submitbtn package_table_btn">Choose</button></a></td>
			</tr>
		@php
			endforeach;
		@endphp
		</table>
	</div>
	</div>
</div>

@endsection