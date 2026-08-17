<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="abstract" content="HTML Symbols" />
    <title>Invoice</title> 
    
    <style> 
    
    @page {
  margin-top: 10px !important;
  margin-bottom: 10px !important;
  margin-left: 10px !important;
  margin-right: 10px !important; 
  padding: 0px !important;
}
</style>
    
  </head>
  <body>
      
     
   <table cellpadding="0" cellspacing="0" border="0" style="width:100%; margin: 0 auto;">
    <tr>
      <td style="vertical-align: top; background: #fff;">
        <table cellpadding="0" cellspacing="0" border="0" style="width:100%; margin: 0; color:#555;">           
            <tr>
              <td valign="top"  style="vertical-align: top; padding:20px; background: #0D253F;">
                  <table cellpadding="0" cellspacing="0" border="0" style="width:100%; margin: 0; color:#555;">  
                      <td>
                        <img src="images/logo.png" alt="" style="width: 160px;">
                      </td>
                      <td style="text-align: right;color:#fff; font-family: Arial, Helvetica, sans-serif; font-size:15px">
                        <strong style="font-size: 15px; font-weight: 700; display: block;">Tax Invoice/Bill of Supply/ Cash Memo</strong>
                        (original of recipient)
                      </td>
                  </table>
              </td>
            </tr>

              

            
            <tr>
              <td style="vertical-align: top; padding-top:50px;">
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%; margin: 0; color:#555;">
                  <tr>
                    <td style="width:60%;font-size: 15px; line-height: 23px; color:#000; font-family: Arial, Helvetica, sans-serif; vertical-align: top;">
                        <div>
                          <span style="font-family: Arial, Helvetica, sans-serif; font-size: 17px; line-height: 20px; padding-bottom:3px; border-bottom:2px solid #000; display: inline-block; color:#000; font-weight: 700; margin: 0 0 5px;">Service Provider Details:</span>
                          <h3 style="font-family: Arial, Helvetica, sans-serif; font-size: 19px; color:#000; font-weight: 700; margin: 0;">{{ $provider_details->med_estab_name }}
                          </h3>
                          
                          <p style="margin:0; font-size: 15px; line-height: 23px; color:#000; font-family: Arial, Helvetica, sans-serif;">
                            @if($provider_details->first_name) {{ $provider_details->first_name }} {{ $provider_details->last_name }} @else {{ $provider_details->name }}  @endif,<br>
{{ $provider_details->address }},{{ $provider_details->pin_code }},{{ $provider_details->city }},<br>{{ $provider_details->state }},{{ $provider_details->country }}<br>
</p>
                        </div>
                    </td>
                    <td style="width:40%;padding-top:20px; font-size: 14px; line-height: 23px; color:#000; font-family: Arial, Helvetica, sans-serif; vertical-align: top; text-align:right">
                       <div style="text-align:right">
                          <span style="float:right;font-family: Arial, Helvetica, sans-serif; font-size: 17px; line-height: 20px; padding-bottom:3px; border-bottom:2px solid #000; display: inline-block; color:#000; font-weight: 700; margin: 0 0 5px;">Billing Address:</span>
                          <h3 style="clear:right;font-family: Arial, Helvetica, sans-serif; font-size: 19px; color:#000; font-weight: 700; margin: 0;">{{ $user_details->first_name }} {{ $user_details->last_name }}.
                          </h3>
                          <div><a  style="font-family: Arial, Helvetica, sans-serif; line-height: 18px; font-size: 17px; text-decoration: none; color:#000; font-weight: 700; margin: 0 0 5px;">{{ $user_details->med_estab_name }}</a></div>
                          <p style="margin:0; font-size: 15px; line-height: 23px; color:#000; font-family: Arial, Helvetica, sans-serif;">
                            {{ $user_details->address }},{{ $user_details->pin_code }},{{ $user_details->city }},<br>{{ $user_details->state }},{{ $user_details->country }}</p>
                        </div>
                    </td>
                  </tr>

                  <tr>
                    <td style="width:60%; padding-top:40px; font-size: 15px; line-height: 23px; color:#000; font-family: Arial, Helvetica, sans-serif; vertical-align: top;">
                        <div>
                                                
                          <p style="margin:0; font-size: 15px; line-height: 23px; color:#000; font-family: Arial, Helvetica, sans-serif;">
                           
                        <strong>GSTIN:</strong> {{$provider_details->gst}}<br></p>
                        </div>
                    </td>
                    <td style="width:40%;padding-top:40px; font-size: 14px; line-height: 23px; color:#000; font-family: Arial, Helvetica, sans-serif; vertical-align: top; text-align:right;">
                       <!--<div>
                          <span style="float:right; font-family: Arial, Helvetica, sans-serif; font-size: 17px; line-height: 20px; padding-bottom:3px; border-bottom:2px solid #000; display: inline-block; color:#000; font-weight: 700; margin: 0 0 5px;">Customer Address:</span>
                          <h3 style="clear:right; font-family: Arial, Helvetica, sans-serif; font-size: 19px; color:#000; font-weight: 700; margin: 0;">Shamyal Das.
                          </h3>
                          <div><a href="http://www.machinotool.com" style="font-family: Arial, Helvetica, sans-serif; line-height: 18px; font-size: 17px; text-decoration: none; color:#000; font-weight: 700; margin: 0 0 5px;">www.company.com</a></div>
                          <p style="margin:0; font-size: 15px; line-height: 23px; color:#000; font-family: Arial, Helvetica, sans-serif;">
                            34/1, Chapala Devi Road, Dasnagar,<br>
