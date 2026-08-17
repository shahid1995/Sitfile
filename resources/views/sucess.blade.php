 @extends('layouts.master_new')
  @section('title', 'register')
  @section('content')

<section class="thank_you_sec">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-push-1">
				<div class="thank_you_inner">
					<div class="tic_pnl">
						<i class="fa fa-check" aria-hidden="true"></i>
					</div>
					<h1>Payment Successfull</h1>
					<p>
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
			          </p>
					<!--<a class="thank_login" href="{{ url('/') }}"><span>Back To Home</span></a>
					<a class="thank_login" href="{{ url('/login') }}"><span>Go To Login</span></a>-->
				</div>
			</div>
		</div>
	</div>
</section>


 



@endsection
