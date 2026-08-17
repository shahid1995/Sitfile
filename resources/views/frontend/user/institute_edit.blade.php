@extends('layouts.userinner')
@section('title', 'Institute Details')
@section('content')

<div class="col-md-9 col-sm-8 col-xs-12 col9flex gfghf">
	<div class="profile_block">
		@if (session('success'))
	        <div class="alert alert-success alert-dismissible">
	            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
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
				<h2>Institute details</h2>
			</div>
			<form class="c-form-wr" method="POST" action="{{ url('user/institute_update')}}/{{$institute_details->branch_id}}">		
			{{ csrf_field() }}
				<div class="row">
					<div class="istdetails">					
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Client Type<span style="color:red;"> <sup>*</sup></span></label>
								<select class="form-control" name="client_type" required>
	                              <option selected="" hidden="">Client Type</option>
	                              <option value="Hospital / Nursing Home" @if($institute_details->client_type=='Hospital / Nursing Home') selected @endif> Hospital / Nursing Home</option>
	                              <option value="Diagnostic Centre" @if($institute_details->client_type=='Diagnostic Centre') selected @endif>Diagnostic Centre</option>
	                              <option value="Dental Centre" @if($institute_details->client_type=='Dental Centre') selected @endif>Dental Centre</option>
	                            </select>
							</div>
						</div>
					
						<!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Hospital / Nursing Home</label>
								<input id="" type="text" class="form-control" name="hospital_name" value="" placeholder="Hospital / Nursing Home" required="true">
							</div>
						</div>-->

						<!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Diagnostic Centre</label>
								<input id="" type="text" class="form-control" name="diagnostic_centre" value="" placeholder="Diagnostic Centre" required="">
							</div>
						</div>-->

						<!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Dental Centre</label>
								<input id="" type="text" class="form-control" name="dental_care" placeholder="Dental Centre " value="" required>
							</div>
						</div>-->					

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Medical Establishment Name<span style="color:red;"> <sup>*</sup></span></label>
								<input type="text" class="form-control" name="medical_establishment" value="{{$institute_details->medical_establishment}}" id="" placeholder="Medical Establishment Name" required>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>NABH/NABL Accredited?<span style="color:red;"> <sup>*</sup></span></label>
								<div class="radio_box">
									<label>
										<input type="radio" name="nabl_accredited" value="1" @if($institute_details->nabl_accredited==1) checked @endif>
										<span></span>
										Yes
									</label>
									<label>
										<input type="radio" name="nabl_accredited" value="0" @if($institute_details->nabl_accredited==0) checked @endif>
										<span></span>
										No
									</label>
								</div>								
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>GSTIN (Optional)</label>
								<input type="text" name="gstin" class="form-control" value="{{$institute_details->gstin}}" >
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Pin Code<span style="color:red;"> <sup>*</sup></span></label>
								<input type="text" name="pincode" class="form-control" value="{{$institute_details->pincode}}" placeholder="Pin Code" required>
							</div>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Country<span style="color:red;"> <sup>*</sup></span></label>
								<input type="text" name="country" class="form-control" value="{{$institute_details->country}}" placeholder="Country" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>City<span style="color:red;"> <sup>*</sup></span></label>
								<input type="text" name="city" class="form-control" value="{{$institute_details->city}}" placeholder="City" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>State<span style="color:red;"> <sup>*</sup></span></label>
								<input type="text" name="state" class="form-control" value="{{$institute_details->state}}" placeholder="State" required>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Address<span style="color:red;"> <sup>*</sup></span></label>
								<textarea class="form-control" name="address" placeholder="Address" required> {{$institute_details->address}} </textarea>
							</div>
						</div>						

					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="submit-btn">
								<button type="submit" class="common-btn submitbtn" id="">Edit branch</button>
								<a href="{{ url('user/institute-details') }}" class="btn btn-danger">Cancel</a>
							</div>
						</div>

					</div>					
				</div>
			</form>
		</div>
	</div>
</div>

@endsection