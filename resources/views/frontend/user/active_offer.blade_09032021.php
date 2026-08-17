@extends('layouts.userinner')
@section('title', 'Active Offer')
@section('content')

<div class="col-md-9 col-sm-8 col-xs-12 col9flex gfghf">
	<div class="profile_block">
		@if (session('success'))
	        <div class="alert alert-success alert-dismissible">
	            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	            {{ session('success') }}
	        </div>
	    @endif
	    @if (session('error'))
	        <div class="alert alert-danger alert-dismissible">
	            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	            {{ session('error') }}
	        </div>
	    @endif
	    
		<div class="right-panel">
			<div class="logheading">
			    <h2 class="pull-left">Active Offer</h2>
			</div>
			    @if(!empty($order_details))
    		    @foreach($order_details as $order_details)
    		    @php $order_id = $order_details->id; @endphp
    		    @php $services = DB::table('service_order_equipment_services as soe')->select('services.service_name','soe.order_id','soe.service_id')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order_id)->groupBy('soe.service_id')->get(); @endphp
    			<div class="row">
    				<div class="col-sm-12">
    					@if (session('success'))
    				        <div class="alert alert-success alert-dismissible">
    				            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    				            {{ session('success') }}
    				        </div>
    				    @endif
    					<table width="100%" cellpadding="0" cellspacing="0" align="center">
    					    <tr>
    					      <td width="100%" valign="top" style="padding:0px 0px;">
    					        <table width="100%" bgcolor="#fff"  cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
    					          <tr>
    					            <td style="padding: 0px 20px;">
    					              <table width="100%" cellpadding="0"  cellspacing="0" align="center" class="deviceWidth" style="border: 1px solid #333; background: #fff;">
    					                <tr>
    					                  <td style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">SERVICE REQUESTED</td>
    					                  <td style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">OFFER # {{ $order_details->invoice_no }}</td>
    					                </tr>
    					                <tr>
    					                  <td style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">{{ date('d M Y', strtotime($order_details->created_at)) }} <p>Offer will expire in {{ date('d M Y', strtotime($order_details->created_at.'+1 day')) }}</p></td>
    					                  <!--<td style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;"><a style="color: #3f51b5; text-decoration: none;" href="#" data-toggle="modal" data-target="#SendMail{{ $order_details->id }}">Send it to my inbox</a></td>-->
    					                </tr>
    					                <tr>
    					                  <td colspan="2" style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">
    					                  	@if(!empty($services))
    					                  	
    					                  	@foreach($services as $service)
    					                  	@php $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get(); $tot=count($service_details); @endphp
    					                    <table width="100%" cellpadding="0" cellspacing="0">
    					                      <tr>
    					                        <td style="font-size: 22px; color: #000; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 30px; font-weight: normal; vertical-align: middle; padding: 5px 0px;">{{ $service->service_name }}</td>
    					                        <td style="font-size: 17px; color: #333; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 0px;">Total Equipment: {{ $tot }}</td>
    					                        <td style="font-size: 17px; color: #333; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 0px;">Total Location: {{ $tot }}</td>
    					                      </tr>
    					                    </table>
    					                    <table width="100%" cellpadding="0" cellspacing="0">
    					                      <tr>
    					                        <td style="font-size: 16px; color: #797979; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 22px; vertical-align: middle; padding: 5px 0px;">Equipment</td>
    					                        <td style="font-size: 16px; color: #797979; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 22px; vertical-align: middle; padding: 5px 0px;">Quantity</td>
    					                        <td style="font-size: 16px; color: #797979; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 22px; vertical-align: middle; padding: 5px 0px;">Charges</td>
    					                        <td style="font-size: 16px; color: #797979; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 22px; vertical-align: middle; padding: 5px 0px;">Location</td>
    					                      </tr>
    					                      @foreach($service_details as $servicedt)
    					                      <tr>
    					                        <td style="font-size: 15px; color: #333; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 0px;">{{ $servicedt->equipments }}</td>
    					                        <td style="font-size: 15px; color: #333; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 0px;">{{ $servicedt->quantity }}</td>
    					                        <td style="font-size: 15px; color: #333; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 0px;">&#8377;{{ $servicedt->amount }}</td>
    					                        <td style="font-size: 15px; color: #333; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 0px;">{{ $servicedt->location }}</td>
    					                      </tr>
    					                      @endforeach
    					                      
    					                    </table>
    					                    @endforeach
    					                @endif
    					                  </td>
    					                </tr>
    					                <tr>
    					                  <!--<td colspan="2" style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">
    					                    <table width="100%" cellpadding="0" cellspacing="0">
    					                      <tr>
    					                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 2px 0px;">Subtotal:</td>
    					                        <td style="font-size: 15px; color: #000; font-weight: bold; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 2px 0px;">₹{{ $order_details->total_amount }}</td>
    					                      </tr>
    					                      <tr>
    					                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 2px 0px;">GST18%</td>
    					                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 2px 0px;">₹ @php $gst=$order_details->total_amount*(18/100); echo $gst; @endphp</td>
    					                      </tr>
    					                      <tr>
    					                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:18px; vertical-align: middle; padding: 2px 0px;">Total Amount Payable:</td>
    					                        <td style="font-size: 15px; color: #000; font-weight: bold; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:18px; vertical-align: middle; padding: 2px 0px;">₹ @php echo $order_details->total_amount+$gst; @endphp </td>
    					                      </tr>
    					                      <tr>
    					                        <td colspan="2" style="font-size: 12px; color: #9c9c9c; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:16px; vertical-align: middle; padding: 15px 0px 2px 0px; font-style: italic;">This quote is based on the information submitted. Quotes may be subject to change upon further inspection of the Equipment.</td>
    					                      </tr>
    					                    </table>
    					                  </td>-->
    					                  
    					                  
    					                  
    					                  
    					                  
    					                </tr>
    					                <tr>
    					                  <td colspan="2" style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">
    					                    <table width="100%" cellpadding="0" cellspacing="0">
    					                      <tr>
    					                       <!-- <td style="font-size: 18px; color: #000; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 0px;">
    					                          <a href="javascript:void(0);" style="color: #3f51b5; text-decoration: none;">Service Provider Offer Price ({{$order_details->provider_name}}) : ₹ {{$order_details->provider_price}}</a>
    					                        </td>-->
    					                        <!--<td style="font-size: 15px; color: #000; font-weight: normal; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 0px;">
    					                          <a href="{{ url('user/user-accept-bid/'.$order_details->id) }}" style="background: #444c55; font-size: 16px; padding: 5px 10px; text-decoration: none; color: #fff;">Accept Bid</a>
    					                        </td>-->
    					                      </tr>
    					                    </table>
    					                  </td>
    					                </tr>
    					              </table>
    					            </td>
    					          </tr>
    					        </table> 
    					      </td>
    					    </tr>
    					  </table> 
    				</div>
    			</div>
    			<!-- Modal -->
                <div class="modal fade" id="SendMail{{$order_details->id}}" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form action="{{url('user/sendinvoicemail')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="order_id" value="{{$order_details->id}}">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send Invoice Mail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Invoice</button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
    			<div class="row">
    			    <div class="col-sm-12"><hr></div>
    			</div>
    			@endforeach
    			@endif
			</div>
		</div>
	</div>
</div>	
<section class="signupcontainer">
	<div class="signupcoinner">
		<div class="container">
		    
		</div>
	</div>
</section>
@endsection