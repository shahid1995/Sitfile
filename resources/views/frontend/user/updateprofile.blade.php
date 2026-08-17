@extends('layouts.inner')
@section('title', 'Profile')
@section('content')
<!--========================= login body section start =========================-->			
<div class="container">
	<div class="right_aftr_lgin_frm_bg">
		<div class="row">
            <div class="col-md-12 col-sm-12">
                @if (session('success_message'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('warning') }}
                    </div>
                @endif
            </div>
        </div>
		<div class="row">
			<div class="col-sm-12">
				<div class="aftr_lgin_frm_sec user_acc_update">
					<div class="row">
						<form class="c-form-wr" enctype="multipart/form-data" method="POST" action="" onsubmit="return validateForm()">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="row">
								<div class="col-sm-6">
								<div class="form-group">
									<label class="lbl">Name<span>*</span></label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ (($userdata->name) ? $userdata->name : old('name')) }}" placeholder="Name" required="true">
								</div>
								</div>
								
								<div class="col-sm-6">
								<div class="form-group">
									<label class="lbl">Email<span>*</span></label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ (($userdata->email) ? $userdata->email : old('email')) }}" placeholder="Email" readonly>
								</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
								<div class="form-group">
									<label class="lbl">Age<span>*</span></label>
                                    <input id="age" type="number" class="form-control" name="age" value="{{ (($userdata->age) ? $userdata->age : old('age')) }}" placeholder="Age" required="true">
								</div>
								</div>
								
								<div class="col-sm-6">
								<div class="form-group">
									<label class="lbl">Gender<span>*</span></label>
                                    <select class="form-control" name="gender" id="gender" required="true">
									<option value="">--Select---</option>
										<option value="Male" <?php if($userdata->gender=='Male'){echo "selected";}?>>Male</option>
										<option value="Female" <?php if($userdata->gender=='Female'){echo "selected";}?>>Female</option>
									</select>
								</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-6">
								<div class="form-group">
									<label class="lbl">Phone No</label>
                                    <input id="phoneno" type="text" class="form-control" name="phoneno"  placeholder="Phone No" value="{{ (($userdata->phoneno) ? $userdata->phoneno : old('phoneno')) }}">
								</div>
								</div>
								<div class="col-sm-6">
								<div class="form-group">
									<label class="lbl">Address</label>
                                    <input id="address" type="text" class="form-control" name="address"  placeholder="Address" value="{{ (($userdata->address) ? $userdata->address : old('address')) }}">
									
								</div>
								</div>
							</div>
							
							<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="lbl">Health Details</label>
                                   <textarea name="health" class="form-control" >{{$userdata->health_details}}</textarea>
									
								</div>
								</div>
								<?php if($userdata->profile_picture==""){ ?>
								<div class="col-sm-6">
								<div class="form-group">
									<label class="lbl">Upload Image</label>
                                    <input id="UploadImage" type="file" class="form-control" name="user_image" >
								</div>
								</div>
								<?php }else{ ?>
								<div class="col-sm-6">
									<div class="profileuploadimg">
										<div class="imgc">
											<img src="{{ url('/') }}/public/{{ $userdata->profile_picture }}">

											<a class="removeimg" title="delete"><i class="fa fa-trash-o"  onclick="delete_user_image('{{ $userdata->profile_picture }}')"></i></a>
										</div>
										
									</div>
								</div>
								<?php } ?>
							</div>
							<!-- if user_type = 'serviceprovider' then update paypal id -->
							<div class="row">
								<div class="col-sm-12 text-right">
									<div class="form-group">
										<input class="common-btn" type="submit" value="submit" name="submit">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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
			var password=$('#password').val();
			var confirmed=$('#confirmed').val();
			if(password!=""){
				
				if(password!=confirmed){
					$('#error_c').empty();
					$('#error_c').append('Not match password confirm password');
					return false;
				}
			}
			
			return true;
			}
	</script>	
<!--========================= login body section end =========================-->
@endsection