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
			    <h2>Active Offer</h2>
			</div>

            <section class="signupcontainer actvoffer_wrap">
                <div class="signupcoinner">
                    <div class="signuptopheading">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2>Tell us about your equipment and the service you need</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="signupboxcontainer">
                        <div class="container">
                            <div class="signuprow">
                                <div class="signupcolumn">
                                    <div class="signupbxouter">
                                        <div class="signupbxinner">
                                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingOne">
                                                        <h4 class="panel-title"> <a class="collapsed servces" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i>1</i><span>Select Services</span></a></h4>
                                                    </div>
                                                    <div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body">
                                                            <ul>
                                                                @if(!empty($services))
                                                                @foreach($services as $service)
                                                                <li><a href="javascript:void();" onclick="selectService('<?php echo $service->id;?>','<?php echo $service->service_name;?>');">{{ $service->service_name }}</a></li>
                                                                @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingTwo">
                                                        <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i>2</i><span>Select Equipment</span></a></h4>
                                                    </div>
                                                    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                                                        <div class="panel-body">
                                                            <div class="panelformgroup">
                                                                <div class="signupformrow">
                                                                    <div class="signupformcolum1">
                                                                        <div class="form-group">
                                                                            <select class="form-control" name="equipment" id="equipment" data-id="">
                                                                                <option selected="" hidden="">Type of equipment</option>
                                                                                @if(!empty($equipments))
                                                                                @foreach($equipments as $equipment)
                                                                                    <option>{{ $equipment->machine_type }}</option>
                                                                                @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="signupformcolum2">
                                                                        <div class="qtywrap">
                                                                        <label>Quantity</label>
                                                                        <div class="qtyinner">
                                                                          <div class="input-group">
                                                                            <a class="incr-btn input-group-addon" data-action="decrease" href="#">-</a>
                                                                            <input class="quantity form-control" type="text" name="quantity" id="set-quantity" value="1">
                                                                            <a class="incr-btn input-group-addon" data-action="increase" href="#">+</a>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                                <div class="signupformrow">
                                                                    <div class="signupformcolum3 sm1">
                                                                        <div class="sabx">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">+ Add more Services</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="signupformcolum3 sm2">
                                                                        <div class="sabx">
                                                                            <a href="javascript:void(0);"id="add-more-equip">+ Add more equipment</a>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    @if($order_pendding > 0)
                                                                    
                                                                    
                                                                    @else
                                                                    <div class="signupformcolum3 sm3 textright">
                                                                        <button class="nextbtn" type="button">Next</button>
                                                                    </div>
                                                                    
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
                                <div class="signupcolumn">
                                    <div class="signupbxouter">
                                        <div class="signupbxinner signupbxright">
                                            <h3>Altibbe is X-Ray equipment Quality Assurance For 21st Century</h3>
                                            <p>Altibbe gets technician back in the X-Ray room peaceof mind. Safe operation of X-Ray Equipment may never be fun, but at least it can be worry-free.</p>
                                            <ul>
                                                <li>Service by AERB authorised company</li>
                                                <li>Seamless booking</li>
                                                <li>Project progress tracker</li>
                                                <li>Cash rewards</li>
                                                <li>Excellence customer experience</li>
                                            </ul>
                                            <p>All service is backed by the Altibbe Guarantee<br><strong>Quality work, no unexpected charges, and secure payment.</strong></p>
                                            <div class="satisfactionlogo">
                                                <img src="images/satisfaction-logo.png" alt="" />
                                            </div>
                                        </div>
                                        <form action="{{ url('/orderprocessuser') }}" method="post" id="service-form">
                                            {{csrf_field()}}
                                        <input type="hidden" name="location" value="{{ $location }}">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <div class="signupbxinner signupbxright show-services" style="display: none;">
                                           
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
			 <?php /*   @if(!empty($order_details))
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
    			@endif */ ?>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
