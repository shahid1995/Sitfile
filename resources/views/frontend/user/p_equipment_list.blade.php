@extends('layouts.userinner')
@section('title', 'Equipment Details')
@section('content')

<!--Place html here -->
<div class="col-md-9 col-sm-8 col-xs-12 col9flex gfghf">
	<div class="profile_block">
	    
		<div class="right-panel">
			<div class="logheading">
			    <a href="{{ url('user/equipment-price-create') }}" class="btn btn-primary pull-right">+ Add Equipment</a>
				<h2 class="pull-left">Equipment details</h2>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Service</th>
						<th>Type of Equipment</th>
						<th>Price</th>
					</tr>
				</thead>
				@if(!empty($p_equipments))
				<tbody>
					@foreach($p_equipments as $equipment)
					<tr>
						<td>{{ $equipment->service_name }}</td>
						<td>{{ $equipment->machine_type }}</td>
						<td>{{ $equipment->price }}</td>
						
						<td>
						    <a href="{{ url('user/p-delete-equipment/').'/'.$equipment->id }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash"></i></a>
						    <!--<a href="{{ url('user/edit-equipment/').'/'.$equipment->id }}" class="btn btn-danger" ><i class="fa fa-pencil"></i></a>-->
						    
						    </td>
					</tr>
					@endforeach
				</tbody>
				@endif
			</table>
			
		</div>
	</div>
</div>

@endsection