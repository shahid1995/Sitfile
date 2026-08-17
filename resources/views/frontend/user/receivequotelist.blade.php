@extends('layouts.userinner')
@section('title', 'Quotelist')
@section('content')
<!--========================= profile body section start =========================-->	
	                
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">

	@if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            @lang('sitelanguage.update_account_success_msg')
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
			<h2><!-- @lang('sitelanguage.editprofile') -->Quote List</h2>
		</div>
    <div class="row">
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
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="table-responsive">
          <table class="table table-bordered modifiedtable">
            <thead>
              <tr>
                <th>Vendor Name</th>
                <th>Price Quote</th>
                <!-- <th>Rating</th> -->
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($receive_qoute as $request_list_data)
              <tr>
                <td><a href="javascript:void(0);" class="vendor vendar-details" data-toggle="modal" data-vendar="{{ $request_list_data->vender_id }}" data-target="#SellerModal"> {{$request_list_data->vendar_name}} </a></td>
                <td> ${{$request_list_data->vendar_price}} </td>
                <!-- <td>
                  <i class="fa fa-rating fa-star"></i>
                  <i class="fa fa-rating fa-star"></i>
                  <i class="fa fa-rating fa-star"></i>
                  <i class="fa fa-rating fa-star"></i>
                  <i class="fa fa-rating fa-star-o"></i>
                </td> -->
                <td>
                  <a class="bookbtn" href="{{url('/')}}/user/booking-vendor/{{ $request_list_data->id }}/{{$customer_request_id}}">Booking</a>
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

<div id="SellerModal" class="modal fade sellerdetailsmodal" role="dialog">
  <div class="modal-dialog">
    <!-- <div class="modal-content">
    	<div class="modal-body">
    		<button type="button" class="close" data-dismiss="modal">×</button>
    		<div class="sellermodalinner">
          <div class="selleruserbox">
            <div class="sellerimag">
              <img src="http://keenthemes.com/preview/metronic/theme/assets/pages/media/profile/profile_user.jpg" />
            </div>
            <div class="sellerusercontent">
              <h4>Koushik Mukherjee</h4>
              <p>India</p>
            </div>
          </div>
          <dl class="dl-horizontal">
            <dt>Email</dt>
            <dd>koushik.mukherjee@gmail.com</dd>
            <hr>
            <dt>Phone Number</dt>
            <dd>9336738638</dd>
            <hr>
            
            <dt>Company Name</dt>
            <dd>Webguru Infosystems</dd>
            <hr>
            <dt>Rating</dt>
            <dd><i class="fa farating fa-star"></i><i class="fa farating fa-star"></i><i class="fa farating fa-star"></i><i class="fa farating fa-star"></i><i class="fa  farating fa-star-o"></i></dd>
            <hr>
          </dl>
        </div>
    	</div>
    </div> -->
    <div id="vendar_data"> </div>
  </div>
</div>
<!--========================= profile body section end =========================-->
	

  <script type="text/javascript">
  $(function() {
  $(".vendar-details").on('click',function() {
      var lang = '<?php echo $locale =app()->getLocale(); ?>';
          var vendar_id = $(this).data('vendar');
            //alert(vendar_id); 
             var token = '<?php echo csrf_token() ?>';

            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              var url_val='{{ url('/') }}/user/vendar-details/'+vendar_id;                 

              $.ajax({
                url: url_val,
                method: 'get',
                success: function(result){
                  
                    $("#vendar_data").html(result);                          
                   
                  }
              });

              });
              });


</script>

@endsection