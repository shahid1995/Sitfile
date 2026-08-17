@extends('layouts.inner')
@section('title', 'Profile')
@section('content')
<!--========================= login body section start =========================-->
<div class="container">
	<div class="right_aftr_lgin_frm_bg">

		<div class="row">
			<div class="col-sm-12">
				<div class="aftr_lgin_frm_sec food_allergy_user">
					<div class="row">
						@if(Session::has('success_message'))
            <div class="alert alert-success">{{ Session::get('success_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            @endif
            	@if(Session::has('error_message'))
            <div class="alert alert-danger">{{ Session::get('error_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            @endif
                <div class="head-title-name">
        					<h3 class="page-heading">Food Allergy List </h3>
                  <button class="btn btn-success btn-add pull-right" onclick="open_allergy_modal()">Add Allergy Item</button>
                </div>  
                <div class="table-section">
        						<table class="table">
                      <thead>
                        <tr>
                          <th>Sl No</th>
                          <th>Food Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@if($allergy_list)
                      	@foreach($allergy_list as $key=>$row)
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{{$row->name}}</td>
                          <td><a href="{{ url('/user/deleteallergy') }}/{{$row->id}}" class="btn btn-danger" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                        	<td></td>
                          <td>{{'No Data Found'}}</td>
                        </tr>
                        @endif
                    </tbody>
                    </table>
                </div>  
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="allergy-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form class="form-horizontal" method="post" action="{{ url('/user/saveallergyfood') }}">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Allergy Food</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			 <input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="col-md-12">
				<input type="text" name="food_name" placeholder="Food Name" required="" class="form-control">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success pull-right">Add</button>
      </div>
    </div>
</form>

  </div>
</div>

<script type="text/javascript">
	function open_allergy_modal()
	{
		$('#allergy-modal').modal('show');
	}
</script>

@endsection
