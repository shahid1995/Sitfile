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
			<form class="c-form-wr" method="POST" action="{{url('user/equipment_update')}}/{{$equipments->id}}">
			    {{ csrf_field() }}				
				<div class="row">
					<div class="istdetails eqpdetails">
					
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Date of last QA test</label>
								<input type="date" class="form-control" name="last_qa_test" value="{{date('m/d/Y',strtotime($equipments->last_qa_test)) }}" placeholder="Date of last QA test">
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Type of Equipment</label>
								<select class="form-control" name="equipment_type" required="">
	                              @if(!empty($equipment))
	                              @foreach($equipment as $equipment)
	                                <option value="{{$equipment->id}}" @if($equipments->equipment_type == $equipment->id) selected @endif>{{$equipment->machine_type}}</option>
	                              @endforeach
	                              @endif
	                            </select>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Manufacturer</label>
								<input id="" type="text" class="form-control" name="manufacturer" value="{{$equipments->manufacturer}}" placeholder="Diagnostic Centre" required="">
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Model Name</label>
								<input id="" type="text" class="form-control" name="model" placeholder="Model Name" value="{{$equipments->model}}" required="">
							</div>
						</div>					

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Serial Number</label>
								<input type="text" class="form-control" name="serial_no" id="" placeholder="Serial Number" value="{{$equipments->serial_no}}">
							</div>
						</div>
					

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Branch</label>
								<select name="branch" class="form-control">
								    @if(!empty($branch))
								    @foreach($branch as $branch)
								    <option value="{{$branch->branch_id}}" @if($equipments->serial_no == $branch->branch_id) selected @endif>{{$branch->city}} - {{$branch->pincode}}</option>
								    @endforeach
								    @endif
								</select>
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