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
					<h1>thank you!</h1>
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
					<a class="thank_login" href="{{ url('/') }}"><span>Back To Home</span></a>
					<a class="thank_login" href="{{ url('user/dashboard') }}"><span>Go To Dashboard</span></a>
				</div>
			</div>
		</div>
	</div>
</section>


 <!-- Modal -->
  <!--<div class="modal fade" id="myModalyes" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <form action="{{url('/equipment')}}" method="post">
            {{ csrf_field() }}
        <div class="modal-body">
          Do you want to add new equipment?  Yes <input type="radio" name="equipment" value="yes">  No <input type="radio" name="equipment" value="no">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">Submit</button>
        </div>
        
        </form>
      </div>
    </div>
  </div>-->
</div>



@endsection
