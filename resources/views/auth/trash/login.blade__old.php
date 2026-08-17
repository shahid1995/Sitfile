@extends('layouts.master_new')
@section('title', 'login')
@section('content')
<section class="container-fluid servicecontainer logincontainer">
	<div class="maincontainer">
		<div class="row">
		 <form  method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
			<div class="col-xs-12">
				<div class="logincolumn">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label>Email</label>
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
								<label>Password</label>
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
								<a class="forgot" href="{{ route('password.request') }}">Forgot your password?</a>
							</div>
						</div>
						<!--<div class="col-xs-12">
							<div class="checkbox">
                 <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="Remember"> 
                <label for="Remember">Remember Me</label>
              </div>
						</div>-->
						<div class="col-xs-12">
							<div class="form-group">
                <input type="submit" class="loginbtn" name="" value="Login" />
              </div>
			  </form>
						</div>
						<div class="col-xs-12">
							<div class="createaccount">
								<p><strong>Don't have an account?</strong></p>
								<a href="{{ route('register') }}" class="createaccountbtn">Sign up for an account</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


@endsection
