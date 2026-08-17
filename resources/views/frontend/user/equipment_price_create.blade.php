@extends('layouts.userinner')
@section('title', 'Equipment Details')
@section('content')

<!--Place html here -->
<div class="col-md-9 col-sm-8 col-xs-12 col9flex gfghf">
	<div class="profile_block">
	    
		<div class="right-panel">
			<div class="logheading">
				<h2>Equipment details</h2>
			</div>
			<form class="c-form-wr" method="POST" action="{{url('user/equipment-price-create')}}">
			    {{ csrf_field() }}				
				<div class="row">
					<div class="istdetails eqpdetails">
					
						

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Type of Services</label>
								<select class="form-control" name="service" required="">
	                              @if(!empty($services))
	                              @foreach($services as $services_data)
	                                <option value="{{$services_data->id}}">{{$services_data->service_name}}</option>
	                              @endforeach
	                              @endif
	                            </select>
							</div>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Type of Equipment</label>
								<select class="form-control" name="equipment_type" required="">
	                              @if(!empty($equipment))
	                              @foreach($equipment as $equipment)
	                                <option value="{{$equipment->id}}">{{$equipment->machine_type}}</option>
	                              @endforeach
	                              @endif
	                            </select>
							</div>
						</div>

						

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Price</label>
								<input id="" type="text" class="form-control" name="price" placeholder="Price" value="" required="">
							</div>
						</div>					

						
					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="submit-btn">
								<button type="submit" class="common-btn submitbtn" id="">Submit</button>
							</div>
						</div>

					</div>					
				</div>
			</form>
		</div>
	</div>
</div>

@endsection