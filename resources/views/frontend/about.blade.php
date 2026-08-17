@extends('layouts.inner')
@section('title', 'Page')
@section('content')

<section class="about_panel_sec abtblock">
	@foreach ($page_details as $details)
		@foreach ($details->details as $content)
			@if(!$content->has_slider)
				{!! $content->page_content !!}
			@else
				<div class="about_panel_sec_inner">
					<div class="value_wrap">
						<div class="container">
							<h3 class="vshead">{{ $content->page_title }}</h3>
							<div class="valueslide_wrap">
								<div class="valueSlide owl-carousel owl-theme">
									@foreach ($content->sliders as $slider)
										<div class="item">
											<div class="valuebox">
												<h5 class="valuehead">{{ $slider->slider_title }}</h5>
												<div class="valcon">
													<p>{!! $slider->content !!}</p>
												</div>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			@endif
		@endforeach
	@endforeach
</section>
{{-- <section class="about_panel_sec abtblock">
	<div class="about_top_outer">
		<div class="container">
			<div class="about_banner_pic">
				<img src="http://192.168.5.44/sahid/public/images/about-banner-page.png" alt="">
			</div>
			<div class="about_panel_sec_inner">
				<div class="about_top">
					<h1>Let's protect your x ray technician and patient from over exposure, together</h1>
					<h4>With your passion and our expertise, anything is possible</h4>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="about_panel_sec_inner">	
			<div class="whoweare_wrap">
				<div class="row">
					<div class="col-sm-6 aboutn_left">
						<div class="about_service_img">
							<img src="http://192.168.5.44/sahid/public/images/who-we-are.png" alt="">
						</div>
					</div>
					<div class="col-sm-6 aboutn_right">
						<div class="about_service_content">
							<h2>Who We Are?</h2>
							<p>We come from diverse backgrounds and are united by an enthusiasm for great services and delightful customer experiences. We created altibbe to be different from other companies. We believe that you shouldn’t have to compromise when it comes to the services you need to ensure the Quality of your x-ray equipment and to safeguard whom you care, so ours are designed to be effective and to provide a great experience.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="whatwedo_wrap">
				<div class="row">
					<div class="col-sm-6 what_left">
						<div class="about_service_img">
							<img src="http://192.168.5.44/sahid/public/images/what-we-do.png" alt="">
						</div>
					</div>
					<div class="col-sm-6 what_right">
						<div class="about_service_content">
							<h2>What We Do?</h2>
							<p>Our team of more than 20 remote engineers all over India provides quality service to give you the insight of your equipment as well as to help you to comply with the AERB Norms.</p>
						</div>
					</div>
				</div>
			</div>

			<div class="question_wrap">
				<div class="row">
					<div class="col-sm-4">
						<div class="qbox">
							<h3 class="qtitile">What is altibbe’s mission?</h3>
							<div class="qcontent">
								<p>“To be and be recognized as India’s most customer-centric company, where people can get the best product and services they might need to operate medical equipment properly and focus on the price and convenience.”</p>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="qbox">
							<h3 class="qtitile">What’s it like working at altibbe?</h3>
							<div class="qcontent">
								<p>It’s fun. It’s challenging. It’s rewarding. If you’re ready to do some of the best work of your career, altibbe is for you.</p>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="qbox">
							<h3 class="qtitile">What are we proud of?</h3>
							<div class="qcontent">
								<p>We’re innovative, but thoughtful about it. We update our product and service a lot, but it’s based on real research.We want to deliver a solution that actually helps our customers. Otherwise, what’s the point.</p>
							</div>
						</div>
					</div>
				</div>
			</div>					
		</div>
	</div>
	
	<div class="about_panel_sec_inner">
		<div class="value_wrap">
			<div class="container">
				<h3 class="vshead">Our values</h3>
				<div class="valueslide_wrap">
					<div class="valueSlide owl-carousel owl-theme">
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
					</div>
				</div>
			</div>
		</div>
	</div>
</section> --}}
@endsection