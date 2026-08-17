
	<div class="leftprofile_bg">
		<div class="left-panel">
			<div class="user-sec">
				@if($data['userleft']->roll_id == 1)
				<div class="userimg">
					@if($data['userleft']->profile_picture)
					<img src="{{ url('/') }}/public/{{ $data['userleft']->profile_picture }}" alt="{{ $data['userleft']->name }}" />
					@else
					<img src="{{ url('/public/images/no-image.png') }}" alt="User Image" />
					@endif
					<a class="uploadimage" data-toggle="modal" data-target="#upload-profile-image"><i class="fa fa-pencil-square-o"></i></a>
				</div>
				<h3>{{ $data['userleft']->name }}</h3>
				@elseif($data['userleft']->roll_id == 2)
				<div class="userimg">
					@if($data['userleft']->company_logo)
					<img src="{{ url('/') }}/public/images/upload/service/{{ $data['userleft']->company_logo }}" alt="Service Image"  style="height: 100%;width: 100%;"/>
					@else
					<img src="{{ url('/public/images/no-image.png') }}" alt="User Image" />
					@endif
				</div>
				<h3>{{ $data['userleft']->business_details }}</h3>
				@endif;
				<h4>
					@if($data['userleft']->roll_id ==1) Customer Dashboard @else Service Provider Dashboard @endif
				</h4>
				<h5>{{ $data['userleft']->email }}</h5>
			</div>
			<div class="usernav">
				<ul class="afterloginnav">
					<?php   $segment =request()->segment(2);   ?>

					<li id="dashboard-nav">
						<a href="{{url('user/dashboard')}}"><i class="fa fa-tachometer"></i>Dashboard</a>
						<!--<ul id="dashboard-nav-list">-->
					 <!--       <li><a href="{{ url('/user/qa-expiration') }}">QA Expiration </a></li>-->
					 <!--       <li><a href="#">Details of the Equipment </a></li>-->
					 <!--       <li><a href="#">Profile Completion </a></li>-->
					 <!--       <li><a href="#">Service Engineer Arrival Time </a></li>-->
					 <!--       <li><a href="#">Account Status</a></li>-->
					 <!--   </ul>-->
					</li>
					<!-- <li class="@if($segment =='changepass') active @endif"><a href="{{ url('/changepass') }}"><i class="fa fa-key"></i>Change Password</a></li>
					<li class="@if($segment =='profile') active @endif"><a href="{{ url('/user/profile') }}"><i class="fa fa-user-o"></i>@lang('sitelanguage.editprofile')</a></li>
					@if($data['userleft']->roll_id ==1)

					<li class="@if($segment =='xray') active @endif"><a href="{{ url('/') }}/user/xray"><i class="fa fa-list"></i>X-Ray MachineList</a></li> -->
					<li class=""><a href="{{ url('/user/myorders') }}"><i class="fa fa-list"></i> My Orders</a></li>
					<li id="request-service"><a href="{{url('user/new-order')}}"><i class="fa fa-list"></i>Request Service </a>
						<ul id="request-service-nav">
							<li><a href="{{url('user/active-offer')}}">Active Offer </a></li>
							<li><a href="{{ url('user/expired-offer') }}">Withdrawn/Expired  </a></li>
						</ul>
					</li>
					<!--<li><a href="#"><i class="fa fa-list"></i>Subscription </a></li>-->
					<li id="setting-nav"><a href="#"><i class="fa fa-list"></i>Settings </a>
						<ul id="setting-nav-list">
							<li><a href="{{ url('/user/institute-details') }}">Institute Details</a></li>
							<li><a href="{{ url('user/equipment-details') }}">Equipment Details</a></li>
							<li><a href="{{ url('user/account-info') }}">Account Info </a></li>
						</ul>
					</li>
					<!-- <li><a href="#"><i class="fa fa-list"></i>Community</a></li> -->
					<li><a href="https://www.awzonex.com/blog/"><i class="fa fa-list"></i>Blog</a></li>
					<!-- <li class="@if($segment =='requestaquote') active @endif"><a href="{{ url('/user/requestaquote') }}"><i class="fa fa-file-text-o"></i>Post new quote</a></li>
					<li class="@if($segment =='requestajob') active @endif"><a href="{{ url('/user/requestajob') }}"><i class="fa fa-file-text-o"></i>Post new Job</a></li>
					<li class="@if($segment =='managejob') active @endif"><a href="{{ url('/user/managejob') }}"><i class="fa fa-file-text-o"></i>View & Manage Jobs</a></li>
					<li class="@if($segment =='quotelist' || $segment =='receivequotelist') active @endif"><a href="{{ url('/') }}/user/quotelist"><i class="fa fa-file-text-o"></i> Quote List </a></li> -->

					@elseif($data['userleft']->roll_id ==2)
					<!-- <li class="@if($segment =='quoterequetlist') active @endif"><a href="{{ url('/') }}/user/quoterequetlist"><i class="fa fa-file-text-o"></i> Quote Requests </a></li>

					<li class="@if($segment =='truck-driver') active @endif"><a href="{{ url('/') }}/user/truck-driver"><i class="fa fa-file-text-o"></i> Create Truck Driver </a></li> -->
					<!--<li class=""><a href="{{ ($data['userleft']->is_service_selected=='1')? url('/renew'):'javascript:void(0)' }}"><i class="fa fa-repeat"></i>Renew Membership</a></li>-->
					<li class="@if($segment =='servicerequest') active @endif">
					    <a href="{{ ($data['userleft']->is_service_selected=='1')? url('/user/servicerequest_new'):'javascript:void(0)' }}">	<i class="fa fa-get-pocket"></i>Service Request</a>
					    <ul @if($segment =='servicerequest_new' || $segment =='servicerequest_completed' || $segment =='servicerequest_expired') style="display:block;" @endif>
					        <li><a href="{{ url('/user/servicerequest_new') }}">New</a></li>
					        <li><a href="{{ url('/user/servicerequest_completed') }}">Completed</a></li>
					        <li><a href="{{ url('/user/servicerequest_expired') }}">Declined/ Expired</a></li>
					    </ul>
					</li>
					<li>
					    <a href="{{ url('/user/servicerequest_active') }}"><i class="fa fa-file-text"></i>Bidding</a>
					    <ul @if($segment =='servicerequest_active' || $segment =='servicerequest_won' || $segment =='servicerequest_lost') style="display:block;" @endif>
					        <li><a href="{{ url('/user/servicerequest_active') }}">Active</a></li>
					        <li><a href="{{ url('/user/servicerequest_won') }}">Won</a></li>
					        <li><a href="{{ url('/user/servicerequest_lost') }}">Lost</a></li>
					    </ul>
					</li>
					<!--<li class="@if($segment =='manageservices') active @endif"><a href="{{ ($data['userleft']->is_service_selected=='1')? url('/user/manageservices'):'javascript:void(0)' }}"><i class="fa fa-get-pocket"></i>Manage Services</a></li>-->
					<li class="@if($segment =='manageproject') active @endif"><a href="{{url('/user/manageproject')}}"><i class="fa fa-briefcase"></i>Manage Project</a></li>
					<!--<li class=""><a href="javascript:void(0);"><i class="fa fa-file-text-o"></i>Payment Reports</a></li>-->
					<!--<li class=""><a href="{{url('myoders')}}"><i class="fa fa-file-text-o"></i>My Oders</a></li>-->
					<li>
					    <a href="{{ url('/user/profile_setting') }}"><i class="fa fa-file-text"></i>Account Setting</a>
					    <ul @if($segment =='profile_setting' || $segment =='service_pricing' || $segment =='service_area' || $segment=='bank_account_details') style="display:block;" @endif>
					        <li><a href="{{ url('/user/profile_setting') }}">Profile Setting</a></li>
					        <!--<li><a href="{{ url('/user/service_pricing') }}">Services & Pricing</a></li>-->
					        <li><a href="{{ url('/user/manageservices') }}">List of Services</a></li>
					        <li><a href="{{ url('/user/equipment-list') }}">List of Equipment Modality</a></li>
					        <li><a href="{{ url('/user/bank_account_details') }}">Bank Account Details</a></li>
					    </ul>
					</li>
					@endif
					<li><a href="{{ url('/') }}/logout"><i class="fa fa-sign-out"></i>@lang('sitelanguage.logout')</a></li>
				</ul>
			</div>
		</div>
	</div>



<!-- Modal -->
<div id="upload-profile-image" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Profile Image</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('user/update-profile-image') }}" method="post" enctype="multipart/form-data">
        	<label>Upload</label>
        	{{ csrf_field() }}
        	<div class="form-group">
        		<input type="file" name="profile_image" required>
        	</div>
        	<div class="form-group">
        		<input type="submit" class="common-btn submitbtn" value="Save">
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>