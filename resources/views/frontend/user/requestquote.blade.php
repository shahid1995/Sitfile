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
			<h2><!-- @lang('sitelanguage.editprofile') -->Post a new quote</h2>
		</div>
		<form class="c-form-wr" enctype="multipart/form-data" method="POST" action="{{ route('send_quote') }}" onsubmit="return validateForm()">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.deliverytype') --> Delivery type<span>*</span></label>

						<select class="form-control" name="delevery_type_id" class="delevery_type" id="delevery_type_id" required="true">
							<option value="">Select delivery type</option>
							@if($deliverytype)
							@foreach($deliverytype as $deliverytypedata)
							<option value="{{ $deliverytypedata->id }}">{{ $deliverytypedata->{'type_name_'.$lc} }}</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.cemail') --> Truck Type<span>*</span></label>
						<select class="form-control" name="truck_type_id" class="truck_type" id="truck_type_id" required="true">
							<option value="">Select truck type</option>
							@if($trucktype)
							@foreach($trucktype as $trucktypedata)
							<option value="{{ $trucktypedata->id }}">{{ $trucktypedata->{'truck_type_name_'.$lc} }}</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>

				<!-- shipping from -->
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.cmobile') --> Shipping From<span>*</span></label>
						<select class="form-control" name="country_id" class="country" id="country_id" required="true">
							<option value="">Select country</option>
							@if($allcountry)
							@foreach($allcountry as $country)
							<option value="{{ $country->id }}">{{ $country->{'country_name_'.$lc} }}</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.cwhatsaap') --></label>
						<select class="form-control" name="state_id" class="" id="state_id" required="true">
							<option value="">Select state</option>
							
						</select>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.cusername') --></label>
						<select class="form-control" name="city_id" class="" id="city_id" required="true">
							<option value="">Select city</option>
							
						</select>
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --> Zip Code </label>
						<input type="text" name="zip_code" id="zip_code" class="form-control" value="" required="true">
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --> Date<span>*</span></label>
						<input type="text" name="date" id="date" class="form-control" value="" required="true">
					</div>
				</div>

				<!-- shipping from -->
				<!-- shipping to -->
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.cmobile') --> Shipping To<span>*</span></label>
						<select class="form-control" name="country_id_to" class="" id="country_id_to" required="true">
							<option value="">Select country</option>
							@if($allcountry)
							@foreach($allcountry as $country)
							<option value="{{ $country->id }}">{{ $country->{'country_name_'.$lc} }}</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.cwhatsaap') --></label>
						<select class="form-control" name="state_id_to" class="" id="state_id_to" required="true">
							<option value="">Select State</option>
							
						</select>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.cusername') --></label>
						<select class="form-control" name="city_id_to" class="" id="city_id_to" required="true">
							<option value="">Select City</option>
							
						</select>
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --> Zip Code</label>
						<input type="text" name="zip_code_to" id="zip_code_to" class="form-control" value="" required="true">
					</div>
				</div>
				<!-- shipping to -->

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --> Total Weight (in KG)<span>*</span></label>
						<input type="text" name="weight" id="weight" class="form-control" value="" required="true">
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --> Required Dimension of each truck<span>*</span></label>
						<input type="text" name="hight" id="hight" placeholder="Hight" class="form-control" value="" required="true">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --></label>
						<input type="text" name="width" id="width" placeholder="Width" class="form-control" value="" required="true">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --></label>
						<input type="text" name="length" id="length" placeholder="Length" class="form-control" value="" required="true">
					</div>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="submit-btn">
						<input class="common-btn submitbtn" type="submit" value="Sent Quote" name="submit">
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