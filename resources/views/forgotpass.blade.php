@extends('layouts.master_new')
  @section('title', 'Forgot Password')
@section('content')
<style>
.succls{
  border: 2px solid #8e8e8e !important;
}
.errcls
{
  border: 2px solid red !important;
}
.hidemsg
{
display:none;
}
.showmsg
{
  display:block;
}
.errmsg
{
  color:red;
}
</style>

<section class="container-fluid homecarouselcontainer logincontainer">
  <div class="logininnercontainer">
    <div class="maincontainer">
      <div class="row">

         @if ( Session::get('message') != '' )
          <div class='alert alert-warning'>
              {{ Session::get('message') }}
          </div>
        @endif
      	<div class="col-sm-6 col-sm-offset-3 col-xs-12">
          @if(Session::has('flash_message'))
            <div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>
          @endif
          <div class="form-outer">
  		      <form id="" action="{{route('auth.forgot.reset')}}" method="post">		         
  			      <div class="login-section">
                <div class="logincolumn">
    			        <div class="logheading">
    								<h2>Forgot Password</h2>
    							</div>
      				    <div class="form-group">
      					    <div class="input-span">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
      					      <input type="email" class="form-control" name="email" required="true" placeholder="Enter Email" id="email_id">
      					      <p><small id="email_id_err" class="errmsg hidemsg"></small></p>
      					    </div>
      					  </div>
    					    <div class="form-group forgot_btn_link_group clearfix marginbottom">                        
      					    <div class="button-submit">
      						    <input type="submit" value="submit" class="loginbtn signupbutton" id="forgotbtn">
      						  </div>
                    <div class="createaccount">
                      <p><strong>@lang('sitelanguage.donthaveaccount')</strong> 
                        <a href="{{ route('register') }}">@lang('sitelanguage.signuptext')</a>
                      </p>
                    </div>
                  </div>
                     
                  <!-- <a href="javascript:void(0)">Forget Password</a> -->
                </div>
  				    </div>
  		      </form>
         <!--  <div class="carouselheading">
            <div class="headingleft">
                <span>Don't have an account?</span>
            </div>
            <div class="createright">
                <a href="{{url('/')}}/registration">Signup</a>
            </div>
          </div> -->
          </div>
        </div>
      </div>
     
    </div>
  </div>
</section>





<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

</body>
</html>

@endsection