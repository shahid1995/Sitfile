@extends('layouts.master_new')
@section('title', 'register')
@section('content')

	<section class="container-fluid servicecontainer logincontainer">
	<div class="maincontainer">
	<div class="row">
            <div class="col-md-12 col-sm-12">
                @if (session('status'))
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
			<div class="col-xs-12">
				<div class="serviceheadingcolumn">
					<h2>Create Account</h2>
				</div>
				 <form  method="POST" action="{{ route('register') }}">
					{{ csrf_field() }}
				<div class="logincolumn">
					<div class="row">
					
						<div class="col-xs-12">
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" >
								<label>Email</label>
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<label>Confirm Email</label>
								<input id="confirm_email" type="email" class="form-control" name="confirm_email" required>

                                @if ($errors->has('confirm_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirm_email') }}</strong>
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
								<label>Confirm Password</label>
								 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
								<a class="forgot" href="javascript:void(0);">Forgot your password?</a>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="checkbox agree">
                <input id="agree" type="checkbox" required>
                <label for="agree">By creating an account, I agree to the <a href="javascript:void(0);"
                	data-toggle="modal" data-target="#myModal" >terms of use.</a> </label>
              </div>
						</div>
						<div class="col-xs-12">
							<div class="form-group">
                <button type="submit" class="loginbtn" />Create Account</button>
              </div>
			  </form>
						</div>
						<div class="col-xs-12">
							<div class="alreadyaccount">
								<p>Already have an account? <a href="{{ route('login') }}">Login</a> </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

 
 <div id="myModal" class="modal fade c-model-wrper" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">terms of use</h4>
        <span><i class="fa fa-file-text-o" aria-hidden="true"></i></span>
      </div>
      <div class="modal-body">
      	<h4>Lorem Ipsum is simply dummy</h4>
        <p>
        	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
        <h4>Lorem Ipsum is simply dummy</h4>
          <p>
        	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
        <h4>Lorem Ipsum is simply dummy</h4>
          <p>
        	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
        <h4>Lorem Ipsum is simply dummy</h4>
          <p>
        	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
        <h4>Lorem Ipsum is simply dummy</h4>
          <p>
        	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
        <ul>
        	<li>Lorem Ipsum is simply dummy</li>
        	<li>Lorem Ipsum is simply dummy</li>
        	<li>Lorem Ipsum is simply dummy</li>
        	<li>Lorem Ipsum is simply dummy</li>
        	<li>Lorem Ipsum is simply dummy</li>
        </ul>
      </div>
    </div>

  </div>
</div>



@endsection
