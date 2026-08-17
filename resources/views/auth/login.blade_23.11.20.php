@extends('layouts.master_new')
@section('title', 'login')
@section('content')

<!-- <section class="innerbanner wow fadeIn"style="visibility: visible; animation-name: fadeIn;">
	<img src="{{asset('images/contactbanner.jpg') }}" alt="">
	<div class="maincontainer">
	  <div class="row">
	    <div class="col-xs-12">
	    </div>
	  </div>
	</div>
</section> -->
  
<section class="container-fluid logincontainer login_sec">
	<div class="maincontainer">
		<div class="row">
          <div class="col-sm-12">
          	<div class="login_box">
              @if (session('success'))
              <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {{ session('success') }}
              </div>
              @endif
              @if (session('error'))
              <div class="alert alert-danger alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {{ session('error') }}
              </div>
              @endif
          </div>
          </div>
      </div>
		<div class="row">
			<div class="col-sm-12">
				<div class="login_box">
			 <form  method="POST" action="{{ route('login') }}">
		      {{ csrf_field() }}
					<div class="login-section">
						<div class="logincolumn">
							<div class="row">
								<div class="col-xs-12">
									<div class="logheading">
				             			<h2>@lang('sitelanguage.signin')</h2>
				         			</div>
									<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

										<label>Username / @lang('sitelanguage.cemail') / Phone no</label>
										  <input id="login" type="text" class=form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }} name="login" value="{{ old('username') ?: old('email') }}" required autofocus>

								        @if ($errors->has('username') || $errors->has('email') || $errors->has('phoneno'))
								            <span class="invalid-feedback">
								                <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
								            </span>
								        @endif
									</div>
								</div>
								<div class="col-xs-12">
									<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
										<label>@lang('sitelanguage.cpassword')</label>
										<a class="forgot" href="{{url('forgetpass')}}">@lang('sitelanguage.forgotpass')</a>
										 <input id="password" type="password" class="form-control" name="password" required>

		                                @if ($errors->has('password'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('password') }}</strong>
		                                    </span>
		                                @endif
									</div>
								</div>
								<div class="col-xs-12">
									<div class="form-group forgot_btn_link_group clearfix">
										<!-- <a class="forgot" href="{{ route('password.request') }}">Forgot your password?</a> -->
										
										<div class="button-submit">
							                <input type="submit" class="loginbtn" name="" value="@lang('sitelanguage.login')" />
							            </div>
									</div>
								</div>
								<!--<div class="col-xs-12">
									<div class="checkbox">
		                 <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="Remember"> 
		                <label for="Remember">Remember Me</label>
		              </div>
								</div>-->							
							<div class="col-xs-12">
								<div class="createaccount">
									<p><strong>@lang('sitelanguage.donthaveaccount')</strong> <a href="{{ route('register') }}">@lang('sitelanguage.signuptext')</a></p> 
										
									</div>
								</div>
								<div class="col-xs-12">
								<div class="createaccount">
									<p><strong>Service Provider Registration</strong> <a href="{{ route('serviceregisterer') }}">@lang('sitelanguage.signuptext')</a></p> 
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</section>


@endsection
