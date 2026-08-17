@extends('layouts.inner')
@section('title', 'Contact Us')
@section('content')

<section class="innerbanner wow fadeIn"style="visibility: visible; animation-name: fadeIn; text-align:center;">
	<img class="c-img" src="{{asset("images/contact-us-banner.png") }}" alt="">
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
				<div class="row">
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
						    <a target="_blank" href="https://awzonex.setmore.com/">Book your appointment</a>
						</div>
					</div>
				</div>
				<div class="col-sm-6 zohoform">
					<div id='crmWebToEntityForm' class='zcwf_lblLeftcrmWebToEntityForm'>
					<form action='https://crm.zoho.com/crm/WebToContactForm' name=WebToContacts4672655000000300040 method='POST' onSubmit='javascript:document.charset="UTF-8"; return checkMandatory4672655000000300040()' accept-charset='UTF-8'>
<input type='text' style='display:none;' name='xnQsjsdp' value='ccbc62a85e7f8746f79c0970d98dd4edcde4d314caba01127d9b9d0d0388a6b2'></input>
<input type='hidden' name='zc_gad' id='zc_gad' value=''></input>
<input type='text' style='display:none;' name='xmIwtLD' value='9c36547fd13259c9f51145a3dcfde96fc1d243d4707fd435c8745d54ee586371'></input>
<input type='text'  style='display:none;' name='actionType' value='Q29udGFjdHM='></input>
<input type='text' style='display:none;' name='returnURL' value='http://quality-web-programming.com/projects/f4/shahid/' ></input>
	<!-- Do not remove this code. -->
	<input type='text' style='display:none;' id='ldeskuid' name='ldeskuid'></input>
	<input type='text' style='display:none;' id='LDTuvid' name='LDTuvid'></input>
	<!-- Do not remove this code. -->
<div class='zcwf_title'>Contact Us</div>
<div class='zcwf_row'><div class='zcwf_col_lab' style='font-size:12px; font-family: Arial;'><label for='First_Name'>First Name<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' id='First_Name' name='First Name' maxlength='40'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' style='font-size:12px; font-family: Arial;'><label for='Last_Name'>Last Name<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' id='Last_Name' name='Last Name' maxlength='80'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' style='font-size:12px; font-family: Arial;'><label for='Mobile'>Mobile<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' id='Mobile' name='Mobile' maxlength='30'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row'><div class='zcwf_col_lab' style='font-size:12px; font-family: Arial;'><label for='Email'>Email<span style='color:red;'>*</span></label></div><div class='zcwf_col_fld'><input type='text' ftype='email' id='Email' name='Email' maxlength='100'></input><div class='zcwf_col_help'></div></div></div>
<div class='zcwf_row fullrow'><div class='zcwf_col_lab' style='font-size:12px; font-family: Arial;'><label for='Description'>Description</label></div><div class='zcwf_col_fld'><textarea id='Description' name='Description'></textarea><div class='zcwf_col_help'></div></div></div><div class='zcwf_row fullrow'><div class='zcwf_privacy'><div class='dIB vat' align='left'><div class='displayPurpose  f13'><label class='newCustomchkbox-md dIB w100per'><input autocomplete='off' id='privacyTool' type='checkbox' name='privacyTool' onclick='disableErr()'></label></div></div><div class='dIBzcwf_privacy_txt' style='font-size: 12px;font-family:Arial;color: #000000;'>I agree to the <a href='https://www.awzonex.com/page/privacy-policy' title='Privacy Policy' target='_blank'>Privacy Policy</a> and <a href='https://www.awzonex.com/page/terms-of-use' title='Terms of Service' target='_blank'>Terms of Service</a>.</div><div  id='privacyErr' style='font-size:12px;color:red;padding-left: 5px;visibility:hidden;'>Please accept this</div></div></div><div class='zcwf_row fullrow'><div class='zcwf_col_lab'></div><div class='zcwf_col_fld'><input type='submit' id='formsubmit' class='formsubmitzcwf_button' value='Submit' title='Submit'><input type='reset' class='zcwf_button' name='reset' value='Reset' title='Reset'></div></div>
	</form>

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




