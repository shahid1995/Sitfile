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
      
    <div class="logheading">
      <h2>My Orders</h2>
    </div>
    <div class="service_tab">				
      <ul class="nav nav-tabs" role="tablist">
        <li role="OpenOrders" class="active"><a href="#OpenOrders" aria-controls="OpenOrders" role="tab" data-toggle="tab">Open Orders</a></li>
        <li role="Orders"><a href="#Orders" aria-controls="Orders" role="tab" data-toggle="tab">Orders</a></li>
        <li role="presentation"><a href="#CancelledOrders" aria-controls="CancelledOrders" role="tab" data-toggle="tab">Canceled Orders</a></li>
      </ul>
      <div class="tab-content">
         <div class="ordersearch">
                <div class="row">
                    <form action="">
                        
                        @php 
                        
                        $recent_year = date('Y');
                            
                        @endphp
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label>Orders placed in</label>
                        <div class="form-group">
                            <i class="fa fa-angle-down"></i>
                            <select class="form-control" name="year">
                                <!--<option @if($year=='2020') selected @endif>2020</option>
                                <option @if($year=='2019') selected @endif>2019</option>
                                <option @if($year=='2018') selected @endif>2018</option>
                                <option @if($year=='2017') selected @endif>2017</option>
                                <option @if($year=='2016') selected @endif>2016</option>
                                <option @if($year=='2015') selected @endif>2015</option>-->
                                
                                
                                
                                @for($i=2015; $i <= $recent_year; $i++ )
                                
                                <option @if($year==$i) selected @endif> {{$i}} </option>
                                @endfor
                                
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <button class="ordersearchbtn" type="submit">Search <i class="fa fa-search"></i></button>
                    </div>
                    </form>
                </div>
            </div>
        <div role="OpenOrders" class="tab-pane active" id="OpenOrders">
          <div class="plan_history">
            
            @if(!empty($order_details))
            @foreach($order_details as $order)
            @if(count(array($order)) > 0)
            @php $services = DB::table('service_order_equipment_services as soe')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order->id)->groupBy('soe.service_id')->get();
            $tot=count(array($services)) 
            
            
            @endphp
            <div class="plan_details_table">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Order Placed</th>
                      <th class="text-center">Total</th>
                      <th class="text-center">Total Equipment</th>
                      <th class="text-center">Details</th>
                      <th>Order # {{ $order->invoice_no }}</th>			            						
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                      <td class="text-center">INR {{ $order->total_amount }}</td>
                      <td class="text-center"> {{ $order->machine_quantity }}</td>
                      <td class="text-center">
                          
                          <a href="{{ url('orderplaced?order_id='.$order->id) }}" class="actbtn">Details</a>
                          
                          @if($order->accept_job)
                          
                          <a href="{{ url('orderplaced?inv_order_id='.$order->id) }}" class="actbtn">Download</a>
                          
                          @endif
                          
                          </td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              @foreach($services as $service)
            @php $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get(); @endphp
              <h4><strong>{{ $service->service_name }}</strong></h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Equipments</th>
                      <th class="text-center">Quantity</th>
                      <th>Location</th>
                      <th>Service Status:</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td></td>
                      </tr>
                    @foreach($service_details as $service_dt)
                    <tr>
                      <td>{{ $service_dt->equipments }}</td>
                      <td class="text-center">{{ $service_dt->quantity }}</td>
                      <td>{{ $order->city }}</td>
                      <td>{{ $order->order_status }}</td>
                    </tr>
                    @endforeach
                    <tr>
                      <td colspan="3"><!--<a href="{{ url('user/myorders?reschedule_bid=').$order->id }}" class="btn btn-primary btn-sm">Reschedule</a>--></td>
                      <td><!--<p>Your appointment date and time will schedule by email or text</p>-->
                    @if($order->is_bid_accepted==1 && $order->accept_job==0) <a href="{{ url('user/myorders?confirm_bid=').$order->id }}" class="btn btn-primary btn-sm">Confirm</a>
                    
                    @elseif($order->accept_job==1)
                    
                    <!--<a href="javascript:void(0);" class="btn btn-primary btn-sm">Order Confirmed</a>-->
                    
                    @endif </td> 
                    </tr>
                  </tbody>
                </table>
              </div>
              @endforeach
            </div>
            @endif
            @endforeach
            @endif
          </div>
        </div>
        <div role="Orders" class="tab-pane" id="Orders">
            @if(!empty($order_details))
            @foreach($order_details as $order)
            @if($order->is_bid_accepted==1)
            @php $services = DB::table('service_order_equipment_services as soe')->join('services','soe.service_id','=','services.id')->where('soe.order_id',$order->id)->groupBy('soe.service_id')->get();
            $tot=count(array($services)) @endphp
            <div class="plan_details_table">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Order Placed</th>
                      <th class="text-center">Total</th>
                      <th class="text-center">Total Equipment</th>
                      <th class="text-center">Total Location</th>
                      <th>Order # {{ $order->invoice_no }}</th>                             
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                      <td class="text-center">INR {{ $order->total_amount }}</td>
                      <td class="text-center">{{ $tot }}</td>
                      <td class="text-center">
                          
                          <a href="{{ url('orderplaced?order_id='.$order->id) }}" class="actbtn">Details</a>
                          
                          
                      
                     
                     
                      
                      </td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="plan_details_table">
              @foreach($services as $service)
            @php $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get(); @endphp
              <h4><strong>{{ $service->service_name }}</strong></h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Equipments</th>
                      <th class="text-center">Quantity</th>
                      <th>Location </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($service_details as $service_dt)
                    <tr>
                      <td>{{ $service_dt->equipments }}</td>
                      <td class="text-center">{{ $service_dt->quantity }}</td>
                      <td>{{ $service_dt->location }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @endforeach
            </div>
            @endif
            @endforeach
            @endif
        </div>
        <div role="tabpanel" class="tab-pane" id="CancelledOrders">
            @if(!empty($order_details))
            @foreach($order_details as $order)
            @if($order->status==2)
            @php $services = DB::table('service_order_equipment_services as soe')->leftjoin('services','soe.service_id','=','services.id')->where('order_id',$order->id)->get();
            $tot=count(array($services)) @endphp
            <div class="plan_details_table">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Order Placed</th>
                      <th class="text-center">Total</th>
                      <th class="text-center">Total Equipment</th>
                      <th class="text-center">Total Location</th>
                      <th>Order # {{ $order->invoice_no }}</th>                             
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                      <td class="text-center">INR {{ $order->total_amount }}</td>
                      <td class="text-center">{{ $tot }}</td>
                      <td class="text-center"><a href="{{ url('orderplaced?order_id='.$order->id) }}" class="actbtn">Invoice</a></td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="plan_details_table">
              @foreach($services as $service)
            @php $service_details = DB::table('service_order_equipment_services')->where('service_id',$service->service_id)->where('order_id',$service->order_id)->get(); @endphp
              <h4><strong>{{ $service->service_name }}</strong></h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Equipments</th>
                      <th class="text-center">Quantity</th>
                      <th>Location2</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($service_details as $service_dt)
                    <tr>
                      <td>{{ $service_dt->equipments }}</td>
                      <td class="text-center">{{ $service_dt->quantity }}</td>
                      <td>{{ $service_dt->location }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @endforeach
            </div>
            @endif
            @endforeach
            @endif
        </div>
      </div>
    </div>
  </div>
</div>

@endsection