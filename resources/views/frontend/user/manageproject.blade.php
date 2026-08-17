@extends('layouts.userinner')
@section('title', 'Profile')
@section('content')

<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
  <div class="profile_block myorderouter">
    @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('success') }}
                </div>
            @endif
    <div class="service_tab">       
      <div class="plan_history">
         <ul class="nav nav-tabs" style="margin-bottom:10px;">
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/user/servicerequest_active') }}">Active</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/user/servicerequest_won') }}">Won</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/user/servicerequest_lost') }}">Lost</a>
              </li>
        </ul>
        <div class="cheadbx">
          <h3>Active</h3>
        </div>
        @if(!empty($order_details))
            @foreach($order_details as $order)
            @php //$services = DB::table('service_order_equipment_services as soe')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order->id)->whereIn('soe.service_id', $service_type)->groupBy('soe.service_id')->get(); @endphp
            @php $services = DB::table('service_order_equipment_services as soe')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order->id)->groupBy('soe.service_id')->get();
            $tot=count($services) @endphp
        <div class="plan_details_table">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Offer Placed</th>
                  <th class="text-center"># Of Offer</th>
                  <th class="text-center">Total Equipment</th>
                  <!--<th class="text-center">Total Location</th>-->
                  <th>Offer # {{ $order->invoice_no }}</th>                             
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                  <td class="text-center">{{ $order->offer_count }}</td>
                  <td class="text-center">{{ $order->machine_quantity }}</td>
                  <!--<td class="text-center">{{ $tot }}</td>-->
                  <td>&nbsp;</td>
                </tr>
              </tbody>
            </table>
          </div>
          
          @php 
        
            $i=1;
        
            @endphp
                 
                 
          @foreach($services as $service)
            @php $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get(); @endphp
          <form action="{{ url('user/bid_services') }}" method="post">
            {{ csrf_field()}}
          <input type="hidden" name="service_order_id" value="{{ $order->id }}">
          <input type="hidden" name="service_id" value="{{ $service->service_id }}">
          <input type="hidden" name="total_amount" value="{{ $order->total_amount }}">
          <input type="hidden" name="min_bid_amt" class="min_bid_amt" value="1000">
          <input type="hidden" name="bid_price" value="{{ $order->total_amount }}">
          <div class="tableheading">
            <div class="tbleft">
              <h4>{{ $service->service_name }}</h4>
            </div>
            
            @if($i==1)
            <div class="tbright">
              <div class="tbrightinner">
                <span class="ptext">&#8377; {{ $order->total_amount }}</span>
                
              </div>
            </div>
            
        @endif
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Equipments</th>
                  <th class="text-center">Quantity</th>
                  @if($i==1) <th>Location</th> @endif
                 @if($i==1) <th>Action</th> @endif
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>
                    Radiography (Fixed)
                    <div><a class="plusbtn" href="javascript:void(0);">+</a></div>
                  </td>
                  <td class="text-center">1</td>
                  <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                  <td class="nowrap">
                    <div class="qtywrap">
                      <div class="qtyinner">
                        <div class="input-group">
                          <a class="incr-btn input-group-addon" data-action="decrease" href="#">-</a>
                          <input class="quantity form-control" type="text" name="quantity" value="18900">
                          <a class="incr-btn input-group-addon" data-action="increase" href="#">+</a>
                        </div>
                      </div>
                    </div>
                    <div class="acebtngroup">                                        
                        <a class="acebtn" href="javascript:void(0);" style="min-width: 100px;">BID</a>
                    </div>
                  </td>
                </tr> -->
                @foreach($service_details as $service_dt)
                
                <tr>
                  <td>{{ $service_dt->equipments }}</td>
                  <td class="text-center">{{ $service_dt->quantity }}</td>
                  @if($i==1) <td>{{ $order->location }}</td> @endif
                  <td class="nowrap"></td>
                </tr>
                @endforeach
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <!--<p>Want it now?  &#8377; 8,000</p>-->
                    @if($i==1)
                    
                    <div class="acebtngroup">
                      <a class="acebtn" href="javascript:void(0);" data-orderId="{{ $order->id }}" data-toggle="modal" data-target="#BidModal{{ $order->id }}">Change Project Status</a>
                      <!--<a class="acebtn" href="javascript:void(0);">Get it Now</a>-->
                    </div>
                    
                    @endif
                    <div class="acebtngroup">
                      <!--<span>Minimum Bid: &#8377; <span class="min-bid">1000</span></span><br>-->
                      
                      @if(in_array($service->service_id, $bids))
                      <!--<button type="button" class="btn btn-success btn-sm" onclick="alert('Bid already placed !')">Bid Placed</button>-->
                      @else
                      <!--<input type="submit" class="acebtn" value="Bid Now">-->
                      @endif
                      
                     
                      
                      
                    </div> 
                    
                    <!--<div class="minimumbidbox pagebid">          
                        <h5><a href="javascript:void(0);" data-toggle="modall" data-target="#MinBidModall"  data-id="{{ $order->id }}" class='price_cal_model'>Minimum bid &#8377; <span id="min_bid">{{ $order->total_amount }} </span></a></h5>          
                    </div>-->
                    
                    
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </form>
        
        
        <!-- Bid Modal -->
        
        <div class="modal fade bidmodal" id="BidModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="BidModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Change Status</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>Equipments</th>
                                  <th class="text-center">Quantity</th>
                                 
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                   @foreach($service_details as $service_dt)
                
                                        <tr>
                                          <td>{{ $service_dt->equipments }}</td>
                                          <td class="text-center">{{ $service_dt->quantity }}</td>
                                          
                                        </tr>
                                    @endforeach
                                    
                                
                                  <td class="nowrap">
                                      
                                      <select class="form-control status" name='status' id="status">
                                          
                                          <option value="Engineer Visit Scheduled"> Engineer Visit Scheduled </option>
                                          <option value="Onsite Job Completed"> Onsite Job Completed </option>
                                          <option value="Project Completed"> Project Completed </option>
                                          
                                      </select>
                                      
                                      <p class="price_error" style="color:red;"> </p>
                                      
                                  </td>
                                 
                                  
                                  
                                  <td class="nowrap">
                                      <div class="bidbtngroup"></div><a class="bidbtn bidsubmit" href="javascript:void(0);" data-price="{{ $order->total_amount }}" data-orderid="{{ $order->id }}">Submit</a></div>
                                  </td>
                                  
                                </tr>
                                
                                
                              </tbody>
                              
                             
                            </table>
                            
                             
                              
                          </div>
                          
                          <p id="bidsuccess{{$order->id}}" style="color:green;">  </p>
                              <p id="biderror{{$order->id}}" style="color:red;"> </p>
                    </div>
                </div>
              </div>
              </div>
              </div>
              </div>
        
        
            <!-- End Bid Modal -->
        
        
            @php $i++ @endphp
        
          @endforeach
        </div>
      </form>
        @endforeach
        @endif
        <!--<div class="activitybx">
          <div class="acnch"><a role="button" data-toggle="collapse" href="#Activity" aria-expanded="false" aria-controls="Activity">Activity <i class="fa fa-caret-down"></i></a></div>
          <div class="acnchtable collapse" id="Activity">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Time</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10:15 AM</td>
                    <td>Accepted the project</td>
                  </tr>
                  <tr>
                    <td>10:20 AM</td>
                    <td>Made an offer of &#8377;13,000</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>-->
        <!--<div class="minimumbidbox pagebid">          
          <h5><a href="javascript:void(0);" data-toggle="modal" data-target="#MinBidModal">Minimum bid* &#8377; <span id="min_bid">1000</span></a></h5>          
        </div>-->

      <!-- Minimum Bid Modal -->
        <div class="modal fade bidmodal minbidModal" id="MinBidModal" tabindex="-1" role="dialog" aria-labelledby="minBidModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="minimumbidbox">                  
                  <h3>Enter minimum bid and calculate the profit you can earn with your service </h3>
                  <div class="mintable">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td>
                              <span class="thto">Enter the minimum bid</span>
                              <span class="thbo">Excluding GST</span>
                              <span class="thprleft ththmecolor">&#8377;<input type="text" name="min_bid_amt" id="min_bid_amt" value="1000.00" class="minbidfield"></span>
                              
                              <input type='hidden' class='hidden_service_id'>
                              <!--<button class="sutablebtn" id="submit-min-bid">Submit</button>-->
                              <button class="sutablebtn submit-min-bid" >Submit</button>
                            </td>
                            <td>
                              <span class="thto">GST on Minimum Bid</span>
                              <span class="thbo">@ 18%</span>
                              <span class="thprleft">&#8377;<span id="gst_amt">180.00</span></span>
                            </td>
                            <td>
                              <span class="thto">Total Minimum Bid</span>
                              <span class="thbo">Including GST</span>
                              <span class="thprleft">&#8377;<span id="includeing_gst_amt">1180.00</span></span>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <span class="thto">Altibbe Referral Fee</span>
                              <span class="thbo">15%</span>
                              <span class="thprleft">&#8377;<span id="referral_fee">150.00</span></span>
                            </td>
                            <td>
                              <span class="thto">GST on Total Altibbe fee</span>
                              <span class="thbo">@ 18%</span>
                              <span class="thprleft">&#8377;<span id="gst_altibe">27.00</span></span>
                            </td>
                            <td>
                              <span class="thto">Total Altibbe Service Fees</span>
                              <span class="thbo">Including GST</span>
                              <span class="thprleft">&#8377;<span id="including_gst_altibe">177.00</span></span>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <span class="thto">You Make</span>
                              <span class="thbo">Excluding GST</span>
                              <span class="thprleft">&#8377;<span id="excluding_gst">850.00</span></span>
                            </td>
                            <td>
                              <span class="thto">GST on You Make</span>
                              <span class="thbo">@ 18%</span>
                              <span class="thprleft">&#8377;<span id="gst_make">153.00</span></span>
                            </td>
                            <td>
                              <span class="thto">Total You Make</span>
                              <span class="thbo">Including GST</span>
                              <span class="thprleft">&#8377;<span id="total_gst_make">1003.00</span></span>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <span class="thto">Cost of Service</span>
                              <br>
                              <span class="thprleft ththmecolor">&#8377;<input type="text" name="service_cost" id="service_cost" value="500.00" class="minbidfield"></span>
                              <button class="sutablebtn" id="submit-service-cost">Submit</button>
                            </td>
                            <td valign="middle">
                              <span class="thto profitc">Your Profit </span>
                            </td>
                            <td>
                              <span class="thprleft bigpthbo">&#8377;<span id="profit">503.00</span></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Bid Modal -->
        <!-- Modal -->
        <div class="modal fade bidmodal" id="BidModal" tabindex="-1" role="dialog" aria-labelledby="BidModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Bid Now</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>Equipments</th>
                                  <th class="text-center">Quantity</th>
                                  <th>Location</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Radiography (Fixed)</td>
                                  <td class="text-center">1</td>
                                  <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                                  <td class="nowrap">
                                      <div class="bidbtngroup"></div><a class="bidbtn" href="javascript:void(0);">Bid Now</a></div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Radiography (Fixed)</td>
                                  <td class="text-center">1</td>
                                  <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                                  <td class="nowrap">
                                      <div class="bidbtngroup"></div><a class="bidbtn" href="javascript:void(0);">Bid Now</a></div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Radiography (Fixed)</td>
                                  <td class="text-center">1</td>
                                  <td>A-19 Saheed Nagar, maharishi college road, Bhubaneswar, Odisha 751007</td>
                                  <td class="nowrap">
                                      <div class="bidbtngroup"></div><a class="bidbtn" href="javascript:void(0);">Bid Now</a></div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
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

