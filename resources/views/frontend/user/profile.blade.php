@extends('layouts.userinner')
@section('title', 'Profile')
@section('content')
<!--========================= profile body section start =========================-->
<?php 
if($userdata->roll_id == '1'):
 ?>

<div class="col-md-9 col-sm-8 col-xs-12 col9flex gfghf">
	<div class="profile_block">
	@if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <!-- @lang('sitelanguage.update_account_success_msg') -->

            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('error') }}
        </div>
    @endif

		<div class="right-panel">
			<div class="logheading">
				<h2>@lang('sitelanguage.editprofile')</h2>
			</div>
			<form class="c-form-wr" enctype="multipart/form-data" method="POST" action="{{ url('/user/updateprofile') }}" onsubmit="return validateForm()">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="role" value="{{ $userdata->roll_id }}">
				<div class="row">
					<div id="first-step">
					<div class="col-sm-12 col-xs-12"><h3>Step 1</h3><hr></div>
					
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>@lang('sitelanguage.first_name')</label>
							<input id="name" type="text" class="form-control" name="first_name" value="{{ (($userdata->first_name) ? $userdata->first_name : old('first_name')) }}" placeholder="First Name" required="true">
						</div>
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>@lang('sitelanguage.last_name')</label>
							<input id="name" type="text" class="form-control" name="last_name" value="{{ (($userdata->last_name) ? $userdata->last_name : old('last_name')) }}" placeholder="Last Name" required="true">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>@lang('sitelanguage.cemail')</label>
							<input id="email" type="email" class="form-control" name="email" value="{{ (($userdata->email) ? $userdata->email : old('email')) }}" placeholder="Email" readonly required>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>@lang('sitelanguage.cmobile')</label>
							<input id="phoneno" type="text" class="form-control" name="phoneno"  placeholder="Phone No" value="{{ (($userdata->phoneno) ? $userdata->phoneno : old('phoneno')) }}"  required>
						</div>
					</div>
					<!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>@lang('sitelanguage.cwhatsaap')</label>
							<input id="whatsappno" type="text" class="form-control" name="whatsappno"  placeholder="Whatsapp No" value="{{ (($userdata->phoneno) ? $userdata->phoneno : old('whatsappno')) }}" required>
						</div>
					</div> -->
					<!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>@lang('sitelanguage.cusername')</label>
							<input type="text" class="form-control" name="username" id="username" value="{{ (($userdata->email) ? $userdata->email : old('username')) }}" readonly required/>
						</div>
					</div> -->

					<!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>@lang('sitelanguage.address')</label>
							<input type="text" class="form-control" name="address" id="address" value="{{ (($userdata->address) ? $userdata->address : old('address')) }}" required/>
						</div>
					</div> -->

					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>Password (<small>Please leave blank if you don't want to change password</small>)</label>
							<input type="password" class="form-control" name="password" id="password">
						</div>
					</div>

					<?php if($userdata->profile_picture==""){ ?>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="lbl">@lang('sitelanguage.uploadimage')</label>
						<div class="fileinput">
	                    	<input id="UploadImage" type="file" class="form-control" name="user_image" >
	                    	<input type="text" class="form-control filetext">
                            <span class="filebtn">Choose File</span>
	                    </div>
					</div>
					</div>
					<?php }else{ ?>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="profileuploadimg">
							<div class="imgc">
								<img src="{{ url('/') }}/public/{{ $userdata->profile_picture }}" width="100" height="100">

								<a class="removeimg" title="delete"><i class="fa fa-pencil-square-o"  onclick="delete_user_image('{{ $userdata->profile_picture }}')"></i></a>
							</div>
							
						</div>
					</div>
					<?php } ?>

					<div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
						<div class="submit-btn">
							<button type="button" class="common-btn submitbtn" id="btn-step-1">Step 2</button>
						</div>
					</div>

					</div>
					<div id="second-step">
						<div class="col-sm-12 col-xs-12"><h3>Step 2</h3><hr></div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Customer Type</label>
								<select class="form-control" name="customer_type" required>
                                  <option selected="" hidden="">Customer Type</option>
                                  <option {{ ($userdata->customer_type=='Hospital / Nursing Home')?'selected':'' }}>Hospital / Nursing Home</option>
                                  <option {{ ($userdata->customer_type=='Diagnostic Centre')?'selected':'' }}>Diagnostic Centre</option>
                                  <option {{ ($userdata->customer_type=='Dental Centre')?'selected':'' }}>Dental Centre</option>
                                </select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Medical Establishment Name</label>
								<input type="text" name="med_estab_name" class="form-control" value="{{ $userdata->med_estab_name}}">
							</div>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Institute Name</label>
								<input type="text" name="institute_name" class="form-control" value="{{ $userdata->institute_name}}">
							</div>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Contact Person Name</label>
								<input type="text" name="contact_person_name" class="form-control" value="{{ $userdata->contact_person_name}}">
							</div>
						</div>
						
						
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>GSTIN (Optional)</label>
								<input type="text" name="gstin" class="form-control" value="{{$userdata->gst}}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Pin Code</label>
								<input type="text" name="pincode" class="form-control" value="{{ $userdata->pin_code }}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Address</label>
								<textarea class="form-control" name="address">{{ $userdata->address }}</textarea>
							</div>
						</div>
						
						
						
						
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Country</label>
								<input type="text" name="country" class="form-control" value="{{ $userdata->country }}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>State</label>
								<input type="text" name="state" class="form-control" value="{{ $userdata->state }}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>City</label>
								<input type="text" name="city" class="form-control" value="{{ $userdata->city }}">
							</div>
						</div>


						<div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
							<div class="submit-btn">
								<input class="common-btn submitbtn" type="submit" value="@lang('sitelanguage.update')" name="submit">
							</div>
							<div class="submit-btn" style="margin-right: 5px;">
								<button type="button" class="common-btn submitbtn" id="btn-step-2">Step 1</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!--Verify User Model -->
@if($userdata->status==0)
	<div class="modal fade profile-modal-body" id="profile-verify-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="width: 50%; margin: 0 auto;">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">    	
      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h2>Verify Your Account</h2>
	    </div>

	  <form action="{{ url('user/verify-account') }}" method="post" enctype="multipart/form-data">
	  	{{ csrf_field() }}
	  	<input type="hidden" name="user_id" value="{{$userdata->id}}">
      <div class="modal-body">
        <div class="profile-body_cont">
        	@if (session('success'))
		        <div class="alert alert-success alert-dismissible">
		            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		            <!-- @lang('sitelanguage.update_account_success_msg') -->

		            {{ session('success') }}
		        </div>
		    @endif
		    @if (session('error'))
		        <div class="alert alert-danger alert-dismissible">
		            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		            {{ session('error') }}
		        </div>
		    @endif
        		<div class="box_pnl_profile">
        			<div class="alert alert-danger">
        				<p>You need to submit any government issued document of institute to verify the account.</p>
        			</div>

        			<div class="form-group">
       					<label>Government issued document</label>
       					@if(!empty($errors->has('document')))
       						<span class="error-block">{{$errors->first('document')}}</span>
       					@endif
       					<input type="file" name="document" class="form-control" accept="image/*" required onchange="checkExtension(this.value);" id="resources">
       					<p id="resources_error" style="color:red;"></p>
       				</div>
        			<input type="submit" name="" value="submit" class="submitbtn profile_submitbtn">
        		</div>
        	</form>
        	</div>
        
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#profile-verify-modal').modal('show');
    });
