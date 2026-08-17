@extends('layouts.inner')
@section('title', 'Change_password')
@section('content')
<!--========================= login body section start =========================-->	
 @if (session('success'))
	                    <div class="alert alert-success alert-dismissible">
	                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                       {{ session('success') }}
	                    </div>
	                @endif
	                @if (session('warning'))
	                    <div class="alert alert-danger alert-dismissible">
	                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                        {{ session('warning') }}
	                    </div>
	                @endif
	                
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
							<div class="rightcolumnpanel">
								<div class="wizard">
		              <div class="wizardformouter">
		              	<div class="rightheading">
			              	<h2>Change Password</h2>
			              </div>
		                <form role="form" class="wizardform" action="#">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    	<div class="form-group">
                    		<input type="password" class="form-control" placeholder="Old Password" name="current-password" required/>
							@if ($errors->has('current-password'))
								<span class="help-block">
									<strong>{{ $errors->first('current-password') }}</strong>
								</span>
							@endif
                    	</div>
                    	<div class="form-group">
                    		<input type="password" class="form-control" placeholder="New Password" name="new-password" required/>
							@if ($errors->has('new-password'))
								<span class="help-block">
									<strong>{{ $errors->first('new-password') }}</strong>
								</span>
							@endif
                    	</div>
                    	<div class="form-group">
                    		<input type="password" class="form-control" placeholder="Confirm Password" name="new-password_confirmation" required />
                    	</div>
                    	<input type="submit" class="btn btn-primary" name="submit" value="Change Password" />
		                </form>
		              </div>
		            </div>								
							</div>
						</div>
					

<!--========================= login body section end =========================-->
@endsection