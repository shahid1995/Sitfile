@extends('layouts.userinner')
@section('title', 'Profile')
@section('content')

<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
  <div class="profile_block myorderouter">
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
          <h3>Lost</h3>
        </div>
        @if(!empty($order_details))
            @foreach($order_details as $order)
            @php $services = DB::table('service_order_equipment_services as soe')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order->id)->whereIn('soe.service_id', $service_type)->groupBy('soe.service_id')->get();
            $tot=count($services) @endphp
        <div class="plan_details_table">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Offer Placed</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Total Equipment</th>
                  <th class="text-center">Total Location</th>
                  <th>Offer # {{ $order->invoice_no }}</th>                             
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                  <td class="text-center">&#8377; {{ $tot }}</td>
                  <td class="text-center">{{ $tot }}</td>
                  <td class="text-center">{{ $tot }}</td>
                  <td>&nbsp;</td>
                </tr>
              </tbody>
            </table>
          </div>
          @foreach($services as $service)
            @php $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get(); @endphp
          <div class="tableheading">
            <div class="tbleft">
              <h4>{{ $service->service_name }}</h4>
            </div>
            <div class="tbright">
              <div class="tbrightinner">
                <a class="managebtn" href="javascript:void(0);">Manage Order</a>
              </div>
            </div>
          </div>
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
                @foreach($service_details as $service_dt)
                <tr>
                  <td>{{ $service_dt->equipments }}</td>
                  <td class="text-center">{{ $service_dt->quantity }}</td>
                  <td>{{ $service_dt->location }}</td>
                  <td class="nowrap">
                    
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
           @endforeach
        </div>
        @endforeach
        @endif
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