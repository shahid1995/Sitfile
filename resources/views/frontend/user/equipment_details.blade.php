@extends('layouts.userinner')
@section('title', 'Equipment Details')
@section('content')

<!--Place html here -->
<div class="col-md-9 col-sm-8 col-xs-12 col9flex gfghf">
	<div class="profile_block">
	    
		<div class="right-panel">
			<div class="logheading">
			    <a href="{{ url('user/equipment-details-create') }}" class="btn btn-primary pull-right">+ Add Equipment</a>
				<h2 class="pull-left">Equipment details</h2>
			</div>
			<div class="w-100">
			    <div class="table-responsive">
        			<table class="table table-bordered">
        				<thead>
        					<tr>
        						<th>Date of last QA test</th>
        						<th>Type of Equipment</th>
        						<th>Manufacturer</th>
        						<th>Model Name</th>
        						<th>Serial Number</th>
        						<th>Branch</th>
        						<th>Action</th>
        					</tr>
        				</thead>
        				@if(!empty($equipments))
        				<tbody>
        					@foreach($equipments as $equipment)
        					<tr>
        						<td>{{ $equipment->last_qa_test }}</td>
        						<td>{{ $equipment->machine_type }}</td>
        						<td>{{ $equipment->manufacturer }}</td>
        						<td>{{ $equipment->model }}</td>
        						<td>{{ $equipment->serial_no }}</td>
        						<td>{{ $equipment->city}} - {{ $equipment->pincode }}</td>
        						<td>
        						    <a href="{{ url('user/delete-equipment/').'/'.$equipment->id }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash"></i></a>
        						    <a href="{{ url('user/edit-equipment/').'/'.$equipment->id }}" class="btn btn-danger" ><i class="fa fa-pencil"></i></a>
        						    
        						    </td>
        					</tr>
        					@endforeach
        				</tbody>
        				@endif
        			</table>
        		</div>
            </div>
			
		</div>
	</div>
</div>

@endsection