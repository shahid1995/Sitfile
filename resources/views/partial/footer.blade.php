<footer class="footercontainer" id="newsletter">
	<div class="footerinnertop">
		<div class="maincontainer">
			<div class="flexfooter">
				<div class="footerflexcol1">
	        <div class="footerlogo">
	          <a href="{{url('/')}}"><img src="{{ asset('images/footer-logo.png')}}" alt="Footer Logo"></a>
	        </div>
	        <div class="footerlcontent">
	          <div class="dummy">  <p>{!! strip_tags(config('settings.footer_text')) !!}</p> </div>
	          <div class="footersocial">
	            <a class="social facebook" href="{{ config('settings.facebook_link') }}" target="_blank"><i class="fa fa-facebook"></i></a>
	            <a class="social twitter" href="{{ config('settings.twitter_link') }}" target="_blank"><i class="fa fa-twitter"></i></a>
	            <a class="social linkedin" href="{{ config('settings.linkedin') }}" target="_blank"><i class="fa fa-linkedin"></i></a>
	          </div>
	        </div>
	      </div>
	      <div class="footerflexcol2">
	      	<div class="footernav">
	      		<h3>Company</h3>
	      		<ul>
	      			<li><a href="{{url('/page/about-us')}}">About</a></li> 
	      			<li><a href="{{url('/page/policy-busniss')}}">Policy</a></li>
	      			<!-- <li><a href="{{url('testimonials') }}">Testimonials</a></li> -->
	      			<li><a href="https://www.awzonex.com/blog/">Blog</a></li>
	      			<!-- <li><a href="javascript:void(0);">Community</a></li> -->
	      			<!-- <li><a href="javascript:void(0);">Forum</a></li>
	      			<li><a href="{{url('/page/public-awareness')}}">Public Awareness</a></li>
	      			<li><a href="{{url('/page/knowledge-corner')}}">Knowledge Corner</a></li> -->
	      			<li><a href="{{ url('/contact') }}">Contact Us</a></li>
	      		</ul>
	      	</div>
	      </div>
	      <div class="footerflexcol3">
	      	<div class="footernav">
	      		<h3>Discover</h3>
	      		<ul>
	      			<!-- <li><a href="{{url('/page/how-altibbe-works')}}">How altibbe Works</a></li>
	      			<li><a href="javascript:void(0);">Sign Up</a></li>
	      			<li><a href="{{url('/page/guarantee')}}">Guarantee</a></li> -->
	      			<!--<li><a href="{{url('/page/quality-assurance')}}">Quality Assurance (QA) test service</a></li>-->
	      			<!--<li><a href="{{url('service-page')}}">Quality Assurance (QA) test service</a></li>-->
	      			<!-- <li><a href="{{url('service')}}">Quality Assurance (QA) test service</a></li>
	      			<li><a href="{{url('/page/maintenance-service')}}">Maintenance Service</a></li>
	      			<li><a href="{{url('/page/aerb-license')}}">AERB License/Regulatory</a></li> -->
	      			<!--<li><a href="{{url('/page/aerb-license')}}">AERB Compliance Service</a></li>-->
	      			
	      			<li><a href="{{url('service')}}">AERB Compliance Service</a></li>
	      			
	      			<!-- <li><a href="{{url('/page/service-area')}}">Service Area</a></li> -->
	      			<!--<li><a href="{{url('/page/guarantee')}}">Guarantee</a></li>-->
	      			<!--<li><a href="{{url('guarantee')}}">Guarantee</a></li>-->
	      			<li><a href="{{url('page/altibbe-peace-of-mind-guarantee')}}">Guarantee</a></li>
	      			@if(Auth::user()->roll_id=='') <li><a href="{{url('register')}}">Sign Up</a></li> @endif
	      		</ul>
	      	</div>
	      </div>
	      <!--<div class="footerflexcol4">-->
	      <!--	<div class="footernav">-->
	      <!--		<h3>Discover</h3>-->
	      <!--		<ul>-->
	      <!--			<li><a href="{{url('/page/why-join-altibbe')}}">Why join altibbe</a></li>-->
	      <!--			<li><a href="{{url('/page/how-the-marketplace-Works')}}">How the marketplace Works</a></li> -->
	      <!--			<li><a href="javascript:void(0);">Altibbe Profile</a></li>-->
	      <!--			<li><a href="{{url('/page/altibbe-service-advisor')}}">Altibbe Service Advisor</a></li> -->
	      <!--			<li><a href="javascript:void(0);">Join Us</a></li>-->
	      <!--		</ul>-->
	      <!--	</div>-->
	      <!--</div>-->
	      <div class="footerflexcol5">
	      	<div class="footernav">
	      		<div class="footernewsletter">
	      		<!--	<h3>Subscribe to our newsletter</h3>-->

	      		<!--	@if (Session::has('success'))-->
				     <!--   <div class="alert alert-success">-->
				     <!--     <strong>Success!</strong> -->
				     <!--     {{ Session::get('success') }}-->
				     <!--   </div>-->
				     <!--@endif-->
	      		<!--	<div class="form-group">-->
	      		<!--		<div class="newslgroup">-->
	      		<!--			<form action="{{url('/newsletter')}}#newsletter" method="post">-->
	      		<!--			{{ csrf_field() }}-->
	      		<!--			<input type="email" class="form-control" placeholder="Enter your email" name="email" required/>-->
	      					 <!--<input type="submit" class="subscribebtn ico ico-paper-plane"> -->
	      		<!--			<button type="submit" class="subscribebtn"><i class="ico ico-paper-plane"></i></button>-->
	      		<!--		</form>-->
	      		<!--		</div>-->
	      		<!--	</div>-->
	      		
	      		<!--Zoho Campaigns Web-Optin Form's Header Code Starts Here--> 
	      		<script type="text/javascript" src="https://plza.maillist-manage.com/js/optin.min.js" onload="setupSF('sf011b4c7ab60978bd2afd563b52fc032bf3898872493ca85e','ZCFORMVIEW',false,'acc',false,'2')"></script> 
	      		<script type="text/javascript"> function runOnFormSubmit_sf011b4c7ab60978bd2afd563b52fc032bf3898872493ca85e(th){ /*Before submit, if you want to trigger your event, "include your code here"*/ }; </script> <style> .quick_form_7_css * { -webkit-box-sizing: border-box !important; -moz-box-sizing: border-box !important; box-sizing: border-box !important; overflow-wrap: break-word } @media only screen and (max-width: 600px) {.quick_form_7_css[name="SIGNUP_BODY"] { width: 100% !important; min-width: 100% !important; margin: 0px auto !important; padding: 0px !important }  } </style> <!--Zoho Campaigns Web-Optin Form's Header Code Ends Here--><!--Zoho Campaigns Web-Optin Form Starts Here--> <div id="sf011b4c7ab60978bd2afd563b52fc032bf3898872493ca85e" data-type="signupform" style="opacity: 1;"> <div id="customForm"> <div class="quick_form_7_css" style="background: transparent; width: 100%; z-index: 2; font-family: &quot;Arial&quot;; border: none; overflow: hidden" name="SIGNUP_BODY"> <div> <h3 id="SIGNUP_HEADING">Subscribe for our Newsletter</h3> <div style="position:relative;"> <div id="Zc_SignupSuccess" style="display:none;position:absolute;margin-left:4%;width:90%;background-color: white; padding: 3px; border: 3px solid rgb(194, 225, 154); margin-top: 10px;margin-bottom:10px;word-break:break-all"> <table width="100%" cellpadding="0" cellspacing="0" border="0"> <tbody> <tr> <td width="10%"> <img class="successicon" src="https://plza.maillist-manage.com/images/challangeiconenable.jpg" align="absmiddle"> </td> <td> <span id="signupSuccessMsg" style="color: rgb(73, 140, 132); font-family: sans-serif; font-size: 14px;word-break:break-word">&nbsp;&nbsp;Thank you for Signing Up</span> </td> </tr> </tbody> </table> </div> </div> <form method="POST" id="zcampaignOptinForm" style="margin: 0px; width: 100%; text-align: center" action="https://maillist-manage.com/weboptin.zc" target="_zcSignup"> <div style="background-color: rgb(255, 235, 232); padding: 10px; color: rgb(210, 0, 0); font-size: 11px; margin: 20px 10px 0px; border: 1px solid rgb(255, 217, 211); opacity: 1; display: none" id="errorMsgDiv">Please fill up this field.</div> <div style="position: relative; width: 100%; height: auto; display: inline-block" class="SIGNUP_FLD"> <div style="padding: 5px 0px; color: rgb(85, 85, 85); font-size: 12px; font-family: Arial; display: block; text-align: left"></div> <input type="text" class="form-control" changeitem="SIGNUP_FORM_FIELD" name="CONTACT_EMAIL" id="EMBED_FORM_EMAIL_LABEL" placeholder="Enter your email"> </div> <div style="position: relative; margin: 5px 0 0px 0px; width: 100%; height: auto; display: inline-block" class="SIGNUP_FLD"><div style="padding: 5px 0px; color: rgb(85, 85, 85); font-size: 12px; font-family: Arial; display: block; text-align: left"></div> <input type="text" class="form-control" changeitem="SIGNUP_FORM_FIELD" name="FIRSTNAME" id="FIRSTNAME" placeholder="Enter your name"> </div> <div style="position: relative; height: auto; margin: 0 0 25px 0px; display: block; text-align: left;" class="SIGNUP_FLD"> <input type="button" class="newsbtn" name="SIGNUP_SUBMIT_BUTTON" id="zcWebOptin" value="Subscribe"> </div> <input type="hidden" id="fieldBorder" value=""> <input type="hidden" id="submitType" name="submitType" value="optinCustomView"> <input type="hidden" id="emailReportId" name="emailReportId" value=""> <input type="hidden" id="formType" name="formType" value="QuickForm"> <input type="hidden" name="zx" id="cmpZuid" value="127910649"> <input type="hidden" name="zcvers" value="3.0"> <input type="hidden" name="oldListIds" id="allCheckedListIds" value=""> <input type="hidden" id="mode" name="mode" value="OptinCreateView"> <input type="hidden" id="zcld" name="zcld" value="1a2ebd5dd456f41c"> <input type="hidden" id="document_domain" value=""> <input type="hidden" id="zc_Url" value="plza.maillist-manage.com"> <input type="hidden" id="new_optin_response_in" value="0"> <input type="hidden" id="duplicate_optin_response_in" value="0"> <input type="hidden" name="zc_trackCode" id="zc_trackCode" value="ZCFORMVIEW"> <input type="hidden" id="zc_formIx" name="zc_formIx" value="011b4c7ab60978bd2afd563b52fc032bf3898872493ca85e"> <input type="hidden" id="viewFrom" value="URL_ACTION"> <span style="display: none" id="dt_CONTACT_EMAIL">1,true,6,Contact Email,2</span> <span style="display: none" id="dt_FIRSTNAME">1,false,1,First Name,2</span> <span style="display: none" id="dt_LASTNAME">1,false,1,Last Name,2</span> </form> </div> </div> <div style="display: none" id="unauthPageTitle">Newsletter - Form</div> </div> <img src="https://plza.maillist-manage.com/images/spacer.gif" id="refImage" onload="referenceSetter(this)" style="display:none;"> </div> <input type="hidden" id="signupFormType" value="QuickForm_Horizontal"> <div id="zcOptinOverLay" oncontextmenu="return false" style="display:none;text-align: center; background-color: rgb(0, 0, 0); opacity: 0.5; z-index: 100; position: fixed; width: 100%; top: 0px; left: 0px; height: 988px;"></div> <div id="zcOptinSuccessPopup" style="display:none;z-index: 9999;width: 800px; height: 40%;top: 84px;position: fixed; left: 26%;background-color: #FFFFFF;border-color: #E6E6E6; border-style: solid; border-width: 1px; box-shadow: 0 1px 10px #424242;padding: 35px;"> <span style="position: absolute;top: -16px;right:-14px;z-index:99999;cursor: pointer;" id="closeSuccess"> <img src="https://plza.maillist-manage.com/images/videoclose.png"> </span> <div id="zcOptinSuccessPanel"></div> </div> <!--Zoho Campaigns Web-Optin Form Ends Here-->

	      		</div>
	      		<div class="footeraddress">
	      			<h3>Contact Us</h3>
		      		<p><i class="ico ico-map-marker"></i>{!! strip_tags(config('settings.site_address')) !!}</p>
		      		<p><i class="ico ico-envelope"></i><a href="mailto:{{ config('settings.site_email_id') }}">{{ config('settings.site_email_id') }}</a></p> 
		      		<p><i class="ico ico-mobile"></i><a href="tel:{{ config('settings.site_phone') }}">{{ config('settings.site_phone') }}</a></p>
	      		</div>
	      	</div>
	      </div>
			</div>
		</div>
	</div>
	<div class="footerinnerbottom">
		<div class="maincontainer">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="copyright">
						&copy;{{date('Y')}} <a href="{{url('/')}}">Awzonex.</a> All Right Reserved.
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="footerbtmnav">
						<ul>
							<li><a href="{{url('/page/privacy-policy')}}">Privacy Policy</a></li>
							<li><a href="{{url('/page/terms-of-use')}}">Terms of Use</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>