</script>
@endif					
<?php 
elseif($userdata->roll_id == '2'):
?>
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
	<div class="profile_block">
	@if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <!-- @lang('sitelanguage.update_account_success_msg') -->

            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('error') }}
        </div>
    @endif
	    <div class="right-panel">
	    	<div class="logheading">
				<h2>@lang('sitelanguage.editprofile')</h2>
			</div>
			<form class="c-form-wr" enctype="multipart/form-data" method="POST" action="{{ url('/user/updateprofile') }}" onsubmit="return validateForm()">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="role" value="{{ $userdata->roll_id }}">
				<div class="row">
					<div id="sp-step-1">
						<div class="col-sm-12">
							<h3>Step 1</h3><hr>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Name</label>
								<input id="name" type="text" class="form-control" name="name" value="{{ (($userdata->name) ? $userdata->name : old('name')) }}" placeholder="Name" required="true">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Mobile Number</label>
								<input id="mobile_no" type="text" class="form-control" name="phoneno" value="{{ (($userdata->phoneno) ? $userdata->phoneno : old('phoneno')) }}" placeholder="Mobile Number" required="true">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Email ID</label>
								<input id="email" type="text" class="form-control" name="email" value="{{ (($userdata->email) ? $userdata->email : old('email')) }}" placeholder="Email ID" required="true">
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Password (<small>Please leave blank if you don't want to change password</small>)</label>
								<input id="password" type="password" class="form-control" name="password" placeholder="Password">
							</div>
						</div>
						<?php if($userdata->company_logo==""){ ?>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="lbl">@lang('sitelanguage.uploadimage')</label>
		                    <div class="fileinput">
		                    	<input id="UploadImage" type="file" class="form-control" name="company_logo" >
		                    	<input type="text" class="form-control filetext">
	                            <span class="filebtn">Choose File</span>
		                    </div>
						</div>
						</div>
						<?php }else{ ?>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="profileuploadimg">
								<div class="imgc">
									<img src="{{ url('/') }}/public/images/upload/service/{{ $userdata->company_logo }}" width="100" height="100">

									<a class="removeimg" title="delete"><i class="fa fa-pencil-square-o"  onclick="delete_user_image('{{ $userdata->company_logo }}')"></i></a>
								</div>
								
							</div>
						</div>
						<?php } ?>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="submit-btn">
								<button class="common-btn submitbtn" type="button" id="sp-btn-step-1">Step 2</button>
							</div>
						</div>
					</div>

					<div id="sp-step-2">
						<div class="col-sm-12">
						<h3>Step 2</h3><hr>
					</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Company/Business Name</label>
								<input id="business" type="text" class="form-control" name="business" value="{{ (($userdata->company_name) ? $userdata->company_name : old('business')) }}" placeholder="Business Name" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>GSTIN</label>
								<input id="gstin" type="text" class="form-control" name="gstin" value="{{ (($userdata->gst) ? $userdata->gst : old('gstin')) }}" placeholder="GSTIN" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Pin Code</label>
								<input id="pincode" type="text" class="form-control" name="pincode" value="{{ (($userdata->pin_code) ? $userdata->pin_code : old('pincode')) }}" placeholder="Pin Code" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Address</label>
								<input id="address" type="text" class="form-control" name="address" value="{{ (($userdata->address) ? $userdata->address : old('address')) }}" placeholder="Address" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Country</label>
								<input id="country" type="text" class="form-control" name="country" value="{{ (($userdata->country) ? $userdata->country : old('country')) }}" placeholder="Country" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>State</label>
								<input id="state" type="text" class="form-control" name="state" value="{{ (($userdata->state) ? $userdata->state : old('state')) }}" placeholder="State" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>City</label>
								<input id="city" type="text" class="form-control" name="city" value="{{ (($userdata->city) ? $userdata->city : old('city')) }}" placeholder="GSTIN" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Number of Service Engineer/RSO</label>
								<input id="number_of_service" type="text" class="form-control" name="number_of_service" value="{{ (($userdata->number_of_service) ? $userdata->number_of_service : old('number_of_service')) }}" placeholder="Number of Service" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Name of Service Engineer/RSO</label>
								<input id="name_of_serv_eng" type="text" class="form-control" name="name_of_serv_eng" value="{{ (($userdata->name_of_serv_eng) ? $userdata->name_of_serv_eng : old('name_of_serv_eng')) }}" placeholder="Number of Service" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Anything you want to say</label>
								<input id="remarks" type="text" class="form-control" name="remarks" value="{{ (($userdata->remarks) ? $userdata->remarks : old('remarks')) }}" placeholder="Anything you want to say">
							</div>
						</div>
						<div class="col-sm-12 col-xs-12">
							<div class="submit-btn">
								<button class="common-btn submitbtn" type="button" id="sp-btn-step-2">Step 1</button>
								<input class="common-btn submitbtn" type="submit" value="@lang('sitelanguage.update')" name="submit">

							</div>
						</div>


					</div>
					
					<!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>Business Location</label>
							<input id="state_city" type="text" class="form-control" name="state_city" value="{{ (($userdata->city) ? $userdata->city : old('city')) }}" placeholder="Business Location" required>
						</div>
					</div> -->
					
					<!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>@lang('sitelanguage.address')</label>
							<textarea class="form-control" name="address" id="address" required>{{ (($userdata->address) ? $userdata->address : old('address')) }}</textarea>
						</div>
					</div> -->
					<!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="description" id="description" required>{{ (($userdata->description) ? $userdata->description : old('description')) }}</textarea>
						</div>
					</div> -->
					<!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>@lang('sitelanguage.cemail')</label>
							<input id="email" type="email" class="form-control" name="email" value="{{ (($userdata->email) ? $userdata->email : old('email')) }}" placeholder="Email" readonly required>
						</div>
					</div> -->
					<!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>GST</label>
							<input id="gst" type="text" class="form-control" name="gst" value="{{ (($userdata->gst) ? $userdata->gst : old('gst')) }}" placeholder="GST" required="true">
						</div>
					</div> -->
					<!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>Website URL</label>
							<input id="website_url" type="text" class="form-control" name="website_url" value="{{ (($userdata->website_url) ? $userdata->website_url : old('website_url')) }}" placeholder="Website URL" required="true">
						</div>
					</div> -->
					<!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>Membership Package</label>
							<input id="membership_package" type="text" class="form-control" name="membership_package" value="{{ (($packageinfo->package_name) ? $packageinfo->package_name : old('membership_package')) }}" placeholder="Membership Package" readonly>
						</div>
					</div> -->
					
					
				</div>
			</form>
	    </div>
	</div>
</div>

@if($is_service_selected=='0'))
<!-- profile-my-modal -->
<div class="modal fade profile-modal-body" id="profile-my-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	
      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h2>Manage Machine & Services List</h2>
	    </div>

	  <form action="{{ url('addservices') }}" method="post">
	  	{{ csrf_field() }}
      <div class="modal-body">
        <div class="profile-body_cont">
        	@if (session('success'))
		        <div class="alert alert-success alert-dismissible">
		            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		            <!-- @lang('sitelanguage.update_account_success_msg') -->

		            {{ session('success') }}
		        </div>
		    @endif
		    @if (session('error'))
		        <div class="alert alert-danger alert-dismissible">
		            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		            {{ session('error') }}
		        </div>
		    @endif
        		<div class="box_pnl_profile">
        			<h3>Select your machine service type</h3>
        			<div class="row box_pnl_row">
        				@if(!empty($machine_types))
        				@foreach($machine_types as $machinetype)
        				<div class="col-sm-3 box_pnl_col">
        					<div class="box_pnl_in">
        						<a data-fancybox="gallery" href="{{ asset($machinetype->image) }}"><img src="{{ asset($machinetype->image) }}" width="200" height="200"></a>
        						<h4>{{ $machinetype->machine_type }}</h4>
        						<div class="checkbox">
		                  	<input type="checkbox" name="machine_type[]" value="{{ $machinetype->id }}" id="checkimg{{$machinetype->id}}">
		                  	<label for="checkimg{{$machinetype->id}}"></label>
		        				</div>
        					</div>
        				</div>
        				@endforeach
        				@endif
        			</div>
        		</div>
        		<div class="box_pnl_select">
        			<h3>Select your service type</h3>
        			<div class="box_pnl_select_inner"> 
        			@if(!empty($services))
        			@foreach($services as $service)          
        				<div class="checkbox">
		                  	<input type="checkbox" name="service[]" value="{{ $service->id }}" id="check{{$service->id}}">
		                  	<label for="check{{$service->id}}">{{ $service->service_name }}</label>
        				</div>
        			@endforeach
        			@endif
               </div>
               <input type="submit" name="" value="submit" class="submitbtn profile_submitbtn">
        		</div>
        	</div>
        
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(window).on('load',function(){
        $('#profile-my-modal').modal('show');
    });