<script type="text/javascript">
  // Quantity JavaScript
  $(".increase-btn").on("click", function (e) {
  var $button = $(this);
  var oldValue = $button.parent().find('.quantity').val();
  $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
  if ($button.data('action') == "increase") {
  var newVal = parseFloat(oldValue) + 1;
  } else {
  // Don't allow decrementing below 1
  if (oldValue > 1) {
  var newVal = parseFloat(oldValue) - 1;
  } else {
  newVal = 1;
  $button.addClass('inactive');
  }
  }
  $button.parent().find('.quantity').val(newVal);
  e.preventDefault();
  });

  $("#min_bid_amt").on('keyup', function(){
    $bid_amt = $(this).val();
    $gst_amt = parseInt($bid_amt*(18/100));
    $total_gst = parseInt($bid_amt)+parseInt($gst_amt);
    $referral_fee = parseInt($bid_amt*(15/100));
    $gst_altibe = parseInt($referral_fee*(18/100));
    $including_gst_altibe = parseInt($referral_fee)+parseInt($gst_altibe);
    $excluding_gst = parseInt($bid_amt)-parseInt($referral_fee);
    $gst_make = parseInt($excluding_gst*(18/100));
    $total_gst_make = parseInt($excluding_gst)+parseInt($gst_make);
    $service_cost = $("#service_cost").val();
    $profit = parseInt($total_gst_make)-parseInt($service_cost);

    $("#gst_amt").html($gst_amt);
    $("#includeing_gst_amt").html($total_gst);
    $("#referral_fee").html($referral_fee);
    $("#gst_altibe").html($gst_altibe);
    $("#including_gst_altibe").html($including_gst_altibe);
    $("#excluding_gst").html($excluding_gst);
    $("#gst_make").html($gst_make);
    $("#total_gst_make").html($total_gst_make);
    $("#service_cost").html($service_cost);
    $("#profit").html($profit);

  });

  $("#service_cost").on('keyup', function(){
    $total_gst_make = $("#total_gst_make").html();
    $service_cost = $(this).val();
    $profit = parseInt($total_gst_make)-parseInt($service_cost);
    $("#profit").html($profit);
  });

 /* $("#submit-min-bid").click( function(){
    var bid_amt = $("#min_bid_amt").val();
    $("#min_bid").html(bid_amt);
    $('.min-bid').html(bid_amt);
    $('.min_bid_amt').val(bid_amt);
    $("#MinBidModal").modal('hide');
  });*/

  $("#submit-service-cost").click( function(){
    var bid_amt = $("#min_bid_amt").val();
    $("#min_bid").html(bid_amt);
    $('.min-bid').html(bid_amt);
    $('.min_bid_amt').val(bid_amt);
    $("#MinBidModal").modal('hide');
  });
  
  $(".bidsubmit").click( function(){
  
     var orderid = $(this).data('orderid');
      price = $(this).data('price');
     
      var status = $(this).parent().parent().find('td').eq(0).find('.status').val();
      
    
      
       $.ajax({
          type: "POST",
          url: '<?php echo url(''); ?>/user/change_status',
          data: {
            _token:'{{csrf_token()}}',
            orderid:orderid,
            status:status,
          },
          success: function(response)
          {
                 if(response==1){
                     
                     
                     $('#bidsuccess'+orderid).text('Change Status Successfully.');
                     
                     setTimeout(function(){ 
                         
                         
                 
                            $('#BidModal'+orderid).modal('hide'); 
                         
                     }, 5000);
                 
                 
                  
                 }else{
                     
                     
                 
                     //$('#BidModal'+orderid).modal('hide'); 
                     $('#biderror'+orderid).text('Bid Already Accepted');
                     
                      setTimeout(function(){ 
                         
                        
                 
                            $('#BidModal'+orderid).modal('hide'); 
                         
                     }, 5000);
                 }
          }
        });

      
      //var provider_price = document.getElementsByName("provider_price").val();
     
     //alert(provider_price);
     
      
  });
  
  
  
  $(".price_cal_model").click( function(){
    /*var bid_amt = $("#min_bid_amt").val();
    $("#min_bid").html(bid_amt);
    $('.min-bid').html(bid_amt);
    $('.min_bid_amt').val(bid_amt);*/
    var hidden_service_id = $(this).data('id');
    //alert(hidden_service_id);
    $('.hidden_service_id').val(hidden_service_id);
    
   // $('.min-bid'+hidden_service_id).html(bid_amt);
    
    $("#MinBidModal").modal('show');
    
  });
  
   $(".submit-min-bid").click( function(){
    var bid_amt = $("#min_bid_amt").val();
     bid_id = $(".hidden_service_id").val();
    $("#min_bid").html(bid_amt);
    $('.min-bid'+bid_id).html(bid_amt);
    $('.min_bid_amt').val(bid_amt);
    $("#MinBidModal").modal('hide');
  });
  
  
</script>

@endsection