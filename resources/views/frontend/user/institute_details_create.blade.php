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
			<form class="c-form-wr" method="POST" action="{{ url('user/institute-details-create')}}">		{{ csrf_field() }}
				<div class="row">
					<div class="istdetails">					
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Client Type <span style="color:red;"> <sup>*</sup></span></label>
								<select class="form-control" name="client_type" required>
	                              <option selected="" hidden="">Client Type</option>
	                              <option>Hospital / Nursing Home</option>
	                              <option>Diagnostic Centre</option>
	                              <option>Dental Centre</option>
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
								<label>Medical Establishment Name <span style="color:red;"> <sup>*</sup></span></label>
								<input type="text" class="form-control" name="medical_establishment" id="" placeholder="Medical Establishment Name" required>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>NABH/NABL Accredited?</label>
								<div class="radio_box">
									<label>
										<input type="radio" name="nabl_accredited" value="1" checked>
										<span></span>
										Yes
									</label>
									<label>
										<input type="radio" name="nabl_accredited" value="0">
										<span></span>
										No
									</label>
								</div>								
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>GSTIN (Optional)</label>
								<input type="text" name="gstin" class="form-control" value="" >
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Pin Code <span style="color:red;"> <sup>*</sup></span></label>
								<input type="text" name="pincode" class="form-control" value="700090" placeholder="Pin Code" required>
							</div>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Country<span style="color:red;"> <sup>*</sup></span></label>
								<input type="text" name="country" class="form-control" value="India" placeholder="Country" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>City<span style="color:red;"> <sup>*</sup></span></label>
								<input type="text" name="city" class="form-control" value="Kolkata" placeholder="City" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>State<span style="color:red;"> <sup>*</sup></span></label>
								<input type="text" name="state" class="form-control" value="West Bengal" placeholder="State" required>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Address<span style="color:red;"> <sup>*</sup></span></label>
								<textarea class="form-control" name="address" placeholder="Address" required></textarea>
							</div>
						</div>						

					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="submit-btn">
								<button type="submit" class="common-btn submitbtn" id="">Add branch</button>
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