</script>
@endif
 <?php 
endif;
  ?>

<!--========================= profile body section end =========================-->




<!-- Modal -->
  <div class="modal fade delete-modal" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
        	<i class="fa fa-exclamation" aria-hidden="true"></i>
          <p>Are you sure delete profile picture?</p>
		  		<input type="hidden" value="" id="image_path">
		  		<input type="hidden" id="role" value="">
		  		<button type="button" class="btn btn-default" id="delete_image" data-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-default" id ="delete_close" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
	
	<!------>
	<script>
var rolevar = "<?php echo $userdata->roll_id; ?>";

	function delete_user_image(image_path){
		$('#myModal').modal('show');
		
			$('#image_path').val(image_path);
			$('#role').val(rolevar);
			
		
		
	}
	$( "#delete_image" ).click(function() {
		var image_path=$('#image_path').val();
		var role_id=$('#role').val();	
				$.ajax({
					url:"{{ url('/') }}/delete_image",
							  data: {image_path: image_path,role_id: role_id, _token: '{{csrf_token()}}'},
							  type:'post',
							  success:function(res){
								 if(res.msg){
									location. reload(true); 
								 }
							  },
					}); 

	});	
	function validateForm() {
			/*var password=$('#password').val();
			var confirmed=$('#confirmed').val();
			if(password!=""){
				
				if(password!=confirmed){
					$('#error_c').empty();
					$('#error_c').append('Not match password confirm password');
					return false;
				}
			}*/
			
			return true;
			}



			var allowedExtensions = {
          '.jpg'  : 1,        
          '.jpeg'  : 1,        
          '.pdf' :1,
          '.png' :1,
        };
        function checkExtension(filename) 
        {
            var fileInput = 
                document.getElementById('resources');

            var match = /\..+$/;
            var ext = filename.match(match);
            if (allowedExtensions[ext]) 
            {
                $('#resources_error').text('');
                return true;
            } 
            else 
            {
                

                fileInput.value = '';           

                $('#resources_error').text('File must be .image  or .pdf!');
            
            //will clear the file input box.
            
            return false;
            }
        }





	</script>	
@endsection