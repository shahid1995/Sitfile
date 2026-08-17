@extends('layouts.master_signup')
@section('title', 'Sign Up')
@section('content')

<section class="signupcontainer snpcontainer">
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
													<li><a href="javascript:void(0);" onclick="selectService('<?php echo $service->id;?>','<?php echo $service->service_name;?>');">{{ $service->service_name }}</a></li>
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
																<!--	@if(!empty($equipments))
																	@foreach($equipments as $equipment)
																		<option>{{ $equipment->machine_type }}</option>
																	@endforeach
																	@endif-->
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
														<div class="signupformcolum3 sm2 add-more-equip" style="display:none;">
															<div class="sabx">
																<a href="javascript:void(0);"id="add-more-equip">+ Add more equipment</a>
															</div>
														</div>
														<div class="signupformcolum3 sm3 textright">
															<button class="nextbtn" type="button">Next</button>
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
					<div class="signupcolumn">
						<div class="signupbxouter">
							<div class="signupbxinner signupbxright">
								<h3>Awzonex is X-Ray equipment Quality Assurance For 21st Century</h3>
								<p>Awzonex gets technician back in the X-Ray room peace of mind. Safe operation of X-Ray Equipment may never be fun, but at least it can be worry-free.</p>
								<ul>
									<li>Service by AERB authorised company</li>
									<li>Seamless booking</li>
									<li>Project progress tracker</li>
									<li>Cash rewards</li>
									<li>Excellence customer experience</li>
								</ul>
								<p>All service is backed by the Awzonex Guarantee<br><strong>Quality work, no unexpected charges, and secure payment.</strong></p>
								<div class="satisfactionlogo">
									<img src="images/satisfaction-logo.png" alt="" />
								</div>
							</div>
							<form action="{{ url('/orderprocess') }}" method="post" id="service-form">
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

