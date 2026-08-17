@extends('layouts.userinner')
@section('title', 'Profile')
@section('content')
<!--========================= profile body section start =========================-->	
	                
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">

	@if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            @lang('sitelanguage.update_account_success_msg')
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('error') }}
        </div>
    @endif

	<div class="right-panel">
		<div class="heading-title">
			<h2><!-- @lang('sitelanguage.editprofile') -->Post a new Job</h2>
		</div>
		<form class="c-form-wr" enctype="multipart/form-data" method="POST" action="{{ url('user/requestajob') }}" onsubmit="return validateForm()">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label>Title<span>*</span></label>
						@if ($errors->has('job_title'))
                            <span class="error-block">
                              <strong>{{ $errors->first('job_title') }}</strong>
                            </span>
                        @endif
						<input type="text" name="job_title" class="form-control" placeholder="Enter job title" @if(!empty($joblist->job_title)) value="{{$joblist->job_title}}" @endif @if(empty($joblist-job_title)) value="{{old('job_title')}}" @endif>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label>X-ray Machine<span>*</span></label>
						@if ($errors->has('xray_mechine'))
                            <span class="error-block">
                              <strong>{{ $errors->first('xray_mechine') }}</strong>
                            </span>
                        @endif
						<select class="form-control selectpicker" name="xray_mechine[]" class="form-control" id="xray_mechine" required="true" multiple="true" data-live-search="true">
							<option value="" disabled="disabled">Select X-ray Machine</option>
							@if($xray_list)
							@foreach($xray_list as $xray)
							<option value="{{ $xray->id }}">{{ $xray->model_title }}</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label>Job Description<span>*</span></label>
						@if ($errors->has('dscription'))
                            <span class="error-block">
                              <strong>{{ $errors->first('dscription') }}</strong>
                            </span>
                        @endif
						<input type="text" name="dscription" class="form-control" placeholder="Job Description" @if(!empty($joblist->job_title)) value="{{$joblist->job_description}}" @endif @if(empty($joblist-job_title)) value="{{old('dscription')}}" @endif>
					</div>
				</div>

				<!-- shipping from -->
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label>Select Contry<span>*</span></label>
						@if ($errors->has('country_id'))
                            <span class="error-block">
                              <strong>{{ $errors->first('country_id') }}</strong>
                            </span>
                        @endif
						<select class="form-control" name="country_id" class="country" id="country_id" required="true">
							<option value="">Select country</option>
							@if($allcountry)
							@foreach($allcountry as $country)
							<option value="{{ $country->id }}" @if($country->id=='101'): selected @endif;>{{ $country->name }}</option>
							@endforeach;
							@endif;
						</select>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label> State/City<span>*</span></label>
						@if ($errors->has('state_city'))
                            <span class="error-block">
                              <strong>{{ $errors->first('state_city') }}</strong>
                            </span>
                        @endif
						<input type="text" name="state_city" value="{{ old('state_city') }}" class="form-control">
					</div>
				</div>
				<!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label>Select City<span>*</span></label>
						<select class="form-control" name="city_id" class="" id="city_id" required="true">
							<option value="">Select city</option>
							
						</select>
					</div>
				</div> -->

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label>Last date to complete the job </label>
						@if ($errors->has('state_city'))
                            <span class="error-block">
                              <strong>{{ $errors->first('last_date') }}</strong>
                            </span>
                        @endif
						<input type="text" name="last_date" id="last_date" class="form-control" value="" placeholder="Last Date" required="true" value="{{ old('last_date') }}">
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label>Desired Key Skill<span>*</span></label>
						<textarea name="key_skill" class="form-control" rows="5"></textarea>
					</div>
				</div>
				<div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
						<div class="submit-btn">
							<input class="common-btn submitbtn" type="submit" value="Post Job" name="submit">
						</div>
					</div>
			</div>
		</form>
	</div>
</div>					

<!--========================= profile body section end =========================-->

