@extends('layouts.userinner')
@section('title', 'Profile')
@section('content')
<!--========================= profile body section start =========================-->	
	                
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
    <div class="profile-modal-body manageservices_pnl">
	@if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            @lang('sitelanguage.update_account_success_msg')
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('error') }}
        </div>
    @endif

	<div class="right-panel">
		<div class="heading-title">
			<h2>Manage Services</h2>
		</div>
        <div class="profile-body_cont">
            <form action="{{ url('updateservices') }}" method="post">
                {{ csrf_field() }}
                <div class="box_pnl_profile">
                    <h3>Select your machine service type</h3>
                    <div class="row box_pnl_row">
                        @if(!empty($machine_types))
                        @php $i=0; @endphp
                        @foreach($machine_types as $machinetype)
                        @foreach($machine_service_type as $mserv)
                        @php $data[]=$mserv->service_type @endphp
                        @endforeach
                        <div class="col-sm-3 box_pnl_col">
                            <div class="box_pnl_in">
                                <a data-fancybox="gallery" href="{{ asset($machinetype->image) }}"><img src="{{ asset($machinetype->image) }}" width="200" height="200"></a>
                                <h4>{{ $machinetype->machine_type }}</h4>
                                <div class="checkbox">
                            <input type="checkbox" name="machine_type[]" value="{{ $machinetype->id }}" id="checkimg{{$machinetype->id}}" @if(in_array($machinetype->id, $data)) checked @endif>
                            <label for="checkimg{{$machinetype->id}}"></label>
                            <input type="hidden" name="machine_type_id" value="{{ $machinetype->id }}">
                                </div>
                            </div>
                        </div>
                        @php $i++; @endphp
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="box_pnl_select">
                    <h3>Select your service type</h3>
                    <div class="box_pnl_select_inner"> 
                    @if(!empty($services))
                    @foreach($services as $service) 
                    @foreach($service_type as $serv)
                    @php $data1[]=$serv->service @endphp
                    @endforeach

                        <div class="checkbox">
                            <input type="checkbox" name="service[]" value="{{ $service->id }}" id="check{{$service->id}}" @if(in_array($service->id,$data1)) checked @endif>
                            <label for="check{{$service->id}}">{{ $service->service_name }}</label>
                            <input type="hidden" name="service_type_id" value="{{ $service->id }}">
                        </div>
                    @endforeach
                    @endif
               </div>
               <input type="submit" name="" value="submit" class="submitbtn profile_submitbtn">
                </div>
            </form>
            </div>
    </div>
    </div>
</div>
@endsection