// 	<div id="service-'+id+'" data-id="div'+dataid+'">
// 	<input type="hidden" name="machine_id[]" value="" id="machineID'+dataid+'">
// 	<input type="hidden" name="equipment_id[]" value="" id="equipmentID'+dataid+'">
// 	<input type="hidden" name="service_id[]" value="" id="serviceID'+dataid+'">
// 	<input type="hidden" name="price[]" value="" id="price'+dataid+'">
// 	<h3 class="text-left">'+val+'</h3> 
// 	<div class="signuprightformrow">
// 		<div class="signupcformcolum1 "> 
// 			<div class="form-group"> 
// 	 			<input type="text" class="form-control" placeholder="Equipment # 1" name="" value="#'+i+'">	 
// 	 		</div> 	
// 	 	</div> 
// 	 	<div class="signupcformcolum1"> 
// 	 		<div class="form-group"> 
// 	 			<input type="number" class="form-control" id="quantity'+dataid+'" placeholder="Quantity" name="quantity[]" value="1"> 
// 	 		</div> 	
// 	 	</div> 
// 	 	<div class="signupcformcolum2"> 
// 	 		<div class="form-group">	
// 	 			<input type="text" class="form-control" placeholder="Radiography (fixed)" name="equipment[]" id="equipment'+dataid+'"> 
// 	 			<div class="actiongroup"> 
// 	 				<a class="editbtn" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>	
// 	 				<a class="trashbtn" href="javascript:void();" onclick="removeservice('+dataid+')">x</a> 
// 	 			</div>	
// 	 		</div> 
// 	 	</div> 
// 	 </div>
// </div>
var service_id='';
var service_name='';
var i=1;
var dataid;
function selectService(id,val)
{
	service_id = id;
	service_name = val;

	dataid = Math.random().toString(36).slice(2);
	
	$("#collapseOne").removeClass('in');
	$("#collapseTwo").addClass('in');
	$('select').first().focus();
	$("#equipment").attr('data-id', dataid);
	$("#add-more-equip").attr('data-serviceid',service_id);
	$.ajax({
      url:"{{ url('/getxrymachines') }}",
      type:'get',
      data:{'service_id':service_id},
      success: function(data)
      {
      	var items='';
      	var resp = $.map(data,function(obj){
                    //console.log(obj.model_title);
                    items = obj.xray_machines_id+';'+obj.equipment_id+';'+obj.machine_type+';'+obj.model_number+';'+obj.price;
                    return '<option value="'+items+'">'+obj.machine_type+'-'+obj.model_number+'</option>';
               }); 

 		$('#equipment').html(resp);
 		$('#set-quantity').val(1);
		if(items!=''){
			itemdata = $("#equipment").val();
			item = itemdata.split(';');
			$(".show-services").append(
			'<div id="service-'+id+'" data-id="div'+dataid+'"><input type="hidden" name="machine_id[]" value="'+item[0]+'" id="machineID'+dataid+'"><input type="hidden" name="equipment_id[]" value="'+item[1]+'" id="equipmentID'+dataid+'"><input type="hidden" name="service_id[]" value="'+service_id+'" id="serviceID'+dataid+'"><input type="hidden" name="price[]" value="'+item[4]+'" id="price'+dataid+'"><h3 class="text-left">'+val+'</h3> <div class="signuprightformrow"> <div class="signupcformcolum1 "> <div class="form-group"> <input type="text" class="form-control" placeholder="Equipment # 1" name="" value="#'+i+'" readonly> </div> 	</div> <div class="signupcformcolum1"> <div class="form-group"> <input type="number" class="form-control" id="quantity'+dataid+'" placeholder="Quantity" name="quantity[]" value="1" readonly> </div> 	</div> <div class="signupcformcolum2"> <div class="form-group">	<input type="text" class="form-control" placeholder="Radiography (fixed)" name="equipment[]" id="equipment'+dataid+'" value="'+item[2]+'-'+item[3]+'" readonly> <div class="actiongroup"> <a class="editbtn" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>	<a class="trashbtn" href="javascript:void();" onclick="removeservice('+service_id+')">x</a> </div>	</div> </div> </div></div>');	
			i++;
			$(".signupbxright").hide();
	    	$(".show-services").show();
			
		}
 		         
      }
    });
}