<!-- Modal -->
  <div class="modal fade delete-modal" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
        	<i class="fa fa-exclamation" aria-hidden="true"></i>
          <p>Are you sure delete profile picture?</p>
		  		<input type="hidden" value="" id="image_path">
		  		<button type="button" class="btn btn-default" id="delete_image" data-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-default" id ="delete_close" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
	
	<!------>
	<script>
	function delete_user_image(image_path){
		$('#myModal').modal('show');
		
			$('#image_path').val(image_path);
			
		
		
	}
	$( "#delete_image" ).click(function() {
		var image_path=$('#image_path').val();	
				$.ajax({
					url:"{{ url('/') }}/delete_image",
							  data: {image_path: image_path, _token: '{{csrf_token()}}'},
							  type:'post',
							  success:function(res){
								 if(res.msg){
									location. reload(true); 
								 }
							  },
					}); 

	});	
	function validateForm() {
			/*var password=$('#password').val();
			var confirmed=$('#confirmed').val();
			if(password!=""){
				
				if(password!=confirmed){
					$('#error_c').empty();
					$('#error_c').append('Not match password confirm password');
					return false;
				}
			}*/
			
			return true;
			}
	</script>	

	<script>
		$( document ).ready(function() {

          var x=$('meta[name="csrf-token"]').attr('content');

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
               // alert(x);



               $('#country_id').change(function(e){
                var c_id=$("#country_id").val();                                                
                        var url_val='{{ url('/') }}/select-state/'+c_id;
                         //alert(url_val);
                         $.ajax({
                          url: url_val,
                          method: 'get',
                          success: function(result){
                            console.log(result);

                            $("#state_id").html(result);

                        	 setTimeout(function() {
                             $("#state_id option[value="+selectedState+"]").prop("selected", true);
                             $("#state_id").trigger("change");
                             }, 100);

                          }});
                });

               $("#country_id").trigger("change");

               $('#state_id').change(function(e){
                var s_id=$("#state_id").val();
                                               
                        var url_val='{{ url('/') }}/select-city/'+s_id;
                         //alert(url_val);
                         $.ajax({
                          url: url_val,
                          method: 'get',
                          success: function(result){
                            console.log(result);

                            $("#city_id").html(result);

                            setTimeout(function() {
                             $("#city_id option[value="+selectedCity+"]").prop("selected", true);
                             $("#city_id").trigger("change");
                             }, 100);

                          }});
                });

               $("#state_id").trigger("change");

             });
	</script>


	<script>
		$( document ).ready(function() {

          var x=$('meta[name="csrf-token"]').attr('content');

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
               // alert(x);



               $('#country_id_to').change(function(e){
                var c_id=$("#country_id_to").val();                                                
                        var url_val='{{ url('/') }}/select-state/'+c_id;
                         //alert(url_val);
                         $.ajax({
                          url: url_val,
                          method: 'get',
                          success: function(result){
                            console.log(result);

                            $("#state_id_to").html(result);

                        	 setTimeout(function() {
                             $("#state_id_to option[value="+selectedState+"]").prop("selected", true);
                             $("#state_id_to").trigger("change");
                             }, 100);

                          }});
                });

               $("#country_id_to").trigger("change");

               $('#state_id_to').change(function(e){
                var s_id=$("#state_id_to").val();
                                               
                        var url_val='{{ url('/') }}/select-city/'+s_id;
                         //alert(url_val);
                         $.ajax({
                          url: url_val,
                          method: 'get',
                          success: function(result){
                            console.log(result);

                            $("#city_id_to").html(result);

                            setTimeout(function() {
                             $("#city_id_to option[value="+selectedCity+"]").prop("selected", true);
                             $("#city_id_to").trigger("change");
                             }, 100);

                          }});
                });

               $("#state_id_to").trigger("change");

             });
	</script>

	<script>
  $( function() {
    $( "#date" ).datepicker();
  } );
  </script>

@endsection