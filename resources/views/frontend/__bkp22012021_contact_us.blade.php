@extends('layouts.inner')
@section('title', 'Contact Us')
@section('content')

<section class="innerbanner wow fadeIn"style="visibility: visible; animation-name: fadeIn; text-align:center;">
	<img src="{{asset("images/contact-us-banner.png") }}" alt="">
	<div class="maincontainer">
		<div class="row">
			<div class="col-xs-12">
			</div>
		</div>
	</div>
</section>

@if($breadcrumbs)
<section class="container-fluid breadcrumbcontainer bannerbreadcrumb">
	<div class="maincontainer">
		<ol class="breadcrumb">
		  @foreach($breadcrumbs as $breadcrumb)
		  <li @if($breadcrumb['active']) class="active" @endif ><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
		  @endforeach
		</ol>
	</div>
</section>
@endif

<section class="container-fluid contactcontainer">
	<div class="maincontainer">
		<div class="row">
			<div class="col-sm-12">
				<h2 style="font-weight:bold; font-family: 'Gotham-Medium';">@lang('sitelanguage.contact_us')</h2><hr>
				<div class="col-sm-6">
					<div class="contactuspanel">
			            <div class="fullsec">
							<div class="left_icon">
								<div class="iconinner">
									<i class="fa fa-map-marker" aria-hidden="true"></i>
								</div>
							</div>
							<div class="right-details">
								<p>{!! config('settings.site_address') !!}</p>
							</div>
						</div>
						<div class="fullsec">
							<div class="left_icon">
								<div class="iconinner">
									<i class="fa fa-phone" aria-hidden="true"></i>
								</div>
							</div>
							<div class="right-details">
								<p>{!! config('settings.site_additional_phone') !!}</p>
							</div>
						</div>
						<div class="fullsec">
							<div class="left_icon">
								<div class="iconinner">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</div>
							</div>
							<div class="right-details">
								<a href="mailto:{{ config('settings.site_email_id') }}">{{ config('settings.site_email_id') }}</a>
							</div>
						</div>
						<div class="zohobookingbox">
						    <a target="_blank" href="https://sefely.zohobookings.com/#/customer/bookings">Book your appointment</a>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="contactouter" style="padding: 20px;">
			          <div class="contactform">
			          	@if (session('success'))
					        <div class="alert alert-success alert-dismissible">
					            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					            <!-- @lang('sitelanguage.update_account_success_msg') -->

					            {{ session('success') }}
					        </div>
					    @endif
					    @if (session('error'))
					        <div class="alert alert-danger alert-dismissible">
					            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					            {{ session('error') }}
					        </div>
					    @endif
					    <div class="row">
			            <form method="post" action="{{url('/contact')}}" id="contact_form">
			            	{{ csrf_field() }}
			            	<div class="col-sm-6">
				              <div class="form-group">
				              	<label for="Name" class="inputlabel">@lang('sitelanguage.cont_name')</label>
				                <input type="text" id="name" class="form-control" placeholder="@lang('sitelanguage.cont_name')" name="name" value="{{old('name')}}" required>
				                <span class="error alert" id="error_name"></span>
				                @if ($errors->has('name'))
		                            <span class="error-block">
		                              <strong>{{ $errors->first('name') }}</strong>
		                            </span>
		                        @endif
				              </div>
				          </div>
				          <div class="col-sm-6">
				          	<div class="form-group">
				              	<label for="Mobile" class="inputlabel">@lang('sitelanguage.cont_mobile')</label>
				                <input type="text" id="mobile" class="form-control" placeholder="@lang('sitelanguage.cont_mobile')" name="mobile" value="{{old('mobile')}}" required>
				                <span class="error alert" id="error_mobile"></span>
				                @if ($errors->has('mobile'))
		                            <span class="error-block">
		                              <strong>{{ $errors->first('mobile') }}</strong>
		                            </span>
		                        @endif
				              </div>
				          </div>
			              <div class="col-sm-12">
			              	<div class="form-group">
				              	<label for="Email" class="inputlabel">@lang('sitelanguage.cont_email')</label>
				                <input type="email" id="email" class="form-control" placeholder="@lang('sitelanguage.cont_email')" name="email" value="{{old('email')}}" required>
				                <span class="error alert" id="error_email"></span>
				                @if ($errors->has('email'))
		                            <span class="error-block">
		                              <strong>{{ $errors->first('email') }}</strong>
		                            </span>
		                        @endif
				              </div>
			              </div>
			              <div class="col-sm-12">
			              	<div class="form-group">
				              	<label for="Message" class="inputlabel">@lang('sitelanguage.cont_msg')</label>
				                <textarea id="message" class="form-control" placeholder="@lang('sitelanguage.cont_msg')" name="message" rows="5" required>{{old('message')}}</textarea>
				                @if ($errors->has('message'))
		                            <span class="error-block">
		                              <strong>{{ $errors->first('message') }}</strong>
		                            </span>
		                        @endif
				              </div>
			              </div>
			              <div class="col-sm-12">
				              <!-- <input type="button" class="sendbtn" id="contact_submit" value="@lang('sitelanguage.cont_btn')"> -->
				              <button class="common-btn submitbtn" type="submit">@lang('sitelanguage.cont_btn')</button>
				          </div>
			            </form>
			        </div>
			          </div>
		        </div>
				</div>
			</div>
		</div>

	</div>
</section> 

<script type="text/javascript">
//========add adventure review by customer===========
$(document).ready(function(){
    $("#contact_form").submit(function () {
		var name = $("#name").val();
		var email = $("#email").val();
		var mobile = $("#mobile").val();
		
		var count=0;
		$('.error').html('');

		if(name == ""){
            $('#error_name').html('First name is required.');
            count=1;
        }
		if(email != ""){
			if(!validateEmail(email)){
				$('#error_email').html('Email should be valid.');
			    count=1;
			}
		}else{
			$('#error_email').html('Email is mandatory field.');
			count=1;
		}
		if(mobile == ""|| isNaN(mobile)){
			if(mobile == "")
				$('#error_mobile').html('Phone is mandatory field.');
			else
				$('#error_mobile').html('Phone should be numeric only.');
			count=1;
		}

		if(count == 1){
			return false;
		}else{
			return true;
		}
    });
});

function validateEmail(email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( email );
}

//========add adventure review by customer===========
</script>         
@endsection




