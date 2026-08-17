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
	      			<li><a href="{{url('/page/privecy-policy')}}">Policy</a></li>
	      			<?/*<li><a href="{{url('testimonials') }}">Testimonials</a></li>*/?>
	      			<li><a href="javascript:void(0);">Blog</a></li>
	      			<li><a href="javascript:void(0);">Community</a></li>
	      			<?/*<li><a href="javascript:void(0);">Forum</a></li>
	      			<li><a href="{{url('/page/public-awareness')}}">Public Awareness</a></li>
	      			<li><a href="{{url('/page/knowledge-corner')}}">Knowledge Corner</a></li>*/?> 
	      			<li><a href="{{ url('/contact') }}">Contact Us</a></li>
	      		</ul>
	      	</div>
	      </div>
	      <div class="footerflexcol3">
	      	<div class="footernav">
	      		<h3>Discover</h3>
	      		<ul>
	      			<?/*<li><a href="{{url('/page/how-altibbe-works')}}">How altibbe Works</a></li>
	      			<li><a href="javascript:void(0);">Sign Up</a></li>
	      			<li><a href="{{url('/page/guarantee')}}">Guarantee</a></li>*/?>
	      			<li><a href="{{url('/page/quality-assurance')}}">Quality Assurance (QA) test service</a></li>
	      			<?/*<li><a href="{{url('/page/maintenance-service')}}">Maintenance Service</a></li>
	      			<li><a href="{{url('/page/aerb-license')}}">AERB License/Regulatory</a></li>*/?> 
	      			<li><a href="{{url('/page/aerb-license')}}">AERB Compliance Service</a></li>
	      			<?/*<li><a href="{{url('/page/service-area')}}">Service Area</a></li>*/?>
	      			<li><a href="{{url('/page/guarantee')}}">Guarantee</a></li>
	      			<li><a href="{{url('register')}}">Sign Up</a></li>
	      		</ul>
	      	</div>
	      </div>
	      <div class="footerflexcol4">
	      	<div class="footernav">
	      		<?/*<h3>Discover</h3>
	      		<ul>
	      			<li><a href="{{url('/page/why-join-altibbe')}}">Why join altibbe</a></li>
	      			<li><a href="{{url('/page/how-the-marketplace-Works')}}">How the marketplace Works</a></li> 
	      			<li><a href="javascript:void(0);">Altibbe Profile</a></li>
	      			<li><a href="{{url('/page/altibbe-service-advisor')}}">Altibbe Service Advisor</a></li> 
	      			<li><a href="javascript:void(0);">Join Us</a></li>
	      		</ul>*/?>
	      	</div>
	      </div>
	      <div class="footerflexcol5">
	      	<div class="footernav">
	      		<div class="footernewsletter">
	      			<h3>Subscribe to our newsletter</h3>

	      			@if (Session::has('success'))
				        <div class="alert alert-success">
				          <strong>Success!</strong> 
				          {{ Session::get('success') }}
				        </div>
				     @endif
	      			<div class="form-group">
	      				<div class="newslgroup">
	      					<form action="{{url('/newsletter')}}#newsletter" method="post">
	      					{{ csrf_field() }}
	      					<input type="email" class="form-control" placeholder="Enter your email" name="email" required/>
	      					<!-- <input type="submit" class="subscribebtn ico ico-paper-plane"> -->
	      					<button type="submit" class="subscribebtn"><i class="ico ico-paper-plane"></i></button>
	      				</form>
	      				</div>
	      			</div>
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
						&copy;{{date('Y')}} <a href="{{url('/')}}">Altibbe.</a> All Right Reserved.
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