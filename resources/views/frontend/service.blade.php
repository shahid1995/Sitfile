@extends('layouts.master_new')
@section('title', 'Home')
@section('content')


<section class="bannercontainer">
	<div class="innerbanner service_banner">
		<div class="container">
			<div class="innerbanner_content">
			<img src="{{ asset('images/banner_inner1.png') }}" alt="inr_banner">
			<div class="bnr_2btn">
			<a href="#quality_assurance" class="get_btn">Quality Assurance (QA) test service</a>
			<a href="#regulatory_compliance" class="get_btn2">Regulatory Compliance Service</a>
			</div>
			</div>
		</div>
	</div>
</section>

<section class="inr_body_section">
	<div class="two_process_section srv_process">
		<div class="process_row first_blue" id="quality_assurance">
		<div class="container">
			<div class="process_content">
				<div class="row">
					<div class="col-sm-6 pull-right">
						<div class="service_img">
							<img src="{{ asset('images/small_inr_img4.png') }}" alt="sm4">
						</div>	
					</div>
					<div class="col-sm-6 pull-left bluecolor">
						<div class="box_content">
							<h5>Quality Assurance (QA) test service</h5>
							
							{!! $quality_assurance->page_content !!}
							
							@if(Auth::user()->id)
							<a href="{{ url('user/dashboard') }}" class="get_support_btn">Get Started</a>
							@else
							<a href="{{ url('/sign-up') }}" class="get_support_btn">Get Started</a>
							@endif
							
							
						</div>	
					</div>
				</div>	
			</div>	
		</div>
		</div>
		<div class="process_row dark_blue" id="regulatory_compliance">
		<div class="container">
			<div class="process_content">
				<div class="row">
					<div class="col-sm-6">
						<div class="service_img">
							<img src="{{ asset('images/small_inr_img5.png') }}" alt="sm5">
						</div>	
					</div>
					<div class="col-sm-6 bluecolor">
						<div class="box_content">
							<h5>Regulatory Compliance Service</h5>
                                {!! $regulatory_compliance->page_content !!}
                                
							@if(Auth::user()->id)
							<a href="{{ url('user/dashboard') }}" class="get_support_btn">Get Started</a>
							@else
							<a href="{{ url('/sign-up') }}" class="get_support_btn">Get Started</a>
							@endif
							
						</div>	
					</div>
				</div>	
			</div>	
		</div>
		</div>
	</div>

	<!--<div class="three_options twooptiontxt">
		<div class="container">
			<div class="rowthree">
				<div class="col4">
					<div class="srv_box">
						<h4>Procurement of X-ray Equipment</h4>
						<p>The employer shall procure NOC validated/ Type Approved X-ray equipment from authorized suppliers and after obtaining procurement permission from the Competent Authority.</p>
					</div>	
				</div>	
				<div class="col4">
					<div class="srv_box">
						<h4>Operation of X-ray Equipment</h4>
						<p>It’s fun. It’s challenging. It’s rewarding. If you’re ready to do some of the best work of your career, altibbe is for you.</p>
					</div>	
				</div>
			</div>	
		</div>	
	</div>-->
	
	
	{!! $procurement_equipment->page_content !!}
	
	
	<div class="book_service_section bluetexture bookservicep">
		<div class="container">
			<h3>Pre-requisites for obtaining Licence for<br> Operation of X-ray Equipment</h3>
		<!--	<h5>X-ray Room Layout and Shielding Requirement</h5>-->
			<!--<div class="fullslide_content">
				<div id="fullSays" class="owl-carousel owl-theme">
					<div class="item wow fadeInDown" data-wow-delay="0.1s">
						<div class="ftxt2">
							Appropriate structural shielding shall be provided for walls, doors, ceiling and floor of the room housing the X-ray equipment so that radiation exposures received by workers and the members of the public are kept to the minimum and shall not exceed the respective limits for annual effective doses as per directives issued by the Competent Authority.
						</div>	
					</div>
					<div class="item wow fadeInDown" data-wow-delay="0.1s">
						<div class="ftxt2">
							Appropriate structural shielding shall be provided for walls, doors, ceiling and floor of the room housing the X-ray equipment so that radiation exposures received by workers and the members of the public are kept to the minimum and shall not exceed the respective limits for annual effective doses as per directives issued by the Competent Authority.
						</div>	
					</div>
					<div class="item wow fadeInDown" data-wow-delay="0.1s">
						<div class="ftxt2">
							Appropriate structural shielding shall be provided for walls, doors, ceiling and floor of the room housing the X-ray equipment so that radiation exposures received by workers and the members of the public are kept to the minimum and shall not exceed the respective limits for annual effective doses as per directives issued by the Competent Authority.
						</div>	
					</div>
				</div>
			</div>-->
		
			
			
			<div class="fullslide_content">
				<div id="fullSays" class="owl-carousel owl-theme">
				    
				    @foreach($shielding_requirement as $shielding_requirement_data)
					<div class="item wow fadeInDown" data-wow-delay="0.1s">
					    <h5 class="valuehead">{{ $shielding_requirement_data->name }}</h5>
						<div class="ftxt2">
						    
						    {{ $shielding_requirement_data->details }}
						    
						</div>	
					</div>
					@endforeach
					
					
				</div>
			</div>
			
			
			
			<!--<div class="valueSlide owl-carousel owl-theme">
						<div class="item">
							<div class="valuebox">
								<h5 class="valuehead">Customer Commitment</h5>
								<div class="valcon">
									<p>We develop relationships that make a positive difference in our customer’s lives.</p>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="valuebox">
								<h5 class="valuehead">Customer Commitment</h5>
								<div class="valcon">
									<p>We develop relationships that make a positive difference in our customer’s lives.</p>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="valuebox">
								<h5 class="valuehead">Customer Commitment</h5>
								<div class="valcon">
									<p>We develop relationships that make a positive difference in our customer’s lives.</p>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="valuebox">
								<h5 class="valuehead">Customer Commitment</h5>
								<div class="valcon">
									<p>We develop relationships that make a positive difference in our customer’s lives.</p>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="valuebox">
								<h5 class="valuehead">Customer Commitment</h5>
								<div class="valcon">
									<p>We develop relationships that make a positive difference in our customer’s lives.</p>
								</div>
							</div>
						</div>
					</div>-->
			
			
		</div>
	</div>
	
	

</section>

@endsection

