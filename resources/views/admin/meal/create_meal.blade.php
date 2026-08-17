@extends('crudbooster::admin_template')
@section('content')
<div class="panel panel-default">
   <div class="panel-heading">
		<strong><i class="fa fa-glass"></i> Add Meal</strong>
	</div>
     <div class="panel-body" style="padding:20px 0px 0px 0px">
     	@if(Session::has('error_message'))
<div class="alert alert-error">{{ Session::get('error_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
@endif
          <form class="form-horizontal" method="post" id="form" enctype="multipart/form-data" action="{{ url('/admin/saveMeal') }}">
             <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="box-body" id="parent-form-area">
						<div class="form-group header-group-0 " id="form-group-title" style="">
							<label class="control-label col-sm-2">Meal Type<span class="text-danger" title="This field is required">*</span></label>
							<div class="col-sm-10">
								<select class="form-control" name="meal_type" required>
									@if($meal_types)
											@foreach($meal_types as $row1)
											<option value="{{$row1->id}}" @if($user_meal[0]->meal_type == $row1->id){{ 'selected' }}@endif>{{$row1->meal_name}}</option>
											@endforeach
											@endif
								<select>
							</div>
						</div>
						<div class="form-group header-group-0 " id="form-group-Description" style="">
							<label class="control-label col-sm-2">No Of Days <span class="text-danger" title="This field is required">*</span></label>
							<div class="col-sm-10">
								<input type="text" title="No Of Days" required="" maxlength="255" class="form-control" name="no_of_days" id="no_of_days" value="{{$user_meal[0]->no_of_days}}">
								<div class="text-danger"></div>
								<p class="help-block"></p>
							</div>
						</div>
						<div class="form-group header-group-0 " id="form-group-price" style="">
							<label class="control-label col-sm-2">Menu <span class="text-danger" title="This field is required">*</span></label>
							<div class="col-sm-10">
								 <select data-placeholder="Begin typing a name to food" multiple class="chosen-select form-control" name="food_menu[]">
											@if($food_menus)
											@foreach($food_menus as $row)
											<option value="{{$row->id}}"
												@if($food_menu)
												@for($i = 0; $i < count($food_menu); $i++)
												@if($food_menu[$i] == $row->id){{'selected'}}
												@endif
												@endfor
												@endif>{{$row->food_name}}</option>
											@endforeach
											@endif
								</select>
								<div class="text-danger">
								</div>
								<p class="help-block"></p>
							</div>
						</div>
						<input type="hidden" name="user_id" value="{{$user_id}}">
                      </div><!-- /.box-body -->

                     <div class="box-footer" style="background: #F5F5F5">
                         <div class="form-group">
                            <label class="control-label col-sm-2"></label>
								<div class="col-sm-10">
                                    <a title="Return" href="{{url('/admin/viewuser')}}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>

                                      <input type="submit" name="submit" value="Save" class="btn btn-success">
								</div>
							</div>
                        </div><!-- /.box-footer-->

                   </form>

            </div>
   </div>

@push('bottom')
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<script>
	$(".chosen-select").chosen({
	no_results_text: "Oops, nothing found!"
})
</script>

@endpush
@endsection