Howrah - 711 105, West Bengal, India.<br>
CIN : U74999WB2018PTC229552</p>
                        </div>-->
                    </td>
                  </tr>

                  <tr>
                    <td style="width:60%; padding-top:40px; font-size: 15px; line-height: 23px; color:#000; font-family: Arial, Helvetica, sans-serif; vertical-align: top;">
                        <div>                
                          <p style="margin:0; font-size: 15px; line-height: 23px; color:#000; font-family: Arial, Helvetica, sans-serif;">
                           <strong>Order Number:</strong> {{ $order_details->invoice_no }}<br>
                          <strong>Order date:</strong> {{ date('d M Y', strtotime($order_details->created_at)) }}
                          </p>
                        </div>
                    </td>
                    <td style="width:40%;padding-top:40px; font-size: 14px; line-height: 23px; color:#000; font-family: Arial, Helvetica, sans-serif; vertical-align: top; text-align:right;">
                         <div>
                                                
                          <p style="margin:0; font-size: 15px; line-height: 23px; color:#000; font-family: Arial, Helvetica, sans-serif;">
                           <strong>Invoice Number:</strong> {{ $order_details->invoice_no }}<br>
                             <strong>Invoice Date:</strong> {{ date('d M Y', strtotime($order_details->created_at)) }}
                          </p>
                        </div>
                        
                    </td>
                  </tr>
                </table>
              </td>
            </tr>  
            <tr>
              <td style="padding: 30px 0 0; font-size: 16px;font-family: Arial, Helvetica, sans-serif;color:#000;border-bottom: 1px solid #0D253F;">
                <table cellpadding="0" cellspacing="0" border="0" style="width:100%; margin: 0;">
                  <tr>
                     <th style="background: #0D253F; padding: 10px; font-weight: 600; color:#fff; vertical-align: middle; text-align: center; border:none; border-top: 1px solid #0D253F; border-bottom: 1px solid #0D253F; ">
                      Sl.
                      No.
                    </th>
                    <th style="background: #0D253F; padding: 10px; font-weight: 600; color:#fff;  width: 35%; vertical-align: middle; text-align: left; border:none; border-top: 1px solid #0D253F; border-bottom: 1px solid #0D253F; ">
                      Description
                    </th>
                    <th style="background: #0D253F; padding: 10px; font-weight: 600; color:#fff; vertical-align: middle; text-align: left; border:none; border-top: 1px solid #0D253F; border-bottom: 1px solid #0D253F; ">
                      Unit Price
                    </th> 
                    <th style="background: #0D253F; padding: 10px; font-weight: 600; color:#fff; vertical-align: middle; text-align: left; border:none; border-top: 1px solid #0D253F; border-bottom: 1px solid #0D253F; ">
                      Discount
                    </th> 
                    <th style="background: #0D253F; padding: 10px; font-weight: 600; color:#fff; vertical-align: middle; text-align: left; border:none; border-top: 1px solid #0D253F; border-bottom: 1px solid #0D253F; ">
                      Qty
                    </th>  
                    <th style="background: #0D253F; padding: 10px; font-weight: 600; color:#fff; font-family: Arial, Helvetica, sans-serif; vertical-align: middle; text-align: left; border:none; border-top: 1px solid #0D253F; border-bottom: 1px solid #0D253F; ">
                      Net<br> Amount
                    </th> 
                    <th style="background: #0D253F; padding: 10px; font-weight: 600; color:#fff; font-family: Arial, Helvetica, sans-serif; vertical-align: middle; text-align: left; border:none; border-top: 1px solid #0D253F; border-bottom: 1px solid #0D253F; ">
                      Tax<br> Rate
                    </th> 
                    <th style="background: #0D253F; padding: 10px; font-weight: 600; color:#fff; font-family: Arial, Helvetica, sans-serif; vertical-align: middle; text-align: left; border:none; border-top: 1px solid #0D253F; border-bottom: 1px solid #0D253F; ">
                      Tax<br> Type
                    </th> 
                    <th style="background: #0D253F; padding: 10px; font-weight: 600; color:#fff; font-family: Arial, Helvetica, sans-serif; vertical-align: middle; text-align: left; border:none; border-top: 1px solid #0D253F; border-bottom: 1px solid #0D253F; ">
                      Tax<br> Amount
                    </th> 
                    <th style="background: #0D253F; padding: 10px; font-weight: 600; color:#fff; font-family: Arial, Helvetica, sans-serif; vertical-align: middle; text-align: right; border:none; border-top: 1px solid #0D253F; border-bottom: 1px solid #0D253F; ">
                      Total <br> Amount
                    </th>
                  </tr>
                    	@if(!empty($services))
                  	
                  	
                  	@php $i=1; @endphp
                  	
                  	@foreach($services as $service)
                  	@php $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get(); $tot=count($service_details); @endphp
                  
                  @foreach($service_details as $servicedt)
                  <tr>
                    <td style="padding: 10px; font-size: 16px; vertical-align: top;border:none; border-bottom: 1px solid #000; text-align: center;">
                     
                     {{$i}}
                     
                    </td>
                     <td style="padding: 10px; font-size: 16px; vertical-align: top; border:none; border-bottom: 1px solid #000; text-align: left;">
                     {{ $service->service_name }}-
                     {{ $service->all_equipment }}
                    </td>   
                     <td style="padding: 10px; font-size: 16px; vertical-align: top; border:none; border-bottom: 1px solid #000; text-align: center;">
                     <span style="font-family:system-ui; line-height: 15px; vertical-align: top;">Rs.</span> {{ $servicedt->amount }}
                    </td> 
                    <td style="padding: 10px; font-size: 16px; vertical-align: top; border:none; border-bottom: 1px solid #000; text-align: center;">
                     <span style="font-family:system-ui; line-height: 15px; vertical-align: top;">Rs.</span> 0.0
                    </td>  
                    <td style="padding: 10px; font-size: 16px; vertical-align: top; border:none; border-bottom: 1px solid #000; text-align: center;">
                     {{ $servicedt->quantity }}
                    </td>
                    <td style="padding: 10px; font-size: 16px; vertical-align: top; border:none; border-bottom: 1px solid #000; text-align: center;">
                     <span style="font-family:system-ui; line-height: 15px; vertical-align: top;">Rs.</span> {{ $servicedt->amount * $servicedt->quantity }}
                    </td> 
                    <td style="padding: 10px; font-size: 16px; vertical-align: top; border:none; border-bottom: 1px solid #000; text-align: center;">
                     9%
                     <br>
                     9%
                    </td> 
                     <td style="padding: 10px; font-size: 16px; vertical-align: top; border:none; border-bottom: 1px solid #000; text-align: center;">
                     CGST <br>
                     SGST
                    </td>  
                     <td style="padding: 10px; font-size: 16px; vertical-align: top; border:none; border-bottom: 1px solid #000; text-align: center;">
                     <!--<span style="font-family:system-ui; line-height: 15px; vertical-align: top;">Rs.{{ $order_details->total_amount*(18/100) }}</span>--> 
                     
                      
                    </td>     
                     <td style="padding: 10px; font-size: 16px; vertical-align: top; border:none; border-bottom: 1px solid #000; text-align: right;">
                     <span style="font-family:system-ui; line-height: 15px; vertical-align: top;"> Rs.{{ $servicedt->amount * $servicedt->quantity }}</span> 
                    </td>            
                  </tr>
                  
                  
                  
                   @endforeach
                   
                   @php $i++ @endphp
                    @endforeach
                @endif
                  
                  <tr>                    
                     <td colspan="8" style="padding: 10px; font-size: 16px; vertical-align: top; border:none; text-align: left;">
                    Total
                    </td> 
                    <td style="padding: 10px; font-size: 16px; vertical-align: top; border:none; text-align: right; background:#0D253F; color:#fff">
                      <!--<span style="font-family:system-ui; line-height: 15px; vertical-align: top; ">Rs.</span> @if($order_details->is_negotiation==1)  @php $gst=$order_details->total_amount*(18/100); echo $gst + $order_details->total_amount; @endphp  @else   @php $gst=$order_details->total_amount*(18/100); echo $gst + $order_details->total_amount; @endphp  @endif--> 
                      <span style="font-family:system-ui; line-height: 15px; vertical-align: top; ">Rs.</span> @php $gst=$order_details->total_amount*(18/100); echo $gst; @endphp
                    </td> 
                     <td style="padding: 10px; font-size: 16px; vertical-align: top; border:none; text-align: right; background:#0D253F; color:#fff">
                      <span style="font-family: '', sans-serif; line-height: 15px; vertical-align: top; ">Rs.</span>  @if($order_details->is_negotiation==1) @php echo $order_details->total_amount+$gst; @endphp  @else @php echo $order_details->total_amount+$gst; @endphp  @endif
                    </td>            
                  </tr>
                     
                </table>
              </td>
            </tr>
            <tr>
              <td style="padding: 12px 10px 10px;color:#000; font-family: Arial, Helvetica, sans-serif; font-size: 18px; line-height: 23px; font-weight: bold; border-bottom: 1px solid #0D253F;">
                Amount in Words:<br>



<?php 
$test =$order_details->total_amount+$gst;

$f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );

$word = $f->format($test);

echo ucwords($word); 
?>
              </td>
            </tr>
                  
          </table>
        </td>
      </tr>
    <!--   <tr>
        <td style="font-family: Arial, Helvetica, sans-serif; padding:20px 10px 10px; font-size: 18px; text-align: center; color:#000; font-weight: 700;">
      Thank You For Shopping With Us</td>
    </tr> -->
   </table>
  </body>
</html>