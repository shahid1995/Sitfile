@extends('crudbooster::admin_template')
@section('content')
<div>
	<a title="Return" href="{{url('/admin/viewuser')}}"><i class="fa fa-chevron-circle-left "></i>
                        &nbsp; Back To User</a>
</div>
<div class="panel panel-default">
   <div class="panel-heading">
       <strong><i class="fa fa-glass"></i> User Details</strong>
  </div>
   <div class="panel-body" style="padding:20px 0px 0px 0px">
      <form class="form-horizontal" method="post" id="form" enctype="multipart/form-data" action="#">
      
     <div class="row">
     	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	      <div class="box-body" id="parent-form-area">
				  <h3>Personal Information</h3>
			      <div class="table-responsive">
							<table id="table-detail" class="table table-striped table-bordered tablefirst">
								<tbody>
									<tr>
											<td>Name</td>
											<td>{{$users_details->name}}</td>
									</tr>   
									<tr> 
											<td>Emails</td>
											<td>{{$users_details->email}}</td>
									</tr>   
									<tr>
										<td>Phone No</td>
										<td>{{$users_details->phoneno}}</td>
									</tr>  
									<tr>
										<td>Age</td>
										<td>{{$users_details->age}}</td>
									</tr> 
									<tr>
										<td>Gender</td>
										<td>{{$users_details->gender}}</td>
									</tr> 
									<tr>
										<td> Health Details</td>
										<td class="health-details-an">{{$users_details->health_details}}</td>
									</tr> 
								</tbody>
							</table>
				  </div>                                           
		  </div>
		</div>  
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	    <div class="box-body" id="parent-form-area">
	    	<h3>Selected Package Information</h3>
	      <div class="table-responsive">
					<table id="table-detail" class="table table-striped table-bordered tablefirst">
						<tbody>
							<tr>
									<td>Package Name</td>
									<td>{{$users_details->title}}</td>
							</tr>   
							<tr>
									<td>Paid Package Amount</td>
									<td>{{$users_details->price}}</td>
									
							</tr> 
							<tr>
									<td>Paid Package Date</td>
									<td>{{$users_details->created_at}}</td>	
							</tr> 
							<tr>
									<td>Package Duration</td>
									<td>{{$users_details->duration}}</td>	
								</tr> 	
						</tbody>
					</table>
				</div>                                           
		</div> 
	</div>
</div>


		@if(count($food_allergies)>0)

		<div class="box-body" id="parent-form-area">
	    	<h3>User Food Allergies</h3>
	      <div class="table-responsive">
					<table id="table-detail" class="table table-striped table-bordered tablefirst">
						<tbody>
						@foreach($food_allergies as $allergie)
							<tr>
									<td>Name</td>
									<td>{{$allergie->name}}</td>
							</tr>   
						@endforeach	
						</tbody>
					</table>
				</div>                                           
		</div>

	@endif	
	</form>

	</div>
  </div>














@endsection