@extends('layouts.userinner')
@section('title', 'Quotelist')
@section('content')
<!--========================= profile body section start =========================-->	
	                
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">

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
		<div class="heading-title">
			<h2><!-- @lang('sitelanguage.editprofile') -->Request Quote List</h2>
		</div>
   <!--  <div class="row">
      <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
        <form class="filterform" method="post">
          <div class="form-group">
            <select class="selectpicker" data-live-search="true">
              <option selected="" data-icon="fa fa-star"> Search by Rating</option>
              <option data-icon="fa fa-star"> One Star</option>
              <option data-icon="fa fa-star"> Two Star</option>
              <option data-icon="fa fa-star"> Three Star</option>
              <option data-icon="fa fa-star"> Four Star</option>
              <option data-icon="fa fa-star"> Five Star</option>
            </select>
          </div>
        </form>
      </div>
    </div> -->
    <div class="row">
      <div class="col-xs-12">
        <div class="datatabl">
        <div class="table-responsive">

          <table class="table table-bordered modifiedtable" id="table_id">
            <thead>
              <tr>
                <th>Quote Id</th>
                <th>Pickup Address</th>
                <th>Drop Address</th>
                <th>Delivery Type</th>
                <th>Truck Type</th>
                <th>Weight(KG)</th>
                <th>Height</th>
                <th>Width</th>
                <th>Length</th>                
                <th>Post Date</th>                
                <th>Submit Price</th>
              </tr>
            </thead>
            <tbody>
               @foreach($request_list as $request_list_data)
              <tr>

                <td> {{$request_list_data->quote_id}} </td>
               
                <td> {{$request_list_data->country_name}}, {{$request_list_data->state_name}}, {{$request_list_data->city_name}}, {{$request_list_data->zip_code}}</td>

                <td> {{$request_list_data->country_to_name}}, {{$request_list_data->state_to_name}}, {{$request_list_data->city_to_name}}, {{$request_list_data->zip_code_to}}</td>
                <td> {{$request_list_data->delevery_type}} </td>
                <td> {{$request_list_data->truck_type}} </td>
                <td> {{$request_list_data->weight}} </td>
                <td> {{$request_list_data->hight}} </td>
                <td> {{$request_list_data->width}} </td>
                <td> {{$request_list_data->length}} </td>
                <td> {{date('Y-m-d',strtotime($request_list_data->created_at))}} </td>
                 <td>

                  @if($request_list_data->payment_status == '1')

                  

                  <a href="{{ url('user/assign-driver/')}}/{{$request_list_data->id}}"> <button type="button" class="bookbtn"> Assign Consignment To Truck Driver </button> </a>
                  
                  @else

                  <form enctype="multipart/form-data" method="POST" action="{{ route('send_price') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="number" name="vendar_price" required="" value="{{$request_list_data->vendarprice}}"> </br>
                  <input type="hidden" name="customer_request_id" value="{{$request_list_data->id}}">
                  <input type="hidden" name="customer_id" value="{{$request_list_data->customer_id}}">
                  <input type="hidden" name="price_id" value="{{$request_list_data->price_id}}">
                  <button type="Submit" class="bookbtn">Send</button>
                  </form>

                  @endif


                </td>
                
              </tr>
             @endforeach
             
             
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
		
	</div>
</div>		
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>			

<script type="text/javascript">
  
  $( document ).ready(function() {

    $('#table_id').DataTable();

  }); 

</script>
<!--========================= profile body section end =========================-->
	
@endsection