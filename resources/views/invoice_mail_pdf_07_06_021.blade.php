<table width="70%" cellpadding="0" cellspacing="0" align="left">
    <tr>
      <td width="70%" valign="top" style="padding:0px 0px;">
        <table width="700" bgcolor="#fff"  cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
          <tr>
            <td style="padding: 0px 20px;">
              <table width="70%" cellpadding="0"  cellspacing="0" align="left" class="deviceWidth" style="border: 1px solid #333; background: #fff;">
                <tr>
                  <td style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">SERVICE REQUESTED</td>
                  <td style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">OFFER # {{ $order_details->invoice_no }}</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">{{ date('d M Y', strtotime($order_details->created_at)) }}</td>
                  <td style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;"></td>
                </tr>
                
                <tr>
                  <td style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">Name</td>
                  <td style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">Address</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">{{ $user_details->first_name }} {{ $user_details->last_name }}</td>
                  <td style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">{{ $user_details->address }},{{ $user_details->pin_code }},{{ $user_details->city }},{{ $user_details->state }},{{ $user_details->country }}</td>
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
                        <td style="font-size: 15px; color: #333; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 0px;">Rs.{{ $servicedt->amount }}</td>
                        <td style="font-size: 15px; color: #333; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 0px;">{{ $servicedt->location }}</td>
                      </tr>
                      @endforeach
                      
                    </table>
                    @endforeach
                @endif
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 2px 0px;">Subtotal: @if($order_details->is_negotiation==1) Bid Accept Price @endif</td>
                        <td style="font-size: 15px; color: #000; font-weight: bold; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 2px 0px;">Rs.@if($order_details->is_negotiation==1) {{ $order_details->offer_price }} @else  {{ $order_details->total_amount }} @endif </td>
                      </tr>
                      <tr>
                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 2px 0px;">GST18%</td>
                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 2px 0px;">Rs. @if($order_details->is_negotiation==1)  @php $gst=$order_details->offer_price*(18/100); echo $gst; @endphp  @else   @php $gst=$order_details->total_amount*(18/100); echo $gst; @endphp  @endif</td>
                      </tr>
                      <tr>
                        <td style="font-size: 15px; color: #000; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:18px; vertical-align: middle; padding: 2px 0px;">Total Amount Payable:</td>
                        <td style="font-size: 15px; color: #000; font-weight: bold; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:18px; vertical-align: middle; padding: 2px 0px;">Rs.  @if($order_details->is_negotiation==1) @php echo $order_details->offer_price+$gst; @endphp  @else @php echo $order_details->total_amount+$gst; @endphp  @endif  </td>
                      </tr>
                      <tr>
                        <td colspan="2" style="font-size: 12px; color: #9c9c9c; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:16px; vertical-align: middle; padding: 15px 0px 2px 0px; font-style: italic;">This quote is based on the information submitted. Quotes may be subject to change upon further inspection of the Equipment.</td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="border: 1px solid #333; font-size: 12px; color: #000; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 5px 8px;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <!--<td style="font-size: 18px; color: #000; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 0px;">
                          <a href="javascript:void(0);" style="color: #3f51b5; text-decoration: none;">Best Price Guarantee!</a>
                        </td>-->
                        <!--<td style="font-size: 15px; color: #000; font-weight: normal; text-align: right; font-family: Arial, Helvetica, sans-serif; line-height:20px; vertical-align: middle; padding: 5px 0px;">
                          <a href="{{ url('user/placeorder/'.$order_details->invoice_no) }}" style="background: #444c55; font-size: 16px; padding: 5px 10px; text-decoration: none; color: #fff;">Place order</a>
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