@extends('layouts.userinner')
@section('title', 'Profile')
@section('content')
<?php //echo "<pre>";print_r($info);die(); ?>

<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
	<!-- <div>
		<h3><i class="{{$info->icon_class}}"></i>&nbsp;Your current Plan Details</h3>
	</div>
	<div>
		<label>Package Name</label>
		<p>{{$info->package_name}}</p>
	</div>
	<br>
	<div>
		<label>Sub Title</label>
		<p>{{$info->sub_title}}</p>
	</div>
	<br>
	<div>
		<label>Description</label>
		<p>{!!$info->description!!}</p>
	</div>
	<br/>
	<div>
		<a href="{{url('/')}}/renewpack"><button class="common-btn submitbtn">Change/Renew package</button></a>
	</div> -->
	<div class="xray_box_main">
		<div class="service_tab">				
	          <ul class="nav nav-tabs" role="tablist">
	            <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Your current Plan Details</a></li>
	            <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Change/Renew package</a></li>
	          </ul>

	          <div class="tab-content">
	            <div role="tabpanel" class="tab-pane active" id="tab1">
	            	<div class="tab-content-pnl">
	            		<div class="cplan_box">
	            			<h2>Current Plan</h2>
	            			<h3><strong>Package Name :</strong> {{ $current_plan->title  }}</h3>
	            			<!-- <h4><strong>Sub Title :</strong> Lorem Ipsum Lorem Ipsum</h4> -->
	            			<!-- <div class="descbox">
		            			<h5>Desctiption : </h5>
		            			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
	            			</div> -->
	            		</div>

	            		<div class="plan_history">
	            			<h3>Plan History</h3>
	            			<div class="plan_details_table">
	            				<div class="table-responsive">
		            				<table class="table">
		            					<thead>
			            					<tr>
			            						<th>Plan</th>
			            						<th>Price</th>
			            						<th>Start Date</th>
			            						<th>End Date</th>
			            						<th>Status</th>			            						
			            					</tr>
		            					</thead>
		            					@if(!empty($subscribed_membership))
		            					@foreach($subscribed_membership as $member)
		            					<tr class="active">
			            					<td>{{ $member->title }}</td>
			            					<td class="nowrap">INR {{ $member->price }}</td>
			            					<td class="nowrap">{{ date('d M Y', strtotime($member->start_date)) }}</td>
			            					<td class="nowrap">{{ date('d M Y', strtotime($member->end_date)) }}</td>
			            					<td>@if($member->status==1) Active @endif</td>
		            					</tr>
		            					@endforeach
		            					@endif
		            				</table>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
	            <div role="tabpanel" class="tab-pane" id="tab2">
	            	<div class="tab-content-pnl">
	            		<div class="package_block">
	            			<div class="bookcontainer">
		            			<div class="bookrow">
                                @if(!empty($membership))
                                @foreach($membership as $membership)
									<div class="bookcolumn">
										<div class="bookcolumninner">
											<!--<span class="iconcircle"><i class="ico ico-calendar"></i></span>-->
											<h3>{{ $membership->title }}</h3>
											<h4>Rental Management</h4>
											<div class="pprice"><span>INR</span> {{ $membership->price }}/-</div>
											{!! $membership->description !!}
											<div class="bookbtns">
												<a href="{{ url('subscribe-membership/'.$membership->id) }}" class="bookbtn">Subscribe <i class="ico ico-right-arrow-o"></i></a>
											</div>
										</div>
									</div>
								@endforeach
								@endif
								</div>
							</div>
	            		</div>
	            	</div>
	            </div>
	        </div>


	    </div>
	</div>

</div>

@endsection