<!-- Modal -->
<div class="modal fade signuppoup" id="AnswerModal" tabindex="-1" role="dialog" aria-labelledby="AnswerModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
        	<div class="col-xs-12">
        		<div class="poupupheading">
						  <h2>Lorem ipsum dolor sit adipiscing elit.</h2>
						  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet ullamcorper mi. Curabitur at porta nunc. In commodo tellus eu pretium varius. Praesent et nibh id nisl faucibus feugiat sed at purus. Donec et mauris volutpat, maximus odio sit amet, ullamcorper est. Sed maximus auctor nisi, ut commodo nisl fermentum id. Sed non aliquet enim. Vestibulum eleifend pharetra tristique.</p>
						  <p>Donec dolor est, gravida quis felis vel, auctor fermentum dui. Nam ornare maximus ex non facilisis. Nullam sapien elit, maximus quis elit in, tempus auctor augue. Nunc tincidunt nunc sem, in facilisis massa posuere in. Mauris ultricies elit a orci ultrices, eget dapibus est mollis. Proin ac hendrerit ligula, nec sodales lorem. Suspendisse eu commodo justo. Fusce mauris nisl, ultricies a sagittis interdum, pretium nec diam. Praesent sagittis tellus ipsum, id rutrum ligula feugiat ut. Phasellus ultricies lorem in condimentum ultricies. Praesent vel porttitor ipsum.</p>
						</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
	
	$(".add-more-equip").show();
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
			//'<div id="service-'+id+'" data-id="div'+dataid+'"><input type="hidden" name="machine_id[]" value="'+item[0]+'" id="machineID'+dataid+'"><input type="hidden" name="equipment_id[]" value="'+item[1]+'" id="equipmentID'+dataid+'"><input type="hidden" name="service_id[]" value="'+service_id+'" id="serviceID'+dataid+'"><input type="hidden" name="price[]" value="'+item[4]+'" id="price'+dataid+'"><h3 class="text-left">'+val+'</h3> <div class="signuprightformrow"> <div class="signupcformcolum1 "> <div class="form-group"> <input type="text" class="form-control" placeholder="Equipment # 1" name="" value="#'+i+'"> </div> 	</div> <div class="signupcformcolum1"> <div class="form-group"> <input type="number" class="form-control" id="quantity'+dataid+'" placeholder="Quantity" name="quantity[]" value="1"> </div> 	</div> <div class="signupcformcolum2"> <div class="form-group">	<input type="text" class="form-control" placeholder="Radiography (fixed)" name="equipment[]" id="equipment'+dataid+'" value="'+item[2]+'-'+item[3]+'"> <div class="actiongroup"> <a class="editbtn" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>	<a class="trashbtn" href="javascript:void();" onclick="removeservice('+service_id+')">x</a> </div>	</div> </div> </div></div>');	
			'<div id="service-'+id+'" data-id="div'+dataid+'"><input type="hidden" name="machine_id[]" value="'+item[0]+'" id="machineID'+dataid+'"><input type="hidden" name="equipment_id[]" value="'+item[1]+'" id="equipmentID'+dataid+'"><input type="hidden" name="service_id[]" value="'+service_id+'" id="serviceID'+dataid+'"><input type="hidden" name="price[]" value="'+item[4]+'" id="price'+dataid+'"><h3 class="text-left">'+val+'</h3> <div class="signuprightformrow"> <div class="signupcformcolum1 "> <div class="form-group"> <input type="text" class="form-control" placeholder="Equipment # 1" name="" value="#'+i+'" readonly> </div> 	</div> <div class="signupcformcolum1"> <div class="form-group"> <input type="number" class="form-control" id="quantity'+dataid+'" placeholder="Quantity" name="quantity[]" value="1" readonly> </div> 	</div> <div class="signupcformcolum2"> <div class="form-group">	<input type="text" class="form-control" placeholder="Radiography (fixed)" name="equipment[]" id="equipment'+dataid+'" value="'+item[2]+'-'+item[3]+'" readonly> <div class="actiongroup">  </div>	</div> </div> </div></div>');	
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
    	$("#quantity"+dataid).val(quantity);
    	
    });

    $("#add-more-equip").click( function(){
    	var service_id = $(this).data('serviceid');
    	
    	if(service_id==''){
    	    
    	    return false;
    	}
    	
    	var id = service_id;
    	
    	$('#equipment').removeAttr('selected').find('option:first').attr('selected', 'selected');
    	dataid = Math.random().toString(36).slice(2);
    	$("#equipment").attr('data-id', dataid);
    	$("#set-quantity").val(1);
    	itemdata = $("#equipment").val();
		item = itemdata.split(';');
    	$(".show-services").append('<div id="service-'+item[0]+'" data-id="div'+dataid+'" class="signuprightformrow"><input type="hidden" name="machine_id[]" value="'+item[0]+'" id="machineID'+dataid+'"><input type="hidden" name="equipment_id[]" value="'+item[1]+'" id="equipmentID'+dataid+'"><input type="hidden" name="service_id[]" value="'+service_id+'" id="serviceID'+dataid+'"><input type="hidden" name="price[]" value="'+item[4]+'" id="price'+dataid+'"><div class="signupcformcolum1 "> <div class="form-group"> <input type="text" class="form-control" placeholder="Equipment # 1" name="" value="#'+i+'">	 </div> </div> <div class="signupcformcolum1"> <div class="form-group"> 			<input type="number" class="form-control" id="quantity'+dataid+'" placeholder="Quantity" name="quantity[]" value="1"> </div> 	</div> <div class="signupcformcolum2"> <div class="form-group">	<input type="text" class="form-control" placeholder="Radiography (fixed)" name="equipment[]" value="'+item[2]+'-'+item[3]+'" id="equipment'+dataid+'"> <div class="actiongroup"> 	<a class="trashbtn" href="javascript:void(0);" onclick="removeservice('+item[0]+')">x</a> </div></div> </div> </div>');
    	i++;
    	
    });

    $(".nextbtn").click( function(){
    	$("#service-form").submit();
    });

});
</script>
@endsection