@extends('layouts.master_signup')
@section('title', 'Sign Up')
@section('content')

<section class="signupcontainer">
	<div class="signupcoinner">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					@if (session('success'))
				        <div class="alert alert-success alert-dismissible">
				            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				            {{ session('success') }}
				        </div>
				    @endif
				    <div class="table-responsive">
						<table width="100%" cellpadding="0" cellspacing="0" align="center">
					    <tr>
					      <td width="100%" valign="top" style="padding:0px 0px;">
					        <table width="800" bgcolor="#fff"  cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="box-shadow: 0 0 20px 0 rgba(0,0,0,.25);">
					          <tr>
					            <td style="border: 2px solid #3B6BBF;">
					              <table width="100%" cellpadding="0"  cellspacing="0" align="center" class="deviceWidth" style="border: none; background: #fff;">
					              	 <tr>					                 
					                  <td colspan="3" style="background: #3B6BBF; font-size: 16px; text-align: center; color: #fff; font-weight: bold;  font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 7px 8px;border:none;">OFFER # {{ $order_details->invoice_no }}</td>
					                </tr>
					                <tr>
					                  <td style="border: 1px solid #d9d9d9; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px; border-top:none;border-left:none;">SERVICE REQUESTED</td>
					                  <td style="border: 1px solid #d9d9d9; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;border-left:none;border-top:none;">{{ date('d M Y', strtotime($order_details->created_at)) }}</td>
					                  <td style="border: 1px solid #d9d9d9; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;border-right:none;border-top:none;"><a style="color: #3f51b5; text-decoration: none;" href="javascript:void();" data-toggle="modal" data-target="#sendInvoice">Send it to my inbox</a></td>
					                </tr>					               
					                <tr>
					                  <td colspan="3" style="border: 1px solid #d9d9d9; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 0; border-left:none;border-right:none;">
					                  	@if(!empty($services))
					                  	
					                  	@foreach($services as $service)
					                  	@php $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get(); $tot=count($service_details); @endphp
					                    <table width="100%" cellpadding="0" cellspacing="0">
					                      <tr>
					                        <td style="font-size: 18px; color: #000; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 30px; font-weight: normal; vertical-align: middle; padding: 8px 8px;">{{ $service->service_name }}</td>
					                        <td style="font-size: 17px; color: #333; font-weight: normal; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">Total Equipment: {{ $tot }}</td>
					                        <td style="font-size: 17px; color: #333; font-weight: normal; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">Total Location: {{ $tot }}</td>
					                      </tr>
					                    </table>
					                    <table width="100%" cellpadding="0" cellspacing="0">
					                      <tr>
					                        <td style="font-size: 16px; color: #797979; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 22px; vertical-align: middle; padding: 5px 8px;background: #3B6BBF;border-top:1px solid #3B6BBF;border-bottom:1px solid #3B6BBF; color:#fff;">Equipment</td>
					                        <td style="font-size: 16px; color: #797979; font-weight: normal; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 22px; vertical-align: middle; padding: 5px 8px;background: #3B6BBF;border-top:1px solid #3B6BBF;border-bottom:1px solid #3B6BBF; color:#fff;">Quantity</td>
					                        <td style="font-size: 16px; color: #797979; font-weight: normal; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 22px; vertical-align: middle; padding: 5px 8px;background: #3B6BBF;border-top:1px solid #3B6BBF;border-bottom:1px solid #3B6BBF; color:#fff;">Charges</td>
					                        <td style="font-size: 16px; color: #797979; font-weight: normal; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height: 22px; vertical-align: middle; padding: 5px 8px;background: #3B6BBF;border-top:1px solid #3B6BBF;border-bottom:1px solid #3B6BBF; color:#fff;">Location</td>
					                      </tr>
					                      @foreach($service_details as $servicedt)
					                      <tr>
					                        <td style="font-size: 15px; color: #555; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 8px;">{{ $servicedt->equipments }}</td>
					                        <td style="font-size: 15px; color: #555; font-weight: normal; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 8px;">{{ $servicedt->quantity }}</td>
					                        <td style="font-size: 15px; color: #555; font-weight: normal; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 8px;">&#8377;{{ $servicedt->amount }}</td>
					                        <td style="font-size: 15px; color: #555; font-weight: normal; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 8px;">{{ $servicedt->location }}</td>
					                      </tr>
					                      @endforeach
					                      
					                    </table>
					                    @endforeach
					                @endif
					                  </td>
					                </tr>
					                <tr>
					                  <td colspan="3" style="border: 1px solid #d9d9d9; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 15px 8px 5px; ">
					                    <table width="100%" cellpadding="0" cellspacing="0">
					                      <tr>
					                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 2px 0px;border-left:none;">Subtotal: @if($order_details->is_negotiation==1) Bid Accept Price @endif</td>
					                        <td style="font-size: 15px; color: #000; font-weight: bold; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 2px 0px;border-right:none;color:#3B6BBF;">₹ @if($order_details->is_negotiation==1) {{ $order_details->offer_price }} @else  {{ $order_details->total_amount }} @endif </td>
					                      </tr>
					                      <tr>
					                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 2px 0px;border-left:none;">GST18%</td>
					                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 2px 0px;border-right:none;color:#3B6BBF;">₹ @if($order_details->is_negotiation==1)  @php $gst=$order_details->offer_price*(18/100); echo $gst; @endphp  @else   @php $gst=$order_details->total_amount*(18/100); echo $gst; @endphp  @endif </td>
					                      </tr>
					                      <!--<tr>
					                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:18px; vertical-align: middle; padding: 2px 0px;border-left:none;">Total Amount Payable:</td>
					                        <td style="font-size: 15px; color: #000; font-weight: bold; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:18px; vertical-align: middle; padding: 2px 0px;border-right:none;color:#3B6BBF;">₹ @if($order_details->is_negotiation==1) @php echo $order_details->offer_price+$gst; @endphp  @else @php echo $order_details->total_amount+$gst; @endphp  @endif  </td>
					                      </tr>-->
					                      <tr>
					                        <td colspan="2" style="font-size: 12px; color: #9c9c9c; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:16px; vertical-align: middle; padding: 15px 0px 2px 0px; font-style: italic;border-left:none;border-right:none;border-bottom:none;">This quote is based on the information submitted. Quotes may be subject to change upon further inspection of the Equipment.</td>
					                      </tr>
					                    </table>
					                  </td>
					                </tr>
					                <tr>
					                  <td colspan="3" style="border: 1px solid #d9d9d9; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px; border-left:none; border-bottom:none; border-right:none;">
					                    <table width="100%" cellpadding="0" cellspacing="0">
					                      <tr>
					                        <td style="font-size: 18px; color: #000; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 0px;">
					                          <!--<a href="javascript:void(0);" style="color: #3f51b5; text-decoration: none;">Best Price Guarantee!</a>-->
					                        </td>
					                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 0px;">
					                          <a href="{{ url('user/placeorder/'.$order_details->invoice_no) }}" style="background: #444c55; font-size: 16px; padding: 5px 10px; text-decoration: none; color: #fff; ">Place order</a>
					                        </td>
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
			</div>
		</div>
	</div>
</section>

<!-- Modal -->
<div id="sendInvoice" class="modal fade mail_modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="user/sendinvoicemail" method="post">
    {{ csrf_field() }}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Invoice</h4>
      </div>
      <div class="modal-body">
          <input type="hidden" name="order_id" value="{{ $order_details->id }}">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" value="Send" class="btn btn-success">
      </div>
    </div>
    </form>

  </div>
</div>
@endsection