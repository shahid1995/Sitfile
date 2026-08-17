<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
<h1>
	<i class="fa fa-user" aria-hidden="true"></i>  User List


</h1>

@if(Session::has('success_message'))
<div class="alert alert-success">{{ Session::get('success_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
@endif
@if(Session::has('error_message'))
<div class="alert alert-error">{{ Session::get('error_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
@endif

<div class="box">
 	<div class="box-header">

    <div class="box-tools pull-right" style="position: relative;margin-top: -5px;margin-right: -10px">
      <form method="get" style="display:inline-block;width: 260px;" action="{{ url('/admin/user/search') }}">
        <div class="input-group">
          <input name="q" value="@if(app('request')->input('q')){{ app('request')->input('q') }}@endif" class="form-control input-sm pull-right" placeholder="Search" type="text">

          <div class="input-group-btn">
            @if(app('request')->input('q'))
              <button type="button" onclick="location.href='{{ url('/admin/viewuser') }}'" title="Reset" class="btn btn-sm btn-warning"><i class="fa fa-ban"></i></button>
            @endif
            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>
      <br style="clear:both">
  </div>

  <div class="box-body table-responsive no-padding">
    <form id="form-table" method="post" action="">
    	<input name="button_name" value="" type="hidden">
    	 <input type="hidden" id="token" value="{{ csrf_token() }}">
    	<table id="table_dashboard" class="table table-hover table-striped table-bordered">
        <thead>
          <tr class="active">

            <th width="auto">
				 Name
          	</th>
          	<th width="auto">
				Age
          	</th>
			<th width="auto">
				Active Package
          	</th>
			<th width="auto">
				Package Date
          	</th>
            <th style="text-align:right" width="auto">Action</th>
          </tr>
        </thead>
		<tbody>
			@if($all_active_users && count($all_active_users))
					@foreach($all_active_users as $user)

						<tr id="{{ $user->id }}">

							 <td>{{ $user->name }}</td>
							 <td>{{ $user->age }}</td>
							  <td>{{ $user->title }}</td>
							  <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d')}}</td>
							 <td>
								<div class="button_action" style="text-align:right">
									<a href="{{ url('/admin/userDetails/'.base64_encode($user->id))}}" class="btn btn-xs btn-success btn-edit" title="View Details"><i class="fa fa-eye"></i></a>
										<a href="{{ url('/admin/createMeal/'.base64_encode($user->id))}}" class="btn btn-xs btn-success btn-edit" title="Create Meal"><i class="fa fa-cutlery"></i></a>
								</div>
							</td>
						</tr>

					@endforeach
				@else
					<tr><td colaspan="4">No records found.</td></tr>
				@endif
		</tbody>
        <tfoot>
          <tr>

            <th>Name</th>
          	<th>Age</th>
            <th>Active Package</th>
			<th>Package Date</th>
			<th></th>
          </tr>
        </tfoot>
    	</table>
	</form><!--END FORM TABLE-->
 	</div>
    {{ $all_active_users->links() }}
</div>
@push('bottom')
<script  type="text/javascript">


</script>
@endpush


@endsection
