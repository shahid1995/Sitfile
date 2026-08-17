@extends('layouts.master_new')
@section('title', 'Home')
@section('content')

<section class="bannercontainer" data-parallax="scroll" data-image-src="{{ asset("images/bannerimg1.jpg")}}">
	<div class="bannercontainerinner">
		<div class="maincontainer">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-push-2 col-md-push-2">
					<div class="bannersearch">
						<h2 class="fadeInDown animated">X-Ray equipment repair and quality assurance test, Simplified</h2>
						<p class="fadeInDown animated">Awzonex is your trusted partner for X-Ray equipment care</p>
						<div class="locationbox">
							<div class="form-group">
								<!--<label class="fadeInDown animated">Tell us your location</label>-->
								<div class="stickyloactionwrap">
									<div class="maincontainer">
										<div class="stickyloactionrow">
											<div class="stickylogocolumn">
												<div class="logocontainer">
													<a href="{{ url('/') }}"><img src="{{ asset('images/logo-sticky.png')}}" alt="Logo" /></a>
												</div>
												<div class="dsknav">
													<a href="javascript:void(0);" class="DskNavbar">
														<span></span>
														<span></span>
														<span></span>
													</a>
												</div>
											</div>
											<div class="stickyloactioncolumn">
												<div class="formgroupinner fadeInDown animated">
													<!-- <input type="text" class="form-control" placeholder="Enter City, State, or Zip" name="pincode" required />
													<button class="getstartedbtn" type="submit"><span>Get Started</span><i class="ico ico-right-arrow-o"></i></button>-->
													
													@if($user_id)
													<a href="{{ url('user/dashboard') }}" class="getstartedbtn"><span>Access your account</span><i class="ico ico-right-arrow-o"></i></a>
												    @else
												
													<a href="{{ url('/sign-up') }}" class="getstartedbtn"><span>Get Started</span><i class="ico ico-right-arrow-o"></i></a>
												    
												    @endif
												
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="howitcontainer">
	<div class="maincontainer">
		<div class="row">
			<div class="col-xs-12 wow fadeInDown" data-wow-delay="0.1s">
				<h2>How Awzonex Works</h2>
				<p>Caring for your X-Ray equipment has never been easier!</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-push-1 col-md-push-1">
				<!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="wow fadeInDown" data-wow-delay="0.1s"><a id="QualityAssurance" href="javascript:void(0);">Quality Assurance<br>test Service</a></li>
					<!-- <li role="presentation" class="wow fadeInUp" data-wow-delay="0.2s"><a id="RepairingBtn" href="javascript:void(0);">Repairing<br>Service</a></li> -->
			  </ul>
			  <!-- Tab panes -->
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="Quality">


			    	{!! $static_page->page_content !!}

			    	<!-- <div class="tabpaneinner">
				    	<h4>3 Easy Steps for Booking Quality Assurance test Service</h4>
				    	<div class="wizarbox">
				    		<div class="wizarboxinner">
				    			<div class="wizardcolumn wow fadeInDown" data-wow-delay="0.1s">
				    				<div class="wizardcolumninner">
				    					<span class="circlebox" id="GetInstant">1</span>
				    					<div class="circletext">Get Instant Quote<br>Online</div>
				    				</div>
				    			</div>
				    			<div class="wizardcolumn wow fadeInUp" data-wow-delay="0.2s">
				    				<div class="wizardcolumninner">
				    					<span class="circlebox" id="ScheduleAppointment">2</span>
				    					<div class="circletext">Schedule your<br>Appointment</div>
				    				</div>
				    			</div>
				    			<div class="wizardcolumn wow fadeInDown" data-wow-delay="0.3s">
				    				<div class="wizardcolumninner">
				    					<span class="circlebox" id="PaySecurely">3</span>
				    					<div class="circletext">Pay Securely<br>Online</div>
				    				</div>
				    			</div>
				    		</div>
				    		<div class="timelinerow">
				    			<div class="timelinecolumn12">
				    				<div class="timelinebox">
				    					<div id="GetInstantBox" class="timelineboxrow wow fadeInDown" data-wow-delay="0.1s">
				    						<div class="timelineboxcolumn">
				    							<div class="timelineboxinner">
				    								<span class="circleboxprimary">1</span>
				    								<h5>Get instant quote online</h5>
				    								<p>Choose the agency that’s right for you, then pick aconvenient day and time for your service</p>
				    							</div>
				    						</div>
				    					</div>
				    					<div id="ScheduleAppointmentBox" class="timelineboxrow wow fadeInUp" data-wow-delay="0.1s">
				    						<div class="timelineboxcolumn">
				    							<div class="timelineboxinner">
				    								<span class="circleboxprimary">2</span>
				    								<h5>Schedule your appointment</h5>
				    								<p>Choose the agency that’s right for you, then pick aconvenient day and time for your service</p>
				    							</div>
				    						</div>
				    					</div>
				    					<div id="PaySecurelyBox" class="timelineboxrow wow fadeInDown" data-wow-delay="0.1s">
				    						<div class="timelineboxcolumn">
				    							<div class="timelineboxinner">
				    								<span class="circleboxprimary">3</span>
				    								<h5>Pay securely online</h5>
				    								<p>Hold your appointment by authorising service ordergenerated by our system, and pay securely online whenyour service is completed</p>
				    							</div>
				    						</div>
				    					</div>
				    				</div>
				    			</div>
				    		</div>
				    	</div>
				    </div> -->
				    <!-- <div id="RepairingService" class="tabpaneinner">
				    	<h4>3 Easy Steps for Booking Repairing Service</h4>
				    	<div class="wizarbox">
				    		<div class="wizarboxinner">
				    			<div class="wizardcolumn wow fadeInDown" data-wow-delay="0.1s">
				    				<div class="wizardcolumninner">
				    					<span class="circlebox" id="GetInstant2">1</span>
				    					<div class="circletext">Get Instant Quote<br>Online</div>
				    				</div>
				    			</div>
				    			<div class="wizardcolumn wow fadeInUp" data-wow-delay="0.2s">
				    				<div class="wizardcolumninner">
				    					<span class="circlebox" id="ScheduleAppointment2">2</span>
				    					<div class="circletext">Schedule your<br>Appointment</div>
				    				</div>
				    			</div>
				    			<div class="wizardcolumn wow fadeInDown" data-wow-delay="0.3s">
				    				<div class="wizardcolumninner">
				    					<span class="circlebox" id="PaySecurely2">3</span>
				    					<div class="circletext">Pay Securely<br>Online</div>
				    				</div>
				    			</div>
				    		</div>
				    		<div class="timelinerow">
				    			<div class="timelinecolumn12">
				    				<div class="timelinebox">
				    					<div id="GetInstantBox2" class="timelineboxrow wow fadeInDown" data-wow-delay="0.1s">
				    						<div class="timelineboxcolumn">
				    							<div class="timelineboxinner">
				    								<span class="circleboxprimary">1</span>
				    								<h5>Get instant quote online</h5>
				    								<p>Choose the agency that’s right for you, then pick aconvenient day and time for your service</p>
				    							</div>
				    						</div>
				    					</div>
				    					<div id="ScheduleAppointmentBox2" class="timelineboxrow wow fadeInUp" data-wow-delay="0.2s">
				    						<div class="timelineboxcolumn">
				    							<div class="timelineboxinner">
				    								<span class="circleboxprimary">2</span>
				    								<h5>Schedule your appointment</h5>
				    								<p>Choose the agency that’s right for you, then pick aconvenient day and time for your service</p>
				    							</div>
				    						</div>
				    					</div>
				    					<div id="PaySecurelyBox2" class="timelineboxrow wow fadeInDown" data-wow-delay="0.3s">
				    						<div class="timelineboxcolumn">
				    							<div class="timelineboxinner">
				    								<span class="circleboxprimary">3</span>
				    								<h5>Pay securely online</h5>
				    								<p>Hold your appointment by authorising service ordergenerated by our system, and pay securely online whenyour service is completed</p>
				    							</div>
				    						</div>
				    					</div>
				    				</div>
				    			</div>
				    		</div>
				    	</div>
				    </div> -->
			    </div>
			  </div>
			</div>
		</div>
	</div>
