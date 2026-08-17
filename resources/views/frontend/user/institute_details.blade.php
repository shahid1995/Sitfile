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
				<a href="{{ url('user/institute-details-create') }}" class="btn btn-primary pull-right">+ Add Branch</a>
				<h2 class="pull-left">Institute details</h2>
			</div>
			<div class="w-100">
			    <div class="table-responsive">
        			<table class="table table-bordered">
        				<thead>
        					<tr>
        						<th>Medical Establishment Name</th>
        						<th>Address</th>
        						<th>City</th>
        						<th>Pin Code</th>
        						<!--<th>Diagnostic Centre</th>
        						<th>Dental Centre</th>-->
        						<th>Action</th>
        					</tr>
        				</thead>
        				@if(!empty($institute_details))
        				<tbody>
        					@foreach($institute_details as $branch)
        					<tr>
        						<td>{{ $branch->medical_establishment }}</td>
        						<td>{{ $branch->address }}</td>
        						<td>{{ $branch->city }}</td>
        						<td>{{ $branch->pincode }}</td>
        						<!--<td>{{ $branch->hospital }}</td>
        						<td>{{ $branch->diagnostic_centre }}</td>
        						<td>{{ $branch->dental_centre }}</td>-->
        						<td>
        						    <a href="{{ url('user/delete-institute/').'/'.$branch->branch_id }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash"></i></a>
        						    <a href="{{ url('user/edit-institute/').'/'.$branch->branch_id }}" class="btn btn-danger" ><i class="fa fa-pencil"></i></a>
        						
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