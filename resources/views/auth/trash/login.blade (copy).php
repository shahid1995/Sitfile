@extends('layouts.master_new')
@section('title', 'login')
@section('content')

<section class="innerbanner wow fadeIn"style="visibility: visible; animation-name: fadeIn;">
	<img src="{{asset("images/contactbanner.jpg") }}" alt="">
	<div class="maincontainer">
	  <div class="row">
	    <div class="col-xs-12">
	    </div>
	  </div>
	</div>
</section>
  
<section class="container-fluid servicecontainer logincontainer">
	<div class="maincontainer">
		<div class="row">
          <div class="col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
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
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
			 <form  method="POST" action="{{ route('login') }}">
		      {{ csrf_field() }}
					<div class="login-section">
						<div class="logincolumn">
							<div class="row">
								<div class="col-xs-12">
									<div class="serviceheadingcolumn">
				             			<h2>@lang('sitelanguage.signin')</h2>
				         			</div>
									<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
										<label>@lang('sitelanguage.cemail')</label>
										  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

		                                @if ($errors->has('email'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('email') }}</strong>
		                                    </span>
		                                @endif
									</div>
								</div>
								<div class="col-xs-12">
									<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
										<label>@lang('sitelanguage.cpassword')</label>
										 <input id="password" type="password" class="form-control" name="password" required>

		                                @if ($errors->has('password'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('password') }}</strong>
		                                    </span>
		                                @endif
									</div>
								</div>
								<div class="col-xs-12">
									<div class="form-group">
										<!-- <a class="forgot" href="{{ route('password.request') }}">Forgot your password?</a> -->
										<a class="forgot" href="#">@lang('sitelanguage.forgotpass')</a>
									</div>
								</div>
								<!--<div class="col-xs-12">
									<div class="checkbox">
		                 <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="Remember"> 
		                <label for="Remember">Remember Me</label>
		              </div>
								</div>-->
								<div class="col-xs-12">
									<div class="button-submit">
		                <input type="submit" class="loginbtn" name="" value="@lang('sitelanguage.login')" />
		              </div>
								</div>
								<div class="col-xs-12">
									<div class="createaccount">
										<p><strong>@lang('sitelanguage.donthaveaccount')</strong></p>
										<a href="{{ route('register') }}">@lang('sitelanguage.signuptext')</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>


@endsection