</section>

<section class="bookcontainer">
	<div class="maincontainer">
		<div class="bookrow">

			@foreach($package_list as $package_data)
			@php
				if($package_data->id==3) $model='FirstCardModal';
				else if($package_data->id==2) $model='SecondCardModal';
				else $model='';
			@endphp
			<div class="bookcolumn wow fadeInDown" data-wow-delay="0.1s">
				<a @if($package_data->id==1) href="https://sefely.zohobookings.com/#/customer/bookings" @else href="https://sefely.zohobookings.com/#/customer/bookings" @endif @if($package_data->id!=1) data-toggle="modal" data-target="#{{$model}}" @endif><div class="bookcolumninner">
					<span class="iconcircle"><i class="{{$package_data->icon_class}}"></i></span>
					<h3>{{$package_data->package_name}}</h3>
					<h4>{{$package_data->sub_title}}</h4>
					{!! $package_data->description !!}
					<!-- <div class="bookbtns">
						<a href="javascript:void(0);" class="bookbtn">Book a consultation <i class="ico ico-right-arrow-o"></i></a>
					</div> -->
				</div></a>
			</div>
			@endforeach
			
		</div>
	</div>

	<!--First Card Modal -->
	<div id="FirstCardModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">QA Test Reminder</h4>
	      </div>
	      <div class="modal-body">	
	      <div id="response-msgt"></div>
	      <form action="#" method="post" id="testreminder"> 
	      {{ csrf_field() }}
	        <div class="form-group">
	        	<label>Is your institute NABH/NABL Accredited?</label> &nbsp; &nbsp;
	        	<input type="radio" name="response" value="1" checked="true">Yes
	        	<input type="radio" name="response" value="0">No
	        </div>
        	<div class="form-group">
        		<label>Last QA test date</label>
        		<input type="text" name="date" id="datepicker" class="form-control"> Or
        	</div>
        	
        	<div class="form-group">
		        	<label>Mobile Number:</label>
		        	<input type="text" name="mobile" id="phonenot" maxlength="12" placeholder="919876543210" class="form-control" required>
		   </div>
		   
		   <div class="form-group">
		        	<label>Email:</label>
		        	<input type="text" name="email" id="emailt"  placeholder="" class="form-control" required>
		   </div>
		   
		   
        	
        	<div class="form-group">
        		<input type="checkbox" class="qatestcheck1" name=""> I have not gotten done QA test ever.
        	</div>
        	<div id="msgresp"></div>
	      </div>
	      
	      </form>
	      
	     <!-- <div class="bookbtns">
	          <input type="submit" value="Remind Me" class="bookbtn">
	      </div>-->
	      <!--<div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>-->
	    </div>

	  </div>
	</div>

	<!--First Card Modal -->
	<div id="SecondCardModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Regulatory Compliances</h4>
	      </div>
	      <div class="modal-body">	 
	      	<div id="response-msg"></div>
		    <form action="#" method="post" id="shedulecall"> 
		      	{{ csrf_field() }}
		        <h4 style="text-align: center; font-weight: bold;">Schedule a call with our sales executive ?</h4>
		        <div class="form-group">
		        	<label>Date :</label> <input type="text" name="date" id="datetime2" class="form-control" required>
		        </div>
		        <div class="form-group">
		        	<lable>Time :</lable> <input type="time" name="time" id="time" class="form-control" required>
		        </div>
		        <div class="form-group">
		        	<label>Mobile Number:</label>
		        	<input type="text" name="mobile" id="phoneno" maxlength="12" placeholder="919876543210" class="form-control" required>
		        </div>
		        <div class="form-group">
		        	<input type="submit" class="bookbtn" value="Shedule">
		        </div>
		    </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>


