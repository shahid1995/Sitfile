<div class="desktopviewnavigation">
	<div class="dnavigationbox">
		<div class="bignavigation">
			<ul>
				<li><a href="https://awzonex.setmore.com/" target="_blank">Know - what regulatory compliance & services you need</a></li>
				<!-- <li><a href="{{url('/page/how-altibbe-works')}}">Know - How altibbe works</a></li> -->
				<li><a href="{{url('/page/altibbe-peace-of-mind-guarantee')}}">Awzonex Peace-of-Mind Guarantee</a></li>
				
				<li><a href="{{url('/service')}}">Service</a></li>
				<li><a href="{{url('/page/quality-assurance')}}">Quality Assurance schedule</a></li>
				<!--<li><a href="{{url('/page/maintenance-service')}}">Maintenance Schedule</a></li>-->
				<!--<li><a href="javascript:void(0);">Diagnostic Trouble Codes</a></li>-->
				@if(Auth::user()->id=='') <li><a href="{{url('sregister')}}">Service agency</a></li> @endif
				<li><a href="{{url('/page/about-us')}}">About us</a></li>
				<!--<li><a href="javascript:void(0);">Testimonial</a></li>-->
				<li><a href="https://www.awzonex.com/blog/">Blog</a></li>
				<li><a href="https://forum.awzonex.com/" target="_blank">Community</a></li>
			</ul>
		</div>
		<!--<div class="smallnavigation">
			<ul>
				<li><a href="{{url('/service')}}">Service</a></li>
				<li><a href="{{url('/page/quality-assurance')}}">Quality Assurance schedule</a></li>
				<!--<li><a href="{{url('/page/maintenance-service')}}">Maintenance Schedule</a></li>-->
				<!--<li><a href="javascript:void(0);">Diagnostic Trouble Codes</a></li>-->
				<!--<li><a href="javascript:void(0);">Service agency</a></li>
				<li><a href="{{url('/page/about-us')}}">About us</a></li>-->
				<!--<li><a href="javascript:void(0);">Testimonial</a></li>-->
			<!--	<li><a href="javascript:void(0);">Blog</a></li>
				<li><a href="javascript:void(0);">Community</a></li>-->
				<!--<li><a href="{{url('/page/knowledge-corner')}}">Knowledge corner</a></li>-->
				
				<!--<li><a href="{{url('/page/public-awareness')}}">Public awareness</a></li>-->
		<!--	</ul>-->
		<!--</div>-->
	</div>
	<div class="dcontactbox">
		<a href="{{url('/contact')}}" class="dcontactboxtop">
			<div class="dcoheading">Contact</div>
			<p>Get in touch helps us to understand you better</p>
		</a>
		<div class="dcontactboxmiddle">
			<img src="{{ asset('images/nav-img.jpg')}}" alt="" />
		</div>
		<div class="dcontactboxbtm">
			<!-- <p>Get in touch helps us to understand you better</p> -->
			<p>Secure Area</p>
			<a class="btn-m" href="{{url('/login')}}">X-ray Equipment Owner</a>
			<!-- <a class="btn-m" href="{{url('/page/altibbe-service-advisor')}}">Service Agency</a> -->
			@if(Auth::user()->id=='') <a class="btn-m" href="{{ route('serviceregisterer') }}">Service Agency</a> @endif
		</div>
	</div>
</div>

<header class="headercontainer">
	<div class="maincontainer">
		<div class="row">
			<div class="col-xs-12">
				<div class="headinner">
					<div class="logocontainer">
						<a href="{{url('/')}}"><img src="{{ asset('images/logo.png')}}" alt="" /></a>
					</div>
					<div class="dsknav">
						<a href="javascript:void(0);" class="DskNavbar">
							<span></span>
							<span></span>
							<span></span>
						</a>
					</div>
					<div class="navigationbox">
						<div class="navigation">
							<div class="navigationinner">
								<!-- <a href="javascript:void(0);" id="NavBar" class="navigationbar"><i class="fa fa-bars"></i></a> -->
								<div class="navboxpanel">
									<div class="navuser">
			              <div class="userimg">
			                <img src="{{ asset('images/user1.jpg')}}" alt="User Image">
			              </div>
			              <h3>Thylane Blondeau</h3>
			              <p>India</p>
			            </div>
									<ul class="NavBox sf-menu">
										<li><a href="https://www.awzonex.com/blog/">Blog</a></li>
										<li><a href="https://forum.awzonex.com/" target="_blank">Community</a></li> 
										<li><a href="{{ url('/contact') }}">Contact Us</a></li>                                                 
									</ul>
								</div>
							</div>
						</div>
						@guest
						<div class="userbtns">
							<a class="login" href="{{url('login')}}"><i class="ico ico-password"></i><span>Sign In</span></a>
							<a class="signup" href="{{url('register')}}"><i class="ico ico-register"></i><span>Sign up</span></a>
						</div>
						@endguest
						@auth
						<div class="userimgbx">
							<a id="UserDrop" class="useprofilerimg" href="javascript:void(0);">
								@php
									if(Auth::user()->roll_id == '2'):
									if(!empty(Auth::user()->company_logo)):
								@endphp
								<img src="{{ url('/') }}/public/images/upload/service/{{ Auth::user()->company_logo}}" alt="" />
								@php
								else:
								@endphp
								<img src="{{ url('/public/images/user_icon.png') }}" alt="" />
								@php
								endif;
									elseif(Auth::user()->roll_id == '1'):
									if(!empty(Auth::user()->profile_picture)):
								@endphp
								<img src="{{ url('/') }}/public/{{ Auth::user()->profile_picture }}" alt="" />
								@php
								else:
								@endphp
								<img src="{{ url('/public/images/user_icon.png') }}" alt="" />
								@php
									endif;
									endif;
								@endphp
							</a>
							<div id="UserDropBox" class="userdropdown">
								<ul>
								    <li><a href="{{ url('user/dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
									<li><a href="{{url('user/profile')}}"><i class="fa fa-user-o"></i>Account Setting</a></li>
									<li><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i>Sign Out</a></li>
								</ul>
							</div>
						</div>
						@endauth
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
