@extends('layouts.inner')
@section('title', 'Service Providers')
@section('content')

	<div class="container">
		<div class="pro_list_block">
			<div class="row">
			@php 
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
			@endphp	
			</div>
		</div>
	</div>

@endsection