</section>

<section class="guranteecontainer">
	 <!-- <div class="maincontainer">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 wow fadeInDown" data-wow-delay="0.1s">
				<div class="guaranteedbox">
					<img src="{{ asset('images/guaranteed-img.jpg') }}" alt="" />
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay="0.2s">
				<div class="guaranteedcontent">
					<h2>All Services is backed by Altibbe Peace-of-Mind Guarantee</h2>
					<ul>
						<li><i class="ico ico-thumbs-up"></i>Quality Service</li>
						<li><i class="ico ico-inr"></i>No unexpected charges</li>
						<li><i class="ico ico-credit-cardt"></i>Secure payment</li>
					</ul>
					<a href="javascript:void(0);" class="learnmore">Learn More<i class="ico ico-right-arrow-o"></i></a>
				</div>
			</div>
		</div>
	</div>  -->

	{!! $satisfaction->page_content !!}
</section>

<section class="clientcontainer">
	<div class="maincontainer">
		<div class="row">
			<div class="col-xs-12">
				<h2>What our clients are saying</h2>
			</div>
		</div>
		<div class="row">
			<div id="ClientsSays" class="owl-carousel owl-theme">

				@foreach($clients_say as $client_data)
				<div class="item wow fadeInDown" data-wow-delay="0.1s">
					<div class="clientsay">
						<img src="{{ asset($client_data->image)}}" alt="" />
						<div class="clientsaycontent">
							<div class="ovheight">
								<p>{{$client_data->clients_says}}</p>
							</div>
							<div class="readmore_wrap">
								<!--<a href="javascript:void(0);" class="moreread">Read More</a>-->
								<a data-name="{{ $client_data->name }}" data-content="{{$client_data->clients_says}}" data-image="{{ asset($client_data->image)}}" class="review_btn" href="javascript:void(0);">Read More</a>
							</div>
							<div class="username">{{ $client_data->name }}</div>
						</div>
					</div>
				</div>
				@endforeach
				
			</div>
		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal fade reviewmodal" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="reviewuserbox">
            <div class="reuserimg">
                <img id="client_image" src="" alt="" />
            </div>
            <div class="reuserct">
                <h5 id="client_name"></h5>
            </div>
            <p id="client_content"></p>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript">

	$(".review_btn").on('click', function() {

        var name = $(this).attr('data-name');

        var content = $(this).attr('data-content');
    
        var image = $(this).attr('data-image');

        $("#client_name").html(name);
    
        $("#client_content").html(content);
    
        $("#client_image").attr('src',image);

        $("#reviewModal").modal('show');

    });

    $(".qatestcheck").on('click', function() {
        
        $("#msgresp").html('<div class="bookbtns"><a href="{{url("/register")}}" class="bookbtn">Remind Me</a></div>');
        
    });

 	

</script>

@endsection

