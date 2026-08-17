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
	    @if (session('error'))
	        <div class="alert alert-danger alert-dismissible">
	            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	            {{ session('error') }}
	        </div>
	    @endif 
      
    <div class="service_tab">       
      <div class="plan_history">
       <ul class="nav nav-tabs" style="margin-bottom:10px;">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/user/servicerequest_new') }}">New</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/user/servicerequest_completed') }}">Completed</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/user/servicerequest_expired') }}">Expired/Declined</a>
        </li>
      </ul>
      <div class="cheadbx">
        <h3>New</h3>
      </div>
      <div class="plan_details_table">
       @php //@if(!empty($order_details)) @endphp
        
        @if(!empty($order_details))
        
        
        
        @foreach($order_details as $order)
        
        
        
        @if($order->assign==1)
        @if($order->decline_jobs==0)
        
         @php // $services = DB::table('service_order_equipment_services as soe')->leftjoin('services','soe.service_id','=','services.id')->where('soe.order_id',$order->id)->whereIn('soe.service_id', $service_type)->groupBy('soe.service_id')->get(); @endphp
        @php $services = DB::table('service_order_equipment_services as soe')->leftjoin('services','soe.service_id','=','services.id')->where('soe.order_id',$order->id)->groupBy('soe.service_id')->get();
        $tot=count($services) @endphp
        
        @php 
        
            //dd($services);
        
        @endphp
        
        
        
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Offer Placed</th>
                <th class="text-center"># Of Offer</th>
                <th class="text-center">Total Equipment</th>
                <!--<th class="text-center">Total Location</th>-->
                <th>Offer # {{ $order->invoice_no }} </th>                             
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
        
        @php 
        
            //dd($service_details);
        
        @endphp
        
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
            
             @if($i==10)
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
                  <!--<th>Location</th>-->
                  @if($i==1)
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                  
                @foreach($service_details as $service_dt)
                <tr>
                  <td>{{ $service_dt->equipments }}</td>
                  <td class="text-center">{{ $service_dt->quantity }}</td>
                  <td>{{ $service_dt->location }}</td>
                  <td></td>
                </tr>
                @endforeach
                <tr>
                    
                @if($i==1)
                    
                  <td class="nowrap" colspan="4" align="right">
                      
                     
                    <div class="acebtngroup">  
                    
                    <span class="ptext">&#8377; {{ $order->total_amount }}</span>
                      <!--<a class="acebtn" href="javascript:void(0);">Accept Job</a>-->
                      <button class="acebtn" type="submit">Accept Job </button>
                      <!--<a class="acebtn" href="{{ url('user/servicerequest_new/'.$order->id) }}">Decline Job</a>-->
                      <a class="acebtn" href="{{ url('user/servicerequest_new?declined=').$order->id }}">Decline Job</a>
                    </div>
                  </td>
                  
                  @endif
                  
                </tr>
              </tbody>
            </table>
          </div>
        </form>
        
        @php $i++ @endphp
        @endforeach
        @endif
        @endif
        
        
        @endforeach
        @endif
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
</script>

@endsection