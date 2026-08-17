@extends('layouts.master_new')
@section('title', 'Home')
@section('content')


<section class="bannercontainer">
	<div class="innerbanner">
		<div class="container">
			<div class="innerbanner_content">
			<img src="{{ asset('images/banner_inner.png') }}" alt="inr_banner">
			<p>The Altibbe Guarantee means quality of work, hassle-free payment resolution, and robust customer support throughout the experience.</p>
			<a href="javascript:void(0);" class="get_btn">Get Free Consultation</a>
			</div>
		</div>
	</div>
</section>

<section class="inr_body_section">
	<div class="three_options">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="srv_box">
						<img src="{{ asset('images/icon_iner1.png') }}" alt="ico1">
						<h4>Quality Service</h4>
						<p>We are constantly developing various tools to provide the quality service to ensure a high-quality experience for our customers.</p>
					</div>	
				</div>	
				<div class="col-sm-4">
					<div class="srv_box">
						<img src="{{ asset('images/icon_iner2.png') }}" alt="ico2">
						<h4>No Unexpected Charges</h4>
						<p>We review pricing changes from the initial quote with the customer prior to initiating incremental services.</p>
					</div>	
				</div>
				<div class="col-sm-4">
					<div class="srv_box">
						<img src="{{ asset('images/icon_iner3.png') }}" alt="ico3">
						<h4>Secure Payment</h4>
						<p>Payment is easy and safe with Altibbe’s secure payment system.</p>
					</div>	
				</div>
			</div>	
		</div>	
	</div>	
	<div class="book_service_section">
		<div class="container">
			<h3>Book Service with Confidence</h3>
			<div class="srv_content">
				<div class="row">
					<div class="col-sm-6">
						<div class="service_img">
							<img src="{{ asset('images/small_inr_img1.png') }}" alt="sm1">
						</div>	
					</div>
					<div class="col-sm-6">
						<div class="box_content">
							<h5>We’re here to make your service experience as pain-free as possible</h5>
							<p>Altibbe’s free Concierge service gives customers additional guidance and support with AERB Regulatory Compliance questions and service bookings.</p>
							<a href="javascript:void(0);" class="get_support_btn">Get free support</a>
						</div>	
					</div>
				</div>	
			</div>	
		</div>
	</div>	

	<div class="two_process_section">
		<div class="process_row first_blue">
		<div class="container">
			<div class="process_content">
				<div class="row">
					<div class="col-sm-6 pull-right">
						<div class="service_img">
							<img src="{{ asset('images/small_inr_img2.png') }}" alt="sm2">
						</div>	
					</div>
					<div class="col-sm-6 pull-left bluecolor">
						<div class="box_content">
							<h5>Stay up to date with Regulatory Compliance</h5>
							<p>Once you join Altibbe, you’ll get notification for taking necessary action on time to perform Periodic Quality Assurance tests as prescribed by AERB.</p>
							<a href="javascript:void(0);" class="get_support_btn">Get free support</a>
						</div>	
					</div>
				</div>	
			</div>	
		</div>
		</div>
		<div class="process_row">
		<div class="container">
			<div class="process_content">
				<div class="row">
					<div class="col-sm-6">
						<div class="service_img">
							<img src="{{ asset('images/small_inr_img3.png') }}" alt="sm3">
						</div>	
					</div>
					<div class="col-sm-6 bluecolor">
						<div class="box_content">
							<h5>Our Omnichannel contact systems keep things smooth</h5>
							<p>This feature on Altibbe creates a new level of transparency. Helps to get in touch instantly when you need to.</p>
							<a href="javascript:void(0);" class="get_support_btn">Request a callback</a>
						</div>	
					</div>
				</div>	
			</div>	
		</div>
		</div>
	</div>
</section>

@endsection

