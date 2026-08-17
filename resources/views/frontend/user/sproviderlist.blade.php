@extends('layouts.inner')
@section('title', 'Service Providers')
@section('content')
<section class="serviceprovidecontainer">
	<div class="maincontainer">
		<div class="pro_list_block1">
			<div class="row">
			<!--@php 
				foreach($providers as $provider):
			@endphp
				<div class="col-sm-4">
					<a href="#" class="probox">						
						<div class="propic_outer">				
							<figure class="propic">
								<img src="{{ url('/') }}/public/images/upload/service/{{$provider->company_logo}}" height="250px" width="500px">
							</figure>
						</div>
						<h3>{{$provider->company_name}} <i class="fa fa-angle-right" aria-hidden="true"></i></h3>						
					</a>
				</div>
				
			@php
				endforeach;
			@endphp-->
    			<div class="col-xs-12">
    			    <ul class="nav nav-tabs" role="tablist">
        				<li role="presentation" class="active"><a href="#QualityAssurance" aria-controls="QualityAssurance" role="tab" data-toggle="tab">Quality Assurance (QA) test service</a></li>
                        <li role="presentation"><a href="#RegulatoryBtn" aria-controls="RegulatoryBtn" role="tab" data-toggle="tab">Regulatory Compliance Service</a></li>
        			</ul>
        			<di class="tab-content">
        			    <div role="tabpanel" class="tab-pane active" id="QualityAssurance">
        			        <h5>Quality Assurance (QA) test service</h5>
        			        <p>A QA programme in diagnostic radiology serves to ensure that the diagnostic images produced are of sufficiently high quality so that they reliably provide adequate diagnostic information with both the lowest possible cost and the least possible exposure of the patient to radiation. A QA programme of imaging equipment used in radiotherapy should not only address image quality but also geometry, including laser/couch and other geometric alignment. Furthermore, if CT data are used for treatment planning, the consistency of the electron density values across the CT, treatment planning system (TPS), and digitally-reconstructed radiographs (DRRs) should be verified.</p>
        			        <a href="javascript:void(0);" class="getstartbtn">Get Started<i class="ico ico-right-arrow-o"></i></a>
        			    </div>
        			    <div role="tabpanel" class="tab-pane" id="RegulatoryBtn">
        			        <h5>Regulatory Compliance Service</h5>
        			        <ol>
        			            <li><strong>Procurement of X-ray Equipment:</strong> You must procure NOC validated/ Type Approved X-ray equipment from authorized suppliers and after obtaining procurement permission from the AERB.</li>
        			            <li><strong>Operation of X-ray Equipment:</strong> You must obtain license for operation of X-Ray equipment from AERB before opening for public</li>
        			            <li><strong>X-ray Room Layout and Shielding Requirement:</strong> You may be wondering why you need to provide radiation protection at your site. The reason is simple: to ensure adequate protection for your staff and the general public in areas where your ionising radiation emitting equipment is used.<br>The specifications are a decisive factor for the success of your operation. Before you start creating your room, you must determine what radiation sources will be used, the technical characteristics and requirements, the plans of the facility, as well as the desired specifications. All these parameters determine the shielding requirements and must take into account the dose emitted, the distance between a person and the radiation source and the duration of exposure.<br>Throughout the project, the Radiation Protection Officer (RPO) will be your main contact person.</li>
        			            <li><strong>Renewal of Licence:</strong> License for operation of X-Ray equipment is valid for 5 years except dental X-ray equipment. You must renew your license before it expires.</li>
        			            <li><strong>Decommissioning of X-ray Equipment:</strong> The procedure for decommissioning x-ray machines depends on the type of the generating device and its construction. Several manufacturers, upon purchase, provide users with the option to return the equipment for disposal at a cost. The cost varies among manufacturers. If the return option is not available, the machine could be disassembled according to the manufacturer’s specific procedures and its individual components disposed of accordingly.</li>
        			        </ol>
        			        <p>X-ray machines do not present a radiation hazard when they are not in operation. Additionally, activation of structural components is not likely due to the nature of the produced radiation and its interaction with the structural materials. However, many structural components are built with materials that may be considered hazardous (e.g., lead, tungsten) for disposal purposes. These materials may be segregated and disposed of according to the regulatory agency having jurisdiction.</p>
        			        <a href="javascript:void(0);" class="getstartbtn">Get Started<i class="ico ico-right-arrow-o"></i></a>
        			    </div>
        			</di>
    			</div>
			</div>
		</div>
	</div>
</section>
@endsection