$(document).ready( function(){
	$("#equipment").on('change', function(){
		var elementid = dataid;		
		if(elementid!='')
		{
			$(".signupbxright").hide();
	    	$(".show-services").show();
	    	var items = $(this).val();
	    	item = items.split(';');
	    	$("#equipment"+elementid).val(item[2]+'-'+item[3]);
	    	$("#machineID"+elementid).val(item[0]);
	    	$("#equipmentID"+elementid).val(item[1]);
	    	$("#serviceID"+elementid).val(service_id);
	    	$("#price"+elementid).val(item[4]);
		}
    	
    });

    $(".incr-btn").click(function(){
        
        
        
        
    	var quantity = $("#set-quantity").val();
    	var action = $(this).data('action');
    	
    	if(action == 'decrease' && quantity > 1){
    	   quantity = Number(quantity) - 1;
    	}
    	
    	if(action == 'increase'){
    	    
    	    quantity = Number(quantity) + 1;
    	    //alert(quantity);
    	}
    	
    	
    	
    	
    	$("#quantity"+dataid).val(quantity);
    	
    });

    $("#add-more-equip").click( function(){
    	var service_id = $(this).data('serviceid');
    	$('#equipment').removeAttr('selected').find('option:first').attr('selected', 'selected');
    	dataid = Math.random().toString(36).slice(2);
    	$("#equipment").attr('data-id', dataid);
    	$("#set-quantity").val(1);
    	itemdata = $("#equipment").val();
		item = itemdata.split(';');
    	$(".show-services").append('<div class="signuprightformrow" data-id="extra'+dataid+'"><input type="hidden" name="machine_id[]" value="'+item[0]+'" id="machineID'+dataid+'" readonly><input type="hidden" name="equipment_id[]" value="'+item[1]+'" id="equipmentID'+dataid+'"><input type="hidden" name="service_id[]" value="'+service_id+'" id="serviceID'+dataid+'"><input type="hidden" name="price[]" value="'+item[4]+'" id="price'+dataid+'"><div class="signupcformcolum1 "> <div class="form-group"> <input type="text" class="form-control" placeholder="Equipment # 1" name="" value="#'+i+'" readonly>	 </div> </div> <div class="signupcformcolum1"> <div class="form-group"> 			<input type="number" class="form-control" id="quantity'+dataid+'" placeholder="Quantity" name="quantity[]" value="1"> </div> 	</div> <div class="signupcformcolum2"> <div class="form-group">	<input type="text" class="form-control" placeholder="Radiography (fixed)" name="equipment[]" value="'+item[2]+'-'+item[3]+'" id="equipment'+dataid+'" readonly> <div class="actiongroup"> <a class="editbtn" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>	<a class="trashbtn" href="javascript:void();" onclick="removeserviceextra('+dataid+')">x</a> </div></div> </div> </div>');
    	i++;
    	
    });

    $(".nextbtn").click( function(){
    	$("#service-form").submit();
    });

});


function addService(id,val)
{
	$(".show-services").append(
		'<div id="service-'+id+'"><h3 class="text-left">'+val+'</h3> <div class="signuprightformrow"> <div class="signupcformcolum1"> <div class="form-group"> <input type="text" class="form-control" placeholder="Equipment # 1" name="" readonly> </div>	</div> <div class="signupcformcolum2"> <div class="form-group">	<input type="text" class="form-control" placeholder="Radiography (fixed)" name="" readonly> <div class="actiongroup"> <a class="editbtn" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>	<a class="trashbtn" href="javascript:void();" onclick="removeservice('+id+')">x</a> </div>	</div> </div> </div></div>');
}

function removeservice(id)
{
	$("#service-"+id).remove();
}
</script>
@endsection