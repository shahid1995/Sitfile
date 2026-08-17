@extends('layouts.userinner')
@section('title', 'Assign Consignment To Truck Driver')
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
			<h2><!-- @lang('sitelanguage.editprofile') --> Assign Consignment To Truck Driver </h2>
		</div>
		<form class="c-form-wr" enctype="multipart/form-data" method="POST" action="{{ route('submit-assign-driver') }}" onsubmit="return validateForm()">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="quote_id" value="{{$quote_details->id}}">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.deliverytype') --> Quote Id <span></span></label>

						<input name="" id="" class="form-control" value="{{$quote_details->quote_id}}" readonly>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.cemail') --> Select Truck Driver <span>*</span></label>

						<select name="truck_driver" id="truck_driver" class="form-control" required="true">

              <option value=""> Select </option>
              @foreach($truck_driver as $driver_data)

              <option value="{{$driver_data->id}}" @if($driver_assign_exit->driver_id == $driver_data->id) selected @endif> {{$driver_data->name}} </option>
              @endforeach
            </select>

					</div>
				</div>

			
				

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					@if($driver_assign_exit->driver_id)
            Already assign.
          @else
          <div class="submit-btn">
            <input class="common-btn submitbtn" type="submit" value="Submit" name="submit">
          </div>
          @endif

          

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